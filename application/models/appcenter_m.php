<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Appcenter_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
		$this->load->model('welcome_m');
		$this->load->model('sina_m');
		$this->load->model('order_m');
		$this->load->helper('front');
    }
	//更改密码
	//账户操作记录查询
	function record($type = 0,$per_page = 20,$page = 0)
	{
		$userinfo = userinfo();	
		$uid = $userinfo['id'];
		//user_account_history
		
		$this->db->start_cache();
		$this->db->from('fr_order');
		switch($type)
		{
			case 1://充值
				$this->db->where('type',1);
			break;
			case 2://产品购买
				$this->db->where('type',2);
				$this->db->where('fr_order.static',2);
			break;
			case 5://利息发放
				$this->db->where('type',5);
			break;
			case 7://提现
				$this->db->where('type',7);
			break;
			case 9://购买债券
				$this->db->where('type',9);
			break;
			case 10://转让
				$this->db->where('type',10);
			break;
			default:
			//全部
				$this->db->where_in('type',array(1,2,5,7,9,10));
			break;	
		}
		$this->db->where('uid',$userinfo['id']);
		$this->db->stop_cache();
		$count = $this->db->count_all_results();
		$this->db->order_by('dateline','desc');
		$this->db->limit($per_page,$page);
		if($type == 2)
		{
			$this->db->select('fr_order.*,bulk_standard.is_backed,bulk_standard.title,bulk_standard.static as pstatic,bulk_standard.next_interest');	
			$this->db->join('bulk_standard','bulk_standard.id = fr_order.productid','left');
		}elseif($type == 5){
			$this->db->select('fr_order.*,bulk_standard.is_backed,bulk_standard.title,bulk_standard.static as pstatic,bulk_standard.next_interest');	
			$this->db->join('bulk_standard','bulk_standard.id = fr_order.productid','left');			
		}
		else
		{
			if($type == 9) //投资债券
			{
				$this->db->select('fr_order.*,bulk_standard.is_backed');	
				$this->db->join('bulk_standard','bulk_standard.id = fr_order.productid','left');	
			}
			$this->db->select('fr_order.*');	
		}
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return array($count,$result);
	}
}