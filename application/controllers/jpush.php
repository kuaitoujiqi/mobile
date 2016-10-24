<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*require_once './data/JPush/autoload.php';
use JPush\Model as M;
use JPush\JPushClient;
use JPush\Exception\APIConnectionException;
use JPush\Exception\APIRequestException;*/
class Jpush extends Front_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$php = php_sapi_name();
		//echo $php;
		if($php != "cli")
		{
			show_404();exit();	
		}
		$this->load->library('jpush');
		$time = strtotime(date('Y-m-d')." 00:00:00");
		$this->db->where('dateline >',$time);
		$query = $this->db->get('pay_app_message')->result_array();	
		foreach($query as $key)
		{
			$this->jpush->push(array('tag' => array('userId'.$key['id'])),'"系统于'.date('Y-m-d',$key['dateline']).'还款成功,项目'.$key['title'].',金额为:'.$key['monkey']);
		}
	}
	
	/*function test()
	{
		$this->load->library('jpush');	
		$this->jpush->push(array('tag' => array('userId30751')),'收到没 那谁谁谁');
	}*/
}
