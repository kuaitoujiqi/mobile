<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usercenter extends Front_Controller {
	function __construct()
	{
		parent::__construct();
		$this->_check_login(); //检查登录
		$this->load->model('usercenter_m');
		$userinfo = userinfo();
		if($userinfo['is_idcard'] == 0)
		{
			if($this->uri->segment(3,3) !="idcard")
			{
				redirect('m/usercenter/idcard'); //未身份验证请先身份验证
			}
		}
		else
		{
			//设置交易密码	
			if($userinfo['trading'] == "")
			{
				if($this->uri->segment(3,3) !="trading"  && $this->uri->segment(3,3) !="sendphoncode")
				{
					redirect('m/usercenter/trading');	
				}
			}
			/*else
			{
				//检查绑定银行卡情况
				$this->db->where('static',2);
				$this->db->where('user_id',$userinfo['id']);
				$bank = $this->db->get('user_bank')->result_array();
				if(count($bank) <=0 && $this->uri->segment(2,2) != "addbindbank" && $this->uri->segment(2,2) != "binding_advance" && $this->uri->segment(2,2) != "binding")
				{
					redirect('usercenter/addbindbank');	
				}
			}*/
		}
		
	}
	
	function index()
	{
		
		$userinfo = userinfo();
		$data['userinfo'] = userinfo();
		
		$data['czjl'] = $this->usercenter_m->record(0,15,0);
		//持有产品金额
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('prostatic',1);
		$data['cyje'] = $this->db->get('user_products')->row_array();
		//待收利息
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('interest');
		$this->db->where('static',2);
		$data['lsje'] = $this->db->get('user_products')->row_array();
		$this->load->model('order_m');
		$this->order_m->same_monkey($userinfo['id']);
		
		//累计还款
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where_in('type',array(5,10));
		$data['ljhk'] = $this->db->get('fr_order')->row_array();
		
		//累计还款
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('type',5); //10为债券
		$ljhk = $this->db->get('fr_order')->row_array(); //累计还款
		$ljhk = empty($ljhk['monkey'])?0:$ljhk['monkey'];
		
		
		//累计购买债券原始价格
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('type',9);
		$ljgz_s = $this->db->get('fr_order')->row_array(); 
		$ljgz_s = empty($ljgz_s['monkey'])?0:$ljgz_s['monkey'];
		
		//累计购买债券实际价格
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('type',2);
		$ljgz_y = $this->db->get('user_products')->row_array(); 
		$ljgz_y = empty($ljgz_y['monkey'])?0:$ljgz_y['monkey'];
		
		//累计购买债券实际价格状态5 提前还本
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',5);
		$this->db->where('type',2);
		$ljgz_y1 = $this->db->get('user_products')->row_array(); 
		$ljgz_y1 = empty($ljgz_y1['monkey'])?0:$ljgz_y1['monkey'];
		
		$ljgz_y = $ljgz_y - (-$ljgz_y1);
		
		//获取已结束项目的的本金
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('interest',0);
		$this->db->where('static',2);
		$end_b = $this->db->get('user_products')->row_array(); 
		$end_b = empty($end_b['monkey'])?0:$end_b['monkey'];
		
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',5);
		$end_b1 = $this->db->get('user_products')->row_array(); 
		$end_b1 = empty($end_b1['monkey'])?0:$end_b1['monkey'];
		
		$end_b = $end_b -(-$end_b1);//41000.00+10000.00
		
		$ljsy = $ljhk - $end_b -(-($ljgz_y-$ljgz_s));//54156.00-51000  + (59000-69000.00)
		//历史还款 减去已结束的本金 加 债券差价
		$data['ljsy'] = $ljsy;			
		$this->load->view('m/usercenter/index',$data);	
	}
	
	function check_recharge_monkey($monkey)
	{
		$ex = explode(".",$monkey);
		if(!is_numeric($monkey) || $monkey <= 0 || count($ex) > 2 || (isset($ex[1]) && strlen($ex[1]) > 2))
		{
			$this->form_validation->set_message('check_recharge_monkey', '%s不正确111');
			return false;
		}	
		else
		{
			return true;	
		}
	}
	
	//充值
	function recharge($paytype = "quick_pay")
	{
		$data['userinfo'] = userinfo();
		$this->load->library('form_validation');
		$this->load->view('m/usercenter/recharge',$data);
		
		/*
		if($paytype == "online_bank")
		{
			//网银在线支付
			$this->form_validation->set_rules('monkey', '充值金额', 'trim|required|greater_than[0]|callback_check_recharge_monkey');
			$this->form_validation->set_rules('optionsRadios', '在线银行', 'trim|required');
			$this->form_validation->set_error_delimiters('', '');
			
			if ($this->form_validation->run() == FALSE)
			{	
				$bankinfo = require('./data/bankinfo.php');
				$data['bankinfo'] = $bankinfo['u_online'];
				$this->load->view('m/usercenter/recharge_online',$data);	
			}
			else
			{
				//充值提交	
				$return = $this->usercenter_m->recharge('online','m');
				if(!$return)
				{
					$bankinfo = require('./data/bankinfo.php');
					$data['bankinfo'] = $bankinfo['u_online'];
					$this->load->view('m/usercenter/recharge_online',$data);		
				}
			}
		}
		else
		{
			//快捷支付	
			$this->form_validation->set_rules('monkey', '充值金额', 'trim|required|greater_than[0]|callback_check_recharge_monkey');
			//$this->form_validation->set_rules('card_id', '在线银行', 'trim|required|integer');
			$this->form_validation->set_error_delimiters('', '');
			if ($this->form_validation->run() == FALSE)
			{						
				$this->db->where('static',2);
				$this->db->where('user_id',$data['userinfo']['id']);
				$bank_query = $this->db->get('user_bank',1,0);
				$data['bank'] = $bank_query->result_array();
				$data['bank_row'] = $bank_query->row_array(); 
				$this->load->view('m/usercenter/recharge',$data);	
			}
			else
			{
				//充值提交
				$return = $this->usercenter_m->recharge('quick','m');
				if($return[0] == 0)
				{
					$out_trade_no = $return[1]['out_trade_no'];
					$ticket = $return[1]['ticket'];	
					redirect('m/usercenter/advance_hosting/'.$out_trade_no."/".$ticket);
				}
				else
				{
					$data['error'] = $return[1];
					$this->db->where('static',2);
					$this->db->where('user_id',$data['userinfo']['id']);
					$bank_query = $this->db->get('user_bank',1,0);
					$data['bank'] = $bank_query->result_array();
					$data['bank_row'] = $bank_query->row_array(); 
					$this->load->view('m/usercenter/recharge',$data);			
				}	
			}
		}
		*/	
	}
	
	//ajax  托管充值  
	function send_recharge(){
		$return = $this->usercenter_m->recharge('online','m');
		echo $return;
	}
	
	//快捷支付短信校验
	function advance_hosting($order_id = false,$ticket = false)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('valid_code', '短信验证码', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('m/usercenter/recharge_adv');
		}
		else
		{
			$return = $this->usercenter_m->advance_hosting_pay($ticket,$order_id);
			if($return == "success")
			{
				$this->recharge_success();
			}
			else
			{
				echo "<script>alert('".$return."');location.href='".site_url('m/usercenter/recharge/quick_pay')."';</script>";exit();
			}	
		}	
	}
	
	//充值成功页面
	function recharge_success()
	{
		$this->load->view('m/usercenter/recharge_success');	
	}
	//操作记录
	function check_recharge_recode($uid){
     		//把新浪拦截的订单更改为失败
		$this->db->where('dateline <=',time()-18000);
		$this->db->where('uid',$uid);
		$this->db->where('type',1);
		$this->db->where('static',1);
		$this->db->set('static',3); //状态变为失败
		$this->db->update('fr_order');
		$result = $this->db->get('fr_order')->result_array();
	}
	function record($type = 2,$page = 1,$ajax = false)
	{   
		if($type == 1){
		$userinfo = userinfo();	
		$uid = $userinfo['id'];
		$this->check_recharge_recode($uid);
		}
		$this->load->library('pagination');
		$config['base_url'] = site_url('m/usercenter/record/'.$type);
		$config['per_page'] = 50; 
		$config['uri_segment'] = 5;
		$return = $this->usercenter_m->record($type,$config['per_page'],($page - 1) * $config['per_page']);
		
		$config['total_rows'] = $return[0];
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config); 
		$data['result'] = $return[1];
		$data['links'] = $this->pagination->create_links();
		$data['type'] = $type;
		$data['page'] = 1;
		if($ajax == false)
		{
			$this->load->view('m/usercenter/record',$data);	
		}
		else
		{
			if(count($return[1]) > 0)
			{
				$this->usercenter_m->info_static($data['result']);
				echo json_encode(array(0,$this->load->view('m/usercenter/ajax_record',$data,true)));	
			}
			else
			{
				echo json_encode(array('1'));	
			}	
		}
	}
	//下期收益
	function next_shouyi()
	{
		$userinfo = userinfo();
		$this->db->select('user_products.*,bulk_standard.next_interest,bulk_standard.endtitme');	
		$this->db->from('user_products');	
		$this->db->join('bulk_standard','user_products.projectid = bulk_standard.id');
		$this->db->where('user_products.static',2);//购买成功
		$this->db->where('user_products.uid',$userinfo['id']);//购买成功
		$this->db->where('user_products.prostatic',1);//持有状态
		$this->db->where('bulk_standard.static',2);//项目进行中
		$this->db->order_by('bulk_standard.next_interest','asc');
		$result = $this->db->get()->result_array();
		$time = array();
		$new_res = array();
		foreach($result as $key)
		{
			$next_interest = strtotime("+1 day",$key['next_interest']);
			$day = date('Y-m',$next_interest);
			if(!in_array($day,$time))
			{
				array_push($time,$day);	
			}
			$new_key['time'] = date('Y-m-d',$next_interest);
			$new_key['time_m'] = $day;
			$is_end = 1;
			$next_send = strtotime("+1 month",$key['next_interest']);
			if($next_send > $key['endtitme'])
			{
				$is_end = 2;	
			}
			$new_key['shouyi'] = $this->_user_lixi($key['rate'],$key['monkey'],$is_end);
			array_push($new_res,$new_key);
		}
		$data['data'] = array($time,$new_res);
		$this->load->view('m/usercenter/next_shouyi',$data);
	}
	
	function _user_lixi($rate,$monkey,$is_end = 1)
	{
		$year_rate = $rate * $monkey;//计算一年的利息
		$day_rate = number_format($year_rate/12,2,'.','');//计算每月的利息	
		if($is_end == 1)
		{
			return $day_rate;	
		}
		else
		{
			return $day_rate-(-$monkey);	
		}
	}
	
	function info($type=0,$page=1,$ajax = false)
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
		$config['base_url'] = site_url('m/usercenter/info/'.$type);
		$config['per_page'] = 10; 
		$config['uri_segment'] = 4;
		$return = $this->usercenter_m->info($type,$config['per_page'],($page - 1) * $config['per_page']);
		$config['total_rows'] = $return[0];
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config); 
		$data['result'] = $return[1];
		$data['links'] = $this->pagination->create_links();
		$data['type'] = $type;
		
			
		$data['type'] = $type;
		$data['page'] = 1;
		if($ajax == false)
		{
			$this->load->view('m/usercenter/info',$data);
		}
		else
		{
			if(count($return[1]) > 0)
			{
				$this->usercenter_m->info_static($data['result']);
				echo json_encode(array(0,$this->load->view('m/usercenter/ajax_info',$data,true)));	
			}
			else
			{
				echo json_encode(array('1'));	
			}	
		}
	}
	//删除信息
	function del_info($id = false)
	{
		$this->usercenter_m->del_info($id);
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	//提现 
	function withdraw()
	{
		$data['shouxufei'] = $this->usercenter_m->check_withdraw();
		$this->load->view('m/usercenter/withdraw',$data);
	}
	//提交提现
	function form_withdraw()
	{
		$return = $this->usercenter_m->withdraw(2);	
		echo json_encode($return);
	}
	
		//绑定银行卡
	function binding()
	{
		$data['userinfo'] = userinfo();
		
		$data['bank'] = $this->usercenter_m->binding_list();
		$this->load->view('m/usercenter/bindbank',$data);	
	}
	//增加银行卡
	function addbindbank()
	{
		$this->usercenter_m->bind_bank(2);
		/*
		if(!$this->usercenter_m->check_add_bind_bank())
		{
			echo "<script>alert('您有未处理完的绑定银行卡或已绑定银行卡');location.href='".site_url('m/usercenter/binding')."';</script>";exit();
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('bank_code', '银行', 'required|max_length[30]');
		$this->form_validation->set_rules('verify_mode', '绑卡类型', 'required|integer');
		$this->form_validation->set_rules('bank_account_no', '银行卡号', 'trim|required|integer|max_length[30]');
		$this->form_validation->set_rules('phone_no', '预留手机号', 'trim|required|integer|max_length[11]|min_length[11]');
		$this->form_validation->set_rules('prov', '省份', 'required|max_length[30]');
		$this->form_validation->set_rules('city', '城市', 'required|max_length[30]');
		$this->form_validation->set_rules('bank_branch', '支行名称', 'trim|max_length[100]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$bankinfo = require('./data/bankinfo.php');
			$data['bankinfo'] = $bankinfo['q_pay'];
			$data['userinfo'] = userinfo();
			$this->load->view('m/usercenter/addbingdbank',$data);		
		}
		else
		{
			$return = $this->usercenter_m->addbindbank();
			if($return[0] == 1)
			{
				$data['error'] = $return[1];
				$bankinfo = require('./data/bankinfo.php');
				$data['bankinfo'] = $bankinfo['q_pay'];
				$data['userinfo'] = userinfo();
				$this->load->view('m/usercenter/addbingdbank',$data);	
				exit();	
			}
			else
			{
				if($return[3] == 0)
				{
					//跳转到推进页面
					redirect('m/usercenter/binding_advance/'.$return[1]."/".$return[2]);	
				}
				else
				{
					echo "<script>alert('绑定成功');location='".site_url('m/usercenter/binding')."';</script>";exit();		
				}
			}
		}	
		*/
	}
	
	//绑定银行卡推进
	function binding_advance($id = false,$ticket = false)
	{
		if(!$this->usercenter_m->check_binding_adv($id,$ticket))
		{
			exit('输入非法');	
		}
		else
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('valid_code', '短信验证码', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('m/usercenter/bankadvice');
			}
			else
			{
				$return = $this->usercenter_m->binding_advance($ticket,$id);
				if($return[0] == 0)
				{
					echo "<script>alert('绑定成功');location='".site_url('m/usercenter/binding')."';</script>";exit();	
				}
				else
				{
					echo "<script>alert('".$return[1]."');location.href='".site_url('m/usercenter/addbindbank')."';</script>";exit();
				}	
			}
		}
		
	}
	
	//解除绑定
	function ubind_bank($id = false)
	{
		$return = $this->usercenter_m->ubinding($id);
		if($return)
		{
			echo "<script>alert('解除绑定成功');location='".site_url('m/usercenter/binding')."';</script>";exit();	
		}
		else
		{
			echo "<script>alert('解除绑定失败');location='".site_url('m/usercenter/binding')."';</script>";exit();		
		}
	}
	
	/*安全中心开始*/
	function safe()
	{
		$data['userinfo'] = userinfo();
		$this->load->view('m/usercenter/safe',$data);	
	}
	//修改密码
	function change_password($ajax = false)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('oldpass', '旧密码', 'required|min_length[8]|max_length[12]|callback_check_password');
		$this->form_validation->set_rules('newpass', '新密码', 'required|min_length[8]|max_length[12]');
		$this->form_validation->set_rules('matches_password', '确认密码', 'required|matches[newpass]');
		$this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('m/usercenter/safe/changepass');
		}
		else
		{
			  if($this->usercenter_m->change_password())
			  {
				  echo "<script>alert('修改成功');location='".site_url('m/usercenter/safe')."'</script>";exit(); 
			  }
			  else
			  {
				  echo "<script>alert('修改失败');location='".site_url('m/usercenter/safe')."'</script>";exit(); 
			  }
		}
	}
	function check_password($str)
	{
		$userinfo = userinfo();
		if(sha1($str) != $userinfo['password'])
		{
			$this->form_validation->set_message('check_password', '%s不正确');
			return false;
		}
		else
		{
			return true;
		}
    }
	
	//绑定身份证
	function idcard()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', '姓名', 'required|min_length[2]|max_length[12]');		
		$this->form_validation->set_rules('idcard', '身份证', 'required|iscard|is_unique[user.idcard]');	
		$this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('m/usercenter/safe/idcard');
		}
		else
		{
				$return = $this->usercenter_m->authentication();
				if($return[0] == 0)
				{
					//$this->session->set_flashdata('trading','1');
					echo "<script>alert('绑定成功');location='".site_url('m/usercenter/safe')."'</script>";exit(); //成功
				}
				else
				{
					echo "<script>alert('绑定失败');location='".site_url('m/usercenter/safe')."'</script>";exit();
				}	
		}	
	}
	
	//交易密码
	function trading()
	{
		$check_trading = $this->usercenter_m->check_trading();
		if(!$check_trading){
			$this->usercenter_m->set_trading(2);
		}else{
			redirect('m/usercenter/safe');
		}
		
	}

	//更改交易密码
	function change_trading()
	{
		$this->usercenter_m->change_trading(2);	
	}	
	
	//发送手机验证码
	function sendphoncode($type = "edit_phone",$phonenum = false)
	{
		if($this->session->userdata('phone_code') != false)
		{
			$phone_code_time = $this->session->userdata('phone_code_time'); //生成验证码时间
			if(time() - $phone_code_time <=60)
			{
				//未超过60秒
				echo "请60秒后重发";exit();
			}
		}
		$this->load->model('interface_m');
		$userinfo = userinfo();
		switch($type)
		{
			case "edit_phone":$model_id = 4;
				//修改手机号
				$this->load->library('form_validation');
				$required = $this->form_validation->required($phonenum);
				$is_unique = $this->form_validation->editonly($phonenum,'user.mobile.mobile');
				$min_length = $this->form_validation->min_length($phonenum,11);
				$max_length = $this->form_validation->max_length($phonenum,11);
				$integer = $this->form_validation->is_natural($phonenum);
				if($required && $is_unique && $min_length && $max_length && $integer)
				{
					if($phonenum == $userinfo['mobile'])
					{
						echo "手机号和原手机号相同无需更改";exit();	
					}
				}
				else
				{
					echo "新手机号已注册或不正确";exit();
				}
			break;	
			case "trading":$model_id = 5;
				$phonenum = $userinfo['mobile'];
			break;
		}
		$return = $this->interface_m->sendmessage($userinfo['mobile'],$model_id);
		if($return) //返回短信发送成功与失败
		{
			echo "success";exit();
		}
		else
		{
			echo "发送失败，请稍后再试";exit();		
		}
	}
	//修改手机号
	function change_phone()
	{
		$userinfo = userinfo();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('phonecode', '手机验证码', 'required|is_natural|min_length[6]|max_length[6]|phonecode[num.'.$userinfo['mobile'].']');
		$this->form_validation->set_rules('mobile','旧手机号','required|is_natural|min_length[11]|max_length[11]|callback_check_changephone');
		$this->form_validation->set_rules('newphone','新手机号','required|is_natural|min_length[11]|max_length[11]|editonly[user.mobile.mobile]');
		$this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('m/usercenter/safe/change_phone');
		}
		else
		{
			  if($this->usercenter_m->change_phone())
			  {
				  echo "<script>alert('修改成功');location='".site_url('m/usercenter/safe')."'</script>";exit(); 
			  }
			  else
			  {
				  echo "<script>alert('修改失败');location='".site_url('m/usercenter/safe')."'</script>";exit(); 
			  }		
		}
	}
	function check_changephone($str)
	{
		$userinfo = userinfo();
		if($str != $userinfo['mobile'])
		{
			$this->form_validation->set_message('check_changephone', '%s不正确');
			return false;
		}
		else
		{
			return true;
		}	
	}
	
	function account(){
		$userinfo = userinfo();
		$data['userinfo'] = $userinfo;
		
		$data['czjl'] = $this->usercenter_m->record(0,15,0);
		//持有产品金额
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('prostatic',1);
		$data['cyje'] = $this->db->get('user_products')->row_array();
		//待收利息
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('interest');
		$this->db->where('static',2);
		$data['lsje'] = $this->db->get('user_products')->row_array();
		$this->load->model('order_m');
		$this->order_m->same_monkey($userinfo['id']);
		
		//累计还款
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where_in('type',array(5,10));
		$data['ljhk'] = $this->db->get('fr_order')->row_array();
		
		//累计还款
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('type',5); //10为债券
		$ljhk = $this->db->get('fr_order')->row_array(); //累计还款
		$ljhk = empty($ljhk['monkey'])?0:$ljhk['monkey'];
		
		
		//累计购买债券原始价格
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('type',9);
		$ljgz_s = $this->db->get('fr_order')->row_array(); 
		$ljgz_s = empty($ljgz_s['monkey'])?0:$ljgz_s['monkey'];

		//累计投资
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('type',1); // 原始投资
		$ljtz = $this->db->get('user_products')->row_array(); //持有产品金额
		$ljtz = empty($ljtz['monkey'])?0:$ljtz['monkey'];

		//新增
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',5);
		$this->db->where('type',1); // 原始投资
		$ljtz1 = $this->db->get('user_products')->row_array(); //持有产品金额
		$ljtz1 = empty($ljtz1['monkey'])?0:$ljtz1['monkey'];
		$data['ljtz'] = $ljtz-(-$ljtz1);		
		
		//累计购买债券原始价格
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('type',9);
		$ljgz_s = $this->db->get('fr_order')->row_array(); 
		$ljgz_s = empty($ljgz_s['monkey'])?0:$ljgz_s['monkey'];
		$data['gmzq'] = $ljgz_s;		
		
		//累计购买债券实际价格
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('type',2);
		$ljgz_y = $this->db->get('user_products')->row_array(); 
		$ljgz_y = empty($ljgz_y['monkey'])?0:$ljgz_y['monkey'];
		
		//累计购买债券实际价格状态5 提前还本
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',5);
		$this->db->where('type',2);
		$ljgz_y1 = $this->db->get('user_products')->row_array(); 
		$ljgz_y1 = empty($ljgz_y1['monkey'])?0:$ljgz_y1['monkey'];
		
		$ljgz_y = $ljgz_y - (-$ljgz_y1);
		$gmzqsjjg = $ljgz_y;

		//待收总额 等于持有产品+预期收益+债券差价
		//$data['cyje']  $data['lsje']  $data['gmzq']  $gmzqsjjg
		$lsjea = $data['lsje']['interest']== ""?0:$data['lsje']['interest'];
		$cyjea = $data['cyje']['monkey'] == ""?0:$data['cyje']['monkey'];
		$data['dsze'] = $cyjea-(-$lsjea)-(-($data['gmzq']-$gmzqsjjg));
		
		//获取已结束项目的的本金
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('interest',0);
		$this->db->where('static',2);
		$end_b = $this->db->get('user_products')->row_array(); 
		$end_b = empty($end_b['monkey'])?0:$end_b['monkey'];
		
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',5);
		$end_b1 = $this->db->get('user_products')->row_array(); 
		$end_b1 = empty($end_b1['monkey'])?0:$end_b1['monkey'];
		
		$end_b = $end_b -(-$end_b1);//41000.00+10000.00
		
		$ljsy = $ljhk - $end_b -(-($ljgz_y-$ljgz_s));//54156.00-51000  + (59000-69000.00)
		$lsjea = $data['lsje']['interest']== ""?0:$data['lsje']['interest'];
		//历史还款 减去已结束的本金 加 债券差价
		$data['ljsy'] = $ljsy;	
		
		$this->load->view('m/usercenter/account',$data);	
	}
	
	function _interest($rate=false,$day = false,$monkey = false)
	{
		//rate 年华利率 day 购买时间 monkey 购买钱数
		//计算一年总利息
		$year_rate = $rate * $monkey;
		//计算每月的利息
		$day_rate = number_format($year_rate/12,2,'.','');
		//计算总共的利息
		//$day_rate = $day_rate * $day;
		//$count_rate = $day_rate * $day;	
		return number_format($day_rate,2,'.','');
	}	
}