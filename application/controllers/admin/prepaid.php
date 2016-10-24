<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prepaid extends Admin_Controller {
	
	function __construct()
 	{
  		parent::__construct();
		$this->load->model('admin/prepaid_m');
		$this->load->model('admin/public_m');
 	}
	//充值列表
	function recharge($page = 0)
	{
		$this->load->library('pagination');
		$get = $this->public_m->page_url();
		$config['base_url'] = admin_url('prepaid/recharge?'.$get);
		$config['page_query_string'] = TRUE;
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$result = $this->prepaid_m->recharge($config['per_page']);
		$config['total_rows'] = $result[0];
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		$data['result'] = $result[1];
		$this->_view('prepaid/recharge',$data);
	}
	
	//提现列表
	function withdraw()
	{
		$this->load->library('pagination');
		$get = $this->public_m->page_url();
		$config['base_url'] = admin_url('prepaid/withdraw?'.$get);
		$config['page_query_string'] = TRUE;
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$result = $this->prepaid_m->withdraw($config['per_page']);
		$config['total_rows'] = $result[0];
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		$data['result'] = $result[1];
		$this->_view('prepaid/withdraw',$data);
	}
	//转账管理
	function transfer()
	{
			
	}
}