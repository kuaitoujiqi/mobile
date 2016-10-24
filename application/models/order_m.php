<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//生成订单
class Order_m extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('sina_m');
    }
	
	//生成订单号
	function create_order($type = false,$uid = false,$monkey = false,$rechargetype = 1,$productid = false,$pid = 0,$quota = false,$poundage = false,$user_pro_id = false,$transfer_id = false)
	{
		/*类型 充值、投资待收、满标待付、还款待收、利息代付、提现请求、邦卡请求*/
		/*类型 1投资人充值 2投资人购买标的待收交易 3 代付到借款人审标 4借款人还款待收 5投资人利息代付 6 邦卡请求 7提现请求 8审核企业资质 9为债券转让代收 10为债券转让代付 11提现手续费代收 12提现手续费代付 13 提现冻结 14 提现解冻*/
		$this->db->set('type',$type);   //交易类型
		$this->db->set('uid',$uid);        //交易用户ID
		$this->db->set('monkey',$monkey);  //交易金额
		$this->db->set('dateline',time()); //提交时间
		$this->db->set('static',1); //1处理中 2 成功 3失败
		if($type == 1) //投资人充值 设置充值类型
		{
			//充值类型
			$this->db->set('rechargetype',$rechargetype);
		}
		if($type == 2 || $type == 3  || $type == 4 || $type == 5 || $type == 9 || $type == 10)  
		{
			$this->db->set('productid',$productid);	
		}
		if($type == 5 && $pid != 0)
		{
			$this->db->set('pid',$pid);
			$this->db->set('user_pro_id',$user_pro_id);
		}
		if($type == 11 || $type == 12 || $type == 13 || $type == 14)
		{
			$this->db->set('pid',$pid);	
		}
		if($type == 7 && $quota)
		{
			$this->db->set('quota',$quota);	
		}
		if($poundage)
		{
			$this->db->set('poundage',$poundage);		
		}
		//债券转让
		if($transfer_id)
		{
			$this->db->set('transfer_id',$transfer_id);
		}
		
		if($this->db->insert('fr_order'))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;	
		}
	}
	
	//生成退款订单号
	function create_order_refund($uid = false,$monkey = false,$user_pro_id = false,$remark = false){
		
		$this->db->set('type',15);   //交易类型
		$this->db->set('uid',$uid);        //交易用户ID
		$this->db->set('monkey',$monkey);  //交易金额
		$this->db->set('dateline',time()); //提交时间
		$this->db->set('static',1); //1处理中 2 成功 3失败	
		$this->db->set('user_pro_id',$user_pro_id); //	
		$this->db->set('remark',$remark); //
		if($this->db->insert('fr_order'))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;	
		}	
	}
	
	//删除订单
	function del_order($id = false)
	{
		$this->db->where('id',$id);
		$this->db->delete('fr_order');
	}
	
	//用户查询订单
	function show_user_order($per_page = 20,$page = 0,$type = 0)
	{
		
	}
	
	//查询单个订单
	function single_order($order_id = false)
	{
		$this->db->where('id',$order_id);
		$query = $this->db->get('fr_order',1,0);	
		if($query->num_rows() <= 0)
		{
			return false;	
		}
		else
		{
			return $query->row_array();	
		}
	}
	//更改订单状态失败
	function order_failed($order_id = false,$remarks = false)
	{
		$this->db->where('id',$order_id);
		$this->db->set('static',3);
		if($remarks)
		{
			$this->db->set('remark',$remarks);	
		}
		$this->db->update('fr_order');	
	}
	//更新订单状态成功
	function order_success($order_id = false)
	{
		$this->db->where('id',$order_id);
		$this->db->set('static',2);
		
		$this->db->update('fr_order');	
	}
	//查询订单是否有处理中的订单
	function order_status($array = array())
	{
		foreach($array as $val=>$key)
		{
			$this->db->where($val,$key);	
		}
		$this->db->where('static',1);
		$query = $this->db->get('fr_order',1,0);
		if($query->num_rows() >0)
		{
			return false;	
		}
		else
		{
			return true;	
		}
	}
	
	//同步用户余额 
	function same_monkey($uid = false)
	{
		$sina_query = $this->sina_m->query_balance($uid);
		if($sina_query[0] == 0)
		{
			@$this->db->set('balance',$sina_query[1]['available_balance']); //更新本地余额 可用余额
			@$this->db->where('id',$uid);
			@$this->db->update('user');
		}
	}
	//获取原冻结订单
	function get_ban_order($order = false)
	{
		$this->db->where('type',13);
		$this->db->where('pid',$order);
		$row = $this->db->get('fr_order',1,0)->row_array();
		return $row['id'];
	}
	
	function create_order_redpackets($uid = false,$monkey = false,$user_pro_id = false,$remark = false){
		$this->db->set('type',16);   //交易类型
		$this->db->set('uid',$uid);        //交易用户ID
		$this->db->set('monkey',$monkey);  //交易金额
		$this->db->set('dateline',time()); //提交时间
		$this->db->set('static',1); //1处理中 2 成功 3失败		
		$this->db->set('remark',$remark); //
		if($this->db->insert('fr_order')){
			return $this->db->insert_id();
		}else{
			return false;	
		}				
	}
	
}