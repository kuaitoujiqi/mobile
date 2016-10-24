<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Order_admin_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }
	
	function orderlist($perpage = 20)
	{
		//判断页数
		$page = $this->input->get('page')?$this->input->get('page'):0;
		
		$this->db->start_cache();
		$this->db->select('fr_order.*');
		$this->db->from('fr_order');
		$this->db->stop_cache();
		
		//判断时间
		$starttime = $this->input->get('starttime');
		$endtime = $this->input->get('endtime');
		$uid = $this->input->get('uid');
		$project = $this->input->get('productid'); //产品ID
		$userproject = $this->input->get('user_pro_id');//用户购买项目ID
		$type = $this->input->get('type')?$this->input->get('type'):0;
		$this->db->start_cache();
		$this->db->where('fr_order.type !=',6);
		$this->db->where('fr_order.type !=',8);
		$this->db->stop_cache();
		if($type !=0)
		{
			$this->db->start_cache();
			$this->db->where('fr_order.type',$type);
			$this->db->stop_cache();	
		}
		if($uid)
		{
			$this->db->start_cache();
			$this->db->where('fr_order.uid',$uid);
			$this->db->stop_cache();	
		}
		if($project)
		{
			$this->db->start_cache();
			$this->db->where('fr_order.productid',$project);
			$this->db->stop_cache();	
		}
		
		if($userproject)
		{
			$this->db->start_cache();
			$this->db->where('fr_order.user_pro_id',$userproject);
			$this->db->stop_cache();	
		}
		
		
		if($starttime)
		{
			$this->db->start_cache();
			$this->db->where('fr_order.dateline >=',strtotime($starttime));
			$this->db->stop_cache();	
		}
		if($endtime)
		{
			$this->db->start_cache();
			$this->db->where('fr_order.dateline <=',strtotime($endtime));
			$this->db->stop_cache();	
		}
		
		$count = $this->db->count_all_results();
		
		$this->db->order_by('fr_order.id','desc');
		$this->db->limit($perpage,$page);
		$query = $this->db->get();
		$return = $query->result_array();
		$this->db->flush_cache();
		$sum = "";
		if($type !=0 && $starttime && $endtime)
		{
			$sum = $this->_sum($type,$starttime,$endtime);
		}
		return array($count,$return,$sum);				
	}
	
	function _sum($type,$starttime,$endtime)
	{
		$this->db->select_sum('monkey');
		$this->db->where('dateline >=',strtotime($starttime));
		$this->db->where('dateline <=',strtotime($endtime));
		$this->db->where('type',$type);
		$this->db->where('static',2);
		$sum = $this->db->get('fr_order')->row_array();
		return $sum['monkey'];	
	}
	
	//还款时间
	function repayment_list($perpage = 20)
	{
		//判断页数
		$page = $this->input->get('page')?$this->input->get('page'):0;
		
		//未还款
		$this->db->start_cache();
		$this->db->where('bulk_standard.repayment_this',1);
		$this->db->where('bulk_standard.static',2);//进行中的项目
		$this->db->stop_cache();
		
		//全部未还款 1为3天内 2为5天内 3为10天内
		$type = $this->input->get('type')?$this->input->get('type'):0;
		$now = time();
		$this->db->start_cache();
		switch($type)
		{
			case 1:
				//下次发利息时间 距离当前时间为3天以内
				$this->db->where('bulk_standard.next_interest <=',$now-(-259200));
			case 2:
				$this->db->where('bulk_standard.next_interest <=',$now-(-432000));
			case 3:
				$this->db->where('bulk_standard.next_interest <=',$now-(-864000));
			default:break;
		}
		
		$this->db->stop_cache();
		$count = $this->db->count_all_results('bulk_standard');
		$this->db->from('bulk_standard');
		$this->db->join('company_user','company_user.id = bulk_standard.company','left');
		$this->db->select('bulk_standard.*,company_user.company_name,company_user.telephone');
		$this->db->order_by('bulk_standard.next_interest','desc');
		$this->db->limit($perpage,$page);
		$query = $this->db->get();
		$return = $query->result_array();
		$this->db->flush_cache();
		return array($count,$return);					
	}
	
	
	//已经还款的企业
	function have_repayment($perpage = 20)
	{
		//判断页数
		$page = $this->input->get('page')?$this->input->get('page'):0;
		
		//未还款
		$this->db->start_cache();
		$this->db->where('fr_order.type',4);
		$this->db->where('fr_order.static',2);//还款成功订单
		$this->db->stop_cache();
		
		//全部未还款 1为3天内 2为5天内 3为10天内
		$type = $this->input->get('type')?$this->input->get('type'):0;
		$now = time();
		$this->db->start_cache();
		switch($type)
		{
			case 1:
				//下次发利息时间 距离当前时间为3天以内
				$this->db->where('fr_order.dateline >=',$now-259200);
			case 2:
				$this->db->where('fr_order.dateline >=',$now-432000);
			case 3:
				$this->db->where('fr_order.dateline >=',$now-864000);
			default:break;
		}
		
		$this->db->stop_cache();
		$count = $this->db->count_all_results('fr_order');
		$this->db->from('fr_order');
		$this->db->join('bulk_standard','bulk_standard.id = fr_order.productid','left');
		$this->db->join('company_user','company_user.id = bulk_standard.company','left');
		$this->db->select('bulk_standard.title,company_user.company_name,company_user.telephone,fr_order.dateline,fr_order.monkey');
		$this->db->order_by('fr_order.id','desc');
		$this->db->limit($perpage,$page);
		$query = $this->db->get();
		$return = $query->result_array();
		$this->db->flush_cache();
		return array($count,$return);					
	}
	
	//统计
	function tongji()
	{
		$starttime = $this->input->get('starttime');
		$endtime = $this->input->get('endtime');
		if($starttime)
		{
			$this->db->start_cache();
			$this->db->where('dateline >=',strtotime($starttime." 00:00:00"));
			$this->db->stop_cache();	
		}
		else
		{
			$this->db->start_cache();
			$this->db->where('dateline >=',strtotime(date('Y-m-d')." 00:00:00"));
			$this->db->stop_cache();	
		}
		if($endtime)
		{
			$this->db->start_cache();
			$this->db->where('dateline <=',strtotime($endtime." 23:59:59"));
			$this->db->stop_cache();	
		}
		else
		{
			$this->db->start_cache();
			$this->db->where('dateline <=',strtotime(date('Y-m-d')." 23:59:59"));
			$this->db->stop_cache();	
		}
		$this->db->start_cache();
		$this->db->where('static',2);
		$this->db->select_sum('monkey');
		$this->db->stop_cache();	
		
		
		//累计充值
		$this->db->where('type',1);
		$this->db->where('usertype',1);
		$recharge = $this->db->get('tongji_view')->row_array();
		$recharge = $recharge['monkey'];
		//echo $this->db->last_query();
		
		//提现
		$this->db->where('type',7);
		$widthdraw = $this->db->get('fr_order')->row_array();
		$widthdraw = $widthdraw['monkey'];
		
		//提现手续费
		$this->db->where('type',12);
		$widthdraw_s = $this->db->get('fr_order')->row_array();
		$widthdraw_s = $widthdraw_s['monkey'];
		
		//借款
		$this->db->where('type',3);
		$jiekuan = $this->db->get('fr_order')->row_array();
		$jiekuan = $jiekuan['monkey'];
		
		//还款总额
		$this->db->where('type',4);
		$huankuan = $this->db->get('fr_order')->row_array();
		$huankuan = $huankuan['monkey'];
		
		
		//债权转让价格总额代收
		$this->db->where('type',9);
		$transfer = $this->db->get('fr_order')->row_array();
		$transfer = $transfer['monkey'];
		
		//债券转让原始价格
		$this->db->where('type',2);
		$transfer_old = $this->db->get('user_products')->row_array();
		$transfer_old = $transfer_old['monkey'];
		
		//付息总额
		$this->db->where('type',5);
		$fuxi = $this->db->get('fr_order')->row_array();
		$fuxi = $fuxi['monkey'];
		
		$this->db->flush_cache();
		$return = array();
		array_push($return,array('name'=>'充值','monkey'=>$recharge));
		array_push($return,array('name'=>'提现','monkey'=>$widthdraw));
		array_push($return,array('name'=>'提现手续费','monkey'=>$widthdraw_s));
		array_push($return,array('name'=>'借款标满放款给企业','monkey'=>$jiekuan));
		array_push($return,array('name'=>'企业还款','monkey'=>$huankuan));
		array_push($return,array('name'=>'债券转让实际金额','monkey'=>$transfer));
		array_push($return,array('name'=>'债券转让原始金额','monkey'=>$transfer_old));
		array_push($return,array('name'=>'付息','monkey'=>$fuxi));
		return $return;	
	}
}