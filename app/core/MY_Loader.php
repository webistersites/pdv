<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader{
	
    function __construct()
    {
        parent::__construct();
    }

    public function view($view, $vars = array(), $return = FALSE) {
        $nv = $view;
        $path = explode('/', $view);
        if($path[0] != 'default') {
            $file = str_replace('/', DIRECTORY_SEPARATOR, $view).'.php';
            if(!file_exists(VIEWPATH.$file)) { 
                die($path[0]);
                $len = count($path); $i = 0;
                $path[0] = 'default';  $nv = '';
                foreach($path as $p) {
                    if ($i == $len - 1) {
                        $nv .= $p;
                    } else {
                        $nv .= $p.'/';
                    }
                    $i++;
                }
            }
        }
        
        return $this->_ci_load(array('_ci_view' => $nv, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
    }

}
