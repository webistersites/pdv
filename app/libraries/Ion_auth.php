<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ion_auth {

    protected $status;
    public $_extra_where = array();
    public $_extra_set = array();
    public $_cache_user_in_group;

    public function __construct() {
        $this->load->config('ion_auth', TRUE);

        // Load IonAuth MongoDB model if it's set to use MongoDB,
        $this->load->model('auth_model');

        $this->_cache_user_in_group = & $this->auth_model->_cache_user_in_group;

        //auto-login the user if they are remembered
        if (!$this->logged_in() && get_cookie('identity') && get_cookie('remember_code')) {
            $this->auth_model->login_remembered_user();
        }

        $this->auth_model->trigger_events('library_constructor');
    }

    public function __call($method, $arguments) {
        if (!method_exists($this->auth_model, $method)) {
            throw new Exception('Undefined method Ion_auth::' . $method . '() called');
        }

        return call_user_func_array(array($this->auth_model, $method), $arguments);
    }

    public function __get($var) {
        return get_instance()->$var;
    }

    public function forgotten_password($identity) {    //changed $email to $identity
        if ($this->auth_model->forgotten_password($identity)) {   //changed
            // Get user information
            $user = $this->where($this->config->item('identity', 'ion_auth'), $identity)->where('active', 1)->users()->row();  //changed to get_user_by_identity from email

            if ($user) {
                $data = array(
                    'identity' => $user->{$this->config->item('identity', 'ion_auth')},
                    'forgotten_password_code' => $user->forgotten_password_code
                );

                if (!$this->config->item('use_ci_email', 'ion_auth')) {
                    $this->set_message('forgot_password_successful');
                    return $data;
                } else {

                    $this->load->library('parser');
                    $parse_data = array(
                        'user_name' => $user->first_name.' '.$user->last_name,
                        'email' => $user->email,
                        'reset_password_link' => anchor('auth/reset_password/'. $user->forgotten_password_code, lang('reset_password')),
                        'site_link' => base_url(),
                        'site_name' => $this->Settings->site_name,
                        'logo' => '<img src="' . base_url() . 'uploads/' . $this->Settings->logo . '" alt="' . $this->Settings->site_name . '"/>'
                    );
                    $msg = read_file('./themes/' . $this->theme . 'email_templates/forgot_password.html');
                    $message = $this->parser->parse_string($msg, $parse_data);
                    $message = $message."<br>".lang('reset_password_link_alt')."<br>".site_url('auth/reset_password/'. $user->forgotten_password_code);

                    $subject = lang('email_forgotten_password_subject').' - '.$this->Settings->site_name;
                     if ($this->tec->send_email($user->email, $subject, $message)) {
                        $this->set_message('forgot_password_successful');
                        return TRUE;
                    } else {
                        $this->set_error('sending_email_failed');
                        return FALSE;
                    }
                }
            } else {
                $this->set_error('forgot_password_unsuccessful');
                return FALSE;
            }
        } else {
            $this->set_error('forgot_password_unsuccessful');
            return FALSE;
        }
    }

    public function forgotten_password_complete($code) {
        $this->auth_model->trigger_events('pre_password_change');

        $identity = $this->config->item('identity', 'ion_auth');
        $profile = $this->where('forgotten_password_code', $code)->users()->row(); //pass the code to profile

        if (!$profile) {
            $this->auth_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
            $this->set_error('password_change_unsuccessful');
            return FALSE;
        }

        $new_password = $this->auth_model->forgotten_password_complete($code, $profile->salt);

        if ($new_password) {
            $data = array(
                'identity' => $profile->{$identity},
                'new_password' => $new_password
            );
            if (!$this->config->item('use_ci_email', 'ion_auth')) {
                $this->set_message('password_change_successful');
                $this->auth_model->trigger_events(array('post_password_change', 'password_change_successful'));
                return $data;
            } else {
                $message = $this->load->view($this->config->item('email_templates', 'ion_auth') . $this->config->item('email_forgot_password_complete', 'ion_auth'), $data, true);

                $this->email->clear();
                //$this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
                $this->email->from($this->admin_email, SITE_NAME);
                $this->email->to($profile->email);
                $this->email->subject($this->config->item('site_title', 'ion_auth') . ' - ' . $this->lang->line('email_new_password_subject'));
                $this->email->message($message);

                if ($this->email->send()) {
                    $this->set_message('password_change_successful');
                    $this->auth_model->trigger_events(array('post_password_change', 'password_change_successful'));
                    return TRUE;
                } else {
                    $this->set_error('password_change_unsuccessful');
                    $this->auth_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
                    return FALSE;
                }
            }
        }

        $this->auth_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
        return FALSE;
    }

    public function forgotten_password_check($code) {
        $profile = $this->where('forgotten_password_code', $code)->users()->row(); //pass the code to profile

        if (!is_object($profile)) {
            $this->set_error('password_change_unsuccessful');
            return FALSE;
        } else {
            if ($this->config->item('forgot_password_expiration', 'ion_auth') > 0) {
                //Make sure it isn't expired
                $expiration = $this->config->item('forgot_password_expiration', 'ion_auth');
                if (time() - $profile->forgotten_password_time > $expiration) {
                    //it has expired
                    $this->clear_forgotten_password_code($code);
                    $this->set_error('password_change_unsuccessful');
                    return FALSE;
                }
            }
            return $profile;
        }
    }

    public function register($username, $password, $email, $additional_data = array(), $active = FALSE, $notify = FALSE) { //need to test email activation
        $this->auth_model->trigger_events('pre_account_creation');

        $email_activation = $this->config->item('email_activation', 'ion_auth');

        if (!$email_activation || $active == '1') {
            $id = $this->auth_model->register($username, $password, $email, $additional_data, $active);
            if ($id !== FALSE) {
                if ($notify) {
                    $this->load->library('parser');
                    $parse_data = array(
                        'client_name' => $additional_data['first_name'].' '.$additional_data['last_name'],
                        'site_link' => site_url(),
                        'site_name' => $this->Settings->site_name,
                        'email' => $email,
                        'password' => $password,
                        'logo' => '<img src="'.base_url().'uploads/'.$this->Settings->logo.'" alt="'.$this->Settings->site_name.'"/>'
                    );

                    $msg = read_file('./themes/' . $this->theme . 'email_templates/credentials.html');
                    $message = $this->parser->parse_string($msg, $parse_data);
                    $subject = $this->lang->line('new_user_created').' - '.$this->Settings->site_name;
                    $this->tec->send_email($email, $subject, $message);
                }

                $this->set_message('account_creation_successful');
                $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful'));
                return $id;
            } else {
                $this->set_error('account_creation_unsuccessful');
                $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
                return FALSE;
            }
        } else {
            $id = $this->auth_model->register($username, $password, $email, $additional_data, $active);

            if (!$id) {
                $this->set_error('account_creation_unsuccessful');
                return FALSE;
            }

            $deactivate = $this->auth_model->deactivate($id);

            if (!$deactivate) {
                $this->set_error('deactivate_unsuccessful');
                $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
                return FALSE;
            }

            $activation_code = $this->auth_model->activation_code;
            $identity = $this->config->item('identity', 'ion_auth');
            $user = $this->auth_model->user($id)->row();

            $data = array(
                'identity' => $user->{$identity},
                'id' => $user->id,
                'email' => $email,
                'activation' => $activation_code,
            );
            if (!$this->config->item('use_ci_email', 'ion_auth')) {
                $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
                $this->set_message('activation_email_successful');
                return $data;
            } else {

                $this->load->library('parser');
                $parse_data = array(
                    'client_name' => $additional_data['first_name'].' '.$additional_data['last_name'],
                    'site_link' => site_url(),
                    'site_name' => $this->Settings->site_name,
                    'email' => $email,
                    'activation_link' => anchor('auth/activate/'. $data['id'] .'/'. $data['activation'], lang('email_activate_link')),
                    'logo' => '<img src="'.base_url().'uploads/'.$this->Settings->logo.'" alt="'.$this->Settings->site_name.'"/>'
                );

                $msg = read_file('./themes/' . $this->theme . 'email_templates/activate_email.html');
                $message = $this->parser->parse_string($msg, $parse_data);
                $subject = $this->lang->line('email_activation_subject').' - '.$this->Settings->site_name;

                if ($this->tec->send_email($email, $subject, $message)) {
                    $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
                    $this->set_message('activation_email_successful');
                    return $id;
                }
            }

            $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful', 'activation_email_unsuccessful'));
            $this->set_error('activation_email_unsuccessful');
            return FALSE;
        }
    }

    public function logout() {
        $this->auth_model->trigger_events('logout');

        if ($this->Settings->mmode) {
            if (!$this->ion_auth->in_group('owner')) {
                $this->set_message('site_is_offline_plz_try_later');
            } else {
                $this->set_message('logout_successful');
            }
        }

        $identity = $this->config->item('identity', 'ion_auth');
        $this->session->unset_userdata(array($identity => '', 'id' => '', 'user_id' => ''));

        //delete the remember me cookies if they exist
        if (get_cookie('identity')) {
            delete_cookie('identity');
        }
        if (get_cookie('remember_code')) {
            delete_cookie('remember_code');
        }
        /*if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach ($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time() - 1000);
                setcookie($name, '', time() - 1000, '/');
            }
        }*/

        //Destroy the session
        $this->session->sess_destroy();

        return TRUE;
    }


    public function logged_in() {
        $this->auth_model->trigger_events('logged_in');

        return (bool) $this->session->userdata('identity');
    }

    public function get_user_id() {
        $user_id = $this->session->userdata('user_id');
        if (!empty($user_id)) {
            return $user_id;
        }
        return null;
    }

    public function in_group($check_group, $id = false) {
        $this->auth_model->trigger_events('in_group');

        $id || $id = $this->session->userdata('user_id');

        $group = $this->getUserGroup($id);

        if($group->name === $check_group) {
            return TRUE;
        }

        return FALSE;
    }

    public function getUserGroup($user_id = false) {
        $user_id || $user_id = $this->session->userdata('user_id');

        $group_id = $this->getUserGroupID($user_id);
        return $this->ion_auth->group($group_id)->row();

    }

    public function getUserGroupID($user_id = false) {
        $user_id || $user_id = $this->session->userdata('user_id');

        $user = $this->ion_auth->user($user_id)->row();
        return $user->group_id;
    }


}
