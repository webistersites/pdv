<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pos extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		if (!$this->loggedIn) {
			redirect('login');
		}
		$this->load->library('form_validation');
		$this->load->model('pos_model');

	}

	function index($sid = NULL, $eid = NULL)
	{
		if( $this->input->get('hold') ) { $sid = $this->input->get('hold'); }
		if( $this->input->get('edit') ) { $eid = $this->input->get('edit'); }
		if( $this->input->post('eid') ) { $eid = $this->input->post('eid'); }
		if( $this->input->post('did') ) { $did = $this->input->post('did'); } else { $did = NULL; }
		if($eid && !$this->Admin){
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'pos');
		}
		if (!$this->Settings->default_customer || !$this->Settings->default_category) {
			$this->session->set_flashdata('warning', lang('please_update_settings'));
			redirect('settings');
		}
		if ($register = $this->pos_model->registerData($this->session->userdata('user_id'))) {
			$register_data = array('register_id' => $register->id, 'cash_in_hand' => $register->cash_in_hand, 'register_open_time' => $register->date);
			$this->session->set_userdata($register_data);
		} else {
			$this->session->set_flashdata('error', lang('register_not_open'));
			redirect('pos/open_register');
		}

		$suspend = $this->input->post('suspend') ? TRUE : FALSE;

		$this->form_validation->set_rules('customer', lang("customer"), 'trim|required');

		if ($this->form_validation->run() == true) {

			$quantity = "quantity";
			$product = "product";
			$unit_cost = "unit_cost";
			$tax_rate = "tax_rate";

			$date = date('Y-m-d H:i:s');
			$customer_id = $this->input->post('customer_id');
			$customer_details = $this->pos_model->getCustomerByID($customer_id);
			$customer = $customer_details->name;
			$note = $this->tec->clear_tags($this->input->post('spos_note'));

			$total = 0;
			$product_tax = 0;
			$order_tax = 0;
			$product_discount = 0;
			$order_discount = 0;
			$percentage = '%';
			$i = isset($_POST['product_id']) ? sizeof($_POST['product_id']) : 0;
			for ($r = 0; $r < $i; $r++) {
				$item_id = $_POST['product_id'][$r];
				$real_unit_price = $this->tec->formatDecimal($_POST['real_unit_price'][$r]);
				$item_quantity = $_POST['quantity'][$r];
				$item_discount = isset($_POST['product_discount'][$r]) ? $_POST['product_discount'][$r] : '0';

				if (isset($item_id) && isset($real_unit_price) && isset($item_quantity)) {
					$product_details = $this->site->getProductByID($item_id);
					$unit_price = $real_unit_price;

					$pr_discount = 0;
					if (isset($item_discount)) {
					    $discount = $item_discount;
					    $dpos = strpos($discount, $percentage);
					    if ($dpos !== false) {
					        $pds = explode("%", $discount);
					        $pr_discount = (($this->tec->formatDecimal($unit_price)) * (Float)($pds[0])) / 100;
					    } else {
					        $pr_discount = $this->tec->formatDecimal($discount);
					    }
					}
					$unit_price = $this->tec->formatDecimal($unit_price - $pr_discount);
					$item_net_price = $unit_price;
					$pr_item_discount = $this->tec->formatDecimal($pr_discount * $item_quantity);
					$product_discount += $pr_item_discount;

					$pr_item_tax = 0; $item_tax = 0; $tax = "";
						if (isset($product_details->tax) && $product_details->tax != 0) {

					        if ($product_details && $product_details->tax_method == 1) {
					            $item_tax = $this->tec->formatDecimal((($unit_price) * $product_details->tax) / 100);
					            $tax = $product_details->tax . "%";
					        } else {
					            $item_tax = $this->tec->formatDecimal((($unit_price) * $product_details->tax) / (100 + $product_details->tax));
					            $tax = $product_details->tax . "%";
					            $item_net_price -= $item_tax;
					        }

						    $pr_item_tax = $this->tec->formatDecimal($item_tax * $item_quantity);

						}

					$product_tax += $pr_item_tax;
					$subtotal = (($item_net_price * $item_quantity) + $pr_item_tax);

					$products[] = array(
						'product_id' => $item_id,
						'quantity' => $item_quantity,
						'unit_price' => $unit_price,
						'net_unit_price' => $item_net_price,
						'discount' => $item_discount,
						'item_discount' => $pr_item_discount,
						'tax' => $tax,
						'item_tax' => $pr_item_tax,
						'subtotal' => $subtotal,
						'real_unit_price' => $real_unit_price,
						'cost' => $product_details->cost
						);

					$total += $item_net_price * $item_quantity;

				}
			}
			if (empty($products)) {
				$this->form_validation->set_rules('product', lang("order_items"), 'required');
			} else {
				krsort($products);
			}

			if ($this->input->post('order_discount')) {
				$order_discount_id = $this->input->post('order_discount');
				$opos = strpos($order_discount_id, $percentage);
				if ($opos !== false) {
					$ods = explode("%", $order_discount_id);
					$order_discount = $this->tec->formatDecimal((($total + $product_tax) * (Float)($ods[0])) / 100);
				} else {
					$order_discount = $this->tec->formatDecimal($order_discount_id);
				}
			} else {
				$order_discount_id = NULL;
			}
			$total_discount = $this->tec->formatDecimal($order_discount + $product_discount);

			if($this->input->post('order_tax')) {
				$order_tax_id = $this->input->post('order_tax');
				$opos = strpos($order_tax_id, $percentage);
				if ($opos !== false) {
					$ots = explode("%", $order_tax_id);
					$order_tax = $this->tec->formatDecimal((($total + $product_tax - $order_discount) * (Float)($ots[0])) / 100);
				} else {
					$order_tax = $this->tec->formatDecimal($order_tax_id);
				}

			} else {
				$order_tax_id = NULL;
				$order_tax = 0;
			}

			$total_tax = $this->tec->formatDecimal($product_tax + $order_tax);
			$grand_total = $this->tec->formatDecimal($this->tec->formatDecimal($total) + $total_tax - $order_discount);
			$paid = $this->input->post('amount') ? $this->input->post('amount') : 0;
			if(!$eid) {
				$status = 'due';
				if ($grand_total > $paid && $paid > 0) {
					$status = 'partial';
				} elseif ($grand_total <= $paid) {
					$status = 'paid';
				}
			}
			$round_total = $this->tec->roundNumber($grand_total, $this->Settings->rounding);
			$rounding = $this->tec->formatMoney($round_total - $grand_total);

			$data = array('date' => $date,
				'customer_id' => $customer_id,
				'customer_name' => $customer,
				'total' => $this->tec->formatDecimal($total),
				'product_discount' => $this->tec->formatDecimal($product_discount),
				'order_discount_id' => $order_discount_id,
				'order_discount' => $order_discount,
				'total_discount' => $total_discount,
				'product_tax' => $this->tec->formatDecimal($product_tax),
				'order_tax_id' => $order_tax_id,
				'order_tax' => $order_tax,
				'total_tax' => $total_tax,
				'grand_total' => $grand_total,
				'total_items' => $this->input->post('total_items'),
				'total_quantity' => $this->input->post('total_quantity'),
				'rounding' => $rounding,
				'paid' => $paid,
				'status' => $status,
				'created_by' => $this->session->userdata('user_id'),
				'note' => $note
				);
			if($suspend) {
				$data['hold_ref'] = $this->input->post('hold_ref');
			}

			if (!$suspend && $paid) {
				$amount = $this->tec->formatDecimal($paid > $grand_total ? ($paid - $this->input->post('balance_amount')) : $paid);
				$payment = array(
					'date' => $date,
					'amount' => $amount,
					'customer_id' => $customer_id,
					'paid_by' => $this->input->post('paid_by'),
					'cheque_no' => $this->input->post('cheque_no'),
					'cc_no' => $this->input->post('cc_no'),
					'gc_no' => $this->input->post('paying_gift_card_no'),
					'cc_holder' => $this->input->post('cc_holder'),
					'cc_month' => $this->input->post('cc_month'),
					'cc_year' => $this->input->post('cc_year'),
					'cc_type' => $this->input->post('cc_type'),
					'cc_cvv2' => $this->input->post('cc_cvv2'),
					'created_by' => $this->session->userdata('user_id'),
					'note' => $this->input->post('payment_note'),
					'pos_paid' => $this->tec->formatDecimal($this->input->post('amount')),
					'pos_balance' => $this->tec->formatDecimal($this->input->post('balance_amount'))
					);
				$data['paid'] = $amount;

			} else {
				$payment = array();
			}

			// $this->tec->print_arrays($data, $products, $payment);
		}


		if ( $this->form_validation->run() == true && !empty($products) )
		{
			if($suspend) {
				unset($data['status'], $data['rounding']);
				if($this->pos_model->suspendSale($data, $products, $did)) {
					$this->session->set_userdata('rmspos', 1);
					$this->session->set_flashdata('message', lang("sale_saved_to_opened_bill"));
					redirect("pos");
				} else {
					$this->session->set_flashdata('error', lang("action_failed"));
					redirect("pos/".$did);
				}

			} elseif($eid) {

				unset($data['date'], $data['paid']);
				$data['updated_at'] = date('Y-m-d H:i:s');
				$data['updated_by'] = $this->session->userdata('user_id');
				if($this->pos_model->updateSale($eid, $data, $products)) {
					$this->session->set_userdata('rmspos', 1);
					$this->session->set_flashdata('message', lang("sale_updated"));
					redirect("sales");
				}
				else {
					$this->session->set_flashdata('error', lang("action_failed"));
					redirect("pos/?edit=".$eid);
				}

			} else {

				if($sale = $this->pos_model->addSale($data, $products, $payment, $did)) {
					$this->session->set_userdata('rmspos', 1);
					$msg = lang("sale_added");
					if (!empty($sale['message'])) {
						foreach ($sale['message'] as $m) {
							$msg .= '<br>' . $m;
						}
					}
					$this->session->set_flashdata('message', $msg);
					redirect("pos/view/" . $sale['sale_id']);
				}
				else {
					$this->session->set_flashdata('error', lang("action_failed"));
					redirect("pos");
				}

			}
		}
		else
		{

			if(isset($sid) && !empty($sid)) {
				$suspended_sale = $this->pos_model->getSuspendedSaleByID($sid);
				$inv_items = $this->pos_model->getSuspendedSaleItems($sid);
				krsort($inv_items);
				$c = rand(100000, 9999999);
				foreach ($inv_items as $item) {
					$row = $this->site->getProductByID($item->product_id);
					if (!$row) {
						$row = json_decode('{}');
					}
					$row->price = $item->net_unit_price+($item->item_discount/$item->quantity);
					$row->unit_price = $item->unit_price+($item->item_discount/$item->quantity)+($item->item_tax/$item->quantity);
					$row->real_unit_price = $item->real_unit_price;
					$row->discount = $item->discount;
					$row->qty = $item->quantity;
					$combo_items = FALSE;
					$ri = $this->Settings->item_addition ? $row->id : $c;
					$pr[$ri] = array('id' => $c, 'item_id' => $row->id, 'label' => $row->name . " (" . $row->code . ")", 'row' => $row, 'combo_items' => $combo_items);
					$c++;
				}
				$this->data['items'] = json_encode($pr);
				$this->data['sid'] = $sid;
				$this->data['suspend_sale'] = $suspended_sale;
				$this->data['message'] = lang('suspended_sale_loaded');
			}

			if(isset($eid) && !empty($eid)) {
				$sale = $this->pos_model->getSaleByID($eid);
				$inv_items = $this->pos_model->getAllSaleItems($eid);
				krsort($inv_items);
				$c = rand(100000, 9999999);
				foreach ($inv_items as $item) {
					$row = $this->site->getProductByID($item->product_id);
					if (!$row) {
						$row = json_decode('{}');
					}
					$row->price = $item->net_unit_price;
					$row->unit_price = $item->unit_price;
					$row->real_unit_price = $item->real_unit_price;
					$row->discount = $item->discount;
					$row->qty = $item->quantity;
					$combo_items = FALSE;
					$row->quantity += $item->quantity;
					if ($row->type == 'combo') {
						$combo_items = $this->pos_model->getComboItemsByPID($row->id);
						foreach ($combo_items as $combo_item) {
							$combo_item->quantity += ($combo_item->qty*$item->quantity);
						}
					}
					$ri = $this->Settings->item_addition ? $row->id : $c;
					$pr[$ri] = array('id' => $c, 'item_id' => $row->id, 'label' => $row->name . " (" . $row->code . ")", 'row' => $row, 'combo_items' => $combo_items);
					$c++;
				}
				$this->data['items'] = json_encode($pr);
				$this->data['eid'] = $eid;
				$this->data['sale'] = $sale;
				$this->data['message'] = lang('sale_loaded');
			}
			$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
			$this->data['reference_note'] = isset($sid) ? $suspended_sale->hold_ref : NULL;
			$this->data['sid'] = isset($sid) ? $sid : 0;
			$this->data['eid'] = isset($eid) ? $eid : 0;
			$this->data['customers'] = $this->site->getAllCustomers();
			$this->data["tcp"] = $this->pos_model->products_count($this->Settings->default_category);
			$this->data['products'] = $this->ajaxproducts($this->Settings->default_category, 1);
			$this->data['categories'] = $this->site->getAllCategories();
			$this->data['message'] = $this->session->flashdata('message');
			$this->data['suspended_sales'] = $this->site->getUserSuspenedSales();
			$this->data['page_title'] = lang('pos');
			$bc = array(array('link' => '#', 'page' => lang('pos')));
			$meta = array('page_title' => lang('pos'), 'bc' => $bc);
			$this->load->view($this->theme.'pos/index', $this->data, $meta);


		}
	}


	function get_product($code = NULL) {

		if($this->input->get('code')) { $code = $this->input->get('code'); }
		$combo_items = FALSE;
		if($product = $this->pos_model->getProductByCode($code)) {
			unset($product->cost, $product->details);
			$product->qty = 1;
			$product->discount = '0';
			$product->real_unit_price = $product->price;
			$product->unit_price = $product->tax ? ($product->price+(($product->price*$product->tax)/100)) : $product->price;
			if ($product->type == 'combo') {
				$combo_items = $this->pos_model->getComboItemsByPID($product->id);
			}
			echo json_encode(array('id' => str_replace(".", "", microtime(true)), 'item_id' => $product->id, 'label' => $product->name . " (" . $product->code . ")", 'row' => $product, 'combo_items' => $combo_items));
		} else {
			echo NULL;
		}

	}

	function suggestions()
	{
		$term = $this->input->get('term', TRUE);

		$rows = $this->pos_model->getProductNames($term);
		if ($rows) {
			foreach ($rows as $row) {
				unset($row->cost, $row->details);
				$row->qty = 1;
				$row->discount = '0';
				$row->real_unit_price = $row->price;
				$row->unit_price = $row->tax ? ($row->price+(($row->price*$row->tax)/100)) : $row->price;
				$combo_items = FALSE;
				if ($row->type == 'combo') {
				    $combo_items = $this->pos_model->getComboItemsByPID($row->id);
				}
				$pr[] = array('id' => str_replace(".", "", microtime(true)), 'item_id' => $row->id, 'label' => $row->name . " (" . $row->code . ")", 'row' => $row, 'combo_items' => $combo_items);
			}
			echo json_encode($pr);
		} else {
			echo json_encode(array(array('id' => 0, 'label' => lang('no_match_found'), 'value' => $term)));
		}
	}


	function registers()
	{

		$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
		$this->data['registers'] = $this->pos_model->getOpenRegisters();
		$bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => site_url('pos'), 'page' => lang('pos')), array('link' => '#', 'page' => lang('open_registers')));
		$meta = array('page_title' => lang('open_registers'), 'bc' => $bc);
		$this->page_construct('pos/registers', $this->data, $meta);
	}

	function open_register()
	{
		$this->form_validation->set_rules('cash_in_hand', lang("cash_in_hand"), 'trim|required|numeric');

		if ($this->form_validation->run() == true) {
			$data = array('date' => date('Y-m-d H:i:s'),
				'cash_in_hand' => $this->input->post('cash_in_hand'),
				'user_id' => $this->session->userdata('user_id'),
				'status' => 'open',
				);
		}
		if ($this->form_validation->run() == true && $this->pos_model->openRegister($data)) {
			$this->session->set_flashdata('message', lang("welcome_to_pos"));
			redirect("pos");
		} else {

			$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

			$bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => '#', 'page' => lang('open_register')));
			$meta = array('page_title' => lang('open_register'), 'bc' => $bc);
			$this->page_construct('pos/open_register', $this->data, $meta);
		}
	}

	function close_register($user_id = NULL)
	{
		if (!$this->Admin) {
			$user_id = $this->session->userdata('user_id');
		}
		$this->form_validation->set_rules('total_cash', lang("total_cash"), 'trim|required|numeric');
		$this->form_validation->set_rules('total_cheques', lang("total_cheques"), 'trim|required|numeric');
		$this->form_validation->set_rules('total_cc_slips', lang("total_cc_slips"), 'trim|required|numeric');

		if ($this->form_validation->run() == true) {
			if ($this->Admin) {
				$user_register = $user_id ? $this->pos_model->registerData($user_id) : NULL;
				$rid = $user_register ? $user_register->id : $this->session->userdata('register_id');
				$user_id = $user_register ? $user_register->user_id : $this->session->userdata('user_id');
			} else {
				$rid = $this->session->userdata('register_id');
				$user_id = $this->session->userdata('user_id');
			}
			$data = array('closed_at' => date('Y-m-d H:i:s'),
				'total_cash' => $this->input->post('total_cash'),
				'total_cheques' => $this->input->post('total_cheques'),
				'total_cc_slips' => $this->input->post('total_cc_slips'),
				'total_cash_submitted' => $this->input->post('total_cash_submitted'),
				'total_cheques_submitted' => $this->input->post('total_cheques_submitted'),
				'total_cc_slips_submitted' => $this->input->post('total_cc_slips_submitted'),
				'note' => $this->input->post('note'),
				'status' => 'close',
				'transfer_opened_bills' => $this->input->post('transfer_opened_bills'),
				'closed_by' => $this->session->userdata('user_id'),
				);
		} elseif ($this->input->post('close_register')) {
			$this->session->set_flashdata('error', (validation_errors() ? validation_errors() : $this->session->flashdata('error')));
			redirect("pos");
		}

		if ($this->form_validation->run() == true && $this->pos_model->closeRegister($rid, $user_id, $data)) {
			$this->session->set_flashdata('message', lang("register_closed"));
			redirect("welcome");
		} else {
			if ($this->Admin) {
				$user_register = $user_id ? $this->pos_model->registerData($user_id) : NULL;
				$register_open_time = $user_register ? $user_register->date : $this->session->userdata('register_open_time');
				$this->data['cash_in_hand'] = $user_register ? $user_register->cash_in_hand : NULL;
				$this->data['register_open_time'] = $user_register ? $register_open_time : NULL;
			} else {
				$register_open_time = $this->session->userdata('register_open_time');
				$this->data['cash_in_hand'] = NULL;
				$this->data['register_open_time'] = NULL;
			}
			$this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
			$this->data['ccsales'] = $this->pos_model->getRegisterCCSales($register_open_time, $user_id);
			$this->data['cashsales'] = $this->pos_model->getRegisterCashSales($register_open_time, $user_id);
			$this->data['chsales'] = $this->pos_model->getRegisterChSales($register_open_time, $user_id);
			$this->data['stripesales'] = $this->pos_model->getRegisterStripeSales($register_open_time, $user_id);
			$this->data['totalsales'] = $this->pos_model->getRegisterSales($register_open_time, $user_id);
			$this->data['expenses'] = $this->pos_model->getRegisterExpenses($register_open_time);
			$this->data['users'] = $this->tec->getUsers($user_id);
			$this->data['suspended_bills'] = $this->pos_model->getSuspendedsales($user_id);
			$this->data['user_id'] = $user_id;
			$this->load->view($this->theme . 'pos/close_register', $this->data);
		}
	}

	function ajaxproducts( $category_id = NULL, $return = NULL) {

		if($this->input->get('category_id')) { $category_id = $this->input->get('category_id'); } elseif(!$category_id) { $category_id = $this->Settings->default_category; }
		if($this->input->get('per_page') == 'n' ) { $page = 0; } else { $page = $this->input->get('per_page'); }
		if($this->input->get('tcp') == 1 ) { $tcp = TRUE; } else { $tcp = FALSE; }

		$products = $this->pos_model->fetch_products($category_id, $this->Settings->pro_limit, $page);
		$pro = 1;
		$prods = "<div>";
		if($products) {
			if($this->Settings->bsty == 1) {
				foreach($products as $product) {
					$count = $product->id;
					if($count < 10) { $count = "0".($count /100) *100;  }
					if($category_id < 10) { $category_id = "0".($category_id /100) *100;  }
					$prods .= "<button type=\"button\" data-name=\"".$product->name."\" id=\"product-".$category_id.$count."\" type=\"button\" value='".$product->code."' class=\"btn btn-name btn-default btn-flat product\">".$product->name."</button>";
					$pro++;
				}
			} elseif($this->Settings->bsty == 2) {
				foreach($products as $product) {
					$count = $product->id;
					if($count < 10) { $count = "0".($count /100) *100;  }
					if($category_id < 10) { $category_id = "0".($category_id /100) *100;  }
					$prods .= "<button type=\"button\" data-name=\"".$product->name."\" id=\"product-".$category_id.$count."\" type=\"button\" value='".$product->code."' class=\"btn btn-img btn-flat product\"><img src=\"".base_url()."uploads/thumbs/".$product->image."\" alt=\"".$product->name."\" style=\"width: 110px; height: 110px;\"></button>";
					$pro++;
				}
			} elseif($this->Settings->bsty == 3) {
				foreach($products as $product) {
					$count = $product->id;
					if($count < 10) { $count = "0".($count /100) *100;  }
					if($category_id < 10) { $category_id = "0".($category_id /100) *100;  }
					$prods .= "<button type=\"button\" data-name=\"".$product->name."\" id=\"product-".$category_id.$count."\" type=\"button\" value='".$product->code."' class=\"btn btn-both btn-flat product\"><span class=\"bg-img\"><img src=\"".base_url()."uploads/thumbs/".$product->image."\" alt=\"".$product->name."\" style=\"width: 100px; height: 100px;\"></span><span><span>".$product->name."</span></span></button>";
					$pro++;
				}
			}
		} else {
			$prods .= '<h4 class="text-center text-info" style="margin-top:50px;">'.lang('category_is_empty').'</h4>';
		}

		$prods .= "</div>";

		if(!$return) {
			if(!$tcp) {
				echo $prods;
			} else {
				$category_products = $this->pos_model->products_count($category_id);
				header('Content-Type: application/json');
				echo json_encode(array('products' => $prods, 'tcp' => $category_products));
			}
		} else {
			return $prods;
		}

	}

	function view($sale_id = NULL, $noprint = NULL)
	{
		if($this->input->get('id')){ $sale_id = $this->input->get('id'); }
		$this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
		$this->data['message'] = $this->session->flashdata('message');
		$inv = $this->pos_model->getSaleByID($sale_id);
		$this->tec->view_rights($inv->created_by);
		$this->load->helper('text');
		$this->data['rows'] = $this->pos_model->getAllSaleItems($sale_id);
		$this->data['customer'] = $this->pos_model->getCustomerByID($inv->customer_id);
		$this->data['inv'] = $inv;
		$this->data['sid'] = $sale_id;
		$this->data['noprint'] = $noprint;
		$this->data['modal'] = false;
		$this->data['payments'] = $this->pos_model->getAllSalePayments($sale_id);
		$this->data['created_by'] = $this->site->getUser($inv->created_by);
		$this->data['page_title'] = lang("invoice");
		$this->load->view($this->theme.'pos/view', $this->data);

	}

	function email_receipt($sale_id = NULL, $to = NULL)
	{
		if($this->input->post('id')) { $sale_id = $this->input->post('id'); }
		if($this->input->post('email')){ $to = $this->input->post('email'); }
		if(!$sale_id || !$to) { die(); }

		$this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
		$this->data['message'] = $this->session->flashdata('message');
		$inv = $this->pos_model->getSaleByID($sale_id);
		$this->tec->view_rights($inv->created_by);
		$this->load->helper('text');
		$this->data['rows'] = $this->pos_model->getAllSaleItems($sale_id);
		$this->data['customer'] = $this->pos_model->getCustomerByID($inv->customer_id);
		$this->data['inv'] = $inv;
		$this->data['sid'] = $sale_id;
		$this->data['noprint'] = NULL;
		$this->data['modal'] = false;
		$this->data['payments'] = $this->pos_model->getAllSalePayments($sale_id);
		$this->data['created_by'] = $this->site->getUser($inv->created_by);

		$receipt = $this->load->view($this->theme.'pos/view', $this->data, TRUE);
		$subject = lang('email_subject');

		if($this->tec->send_email($to, $subject, $receipt)) {
			echo json_encode(array('msg' => lang("email_success")));
		} else {
			echo json_encode(array('msg' => lang("email_failed")));
		}

	}


	function register_details()
	{

		$register_open_time = $this->session->userdata('register_open_time');
		$this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
		$this->data['ccsales'] = $this->pos_model->getRegisterCCSales($register_open_time);
		$this->data['cashsales'] = $this->pos_model->getRegisterCashSales($register_open_time);
		$this->data['chsales'] = $this->pos_model->getRegisterChSales($register_open_time);
		$this->data['stripesales'] = $this->pos_model->getRegisterStripeSales($register_open_time);
		$this->data['totalsales'] = $this->pos_model->getRegisterSales($register_open_time);
		$this->data['expenses'] = $this->pos_model->getRegisterExpenses($register_open_time);
		$this->load->view($this->theme . 'pos/register_details', $this->data);
	}

	function today_sale()
	{
		if (!$this->Admin) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect($_SERVER["HTTP_REFERER"]);
		}

		$this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
		$this->data['ccsales'] = $this->pos_model->getTodayCCSales();
		$this->data['cashsales'] = $this->pos_model->getTodayCashSales();
		$this->data['chsales'] = $this->pos_model->getTodayChSales();
		$this->data['stripesales'] = $this->pos_model->getTodayStripeSales();
		$this->data['totalsales'] = $this->pos_model->getTodaySales();
		// $this->data['expenses'] = $this->pos_model->getTodayExpenses();
		$this->load->view($this->theme . 'pos/today_sale', $this->data);
	}

	function shortcuts()
	{
		$this->load->view($this->theme . 'pos/shortcuts', $this->data);
	}

	function view_bill()
    {
        $this->load->view($this->theme . 'pos/view_bill', $this->data);
    }

    function promotions()
    {
        $this->load->view($this->theme . 'promotions', $this->data);
    }

    function stripe_balance()
    {
        if (!$this->Owner) {
            return FALSE;
        }
        $this->load->model('stripe_payments');
        return $this->stripe_payments->get_balance();
    }

	function language($lang = false)
    {
        if ($this->input->get('lang')) {
            $lang = $this->input->get('lang');
        }
        //$this->load->helper('cookie');
        $folder = 'app/language/';
        $languagefiles = scandir($folder);
        if (in_array($lang, $languagefiles)) {
            $cookie = array(
                'name' => 'language',
                'value' => $lang,
                'expire' => '31536000',
                'prefix' => 'spos_',
                'secure' => false
            );

            $this->input->set_cookie($cookie);
        }
        redirect($_SERVER["HTTP_REFERER"]);
    }

    function validate_gift_card($no)
    {
        if ($gc = $this->pos_model->getGiftCardByNO(urldecode($no))) {
            if ($gc->expiry) {
                if ($gc->expiry >= date('Y-m-d')) {
                    echo json_encode($gc);
                } else {
                    echo json_encode(false);
                }
            } else {
                echo json_encode($gc);
            }
        } else {
            echo json_encode(false);
        }
    }

}
