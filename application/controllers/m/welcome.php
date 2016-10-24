<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends Front_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('welcome_m');
	}
	
	public function index()
	{
		$siteinfo = $this->_siteinfo();  //获取网站信息
		$data['title'] = $siteinfo['indextitle'];
		$data['keyword'] = $siteinfo['keyword'];
		$data['description'] = $siteinfo['description'];
		$data['gonggao'] = $this->welcome_m->indexnews(1);
		$data['meiti'] = $this->welcome_m->indexnews(3);
		$data['bulk'] = $this->welcome_m->bulk();
		//获取焦点图
		$this->db->order_by('sort','asc');
		$this->db->where('is_phone',1);
		$data['focus'] = $this->db->get('focus')->result_array();
		$get = $this->input->get('from',true);	
		if($get)
		{
			$this->session->set_userdata('from','app');	
		}
		$this->load->view('m/index',$data);
	}
	
	function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', '用户名', 'required');
		$this->form_validation->set_rules('password', '密码', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('m/login');
		}
		else
		{
			$username = trim($this->input->post('username'));
			$password = sha1($this->input->post('password'));
			$login = $this->welcome_m->login($username,$password);
			$get = $this->input->get('from',true);	
			if($login == "success")
			{
				if($get == "app" || $this->session->userdata('from') == "app")
				{
					$data['userinfo'] = userinfo();
					$this->db->where('id',$data['userinfo']['id']);
					$this->db->set('app',1);
					$this->db->update('user');
					$this->load->view('m/app_login',$data);
				}
				else
				{
					redirect('m/usercenter');
				}
			}
			else
			{
				$data['error'] = $login;
				$this->load->view('m/login',$data);
			}
		}	
	}
	function exit_login()
	{
		if($this->session->userdata('from') == "app")
		{
			$this->db->where('id',$this->session->userdata('uid'));
			$this->db->set('app',0);
			$this->db->update('user');
			$data['uid'] = $this->session->userdata('uid');
			$this->session->unset_userdata('uid');
			$this->load->view('m/app_exit',$data);
		}
		else
		{
			$this->session->unset_userdata('uid');	
			redirect(site_url('m'));
		}
	}
	
	function regesiter($ajax = false)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nickname', '用户名', 'required|trim|encode_php_tags|strip_tags|htmlspecialchars|is_unique[user.nickname]|min_length[4]|max_length[26]');
		$this->form_validation->set_rules('mobile', '手机号', 'required|trim|is_natural_no_zero|min_length[11]|max_length[11]|is_unique[user.mobile]');
		$this->form_validation->set_rules('password', '登陆密码', 'required|trim|min_length[8]|max_length[12]');
		$this->form_validation->set_rules('matches_password', '确认密码', 'required|trim|matches[password]');
		$this->form_validation->set_rules('phonecode', '手机验证码', 'required|is_natural_no_zero|min_length[6]|max_length[6]|phonecode[input.mobile]');
		$this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
		$this->form_validation->set_rules('piccode', '验证码', 'required|trim|min_length[4]|max_length[4]|callback_check_piccode');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('m/regesiter');
		}
		else
		{
			  $model_return = $this->welcome_m->regesiter();
			  if($model_return[0] == 0)
			  {
				  //注册成功
				  //删除验证码session
				  $this->session->unset_userdata('phone_code');
				  $this->session->unset_userdata('phone_code_time');
				  $this->session->unset_userdata('phone_numbner');	
				  //获取注册到的UID
				  $this->session->set_userdata('uid',$model_return[1]); //使用户登录
				  $this->load->model('interface_m');
				  $this->interface_m->sendmessage($this->input->post('mobile'),3); //发送注册成功短信模板为3
				  $this->session->set_flashdata('idcard','1');
				  redirect('m/usercenter/index'); //跳转到首页

			  }		
			  else
			  {
				  //注册失败	
				  $data['error'] = "系统繁忙,请稍后再试验";
				  $this->load->view('m/regesiter');
			  }
		}	
	}
	
	//验证码
	function regesiter_code($temp = false)
	{
		$this->load->helper('code');
		echo code(4,'regesiter_code');	
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
	//发送短信验证码
	function sendmessage($phone = false,$img_code = false)
	{
		$img_code = trim($img_code);
		if(strtolower($this->session->userdata('regesiter_code')) != strtolower($img_code) || $img_code == "")
		{
			echo "请输入正确的验证码";exit();	
		}
		if($this->session->userdata('phone_code') != false)
		{
			$phone_code_time = $this->session->userdata('phone_code_time'); //生成验证码时间
			if(time() - $phone_code_time <=60 ){
				//未超过60秒
				echo "请60秒后重发";exit();
			}
		}
		$this->load->library('form_validation');
		$required = $this->form_validation->required($phone);
		$is_unique = $this->form_validation->is_unique($phone,'user.mobile');
		$min_length = $this->form_validation->min_length($phone,11);
		$max_length = $this->form_validation->max_length($phone,11);
		$integer = $this->form_validation->is_natural_no_zero($phone);
		if($required && $is_unique && $min_length && $max_length && $integer)
		{
			$this->load->model('interface_m');
			$return = $this->interface_m->sendmessage($phone,1);
			if($return) //返回短信发送成功与失败
			{
				echo "success";exit();
			}
			else
			{
				echo "发送失败，请稍后再试";exit();		
			}
		}	
		else
		{
			echo "手机号已注册或不正确";exit();	
		}
	}
	
	//找回密码
	function forget($ajax = false)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('phonecode', '手机验证码', 'required|is_natural_no_zero|min_length[6]|max_length[6]|phonecode[input.mobile]');
		$this->form_validation->set_rules('mobile','手机号','required|is_natural_no_zero|min_length[11]|max_length[11]|callback_check_getphone');
		$this->form_validation->set_rules('password', '登陆密码', 'required|min_length[8]|max_length[12]');
		$this->form_validation->set_rules('matches_password', '确认密码', 'required|matches[password]');
		$this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('m/forget');
		}
		else
		{
			if($this->welcome_m->forget())
			{
				echo "<script>alert('修改成功');location='".site_url('m/welcome/login')."'</script>";exit(); 
			}
			else
			{
				echo "<script>alert('修改成功');location='".site_url('m/welcome/login')."'</script>";exit(); 
			}	
		}	
	}
	//找回密码发送短信
	function fogetsend($phone = false)
	{
		if($this->session->userdata('phone_code') != false)
		{
			$phone_code_time = $this->session->userdata('phone_code_time'); //生成验证码时间
			if(time() - $phone_code_time <=60 )
			{
				//未超过60秒
				echo "请60秒后重发";exit();
			}
		}
		$this->load->library('form_validation');
		$required = $this->form_validation->required($phone);
		$is_unique = $this->check_getphone($phone);
		$min_length = $this->form_validation->min_length($phone,11);
		$max_length = $this->form_validation->max_length($phone,11);
		$integer = $this->form_validation->is_natural_no_zero($phone);
		if($required && $is_unique && $min_length && $max_length && $integer)
		{
			$this->load->model('interface_m');
			$return = $this->interface_m->sendmessage($phone,2);
			if($return) //返回短信发送成功与失败
			{
				echo "success";exit();
			}
			else
			{
				echo "发送失败，请稍后再试";exit();		
			}
		}	
		else
		{
			echo "手机号不正确或不存在";exit();	
		}	
	}
	
	function check_getphone($str)
	{
		if($this->welcome_m->getphone($str))
		{
			return true;
		}	
		else
		{
			$this->form_validation->set_message('check_getphone', '%s不存在');	
			return false;
		}
	}
}