<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-Type: application/json;charset=utf-8");
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:POST,GET");
// header("Access-Control-Allow-Credentials: true");
// header('Access-Control-Allow-Origin: https://m.kuaitoujiqi.com');
class Welcome extends Front_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('welcome_m');
		$this->load->model('app/response_m');
		$this->load->model('app/product_m');
		$this->load->model('transfer_m');
	}
	function login()
	{
			$username = trim($this->input->post('username'));
			$password = sha1($this->input->post('userpass'));
			$login = $this->welcome_m->login($username,$password);
		 	if($login == "success")
		    {
		    	$data['username'] = $_SESSION['name'];
		    	$data['uid'] = $_SESSION['uid'];
		    	return $this->response_m->show(200, '登陆成功', $data);
             }else{
             	return $this->response_m->show(400, '登陆失败');
             }
		}
		public function index(){
			$siteinfo = $this->_siteinfo();  //获取网站信息
		$data['title'] = $siteinfo['indextitle'];
		$data['keyword'] = $siteinfo['keyword'];
		$data['description'] = $siteinfo['description'];
		$data['gonggao'] = $this->welcome_m->indexnews(1);
		$data['meiti'] = $this->welcome_m->indexnews(3);
		$result= $this->welcome_m->bulkApp();
		$data['jindu'] = array();
		foreach ($result as $key => $value) {
			$data['bulk'][$key]['fJin'] = (((int)$value['fTotal']-(int)$value['fMoney'])/(int)$value['fTotal']*100).'%';
			$data['bulk'][$key]['fRate'] = ($value['fRate']*100).'%';
			$data['bulk'][$key]['fId'] = $value['fId'];
			$data['bulk'][$key]['fMoney'] = $value['fMoney'];
			$data['bulk'][$key]['fTime'] = $value['fTime'];
			$data['bulk'][$key]['fTitle'] = $value['fTitle'];
			$data['bulk'][$key]['fTotal'] = $value['fTotal'];
			
		}
		// echo '<pre>';
		// var_dump($data['bulk']);
		//获取焦点图
		$this->db->order_by('sort','asc');
		$this->db->where('is_phone',1);
		$data['focus'] = $this->db->get('focus')->result_array();
		return $this->response_m->show(200, '首页数据获取成功', $data);
		 }	
	 function bulk_standard_list($page = 1,$ajax = false)
	{
		$config['first_tag_open']		= '<li>';
		$config['first_tag_close']		= '</li>';
		$config['last_tag_open']		= '<li>';
		$config['last_tag_close']		= '</li>';
		$config['cur_tag_open']		= '<li class="active"><a>';
		$config['cur_tag_close']		= '</a></li>';
		$config['next_tag_open']		= '<li>';
		$config['next_tag_close']		= '</li>';
		$config['prev_tag_open']		= '<li>';
		$config['prev_tag_close']		= '</li>';
		$config['num_tag_open']		= '<li>';
		$config['num_tag_close']		= '</li>';
		$this->load->library('pagination');
		$config['base_url'] = site_url('product/bulk_standard_list/');
		$config['per_page'] = 5; 
		$return = $this->welcome_m->app_bulk_standard_list($config['per_page'],($page - 1) * $config['per_page']);

		$config['total_rows'] = $return[0];
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config); 
		$result= $return[1];
		$data['links'] = $this->pagination->create_links();
		$data['page'] = 1;
		foreach ($result as $key => $value) {
			$data['result'][$key]['fJin'] = (((int)$value['fTotal']-(int)$value['fMoney'])/(int)$value['fTotal']*100).'%';
			$data['result'][$key]['fRate'] = ($value['fRate']*100);
			$data['result'][$key]['fID'] = $value['fID'];
			$data['result'][$key]['fMoney'] = $value['fMoney'];
			$data['result'][$key]['fTime'] = $value['fTime'];
			$data['result'][$key]['fTitle'] = $value['fTitle'];
			$data['result'][$key]['fTotal'] = $value['fTotal'];
			
		}
		// echo '<pre>';
		// var_dump($data['result']);
	 echo json_encode($data['result']);
	}
function transfer_list($page = 0)
	{
		//设置超过3天的债券转让状态或2天未审核的项目
		$this->transfer_m->task_transfer_list();
		$config['first_tag_open']		= '<li>';
		$config['first_tag_close']		= '</li>';
		$config['last_tag_open']		= '<li>';
		$config['last_tag_close']		= '</li>';
		$config['cur_tag_open']		= '<li class="active"><a>';
		$config['cur_tag_close']		= '</a></li>';
		$config['next_tag_open']		= '<li>';
		$config['next_tag_close']		= '</li>';
		$config['prev_tag_open']		= '<li>';
		$config['prev_tag_close']		= '</li>';
		$config['num_tag_open']		= '<li>';
		$config['num_tag_close']		= '</li>';
		$this->load->library('pagination');
		$config['base_url'] = site_url('product/transfer_list/');
		$config['per_page'] = 5; 
		$return = $this->transfer_m->front_transfer_list($config['per_page'],$page);
		$config['total_rows'] = $return[0];
		$config['uri_segment'] = 3;
		$data['result'] = $return[1];
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		
		$data['gonggao'] = $this->welcome_m->indexnews(1);
		$data['webgonggao'] = $this->welcome_m->indexnews(11);
		$data['meiti'] = $this->welcome_m->indexnews(3);
		
		foreach ($data['result'] as $key => $value) {
			$userdata[$key]['fID'] = $value['id'];
			$userdata[$key]['fJia'] = $value['holding'];
			$userdata[$key]['fMoney'] = $value['monkey'];
			$userdata[$key]['fRate'] = $value['rate']*100;
			$userdata[$key]['fShou'] = $value['interest'];
			$userdata[$key]['fTime'] = date('Y-m-d',$value['endtitme']-86400);
			$userdata[$key]['fTitle'] = $value['title'];
		}
		// echo '<pre>';
		// var_dump($data['result']);
		// var_dump($userdata);
		return $this->response_m->show(200, '个人中心数据获取成功', $userdata);
	}
	function sendmessage()
	 {  
	   if($this->session->userdata('phone_code') != false)
		{
			$phone_code_time = $this->session->userdata('phone_code_time'); //生成验证码时间
			if(time() - $phone_code_time <=60 ){
				//未超过60秒
				echo "请60秒后重发";exit();
			}
		} 
		$phone = $_POST['Sphone'];
		$this->load->library('form_validation');
		$required = $this->form_validation->required($phone);
		// $is_unique = $this->form_validation->is_unique($phone,'user.mobile');
		$min_length = $this->form_validation->min_length($phone,11);
		$max_length = $this->form_validation->max_length($phone,11);
		$integer = $this->form_validation->is_natural_no_zero($phone);
		if($required && $min_length && $max_length && $integer)
		{
			$this->load->model('interface_m');
			$return = $this->interface_m->sendmessage($phone,1);
			if($return) //返回短信发送成功与失败
			{
					return $this->response_m->show(200, '成功',$this->session->userdata('phone_code'));
			}
			else
			{
				return $this->response_m->show(400, '失败');		
			}
		}	
		else
		{
			return $this->response_m->show(401, '手机格式不正却');
		 }
	}
	function regesiter_code($temp = false)
	{
		$this->load->helper('code');
		 code(4,'allapp_code');	
		// echo ($this->session->userdata('app_code'));
		// echo $return;
	}
	
	function test(){
//    $data = $_GET['code'];
// $callback = $_GET['callback'];
// echo $callback.'('.json_encode($data).')';
// exit;
  echo $this->session->userdata('phone_code');
	}
	//检测图片验证码
	function check_piccode($str = false)
	{
		$code = $this->session->userdata('regesiter_code');
		// var_dump($code);
		if (strtolower($str) == strtolower($code))
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('check_piccode', '%s 不正确');
			return false;	
		}
	}
	function regesiter()
	{		//验证用户名
		 $str = $_GET['code'];
	     $code = $this->session->userdata('allapp_code');
		// var_dump($code);
		if (strtolower($str) != strtolower($code))
		{
			 $data['code'] = '400';//验证码不正确
		}else{
			 $data['code'] = '200';//验证码正确
		}
		  $username = $_GET['nickname']; 
			$preg = '/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{2,16}$/u'; //2到16为中文数字 字母
			if(!preg_match($preg,$username)){
				$data['username'] = '401';//用户名格式
            
			}else{
				$data['username'] = '200';//用户名正确
			}
			$mobile = $_GET['mobile'];
			$preg = '/^1[34578]\d{9}$/';
				if(!preg_match($preg,$mobile)){
				$data['mobile'] = '401';//手机格式不正确
			}else{
				$data['mobile'] = '200';
			}
			// // 密码
			$pass = $_GET['password'];
			$preg = '/^[0-9A-Za-z!-)]{8,16}$/';
				if(!preg_match($preg,$pass)){
				$data['pasd'] = '401';
			}else{
				$data['pasd'] = '200';
			}
			 $model_return = $this->welcome_m->regesiter();
			   if($model_return[0] == 0)
			  {
			 	  //注册成功
				  //删除验证码session
				  $this->session->unset_userdata('phone_code');
				  $this->session->unset_userdata('phone_code_time');
				  $this->session->unset_userdata('phone_numbner');	
				  //获取注册到的UID
				  $this->interface_m->sendmessage($this->input->post('mobile'),3); //发送注册成功短信模板为3
				  $this->session->set_flashdata('idcard','1');
				  $data['register'] = '200';//注册成
			  }	 else{
				  //注册失败	
				   $this->session->unset_userdata('phone_code');
				  $this->session->unset_userdata('phone_code_time');
				  $this->session->unset_userdata('phone_numbner');	
				  $data['error'] = "系统繁忙,请稍后再试验";
				  $data['register'] = '401';//系统繁忙
			  }
			$callback = $_GET['callback'];
           echo $callback.'('.json_encode($data).')';
		}

}