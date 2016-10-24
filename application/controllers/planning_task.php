<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Planning_task extends Front_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('sina_m');
		$this->load->model('public_m');
		$this->load->model('order_m');
		$this->load->helper('front');
	}
	
	function lWDcEQYwOuYTQKGd() //wyjrDMhShiWVOktt
	{
		$php = php_sapi_name();
		if($php != "cli")
		{
			show_404();exit();	
		}else{
			$now = strtotime(date('Y-m-d')." 23:59:59");
			//$now = strtotime('2016-06-17'); 
			$this->db->where('static',2);
			$this->db->where('next_interest <= ',$now);
			$result = $this->db->get('bulk_standard')->result_array();
			//sys_log($this->db->last_query());
			foreach($result as $key)
			{
				//sys_log($key['title'].'开始执行');
				//$tmp_next_interest = strtotime('+1 months',$now); //计算下次还款时间
				//if($tmp_next_interest >= $key['endtitme'])
				$tmp_next_interest = $key['send_num'] - (-1); //计算下次还款时间
				if($tmp_next_interest >= $key['day'])
				{
					$this->_send_bulk_standard($key,2,$key['endtitme']);	 //最后一次发放利息
				}
				else
				{
					$this->_send_bulk_standard($key,1,$tmp_next_interest);	//利息发放
				}
			}
		}
		//循环结束
	}
	
	//发放利息  key为当前利息发放的项目表详情
 	function _send_bulk_standard($key,$is_end,$tmp_next_interest)
	{
		
		$this->db->trans_begin();
		$sina_array = array();
		$create = $this->order_m->create_order(5,0,0,false,$key['id']); //生成大订单
		if(!$create)
		{
			$this->db->trans_rollback();
			sys_log($key['title'].'发放利息失败,生成大订单失败');
			return;	
		}
		$get_user = $this->_get_user_products($key['id']);
		//计算总共付息
		$count_send = $this->_send_lixi($key['rate'],$key['money'],$key['services'],$is_end);
		//返回 //用户利息 分账利息 用户总代付(1平台居间服务费  2用户利息)
		
		$sendcountuser = count($get_user);
		$zong = 0;//用户代付统计
		
		foreach($get_user as $val=>$key_s)
		{
			//计算发放利息
			$send = $this->_send_lixi($key['rate'],$key_s['monkey'],$key['services'],$is_end);//利息 用户金额 服务费率 是否最后一次
			$create_small = $this->order_m->create_order(5,$key_s['uid'],$send[0],false,$key['id'],$create,false,false,$key_s['id']); //生成小订单
			if(!$create_small)
			{
				$this->db->trans_rollback();
				sys_log($key['title'].'发放利息失败,生成小订单失败');	
				return;	
			}
			$zong = $zong-(-$send[2]);
			
			if($val-(-1) == $sendcountuser)
			{
				//执行到最后一个人的时候 计算多余的还账金额分到平台
				//差多少
				$cha_f = $count_send[2] - $zong;
				//10014542^UID^BASIC ^10014543^UID^ENSURE^1.00^备注1
				$fenzhang = $key_s['uid']."^"."UID^SAVING_POT^"."kuaitoujiqi@sina.com"."^EMAIL^BASIC^".round(($send[1]-(-$cha_f)),2)."^".$key['title']."用户分账";//分账信息组合
				//组合新浪单条字符串sinapay_systemsprintf("%.2f", ($send[1]-(-$cha_f)))
			
			$trade_list = $create_small."~".$key_s['uid']."~UID~SAVING_POT~".round(($send[2]-(-$cha_f)),2)."~".$fenzhang."~".$key['title']."利息发放~~~".$key['id']."~";
					
				
			}
			else
			{
				//10014542^UID^BASIC ^10014543^UID^ENSURE^1.00^备注1
				$fenzhang = $key_s['uid']."^"."UID^SAVING_POT^"."kuaitoujiqi@sina.com"."^EMAIL^BASIC^".round($send[1],2)."^".$key['title']."用户分账";//分账信息组合 
				//组合新浪单条字符串 sinapay_system
			
			$trade_list = $create_small."~".$key_s['uid']."~UID~SAVING_POT~".round($send[2],2)."~".$fenzhang."~".$key['title']."利息发放~~~".$key['id']."~";
				
			}
			array_push($sina_array,$trade_list);
		}
		//更改项目状态
		$this->db->set('send_num','send_num+1',false); //增加发放利息次数
		if($is_end == 2)
		{
			$this->db->set('static',3);//项目结束
			$this->db->set('next_interest',$key['endtitme']);//下次还款时间为结束日期
		}
		else
		{
			//计算下次还款时间
			$next_send_time = next_time($key['starttime'],$key['send_num'] - (-1)) - 86400;
			$this->db->set('next_interest',$next_send_time);	
			//$this->db->set('next_interest',strtotime('+1 months',$key['next_interest']));	//下次还款日期为当前还款时间+1月
		}
		//设置下次还款时间
		//$this->db->set('next_interest',$tmp_next_interest);
		$this->db->where('id',$key['id']);
		$this->db->set('repayment_this',1);//设置下期还款状态为未还款
		$this->db->update('bulk_standard');
		
		$this->order_m->order_success($create);// 更改大订单状态成功
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			sys_log($key['title'].'发放利息失败,事务执行失败');
			return;
		}
		else
		{
			//发起新浪代付利息接口
			$trade_list = implode("$",$sina_array);
			//sys_log($key['title'].'开始执行'.$create);
			$this->db->trans_commit(); //保存大小订单数据
			sleep(3);
			$is_sub_row = $this->order_m->single_order($create);
			if($is_sub_row['is_sub'] == 0)
			{
				//设置订单为提交状态
				$this->db->set('is_sub',1);
				$this->db->where('id',$create);
				$this->db->update('fr_order');
				$sina_return = $this->sina_m->create_batch_hosting_pay_trade($create,$trade_list);
				if($sina_return[0] == 0)
				{
					sys_log($key['title'].'发放提交利息成功');
					return;
				}
				else
				{
					//$this->db->trans_rollback();	
					sys_log($key['title'].'发放利息失败,提交新浪请求失败'.$sina_return[1]);
					return;
				}			
			}
			else
			{
				sys_log("本地重复执行,订单号".$create."付息");	
			}
			
		}
	}	
	//获取用户购买项目标
	function _get_user_products($proid = false)
	{
		$this->db->where('static',2);//购买成功状态
		$this->db->where('projectid',$proid);
		return $this->db->get('user_products',300,0)->result_array();
	}

	
	//计算每月利息
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
	}
	
	
	//超过15天未登录 用户余额大于1000短信通知
	function lBKLisSGMSgodhPK()
	{
		$php = php_sapi_name();
		//echo $php;
		if($php != "cli")
		{
			show_404();exit();	
		}
		//获取超过15天未登录 余额大于1000的用户
		
		$this->db->where('lastlogin <',time()-1296000);
		$this->db->where('balance >=',1000);
		$this->db->where('remind <',time()-604800); //一周内未发过短信
		$result = $this->db->get('user')->result_array();

		$failed = 0;
		foreach($result as $key)
		{
			$send = $this->_sms_send($key['mobile']);
			if(!$send)
			{
				$failed = $failed - (-1);
			}
			else
			{
				$this->db->where('id',$key['id']);
				$this->db->set('remind',time());
				$this->db->update('user');	
			}
		}
		if(count($result) > 0)
		{
			sys_log("提醒短信发送成功".count($result)."条,失败".$failed."条");
		}
	
	}
	
	function _sms_send($phone = false,$username = false)
	{
		$this->load->model('interface_m');
		$content = "尊敬的快投机器会员，您好。您已经很久没有登录快投机器了，请及时关注并管理您的账户。【快投机器】";
		return $this->interface_m->send_public_message($phone,$content);	
	}
	
	
	//付息短信提醒
	function VvrZDiT1FDINpRTB()
	{
		$php = php_sapi_name();
		//echo $php;
		if($php != "cli")
		{
			show_404();exit();	
		}
		$time = strtotime(date('Y-m-d')." 00:00:00");
		$this->db->where('dateline >',$time);
		$query = $this->db->get('pay_message');	
		foreach($query->result_array() as $key)
		{
			$this->_sms_send_fuxi($key['mobile'],$key['monkey'],$key['name']);	
		}
	}
	
	
	//付息短信提醒
	function _sms_send_fuxi($phone = false,$monkey = false,$name="")
	{
		$this->load->model('interface_m');
		$content = "尊敬的快投机器会员".$name."你好，您所投资的项目今日还款".$monkey."元，请及时登录快投机器查看。【快投机器】";
		return $this->interface_m->send_public_message($phone,$content);
	}
	/*//计划任务执行
	function index()
	{
		$this->db->where('isend',1);  //利息未结束发放
		$this->db->where('status',1);//生效中
		$result = $this->db->get('user_project')->result_array();
		$success_b = 0; //标的
		$failed_b = 0;
		$failed_text_b = array();
		$success_s = 0; //散标
		$failed_s = 0;
		$failed_text_s = array();
		foreach($result as $key)
		{
			if($key['type'] == 2)
			{
				//散标开始处理
				if(time() >= $key['next_interest']) //当前时间大于下次利息方法时间 进行利息发放 
				{
					$tmp_time = strtotime('+1 months',time());//计算下次发放利息时间
					$send_lixi = $this->_send_lixi($key['rate'],$key['volume']); //每月利息
					if($tmp_time >= $key['endtime']) 
					{
						$this->db->trans_begin(); //事物开始
						//当下次发放利息时间 大于等于项目结束时间 证明是最后一次
						/*执行账户操作 返还本金加最后一次利息*/
						/*$balance = $key['volume'] - (-$send_lixi); //本金加每月利息
						$this->db->set('balance','balance+'.$balance.'',false); //增加账户余额本金+利息
						$this->db->set('frozen','frozen-'.$key['volume'].'',false);  //减少冻结金额 本金
						$this->db->where('id',$key['user_id']);
						$this->db->update('user');	
						//设置项目状态为结束 待收利息为0
						$this->db->set('isend',2); //结束利息发放
						$this->db->set('interest',0);//设置待发放利息为0
						$this->db->where('id',$key['id']);
						$this->db->update('user_project');
						//用户账户操作记录
						$this->db->set('type',6);//利息发放类型
						$this->db->set('related',$key['project_id']);//设置关联产品ID
						$this->db->set('dateline',date('Y-m-d H:i:s'));
						$this->db->set('static',1); //成功状态
						$this->db->set('user_id',$key['user_id']);
						$this->db->set('monkey',$send_lixi); //金额
						$this->db->insert('user_account_history');
						if ($this->db->trans_status() === FALSE)
						{
							$failed_s = $failed_s-(-1);
							array_push($faile_text_s,$key['id']);
							$this->db->trans_rollback();
						}
						else
						{
							$success_s = $success_s - (-1); //设置执行成功数目
							$this->db->trans_commit();		
						}
					}
					else
					{
						//不是最后一次
						$this->db->trans_begin();
						/*执行账户操作 增加账户余额*/
					/*	$this->db->set('balance','balance+'.$send_lixi.'',false); //增加账户余额本金+利息
						$this->db->where('id',$key['user_id']);
						$this->db->update('user');	
						//设置项目状态为结束 待收利息为0
						$this->db->set('isend',1); //结束利息发放
						$this->db->set('next_interest',strtotime('+1 months',time())); //设置下次发放利息时间+一月
						$this->db->set('interest','interest-'.$send_lixi,false);//待收利息减少一个月的
						$this->db->where('id',$key['id']);
						$this->db->update('user_project');
						//用户账户操作记录
						$this->db->set('type',6);//利息发放类型
						$this->db->set('related',$key['project_id']);//设置关联产品ID
						$this->db->set('dateline',date('Y-m-d H:i:s'));
						$this->db->set('static',1); //成功状态
						$this->db->set('user_id',$key['user_id']);
						$this->db->set('monkey',$send_lixi);
						$this->db->insert('user_account_history');
						if ($this->db->trans_status() === FALSE)
						{
							$this->db->trans_rollback();
						}
						else
						{
							$this->db->trans_commit();	
						}	
					}
				}
			}
			else
			{
				//标的开始处理	
			}
		}
		//循环结束 写入计划任务执行
		$this->db->set('success_b',$success_b);
		$this->db->set('failed_b',$failed_b);
		$this->db->set('faield_text_b',implode(",",$failed_text_b));
		$this->db->set('success_s',$success_s);
		$this->db->set('faield_s',$failed_s);
		$this->db->set('faield_text_s',implode(",",$failed_text_s));
		$this->db->set('dateline',date('Y-m-d H:i:s'));
		$this->db->insert('planning_task');
	}	*/
	

}