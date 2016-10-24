<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends Admin_Controller {
	
	function __construct()
 	{
  		parent::__construct();
		$this->load->model('admin/order_admin_m');
		$this->load->model('admin/public_m');
 	}
	
	function orderlist()
	{
		$this->load->library('pagination');
		$get = $this->public_m->page_url();
		$config['base_url'] = admin_url('order/orderlist?'.$get);
		$config['page_query_string'] = TRUE;
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$result = $this->order_admin_m->orderlist($config['per_page']);
		$config['total_rows'] = $result[0];
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		$data['result'] = $result[1];
		$data['type'] =  $this->input->get('type')?$this->input->get('type'):0;
		$data['sum'] = $result[2];
		$this->_view('order/orderlist',$data);			
	}
	
	
	//退款处理
	function refund_pay(){
		$buy_id = $this->input->post('productid');
		$remark = "订单号为".$this->input->post('productid')."退款";  //订单号
		$uid = $this->input->post('uid'); //用户id
		$user_pro_id = $this->input->post('userproid'); //用户投资项目id
		$monkey = $this->input->post('money'); //用户投资项目id
		$summary = "流标退款";
		
		$this->load->model('admin/sina_m');
		$this->load->model('order_m');
			
			$order_id = $this->order_m->create_order_refund($uid,$monkey,$user_pro_id,$remark);
		
			$sina_return = $this->sina_m->create_hosting_refund($order_id,$buy_id,$monkey,$summary);

			if($sina_return[0] == 0)
			 {
				return json_encode(array('code'=>1,'msg'=>$sina_return[1]),true); 
			 }
			 else
			 {
				 return json_encode(array('code'=>2,'msg'=>$sina_return[1]),true);	 
			 }

	}
	
	//还款期限查询
	function repayment_list()
	{
		$this->load->library('pagination');
		$get = $this->public_m->page_url();
		$config['base_url'] = admin_url('order/repayment_list?'.$get);
		$config['page_query_string'] = TRUE;
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$result = $this->order_admin_m->repayment_list($config['per_page']);
		$config['total_rows'] = $result[0];
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		$data['result'] = $result[1];
		$data['type'] =  $this->input->get('type')?$this->input->get('type'):0;
		$this->_view('order/repayment',$data);				
	}
	//还款项目记录
	function have_repayment()
	{
		//error_reporting(E_ALL);
		$this->load->library('pagination');
		$get = $this->public_m->page_url();
		$config['base_url'] = admin_url('order/have_repayment?'.$get);
		$config['page_query_string'] = TRUE;
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$result = $this->order_admin_m->have_repayment($config['per_page']);
		$config['total_rows'] = $result[0];
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		$data['result'] = $result[1];
		$data['type'] =  $this->input->get('type')?$this->input->get('type'):0;
		$this->_view('order/have_repayment',$data);				
	}
	
	//资金统计
	function tongji()
	{
		//error_reporting(E_ALL);
		$data['tongji'] = $this->order_admin_m->tongji();
		$this->_view('order/tongji',$data);	
	}
	
	//付息通知
	function fuxi_message()
	{
		$data['fuxi'] = $this->order_admin_m->fuxi();
		$this->_view('order/fuxi',$data);		
	}
	
}