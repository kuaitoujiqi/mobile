<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends Front_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('welcome_m');
	}
	function test()
	{
		echo date('Y-m-d',strtotime('+1 day',time()));	
	}
	
	
	public function index()
	{
		$this->load->library('user_agent');
		if ($this->agent->is_mobile()){
			redirect('https://m.kuaitoujiqi.com');	
		}
		$siteinfo = $this->_siteinfo();  //获取网站信息
		$data['title'] = $siteinfo['indextitle'];
		$data['keyword'] = $siteinfo['keyword'];
		$data['description'] = $siteinfo['description'];
		$data['gonggao'] = $this->welcome_m->indexnews(1);
		$data['webgonggao'] = $this->welcome_m->indexnews(11);
		$data['bangzhu'] = $this->welcome_m->indexnews(7);
		$data['meiti'] = $this->welcome_m->indexnews(3);
		$data['bulk'] = $this->welcome_m->bulk();
		
		$this->load->model('transfer_m');
		$return = $this->transfer_m->front_transfer_list(5,0);
		$data['transfers'] = $return[1];
		
		//获取焦点图
		$this->db->order_by('sort','asc');
		$data['focus'] = $this->db->get('focus')->result_array();
		$this->load->view('front/index',$data);

	}
	
	//注册页面
	function register_frame($inviteCode = false){
		$this->load->library('user_agent');
		if($inviteCode){
			$inviteUid = base64_decode($inviteCode);
			$this->db->where("id",$inviteUid);
			$query = $this->db->get('user',1,0)->row_array();
			if($query['mobile'] !== ''){
				$data['recommender'] = $query['mobile'];
			}else{
				$data['recommender'] = null;
			}
		}else{
			$data['recommender'] = null;
		}
		
		$siteinfo = $this->_siteinfo();  //获取网站信息
		$data['title'] = $siteinfo['indextitle'];
		$data['keyword'] = $siteinfo['keyword'];
		$data['description'] = $siteinfo['description'];
		
		$this->load->view('front/register_frame',$data);		
	}	
	
	//注册
	function regesiter($ajax = false)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nickname', '用户名', 'required|trim|encode_php_tags|strip_tags|htmlspecialchars|is_unique[user.nickname]|min_length[4]|max_length[26]');
		$this->form_validation->set_rules('mobile', '手机号', 'required|trim|is_natural_no_zero|min_length[11]|max_length[11]|is_unique[user.mobile]');
		$this->form_validation->set_rules('password', '登陆密码', 'required|trim|min_length[8]|max_length[16]');
		$this->form_validation->set_rules('matches_password', '确认密码', 'required|trim|matches[password]');
		$this->form_validation->set_rules('phonecode', '手机验证码', 'required|is_natural_no_zero|min_length[6]|max_length[6]|phonecode[input.mobile]');
		$this->form_validation->set_error_delimiters('<div class="col-lg-4"><p class="alert alert-danger my_alert">', '</p></div>');
		$this->form_validation->set_rules('piccode', '验证码', 'required|trim|min_length[4]|max_length[4]|callback_check_piccode');
		$this->form_validation->set_rules('recommender', '推荐人手机号', 'trim|is_natural_no_zero|min_length[11]|max_length[11]');
		if ($this->form_validation->run() == FALSE)
		{
			if($ajax != false)
			{
				echo form_error($ajax);
			}
			else
			{
				$error_login = $this->form_validation->error_string_array();
				$arr['error'] = 0;
				$arr['msg'] = json_encode($error_login);
				echo json_encode($arr);exit();
			}
		}
		else
		{
			if($ajax == false)
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
					//redirect('usercenter/safe'); //跳转到首页
					$arr['error'] = 2;
					echo json_encode($arr);
				}		
				else
				{
					//注册失败	
					$arr['error'] = 1;
					echo json_encode($arr);
				}
			}
			else
			{
				echo "";	
			}
		}	
	}
	//验证码
	function regesiter_code($temp = false)
	{
		$this->load->helper('code');
		echo code(4,'regesiter_code');	
	}
	
	function check_piccode($str = false)
	{
		$code = $this->session->userdata('regesiter_code');
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
			if(time() - $phone_code_time <=60 )
			{
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
	
	//找回密码页面
	function forget_frame(){
		$this->load->library('user_agent');

		$siteinfo = $this->_siteinfo();  //获取网站信息
		$data['title'] = $siteinfo['indextitle'];
		$data['keyword'] = $siteinfo['keyword'];
		$data['description'] = $siteinfo['description'];
		
		$this->load->view('front/forget_frame',$data);	
	}
	
	//找回密码
	function forget($ajax = false)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('phonecode', '手机验证码', 'required|is_natural_no_zero|min_length[6]|max_length[6]|phonecode[input.mobile]');
		$this->form_validation->set_rules('mobile','手机号','required|is_natural_no_zero|min_length[11]|max_length[11]|callback_check_getphone');
		$this->form_validation->set_rules('password', '登陆密码', 'required|min_length[8]|max_length[16]');
		$this->form_validation->set_rules('matches_password', '确认密码', 'required|matches[password]');
		if ($this->form_validation->run() == FALSE)
		{
			if($ajax != false)
			{
				echo form_error($ajax);
			}
		}
		else
		{
			if($ajax == false)
			{
				if($this->welcome_m->forget())
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
	
	//登录页面
	function login_frame(){
		$this->load->library('user_agent');
		
		
		$siteinfo = $this->_siteinfo();  //获取网站信息
		$data['title'] = $siteinfo['indextitle'];
		$data['keyword'] = $siteinfo['keyword'];
		$data['description'] = $siteinfo['description'];
		
		//$username = trim($this->input->post('username'));
		//$password = sha1($this->input->post('password'));
		//echo $this->welcome_m->login($username,$password);		
		
		$this->load->view('front/login_frame',$data);		
	}

	//登录
	function login()
	{
		$username = trim($this->input->post('username'));
		$username = mysql_real_escape_string($username);
		$password = sha1($this->input->post('password'));
		$password = mysql_real_escape_string($password);
		$piccode = trim($this->input->post('piccode'));
		$piccode = mysql_real_escape_string($piccode);
		
		$code = $this->session->userdata('regesiter_code');
		
		if (strtolower($piccode) != strtolower($code))
		{
			echo "piccode_error";
		}
		else
		{
			echo $this->welcome_m->login($username,$password);	
		}
	}
	//退出登录
	function exit_login()
	{
		$this->session->unset_userdata('uid');	
		 $this->session->unset_userdata('ip');	
		redirect(base_url());
	}
	
	//活动详情页
	function huodong(){
		$this->load->library('user_agent');
		
		$siteinfo = $this->_siteinfo();  //获取网站信息
		$data['row']['title'] = $siteinfo['indextitle'];
		$data['row']['keyword'] = $siteinfo['keyword'];
		$data['row']['description'] = $siteinfo['description'];		
		
		$this->load->view('front/huodong',$data);
	}
	
	//端午活动详情页
	function duanwu(){
		$this->load->library('user_agent');
		
		$siteinfo = $this->_siteinfo();  //获取网站信息
		$data['row']['title'] = $siteinfo['indextitle'];
		$data['row']['keyword'] = $siteinfo['keyword'];
		$data['row']['description'] = $siteinfo['description'];		
		
		$this->load->view('front/duanwu',$data);		
	}
	
/*	function test_buy_transfer()
	{
		$this->session->set_userdata('uid',30013);
		$this->load->model('transfer_m');	
		print_r($this->transfer_m->trade_transfer(25))."\r\n";
	}*/
	//测试用 代收错误款
/*	function trade_daishou($id = false)
	{
		print_r($this->sina_m->trade_daishou());exit();
		if($id == false)
		{
			//代收
			$this->load->model('sina_m');
			print_r($this->sina_m->trade_daishou());exit();
		}
		else
		{
			//异步
			//include_once FCPATH. "key/api/weibopay.class.php";
			//$post = $this->input->post();
			//sys_log("超卖订单5400还给用户31246返回内容".json_encode($post));
			//echo 'SUCCESS';
		}	
	}*/
	
/*	function test_buy_bulk()
	{
		header("Content-type:text/html;charset=utf-8");
		$this->load->model('product_m');
		$this->session->set_userdata('uid',30008);
		$time = time();
		echo $this->product_m->buy_bulk_product(41,3);
		echo "\t"."sendtime".$time;
		echo "\r\n";
	}*/
	
	//测试用
	/*function test_login()
	{
		$this->session->set_userdata('uid',32246);	
	}*/
	
	/*付息失败重组*/
/*	function test_fuxi()
	{
		//付息失败的项目id 
		$proid = 197;
		$big_order = 548777; //提交大订单号
		
		$this->load->model('sina_m');
		$this->load->model('public_m');
		$this->load->model('order_m');
		$this->load->helper('front');
		
		$now = strtotime(date('Y-m-d'));
		$this->db->where('id',$proid);
		$row = $this->db->get('bulk_standard')->row_array();	
		$tmp_next_interest = strtotime('+1 months',$now); //计算下次还款时间
		
		//生成大订单
		$this->db->set('id',$big_order);
		$this->db->set('type',5);   //交易类型
		$this->db->set('uid',0);        //交易用户ID
		$this->db->set('monkey',0);  //交易金额
		$this->db->set('dateline',time()); //提交时间
		$this->db->set('static',2); //1处理中 2 成功 3失败
		$this->db->set('productid',$proid);	
		$this->db->insert('fr_order');
		
		$this->db->set('send_num','send_num+1',false); //增加发放利息次数
		$next_send_time = next_time($row['starttime'],$row['send_num'] - (-1)) - 86400;
		$this->db->set('next_interest',$next_send_time);	
		$this->db->where('id',$proid);
		$this->db->set('repayment_this',1);//设置下期还款状态为未还款
		$this->db->update('bulk_standard');
	}*/
	
	/*付息失败生成用户订单*/
/*	function test_fuxi_user()
	{
		$this->load->model('sina_m');
		$this->load->model('public_m');
		$this->load->model('order_m');
		$this->load->helper('front');
		$pro_id = 197;
		$big_order = 548777;
		$start_id = 548777;
		$end_id = 548813;
		foreach($this->_get_user_products($pro_id) as $key_s)
		{
			//$this->order_m->create_order(5,$key_s['uid'],$send[0],false,$key['id'],$big_order,false,false,$key_s['id']);
			$start_id = $start_id-(-1);
			
			$this->db->set('type',5);
			$this->db->set('uid',$key_s['uid']);        //交易用户ID
			$monkey = $this->_send_lixi(0.144,$key_s['monkey'],0.012,1);
			$this->db->set('monkey',$monkey[0]);  //交易金额
			//echo $start_id."&nbsp;".$monkey[0]."<br>";
			$this->db->set('dateline','1450476050'); //提交时间
			$this->db->set('static',1); //处理中
			$this->db->set('pid',$big_order);
			$this->db->set('user_pro_id',$key_s['id']);
			$this->db->set('productid',$pro_id);	
			$this->db->set('id',$start_id);
			$this->db->insert('fr_order');
			$order_id = $start_id;
			$order_row = $this->order_m->single_order($order_id); 
			$this->order_m->order_success($order_id);
			$this->order_m->same_monkey($order_row['uid']);
			$this->db->where('id',$order_row['user_pro_id']);
			$query = $this->db->get('user_products',1,0);
			$row_user_pro = $query->row_array();
			if($row_user_pro['interest'] <= $order_row['monkey'])//用户待收利息小于订单金额 最后一次
			{
				$this->db->where('id',$order_row['user_pro_id']);
				$this->db->set('interest',0);//设置此项目待收利息为0
				$this->db->set('prostatic',2);//设置此项目结束
				$this->db->update('user_products');
			}
			else
			{
				//减少待收利息
				$this->db->where('id',$order_row['user_pro_id']);
				$this->db->set('interest','interest-'.$order_row['monkey'],false);
				$this->db->update('user_products');
			}
			
			$this->db->where('id',$order_row['productid']);
			$prorow = $this->db->get('bulk_standard',1,0)->row_array();
			$this->load->model('public_m');
			$this->public_m->send_notice($order_row['uid'],'系统于 '.date('Y-m-d H:i:s',$order_row['dateline'])." 还款成功,项目：".$prorow['title'].",金额为".$order_row['monkey']);
		}
		
			
	}
	
	function _get_user_products($proid = false)
	{
		$this->db->where('static',2);//购买成功状态
		$this->db->where('projectid',$proid);
		return $this->db->get('user_products',300,0)->result_array();
	}
	
	//is_end 1 付息 2还本
	function _send_lixi($rate = false,$monkey = false,$services = false,$is_end = false)
	{
		//分账总利息
		$year_rate_b =  ($rate-(-$services)) * $monkey;
		$day_rate_b = number_format($year_rate_b/12,2,'.','');
		//用户利息
		$year_rate = $rate * $monkey;//计算一年的利息
		$day_rate = number_format($year_rate/12,2,'.','');//计算每月的利息
		//分账利息
		$day_rate_s = $day_rate_b - $day_rate;
		if($is_end == 2)
		{
			$day_rate_b = $day_rate_b - (-$monkey); //实际代付用户金额
			$day_rate = $day_rate - (-$monkey); //结束的时候用户利息等于利息+本金
		}
		//用户利息 分账利息 用户总代付
		return array(number_format($day_rate,2,'.',''),number_format($day_rate_s,2,'.',''),number_format($day_rate_b,2,'.','')); //用户利息 分账利息
	}*/
	
	
	
	/*债券转让异常处理 代收订单不存在*/
	/*function test_transfer()
	{
		$this->load->model('sina_m');
		$this->load->model('public_m');
		$this->load->model('order_m');
		$this->load->helper('front');
		
		$outer_trade_no = 544207;
		
		//更改订单状态为成功
		$this->order_m->order_success($outer_trade_no);
		//更新债券数据
		$row = $this->order_m->single_order($outer_trade_no); //获取订单数据
		
		
		$this->db->trans_begin();
		//更新用户项目表
		$this->db->where('id',$row['transfer_id']);
		$this->db->set('buystatic',2); //代付购买成功
		$this->db->update('user_transfer');
		//更新user_products
		$this->db->where('id',$row['transfer_id']);
		$user_transfer = $this->db->get('user_transfer',1,0)->row_array();//获取债券转让详细数据
		//把原项目状态改为债权转让了
		$this->db->set('static',4);
		$this->db->where('id',$user_transfer['projectid']);
		$this->db->update('user_products');
		//把项目复制一遍
		$this->db->where('id',$user_transfer['projectid']);
		$user_products = $this->db->get('user_products',1,0)->row_array();
		unset($user_products['id']);
		$user_products['static'] = 2;
		$user_products['order_id'] = $outer_trade_no;
		$user_products['type'] = 2;
		$user_products['dateline'] = time();
		$user_products['uid'] = $user_transfer['sendee'];
		$user_products['transfer'] = 1;
		$this->db->insert('user_products',$user_products);
		$insert_id = $this->db->insert_id();
		//更新订单中的user_pro_id
		$this->db->where('id',$outer_trade_no);
		$this->db->set('user_pro_id',$insert_id);
		$this->db->update('fr_order');
		//增加用户免费额度
		$this->db->where('id',$user_transfer['sendee']);
		$this->db->set('quota','quota+'.($user_transfer['holding']-(-$user_products['interest'])),false);
		$this->db->update('user');
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			 $content = "债券转让代付成功：交易订单号为".$outer_trade_no."事物处理失败紧急";
			 sys_log($content);
			 echo "SUCCESS";exit();
		}
		else
		{
			$this->db->trans_commit();
			//同步用户余额
			$this->order_m->same_monkey($user_transfer['sendee']);
			$create_sell_order = $this->order_m->create_order(10,$user_transfer['user_id'],$user_transfer['monkey'],false,$user_transfer['pro_id'],false,false,false,false,$row['transfer_id']);
			if($create_sell_order)
			{
				$sina_sell = $this->sina_m->sell_transfer($create_sell_order,$user_transfer['user_id'],$user_transfer['monkey'],$user_transfer['pro_id']);//新浪代付
				if($sina_sell[0] != 0)
				{
					$content = "债券转让代提交新浪失败：交易订单号为".$outer_trade_no."返回错误".$sina_sell[1];
					sys_log($content);
					echo "SUCCESS";exit();
				}
			}
			else
			{
				$content = "债券转让代付生成订单失败：交易订单号为".$outer_trade_no;
				sys_log($content);
				echo "SUCCESS";exit();
			}	
		}
	}*/
	
	
	/*付息失败重组*/
	/*
	//代付 超卖
	function trade_daifu($id = false)
	{
		if($id)
		{
			$this->db->where('id',4821);
			$this->db->set('static',3);
			$this->db->update('user_products');
			
			$this->db->where('id','524655');
			$this->db->set('static',3);
			$this->db->update('fr_order');
			sys_log("超卖订单2000还给用户33106返回内容");
		}
		else
		{
		$this->load->model('sina_m');
		print_r($this->sina_m->daifu_user());exit();
		}
	}*/
	
	/*function add_test()
	{
		$result = $this->db->get('user_products')->result_array();
		foreach($result as $key)
		{
			$this->db->set('quota','quota+'.$key['interest'].'',false);//增加免费额度
			$this->db->where('id',$key['uid']);
			$this->db->update('user');		
		}
			
	}
	*/
	/*function test()
	{
		//费率10.8 1.2 12 1.2  13.2 1.2
		$rate = 0.132; //用户利率
		$server_rate = 0.012;//服务费率
		$monkey = 10000;//企业借款总额  10万
		$user1 = 3800;
		$user2 = 4200;
		$user3 = 2000;
		$day = 3;//3个月项目
		echo "用户利率:".$rate."<br>";
		echo "服务费率:".$server_rate."<br>";
		echo "用户总额:".$monkey."<br>";
		echo "用户1总额:".$user1."<br>";
		echo "用户2总额:".$user2."<br>";
		echo "用户3总额:".$user3."<br>";
		
		//计算企业还款每月利息
		$s_rate = $rate - (-$server_rate);
		$s_year_rate = $rate * $monkey;//总利息
		$s_day_rate = number_format($s_year_rate/12,2,'.','');//企业每月还款的利息
		echo "企业每月还款:".$s_day_rate."<br>";	
	
		
		//用户待收利息
		$user1_daishou = $this->_user_daishou($rate,$user1,$day);
		$user1_lixi = $this->_user_lixi($rate,$server_rate,$user1);
		echo "用户1预期收益:".$user1_daishou."<br>";
		echo "用户1每月利息 保存到本地:".$user1_lixi[0]."<br>";
		echo "用户1分账利息+每月利息总额 提交到新浪:".$user1_lixi[2]."<br>";
		echo "用户1分账利息 提交到新浪:".$user1_lixi[1]."<br>";
		
		$user2_daishou = $this->_user_daishou($rate,$user2,$day);
		$user2_lixi = $this->_user_lixi($rate,$server_rate,$user2);
		echo "用户2预期收益:".$user2_daishou."<br>";
		echo "用户2每月利息 保存到本地:".$user2_lixi[0]."<br>";
		echo "用户2分账利息+每月利息总额 提交到新浪:".$user2_lixi[2]."<br>";
		echo "用户2分账利息 提交到新浪:".$user2_lixi[1]."<br>";
		
		$user3_daishou = $this->_user_daishou($rate,$user3,$day);
		$user3_lixi = $this->_user_lixi($rate,$server_rate,$user3);
		echo "用户3预期收益:".$user3_daishou."<br>";
		echo "用户3每月利息 保存到本地:".$user3_lixi[0]."<br>";
		echo "用户3分账利息+每月利息总额 提交到新浪:".$user3_lixi[2]."<br>";
		echo "用户3分账利息 提交到新浪:".$user3_lixi[1]."<br>";
		
		
		
		
	}
	
	//用户利息总额 分账总额
	function _user_lixi($rate,$server_rate,$monkey)
	{
		//分账总利息
		$year_rate_b =  ($rate-(-$server_rate)) * $monkey;
		$day_rate_b = number_format($year_rate_b/12,2,'.','');
		
		//用户利息
		$year_rate = $rate * $monkey;//计算一年的利息
		$day_rate = number_format($year_rate/12,2,'.','');//计算每月的利息
		//分账利息
		$day_rate_s = $day_rate_b - $day_rate;
		//用户利息 分账利息 用户总代付
		return array(number_format($day_rate,2,'.',''),number_format($day_rate_s,2,'.',''),number_format($day_rate_b,2,'.','')); //用户利息 分账利息
	}
	//用户待收利息
	function _user_daishou($rate,$monkey,$day)
	{
		$year_rate = $rate * $monkey;
		$day_rate = number_format($year_rate/12,2,'.','');
		$day_rate = $day_rate * $day;
		return number_format($day_rate,2,'.','');	
	}
	
	
	
	function pro_city()
	{
		$this->db->group_by('pro');
		$this->db->select('pro as p');
		$result = $this->db->get('bank')->result_array();
		$array = array();
		foreach($result as $key)
		{
			$this->db->select('city as n');
			$this->db->group_by('city');
			$this->db->where('pro',$key['p']);
			$key['c'] = $this->db->get('bank')->result_array();	
			$new_array = $key;
			array_push($array,$new_array);
		}
		$data['json'] = json_encode($array);
		$this->load->view('city_test',$data);
	}*/
	
	


	
	//用户项目购买成功未记录
	/*function buy_test()
	{
		$this->load->model('sina_m');
		$this->load->model('public_m');
		$this->load->model('order_m');
		$this->load->helper('front');
		$uid = 35028;
		$monkey = 5000;
		$pro_id = 636;
		$order_id = "568830";
		$this->db->where('id',$pro_id);
		$row = $this->db->get('bulk_standard',1,0)->row_array();
		//用户购买产品所花的金额
		$this->db->set('type',2);   //交易类型
		$this->db->set('uid',$uid);        //交易用户ID
		$this->db->set('monkey',$monkey);  //交易金额
		$this->db->set('dateline',time()); //提交时间
		$this->db->set('static',1); //1处理中 2 成功 3失败
		$this->db->set('productid',$pro_id);	
		$this->db->set('id',$order_id);
		$this->db->insert('fr_order');
		$interest_new = $this->interest($row['rate'],$row['day'],$monkey);
		  
		
		//$this->db->set('balance','balance-'.$user_monkey.'',false); //减少账户余额
		$this->db->set('quota','quota+'.$interest_new.'',false);//增加免费额度
		$this->db->where('id',$uid);
		$this->db->update('user');	
		  
		
		$this->db->set('projectid',$pro_id); //项目ID
		$this->db->set('uid',$uid);
		$this->db->set('monkey',$monkey); //交易金额
		$this->db->set('order_id',$order_id); //交易金额
		$this->db->set('static',1);//处理中
		$this->db->set('interest',$interest_new);//待收利息
		$this->db->set('day',$row['day']);
		$this->db->set('dateline',time());
		$this->db->set('rate',$row['rate']); //收益率
		$this->db->insert('user_products');
		$products_i_id = $this->db->insert_id();
		
		//保存项目ID到购买产品user_priducts 到订单
		$this->db->where('id',$order_id);
		$this->db->set('user_pro_id',$products_i_id);
		$this->db->update('fr_order');
		
		$this->_notify($order_id);			
	}
	
	function interest($rate=false,$day = false,$monkey = false)
	{
		//rate 年华利率 day 购买时间 monkey 购买钱数
		//计算一年总利息
		$year_rate = $rate * $monkey;
		//计算每月的利息
		$day_rate = number_format($year_rate/12,2,'.','');
		//计算总共的利息
		$day_rate = $day_rate * $day;
		//$count_rate = $day_rate * $day;	
		return number_format($day_rate,2,'.','');
	}
	
	function _notify($outer_trade_no )
	{
		$this->load->model('sina_m');
		$this->load->model('public_m');
		$this->load->model('order_m');
		$this->load->helper('front');
		$this->db->set('static',2);
		$this->db->where('id',$outer_trade_no);
		$this->db->update('fr_order'); //更新订单状态
						
		$this->db->set('static',2);//购买成功
		$this->db->set('prostatic',1); //持有状态
		$this->db->where('order_id',$outer_trade_no);
		$this->db->update('user_products'); //更新用户购买产品订单状态
						
		//增加用户免费提现额度
		$this->db->set('quota','quota+'.$order_row['monkey'].'',false); //增加提现额度
		$this->db->where('id',$order_row['uid']);
		$this->db->update('user');
		//同步用户金额
		$this->order_m->same_monkey($order_row['uid']);
						
		$this->db->where('id',$order_row['productid']);
		$prorow = $this->db->get('bulk_standard',1,0)->row_array();
						
		$this->load->model('public_m');
		$this->public_m->send_notice($order_row['uid'],'您于 '.date('Y-m-d H:i:s',$order_row['dateline'])." 成功购买".$prorow['title'].",金额为".$order_row['monkey']);	
	}
	*/
	/*更换手机绑定*/
/*	function test_phone()
	{
		$this->load->model('sina_m');
		$uid = 34883;
		$old_phone = 18631656775;
		$new_phone = 15033160911;
		print_r($this->sina_m->unbinding_verify($uid));
		echo "<br>";
		print_r($this->sina_m->binding_verify($uid,'MOBILE',$new_phone));
		echo "<br>";
		$this->db->where('id',$uid);
		$this->db->set('mobile',$new_phone);
		$this->db->update('user');	
		
		$this->load->model('interface_m');
		$content = "您好，您申请解绑更换手机号码".$old_phone."，现已更换为".$new_phone."，登陆时可使用新号码登陆，原密码不变。感谢您支持快投机器，祝您生活愉快！【快投机器】";
		return $this->interface_m->send_public_message($phone,$content);
	}*/
	
	/*临时处理*/
/*	function tmp_sina()
	{
		$this->load->model('sina_m');
		$this->sina_m->sell_transfer(544938,32556,50000,236);
		if($sina_sell[0] != 0)
		{
			echo "SUCCESS";exit();
		}
		else
		{
			exit('aaaaa');	
		}
	}*/
	
	 /*循环用户是否邦卡*/
/*	 function is_bind_bank()
	 {
		$query = $this->db->get('user');
		$count = 0;
		foreach($query->result_array() as $key)
		{
			//查询是否邦卡
			$this->db->where('static',2);
			$this->db->where('user_id',$key['id']);
			$bank_query = $this->db->get('user_bank',1,0);
			if($bank_query->num_rows() > 0)
			{
				$this->db->where('id',$key['id']);
				$this->db->set('is_bind_bank',2);
				$this->db->update('user');
			}
		}	 
		
	 }*/
	 
	 //用户购买项目
	/* function buy_pro_auto()
	 {
		$this->load->model('sina_m');
		$this->load->model('public_m');
		$this->load->model('order_m');
		$this->load->helper('front');
		
		$userid = 30018;
		$user_monkey = 10000;
		$productid = 602;
		
		$this->db->where('id',$productid);
		//$this->db->where('is_open',1);//是否开通
		$query = $this->db->get('bulk_standard',1,0);
		$row = $query->row_array();
		
		$order_id = $this->order_m->create_order(2,$userid,$user_monkey,false,$productid);
		$interest_new = $this->interest($row['rate'],$row['day'],$user_monkey);
		  
		
		$this->db->set('balance','balance-'.$user_monkey.'',false); //减少账户余额
		$this->db->set('quota','quota+'.$interest_new.'',false);//增加免费额度
		$this->db->where('id',$userid);
		$this->db->update('user');	
		  
		
		$this->db->set('projectid',$productid); //项目ID
		$this->db->set('uid',$userid);
		$this->db->set('monkey',$user_monkey); //交易金额
		$this->db->set('order_id',$order_id); //交易金额
		$this->db->set('static',1);//处理中
		$this->db->set('interest',$interest_new);//待收利息
		$this->db->set('day',$row['day']);
		$this->db->set('dateline',time());
		$this->db->set('rate',$row['rate']); //收益率
		$this->db->insert('user_products');
		$products_i_id = $this->db->insert_id();
		//保存项目ID到购买产品user_priducts 到订单
		$this->db->where('id',$order_id);
		$this->db->set('user_pro_id',$products_i_id);
		$this->db->update('fr_order');	 
		
		$sina_return = $this->sina_m->create_hosting_collect_trade($order_id,$productid,$userid,$user_monkey);exit('aaaa');
	 }
	 
	 //计算待收利息
	function interest($rate=false,$day = false,$monkey = false)
	{
		//rate 年华利率 day 购买时间 monkey 购买钱数
		//计算一年总利息
		$year_rate = $rate * $monkey;
		//计算每月的利息
		$day_rate = number_format($year_rate/12,2,'.','');
		//计算总共的利息
		$day_rate = $day_rate * $day;
		//$count_rate = $day_rate * $day;	
		return number_format($day_rate,2,'.','');
	}*/
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */