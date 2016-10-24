<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Prepaid_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }
	//充值列表
	function recharge($per_page = 10)
	{
		//判断页数
		$page = $this->input->get('page')?$this->input->get('page'):0;
		//订单号
		$order_id = $this->input->get('order_id');
		if($order_id)
		{
			$this->db->start_cache();
			$this->db->where('fr_order.id',$order_id);
			$this->db->stop_cache();	
		}
		
		//判断UID
		if($this->input->get('user_id'))
		{
			$this->db->start_cache();
			$this->db->where('fr_order.uid',$this->input->get('user_id'));
			$this->db->stop_cache();	
		}
		//判断时间
		$starttime = $this->input->get('starttime');
		$endtime = $this->input->get('endtime');
		if($starttime)
		{
			$this->db->start_cache();
			$this->db->where('fr_order.dateline >=',strtotime($starttime." 00:00:00"));
			$this->db->stop_cache();	
		}
		if($endtime)
		{
			$this->db->start_cache();
			$this->db->where('fr_order.dateline <=',strtotime($endtime." 23:59:59"));
			$this->db->stop_cache();	
		}
		$this->db->start_cache();
		$this->db->where('fr_order.type',1);
		$this->db->stop_cache();
		$count = $this->db->count_all_results('fr_order');
		$this->db->select('fr_order.*,user.nickname');
		$this->db->from('fr_order');
		$this->db->join('user','user.id = fr_order.uid','left');
		$this->db->limit($per_page,$page);
		$this->db->order_by('fr_order.dateline','desc');
		$query = $this->db->get();
		$return = $query->result_array();
		$this->db->flush_cache();
		return array($count,$return);
	}
	//提现管理
	function withdraw($per_page = 10)
	{
		
		//判断页数
		$page = $this->input->get('page')?$this->input->get('page'):0;
		//订单号
		$order_id = $this->input->get('order_id');
		if($order_id)
		{
			$this->db->start_cache();
			$this->db->where('fr_order.id',$order_id);
			$this->db->stop_cache();	
		}
		
		//判断UID
		if($this->input->get('user_id'))
		{
			$this->db->start_cache();
			$this->db->where('fr_order.uid',$this->input->get('user_id'));
			$this->db->stop_cache();	
		}
		//判断时间
		$starttime = $this->input->get('starttime');
		$endtime = $this->input->get('endtime');
		if($starttime)
		{
			$this->db->start_cache();
			$this->db->where('fr_order.dateline >=',strtotime($starttime." 00:00:00"));
			$this->db->stop_cache();	
		}
		if($endtime)
		{
			$this->db->start_cache();
			$this->db->where('fr_order.dateline <=',strtotime($endtime." 23:59:59"));
			$this->db->stop_cache();	
		}
		$this->db->start_cache();
		$this->db->where('fr_order.type',7);
		$this->db->stop_cache();
		$count = $this->db->count_all_results('fr_order');
		$this->db->select('fr_order.*,user.nickname');
		$this->db->from('fr_order');
		$this->db->join('user','user.id = fr_order.uid','left');
		$this->db->limit($per_page,$page);
		$this->db->order_by('fr_order.dateline','desc');
		$query = $this->db->get();
		$return = $query->result_array();
		$this->db->flush_cache();
		return array($count,$return);
	}
}