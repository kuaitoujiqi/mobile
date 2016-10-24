<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-Type: application/json;charset=utf-8");
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:POST,GET");
class Index extends Front_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('product_m');
		$this->load->model('transfer_m');
		$this->load->model('response_m');
	}
	function test(){
		 return $this->response_m->show(200, '个人中心数据获取成功', $data);
	}
}