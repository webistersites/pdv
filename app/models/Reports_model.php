<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports_model extends CI_Model
{


	public function __construct()
	{
		parent::__construct();

	}

	public function getAllProducts()
	{
		$q = $this->db->get('products');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}

			return $data;
		}
	}

	public function getAllCustomers()
	{
		$q = $this->db->get('customers');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	public function topProducts()
	{
		$m = date('Y-m');
		$this->db->select($this->db->dbprefix('products').".code as product_code, ".$this->db->dbprefix('products').".name as product_name, sum(".$this->db->dbprefix('sale_items').".quantity) as quantity")
		->join('products', 'products.id=sale_items.product_id', 'left')
		->join('sales', 'sales.id=sale_items.sale_id', 'left')
		->order_by("sum(".$this->db->dbprefix('sale_items').".quantity)", 'desc')
		->group_by('sale_items.product_id')
		->limit(10)
		->like('sales.date', $m, 'both');
		$q = $this->db->get('sale_items');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	public function topProducts1()
	{
		$m = date('Y-m', strtotime('first day of last month'));
		$this->db->select($this->db->dbprefix('products').".code as product_code, ".$this->db->dbprefix('products').".name as product_name, sum(".$this->db->dbprefix('sale_items').".quantity) as quantity")
		->join('products', 'products.id=sale_items.product_id', 'left')
		->join('sales', 'sales.id=sale_items.sale_id', 'left')
		->order_by("sum(".$this->db->dbprefix('sale_items').".quantity)", 'desc')
		->group_by('sale_items.product_id')
		->limit(10)
		->like('sales.date', $m, 'both');
		$q = $this->db->get('sale_items');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	public function topProducts3()
	{
		$this->db->select($this->db->dbprefix('products').".code as product_code, ".$this->db->dbprefix('products').".name as product_name, sum(".$this->db->dbprefix('sale_items').".quantity) as quantity")
		->join('products', 'products.id=sale_items.product_id', 'left')
		->join('sales', 'sales.id=sale_items.sale_id', 'left')
		->order_by("sum(".$this->db->dbprefix('sale_items').".quantity)", 'desc')
		->group_by('sale_items.product_id')
		->limit(10)
		->where($this->db->dbprefix('sales').'.date >= last_day(now()) + interval 1 day - interval 3 month', NULL, FALSE);
		$q = $this->db->get('sale_items');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	public function topProducts12()
	{
		$this->db->select($this->db->dbprefix('products').".code as product_code, ".$this->db->dbprefix('products').".name as product_name, sum(".$this->db->dbprefix('sale_items').".quantity) as quantity")
		->join('products', 'products.id=sale_items.product_id', 'left')
		->join('sales', 'sales.id=sale_items.sale_id', 'left')
		->order_by("sum(".$this->db->dbprefix('sale_items').".quantity)", 'desc')
		->group_by('sale_items.product_id')
		->limit(10)
		->where($this->db->dbprefix('sales').'.date >= last_day(now()) + interval 1 day - interval 12 month', NULL, FALSE);
		$q = $this->db->get('sale_items');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}

			return $data;
		}
	}

	public function getDailySales($year, $month)
	{

		$myQuery = "SELECT DATE_FORMAT( date,  '%e' ) AS date, COALESCE(sum(total), 0) as total, COALESCE(sum(grand_total), 0) as grand_total,
		COALESCE(sum(total_tax), 0) as tax, COALESCE(sum(total_discount), 0) as discount FROM (".$this->db->dbprefix('sales').")
		WHERE DATE_FORMAT( date,  '%Y-%m' ) =  '{$year}-{$month}'
		GROUP BY DATE_FORMAT( date,  '%e' )";
		$q = $this->db->query($myQuery, false);
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}


	public function getMonthlySales($year)
	{

		$myQuery = "SELECT DATE_FORMAT( date,  '%c' ) AS date, COALESCE(sum(total), 0) as total, COALESCE(sum(grand_total), 0) as grand_total,
		COALESCE(sum(total_tax), 0) as tax, COALESCE(sum(total_discount), 0) as discount
		FROM (".$this->db->dbprefix('sales').")
		WHERE DATE_FORMAT( date,  '%Y' ) =  '{$year}'
		GROUP BY date_format( date, '%c' ) ORDER BY date_format( date, '%c' ) ASC";
		$q = $this->db->query($myQuery, false);
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}

	public function getTotalSalesforCustomer($customer_id, $user = NULL, $start_date = NULL, $end_date = NULL)
	{
		if($start_date && $end_date) {
			$this->db->where('date >=', $start_date);
			$this->db->where('date <=', $end_date);
		}
		if($user) {
			$this->db->where('created_by', $user);
		}
		 $q=$this->db->get_where('sales', array('customer_id' => $customer_id));
		 return $q->num_rows();

	}

	public function getTotalSalesValueforCustomer($customer_id, $user = NULL, $start_date = NULL, $end_date = NULL)
	{
		$this->db->select('sum(total) as total');
		if($start_date && $end_date) {
			$this->db->where('date >=', $start_date);
			$this->db->where('date <=', $end_date);
		}
		if($user) {
			$this->db->where('created_by', $user);
		}
		 $q=$this->db->get_where('sales', array('customer_id' => $customer_id));
		 if( $q->num_rows() > 0 )
		  {
			$s = $q->row();
			return $s->total;
		  }
		return FALSE;
	}

	public function getAllStaff()
    {

        $q = $this->db->get('users');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

	public function getTotalSales($start, $end)
    {
        $this->db->select('count(id) as total, sum(COALESCE(grand_total, 0)) as total_amount, SUM(COALESCE(paid, 0)) as paid, SUM(COALESCE(total_tax, 0)) as tax', FALSE)
            ->where("date >= '{$start}' and date <= '{$end}'", NULL, FALSE);
        $q = $this->db->get('sales');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getTotalPurchases($start, $end)
    {
        $this->db->select('count(id) as total, sum(COALESCE(total, 0)) as total_amount', FALSE)
            ->where("date >= '{$start}' and date <= '{$end}'", NULL, FALSE);
        $q = $this->db->get('purchases');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getTotalExpenses($start, $end)
    {
        $this->db->select('count(id) as total, sum(COALESCE(amount, 0)) as total_amount', FALSE)
            ->where("date >= '{$start}' and date <= '{$end}'", NULL, FALSE);
        $q = $this->db->get('expenses');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }


}
