<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends Front_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('weixin_m');
	}
	function index()
	{
		$access = $this->weixin_m->get_token();
		echo $access;
	}
	
	//绑定微信帐号获取openid
	function revice_message()
	{
		//require('./plug/weixin/wxBizMsgCrypt.php');
		echo 'success';
		//$this->weixin_m->revice_message();
	}
	
}