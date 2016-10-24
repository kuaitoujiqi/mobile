<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usercenter extends Front_Controller {

	function __construct()
	{
		parent::__construct();
		
		//添加假信息
		//$this->session->set_userdata('uid',500143);
		
		$this->_check_login(); //检查登录
		$this->load->model('usercenter_m');
		$this->load->helper('front');
		$this->load->helper('money');
		$userinfo = userinfo();
		
		if($userinfo['is_idcard'] == 0)
		{
			$this->session->set_flashdata('idcard','1');
			if($this->uri->segment(2,2) != "verify_success" && $this->uri->segment(2,2) != "verify_idcard" && $this->uri->segment(2,2) != "safe" && $this->uri->segment(2,2) !="authentication" && $this->uri->segment(2,2) != "change_phone" && $this->uri->segment(2,2) !="change_password" && $this->uri->segment(2,2) !="sendphoncode")
			{
				redirect('usercenter/verify_idcard'); //未身份验证请先身份验证
			}
		}
		else
		{

			//设置交易密码	
			if($userinfo['trading'] == "")
			{
				//使用接口查询是否设置交易密码
				$check_trading = $this->usercenter_m->check_trading();
				if(!$check_trading)
				{
					$this->usercenter_m->set_trading();	
				}
				/*$this->session->set_flashdata('trading','1');
				if($this->uri->segment(2,2) != "safe" && $this->uri->segment(2,2) !="trading"  && $this->uri->segment(2,2) !="sendphoncode")
				{
					redirect('usercenter/safe');	
				}*/
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
		
		$this->order_m->same_monkey($userinfo['id']);
		$data['czjl'] = $this->usercenter_m->record(0,15,0);
		$data['userinfo'] = userinfo();
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
		
		//获取已结束项目的的本金
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('interest',0);
		$this->db->where('static',2);
		$end_b = $this->db->get('user_products')->row_array(); 
		$end_b = empty($end_b['monkey'])?0:$end_b['monkey'];
		//新增
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',5);
		$end_b1 = $this->db->get('user_products')->row_array(); 
		$end_b1 = empty($end_b1['monkey'])?0:$end_b1['monkey'];
		
		$end_b = $end_b - (-$end_b1);
		
		//累计还款
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('type',5); //10为债券
		$ljhk = $this->db->get('fr_order')->row_array(); //累计还款
		$ljhk = empty($ljhk['monkey'])?0:$ljhk['monkey'];
		
		$ljsy = $ljhk - $end_b -(-($ljgz_y-$ljgz_s));
		$data['ljsy'] = $ljsy;
		
		//累计充值
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('type',1);
		$ljgz_s = $this->db->get('fr_order')->row_array(); 
		$ljgz_s = empty($ljgz_s['monkey'])?0:$ljgz_s['monkey'];
		$data['ljcz'] = $ljgz_s;
		
		//累计提现
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('type',7);
		$ljgz_s = $this->db->get('fr_order')->row_array(); 
		$ljgz_s = empty($ljgz_s['monkey'])?0:$ljgz_s['monkey'];
		$data['ljtx'] = $ljgz_s;
		
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
		
		
		//累计债券转让原始产品价格
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',4);
		$ljzz_y = $this->db->get('user_products')->row_array(); 
		$ljzz_y = empty($ljzz_y['monkey'])?0:$ljzz_y['monkey'];
		$data['zzzr'] = $ljzz_y;
		
		//累计购买债券原始价格
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('type',9);
		$ljgz_s = $this->db->get('fr_order')->row_array(); 
		$ljgz_s = empty($ljgz_s['monkey'])?0:$ljgz_s['monkey'];
		
		
		//待收总额 等于持有产品+预期收益+债券差价
		//$data['cyje']  $data['lsje']  $data['gmzq']  $gmzqsjjg
		$lsjea = $data['lsje']['interest']== ""?0:$data['lsje']['interest'];
		$cyjea = $data['cyje']['monkey'] == ""?0:$data['cyje']['monkey'];
		$data['dsze'] = $cyjea-(-$lsjea)-(-($data['gmzq']-$gmzqsjjg));
		
		$data['cha'] = $data['gmzq']-$gmzqsjjg;
		
		$this->load->view('usercenter/index',$data);
	}
	function sina_show()
	{
		$userinfo = userinfo();
		$uid = $userinfo['id'];
		$data['html'] = $this->usercenter_m->show_member_infos_sina($uid);	
		$this->load->view('usercenter/sinashow',$data);	
	}
	
	//消息中心
	function info($type=0,$page=0)
	{
		$data['userinfo'] = userinfo();
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
		$config['base_url'] = site_url('usercenter/info/'.$type);
		$config['per_page'] = 10; 
		$config['uri_segment'] = 4;
		$return = $this->usercenter_m->info($type,$config['per_page'],$page);
		$config['total_rows'] = $return[0];
		$this->pagination->initialize($config); 
		$data['result'] = $return[1];
		$data['links'] = $this->pagination->create_links();
		$data['type'] = $type;
		$this->load->view('usercenter/info',$data);	
		$this->usercenter_m->info_static($data['result']);
	}
	//删除信息
	function del_info($id = false)
	{
		$this->usercenter_m->del_info($id);
		redirect($_SERVER['HTTP_REFERER']);
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
	
	//检查账户余额
	function check_balance(){
		$userinfo = userinfo();
		echo $userinfo['balance'];
	}
	
	//充值中心
	function recharge($page = 0)
	{
		$data['userinfo'] = userinfo();
		$this->load->library('form_validation');

 		$this->load->library('pagination');
		$config['base_url'] = site_url('usercenter/recharge');
		$config['per_page'] = 15; 
		$config['cur_page'] = $page;
		$return = $this->usercenter_m->record(1,$config['per_page'],$page);
		
		$config['total_rows'] = $return[0];
		$this->pagination->initialize($config); 
		$data['result'] = $return[1];
		$data['links'] = $this->pagination->create_links();	
		$data['type'] = 2;	

		$bankinfo = require('./data/bankinfo.php');
		$data['bankinfo'] = $bankinfo['u_online'];
		$this->load->view('usercenter/recharge',$data);	

	}

	//ajax  托管充值  
	function send_recharge(){
		$return = $this->usercenter_m->recharge('online');
		echo $return;
	}	
	
	//邦卡支付推进
	function advance_hosting($order_id = false,$ticket = false)
	{	
	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('valid_code', '短信验证码', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('usercenter/advance_hosting');
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
				echo "<script>alert('".$return."');location.href='".site_url('usercenter/recharge/quick_pay')."';</script>";exit();
			}	
		}	
	}
	
	//充值成功
	function recharge_success()
	{
		$this->load->view('usercenter/recharge_success');	
	}
	
	//操作记录
	function record($type = 0,$page = 0)
	{
		$userinfo = userinfo();
		$data['userinfo'] = userinfo();
		//累计充值
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('type',1);
		$ljgz_s = $this->db->get('fr_order')->row_array(); 
		$ljgz_s = empty($ljgz_s['monkey'])?0:$ljgz_s['monkey'];
		$data['ljcz'] = $ljgz_s;	
		
		//累计提现
		$this->db->where('uid',$userinfo['id']);
		$this->db->select_sum('monkey');
		$this->db->where('static',2);
		$this->db->where('type',7);
		$ljgz_s = $this->db->get('fr_order')->row_array(); 
		$ljgz_s = empty($ljgz_s['monkey'])?0:$ljgz_s['monkey'];
		$data['ljtx'] = $ljgz_s;		
		
		$this->load->library('pagination');
		$config['base_url'] = site_url('usercenter/record/'.$type);
		$config['per_page'] = 15; 
		$config['uri_segment'] = 4;
		$return = $this->usercenter_m->record($type,$config['per_page'],$page);
		$config['total_rows'] = $return[0];
		$this->pagination->initialize($config); 
		$data['result'] = $return[1];
		$data['links'] = $this->pagination->create_links();
		
		$data['type'] = $type;
		$this->load->view('usercenter/record',$data);	
	}
	//红包
	function redpaper($page = 0)
	{   
		$userinfo = userinfo();
		$data['userinfo'] = userinfo();
		$uid = $userinfo['id'];
		$per_page = 15;	
		$queryall= $this->db->query("SELECT user_products.uid,user_products.projectid,bulk_standard.id,bulk_standard.title as alltitle,fr_order.id as allid,fr_order.type,fr_order.uid,fr_order.monkey,fr_order.dateline,user_products.monkey,red_paper.title,red_paper.monkey FROM (fr_order left join user_products on user_products.uid = fr_order.uid) left join red_paper on fr_order.monkey = red_paper.monkey left join bulk_standard on user_products.projectid = bulk_standard.id WHERE fr_order.type = 16 and user_products.monkey >= 5000 and fr_order.uid=$uid and red_paper.monkey>0");//获取记录总数

		$query= $this->db->query("SELECT user_products.uid,user_products.projectid,bulk_standard.id,bulk_standard.title as alltitle,fr_order.id as allid,fr_order.type,fr_order.uid,fr_order.monkey,fr_order.dateline,user_products.monkey,red_paper.title,red_paper.monkey FROM (fr_order left join user_products on user_products.uid = fr_order.uid) left join red_paper on fr_order.monkey = red_paper.monkey left join bulk_standard on user_products.projectid = bulk_standard.id WHERE fr_order.type = 16 and user_products.monkey >= 5000 and fr_order.uid=$uid and red_paper.monkey>0 order by fr_order.id DESC limit $page,10");
		 // var_dump($query);
		 $data['info'] = $query->result_array();
		 $num = $queryall->num_rows();
		 // var_dump($num);
 		$this->load->library('pagination');
		$config['base_url'] = site_url('usercenter/redpaper');
		$config['per_page'] = 10;//每页记录数 
		$config['cur_page'] = $page;
		$config['total_rows'] = $num;//总记录数

		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();	
		//var_dump($data['links']);
       $this->load->view('usercenter/redpaper',$data);
		 		
	}
	//债券转让
	function transfer($page = 0)
	{
		$userinfo = userinfo();
		$data['userinfo'] = userinfo();
		$uid = $userinfo['id'];
		$this->load->model('transfer_m');
		$this->load->library('pagination');
		$config['base_url'] = site_url('usercenter/transfer/');
		$config['per_page'] = 10; 
		$config['uri_segment'] = 3;
		$return = $this->transfer_m->user_transfer_list($config['per_page'],$page,$uid);
		$config['total_rows'] = $return[0];
		$this->pagination->initialize($config); 
		$data['result'] = $return[1];
		$data['links'] = $this->pagination->create_links();
		$this->load->view('usercenter/transfer',$data);		
	}
	
	function user_transfer($page = 0)
	{
		$userinfo = userinfo();
		$data['userinfo'] = userinfo();
		$uid = $userinfo['id'];
		$this->load->model('transfer_m');
		$this->load->library('pagination');
		$config['base_url'] = site_url('usercenter/user_transfer/');
		$config['per_page'] = 10; 
		$config['uri_segment'] = 3;
		$return = $this->transfer_m->user_transfer_history($config['per_page'],$page,$uid);
		$config['total_rows'] = $return[0];
		$this->pagination->initialize($config); 
		$data['result'] = $return[1];
		$data['links'] = $this->pagination->create_links();
		$this->load->view('usercenter/user_transfer',$data);		
	}
	function ajax_transfer()
	{
		$this->load->model('transfer_m');
		echo $this->transfer_m->transfer();	
	}
	
	function del_transfer($id = false)
	{
		$this->load->model('transfer_m');
		$userinfo = userinfo();
		$return = $this->transfer_m->del_transfer($userinfo,$id);
		if($return[0] == 0)
		{
			//成功
			echo "<script>alert('撤销成功');location.href='".site_url('usercenter/user_transfer')."';</script>";exit();
		}
		else
		{
			echo "<script>alert('".$return[1]."');location.href='".site_url('usercenter/user_transfer')."';</script>";exit();	
		}	
	}
	
	//提现 
	function withdraw($type = 7,$page = 0)
	{
		$this->load->library('pagination');
		$config['base_url'] = site_url('usercenter/record/7');
		$config['per_page'] = 15; 
		$config['uri_segment'] = 4;
		$return = $this->usercenter_m->record(7,$config['per_page'],$page);
		$config['total_rows'] = $return[0];
		$this->pagination->initialize($config); 
		$data['result'] = $return[1];
		$data['links'] = $this->pagination->create_links();		
		$data['type'] = 7;
		
		$data['shouxufei'] = $this->usercenter_m->check_withdraw();
		$this->load->view('usercenter/withdraw',$data);
	}
	//提交提现
	function form_withdraw()
	{
		$return = $this->usercenter_m->withdraw(1);	
		echo json_encode($return);
	}
	//安全中心
	function safe($type = false)
	{
		$data['userinfo'] = userinfo();
		$data['trading'] = "";
		if($type == "jymm")
		{
			$data['trading'] = 1;
		}
		$data['userinfo'] = userinfo();
		$this->load->view('usercenter/safe',$data);
	}
    
	/*安全中心开始*/
	//修改密码
	function change_password($ajax = false)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('oldpass', '旧密码', 'required|min_length[8]|max_length[12]|callback_check_password');
		$this->form_validation->set_rules('newpass', '新密码', 'required|min_length[8]|max_length[12]');
		$this->form_validation->set_rules('matches_password', '确认密码', 'required|matches[newpass]');
		$this->form_validation->set_error_delimiters('', '');
		if ($this->form_validation->run() == FALSE)
		{
			echo form_error($ajax);	
		}
		else
		{
			if($ajax == false || $ajax == "")
			{
				if($this->usercenter_m->change_password())
				{
					echo "success";exit();
				}
				else
				{
					echo "failed";exit();
				}
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
	
	//添加绑定邮箱
	function bind_email($type = "add",$ajax = false)
	{
		$this->load->library('form_validation');
		if($type != "add")
		{
			//修改邮箱
			$this->form_validation->set_rules('email', '电子邮箱', 'required|valid_email|editonly[user.id.email]');
			$this->form_validation->set_rules('oldemail', '老邮箱', 'required|valid_email|callback_check_oldemail');
		}
		else
		{
			//添加邮箱
			$this->form_validation->set_rules('email', '电子邮箱', 'required|valid_email|is_unique[user.email]');	
		}
		$this->form_validation->set_rules('email_code', '邮箱验证码', 'required|is_natural|min_length[6]|max_length[6]|callback_email_code');
		$this->form_validation->set_error_delimiters('', '');
		if ($this->form_validation->run() == FALSE)
		{
			echo form_error($ajax);
		}
		else
		{
			if($ajax == false || $ajax == "")
			{
				if($this->usercenter_m->bind_email())
				{
					echo "success";exit();
				}
				else
				{
					echo "failed";exit();
				}
			}	
		}
	}
	//发送邮件CODE
	function sendemailcode($type = "add",$str = false)
	{
		if($this->session->userdata('email_code') != false)
		{
			$phone_code_time = $this->session->userdata('email_code_time'); //生成验证码时间
			if(time() - $phone_code_time <=120 )
			{
				//未超过60秒
				echo "请120秒后重发";exit();
			}
		}
		$str = urldecode($str);
		$this->load->library('form_validation');
		$required = $this->form_validation->required($str);
		if($type == "add")
		{
			//添加
			$is_unique = $this->form_validation->is_unique($str,'user.email');
		}
		else
		{
			//修改
			$is_unique = $this->form_validation->editonly($str,'user.id.email');
		}
		$valid_email = $this->form_validation->valid_email($str);
		if($required && $is_unique && $valid_email)
		{
			$this->load->model('interface_m');
			$return = $this->interface_m->send_email($str);
			if($return == "success")
			{
				//发送成功
				echo "success";exit();
			}
			else
			{
				echo "系统繁忙，请稍后再试";exit();
			}
		}
		else
		{
			//验证失败
			echo "邮箱不正确或已被人绑定";exit();	
		}
	}
	//
	function check_oldemail($str)
	{
		$userinfo = userinfo();
		if($str != $userinfo['email'])
		{
			$this->form_validation->set_message('check_oldemail', '%s不正确');
			return false;
		}
		else
		{
			return true;
		}
	}
	function email_code($str)
	{
		$email = $this->input->post('email');
		$now = time();
		if($this->session->userdata('email_code') != false)
		{
			//检查验证码是否过期
			$exprie = 5; //验证码失效时间 单位分钟
			$phone_code_time = $this->session->userdata('email_code_time'); //生成验证码时间
			if($now - $phone_code_time <= $exprie*60)
			{
				if($str == $this->session->userdata('email_code') && $this->session->userdata('email') == $email)	
				{
					return true;	
				}	
				else
				{
					$this->form_validation->set_message('email_code', '%s不正确');
					return false;	
				}			
			}
			else
			{
				$this->form_validation->set_message('email_code', '%s已过期');
				return false;	
			}
		}	
		else
		{
			$this->form_validation->set_message('email_code', '%s不正确');
			return false;	
		}		
	}
	
	
	//实名认证页面
	function verify_idcard(){
		
		$data['userinfo'] = userinfo();
		if($data['userinfo']['is_idcard'] == 1){
			redirect('usercenter/verify_success');
		}else{
			$this->load->view('usercenter/verify_idcard',$data);
		}
		
	}
	
	//实名认证成功页面
	function verify_success(){
		
		$data['userinfo'] = userinfo();
		if($data['userinfo']['is_idcard'] == 1){
			$this->load->view('usercenter/verify_success',$data);
		}else{
			redirect('usercenter/verify_idcard');
		}			
		
	}
	
	//实名认证
	function authentication($ajax = false)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', '姓名', 'required|min_length[2]|max_length[12]');		
		$this->form_validation->set_rules('idcard', '身份证', 'required|iscard|is_unique[user.idcard]');	
		if ($this->form_validation->run() == FALSE)
		{
			if($ajax != false)
			{
				echo form_error($ajax);
			}
			else
			{
				$error_msg = $this->form_validation->error_string_array();
				$arr['error'] = 3;
				$arr['msg'] = json_encode($error_msg);
				echo json_encode($arr);exit();	
			}
		}
		else
		{
			if($ajax == false)
			{
				$return = $this->usercenter_m->authentication();
				if($return[0] == 0)
				{
					$this->session->set_flashdata('trading','1');
					echo json_encode(array('error'=>0,'msg' => ''));exit(); //成功
				}
				else
				{
					 echo json_encode(array('error'=>1,'msg' =>$return[1]));exit();//失败
				}	
			}
			else
			{
				echo "";exit();	
			}
		}		
	}
	
	
	//绑定银行卡
/*	function bind_bank($type = "add",$ajax = false)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('bank_name', '银行名称', 'required');	
		if($type == "add")
		{	
			$this->form_validation->set_rules('bank_num', '银行卡号', 'required|is_natural|is_unique[user.bank_num]');	
		}
		else
		{
			$this->form_validation->set_rules('bank_num', '银行卡号', 'required|is_natural|min_length[12]|max_length[30]|editonly[user.id.bank_num]');		
		}
		if ($this->form_validation->run() == FALSE)
		{
			echo form_error($ajax);
		}
		else
		{
			if($ajax == false)
			{
				if($this->usercenter_m->bind_bank())
				{
					echo "success";exit();
				}
				else
				{
					echo "failed";exit();
				}	
			}
		}		
	}*/
	
	//更改交易密码
	function change_trading()
	{
		$this->usercenter_m->change_trading();	
	}
	
	//交易密码
	function trading($ajax=false)
	{
		$this->usercenter_m->set_trading();
		/*$userinfo = userinfo();
		$this->load->library('form_validation');
		if($userinfo['trading'] != ""){
		$this->form_validation->set_rules('phonecode', '手机验证码', 'required|is_natural_no_zero|min_length[6]|max_length[6]|phonecode[num.'.$userinfo['mobile'].']');
		}
		$this->form_validation->set_rules('trading','交易密码','required|alpha_dash|min_length[8]|max_length[12]');
		$this->form_validation->set_rules('match_trading','确认交易密码','required|matches[trading]');
		if ($this->form_validation->run() == FALSE)
		{
			echo form_error($ajax);
		}
		else
		{
			if($ajax == false)
			{
				if($this->usercenter_m->trading())
				{
					$this->session->set_flashdata('trading','0');
					echo "success";exit();
				}
				else
				{
					echo "failed";exit();
				}	
			}	
		}*/
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
	function change_phone($ajax=false)
	{
		$this->usercenter_m->modify_verify_mobile();
	}
	
	
	/*安全中心结束*/
	
	
	//绑定银行卡
	function binding()
	{
		$this->usercenter_m->bind_bank(1);
	}
	
	
	//合同 id 为订单ID type1 为协议 2为合同
	function pact($id = false,$type = false)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('fr_order',1,0);
		if($query->num_rows() <=0)
		{
			echo "此记录不存在";exit();
		}
		$row = $query->row_array();
		$userinfo = userinfo();
		if($row['uid'] != $userinfo['id'])
		{
			echo "您无权限查看他人合同";exit();	
		}
		if($row['static'] != 2)
		{
			echo "此项目未购买成功或正在购买中";exit();	
		}
		if($row['type'] !=2 and $row['type'] != 9)
		{
			echo "此交易不存在合同";exit();		
		}
		if($row['type'] == 9)
		{
			//获取债券ID
			$this->db->where('id',$row['transfer_id']);	
			$transfer = $this->db->get('user_transfer',1,0)->row_array();
			$row['user_pro_id'] = $transfer['projectid'];
			
			//获取原来用户信息
			$this->db->where('id',$transfer['user_id']);
			$data['transfer_user'] = $this->db->get('user',1,0)->row_array();
			$data['sendeetime'] = $transfer['sendeetime'];
		}
		
		//获取user_products
		$this->db->where('id',$row['user_pro_id']);
		$row_pro = $this->db->get('user_products',1,0)->row_array();
		//获取项目详情
		$this->db->where('id',$row['productid']);
		$row_xmxq = $this->db->get('bulk_standard',1,0)->row_array();
		if($row_xmxq['static'] < 2)
		{
			echo "项目未开始";exit();	
		}
				

		//获取企业信息
		$this->db->where('id',$row_xmxq['company']);
		$row_company = $this->db->get('company_user',1,0)->row_array();
		
		if($row_xmxq['borrower_type'] == 3){
			$this->db->where('id',$row_xmxq['borrower_id']);
			$row_borrower = $this->db->get('user',1,0)->row_array();			
			//借款人信息
			$row_company['company_name'] = $row_borrower['name'];
			$row_company['license_no'] = $row_borrower['idcard'];
		}	
		
		$data['info'] = array($row,$row_pro,$row_xmxq,$row_company,$userinfo);
		if($type == 1)
		{ 
			if($row['type'] == 2)
			{
				if($row_xmxq['is_backed'] == 1)
				{
					if($row_xmxq['borrower_type'] == 3){
						$this->load->view('pact/pact_diya',$data);
					}else{
						$this->load->view('pact/pact',$data);
					}
				}
				else
				{
					$this->load->view('pact/nobacked_pact',$data);	
				}
				
			}
			else
			{
				if($row_xmxq['is_backed'] == 1)
				{
					$this->load->view('pact/transfer_pact',$data);	
				}
				else
				{
					$this->load->view('pact/nobacked_transfer_pact',$data);		
				}
				
			}
		}
		else
		{
			$this->load->view('pact/baozheng',$data);
		}
	}
	
	
	//投资记录
	function products($type = 1,$page = 0)
	{
		$userinfo = userinfo();
		$data['userinfo'] = userinfo();
		$data['type'] = $type;
		
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
		
		if($type == 1)
		{
			//投资项目
			$userinfo = userinfo();
			$this->load->library('pagination');
			$this->db->where('static',2);
			$this->db->where('uid',$userinfo['id']);
			$this->db->where('type',1);//原始债券
			$count = $this->db->count_all_results('user_products');
			$config['per_page'] = 15; 
			//获取项目
			$this->db->select('user_products.*,bulk_standard.title,bulk_standard.send_num,bulk_standard.next_interest,bulk_standard.static as pstatic,bulk_standard.is_backed,bulk_standard.borrower_type');
			$this->db->from('user_products');
			$this->db->join('bulk_standard','bulk_standard.id = user_products.projectid');
			$this->db->order_by('user_products.id','desc');
			$this->db->where('user_products.type',1);
			$this->db->where('user_products.static != ',3);
			$this->db->where('user_products.uid',$userinfo['id']);
			$this->db->limit($config['per_page'],$page);
			$result = $this->db->get()->result_array();
			//echo $this->db->last_query();
			foreach($result as $val=>$key)
			{
				$result[$val]['interest'] = $this->_interest($key['rate'],$key['day'],$key['monkey']);
				$result[$val]['productid'] = $key['projectid'];	
			}
			

			$config['base_url'] = site_url('usercenter/products/'.$type);
			
			$config['uri_segment'] = 4;
			
			$config['total_rows'] = $count;
			$this->pagination->initialize($config); 
			$data['result'] = $result;
			$data['links'] = $this->pagination->create_links();
			$this->load->view('usercenter/products',$data);
		}
		else
		{
			//投资债券
			//投资项目
			$userinfo = userinfo();
			$this->load->library('pagination');
			$this->db->where('(static=2 or static=5)');
	
			$this->db->where('uid',$userinfo['id']);
			$this->db->where('type',2);//购买债券
			$count = $this->db->count_all_results('user_products');
			$config['per_page'] = 15; 
			//获取项目
			$this->db->select('user_products.*,bulk_standard.title,bulk_standard.send_num,bulk_standard.next_interest,bulk_standard.static as pstatic,bulk_standard.is_backed,bulk_standard.borrower_type');
			$this->db->from('user_products');
			$this->db->join('bulk_standard','bulk_standard.id = user_products.projectid');
			$this->db->order_by('user_products.id','desc');
			$this->db->where('user_products.type',2);
			$this->db->where('(user_products.static = 2 or user_products.static =5)');
			$this->db->where('user_products.uid',$userinfo['id']);
			$this->db->limit($config['per_page'],$page);
			$result = $this->db->get()->result_array();
			//echo $this->db->last_query();
			foreach($result as $val=>$key)
			{
				$result[$val]['interest'] = $this->_interest($key['rate'],$key['day'],$key['monkey']);
				$result[$val]['productid'] = $key['projectid'];	
			}
			

			$config['base_url'] = site_url('usercenter/products/'.$type);
			
			$config['uri_segment'] = 4;
			
			$config['total_rows'] = $count;
			$this->pagination->initialize($config); 
			$data['result'] = $result;
			$data['links'] = $this->pagination->create_links();
			$this->load->view('usercenter/products',$data);
		}	
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
	
	//邀请好友
	function InviteFriends($page = 0){
		$userinfo = userinfo();
		$uid = $userinfo['id'];
		$keyUid = base64_encode($uid);
		$data['inviteLink'] = "https://www.kuaitoujiqi.com/welcome/register_frame/".$keyUid;
		
		$data['userinfo'] = userinfo();		
		//计算出该用户邀请来的用户
		$friends = $this->usercenter_m->getFriends();
		if($friends){
			$data['friends'] = $friends;
		}else{
			$data['friends'] = 0;
		}
		
		$this->load->library('pagination');
		$config['per_page'] = 15;
		$return = $this->usercenter_m->getUserRedPapers($config['per_page'],$page);
		$config['total_rows'] = $return[0];
		$this->pagination->initialize($config); 
		$data['result'] = $return[1];
		$data['links'] = $this->pagination->create_links();
		
		$this->load->view('usercenter/redpaper',$data);
		
	}
	
	
	
}