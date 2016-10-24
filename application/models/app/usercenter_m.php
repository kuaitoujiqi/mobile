<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usercenter_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
		$this->load->model('welcome_m');
	    $this->load->model('app/appsina_m');
		$this->load->model('order_m');
		$this->load->helper('front');
    }
	//更改密码
	function change_password($newpassword,$uid)
	{
		$this->db->where('id',$uid);
		$this->db->set('password',sha1($newpassword));
		return $this->db->update('user');
	}
	//查询是否设置交易密码 //并保存到本地
	function check_trading()
	{
		$userinfo = userinfo();
		$check = $this->sina_m->query_is_set_pay_password($userinfo['id']);	
		if(!$check)
		{
			return false;	
		}
		else
		{
			$this->db->set('trading',1);
			$this->db->where('id',$userinfo['id']);
			$this->db->update('user');
			return true;	
		}
	}
	function check_userinfo($uid){

		$userinfo['id'] = $uid;
		$this->db->where('id',$userinfo['id']);
	    $this->db->select('*');
	    return $this->db->get('user')->row_array();

	}
	//跳转到设置交易密码
	function set_trading($type,$uid)
	{
		if($type == 2){
			
		}else{
			$type = 1;
		}
		
		return $this->appsina_m->set_pay_password($uid,$type);	
	}
	
	//修改设置交易密码
	function change_trading($type,$uid)
	{
		if($type == 2){
			
		}else{
			$type = 1;
		}		
		$this->appsina_m->modify_pay_password($uid,$type);	
	}
	
	//修改认证手机号
	function modify_verify_mobile($uid)
	{
		// $userinfo = userinfo();
		return $this->appsina_m->modify_verify_mobile($uid);	
	}
	
	function change_phone()
	{
		//查询认证信息
		$userinfo = userinfo();
		$return = $this->sina_m->query_verify($userinfo['id']);	
		if($return[1]['response_code'] == "APPLY_SUCCESS")
		{
			if($userinfo['mobile'] != $return[1]['verify_entity'])	
			{
				//更新用户手机号
				$this->db->where('id',$userinfo['id']);
				$this->db->set('mobile',$return[1]['verify_entity']);
				$this->db->update('user');	
			}
		}
	}
	//绑定银行卡
	function bind_bank($type,$uid)
	{	
		if($type == 2){
			
		}else{
			$type = 1;
		}
		// $userinfo = userinfo();	
		$res = $this->sina_m->web_binding_bank_card($uid,$type);
		return $res;	
	}
	
	//充值
	function recharge($pay_type = "online",$mobile = false,$uid,$money)
	{
		$userinfo['id'] = $uid;	
		$monkey = $money;
		//网银在线充值
		$pay_con = "online_bank^".$monkey."^SINAPAY,DEBIT,C";	
		$send_pay = array('online_bank',$pay_con);
		
		$create_order = $this->order_m->create_order(1,$userinfo['id'],$monkey,1);
		if($create_order)
		{

			@$return = $this->appsina_m->create_hosting_deposit_new($create_order,$send_pay,$monkey,$mobile,$uid);
			
			if($return[0] == 1)
			{
				$this->order_m->order_failed($create_order,$return[1]);
			}
			return $return;
		}
		else
		{
			return false;	
		}
	}
	
	
	//新浪个人信息展示
	function show_member_infos_sina($uid = false)
	{
		return $this->sina_m->show_member_infos_sina($uid);
	}
	
	//绑定邮箱
	function bind_email()
	{
		if($userinfo['is_email'] == 1)
		{
			//解除绑定
			$this->sina_m->unbinding_verify($userinfo['id'],'EMAIL');
		}
		
		$email = $this->input->post('email');
		$userinfo = userinfo();
		$this->db->where('id',$userinfo['id']);
		$this->db->set('email',$email);
		$this->db->set('is_email',1);
		if($this->db->update('user'))
		{
			return false;
			$this->sina_m->binding_verify($userinfo['id'],'EMAIL',$email);
		}
		else
		{
			return true;	
		}
	}
	//实名认证
	function authentication($uid,$name,$idcard)
	{
		$info = $this->userinfo($uid);
		if($info['is_idcard'] == 1)
		{
			return array(1,'实名认证消息无法修改');	
		}
		else
		{
			$return = $this->appsina_m->set_real_name($uid,$name,$idcard);
			if($return[0] == 0) 
			{
				//新浪验证通过保存名字到数据库
				// $name = $this->input->post('name');	
				// $idcard = $this->input->post('idcard');	
				$this->db->set('idcard',substr_replace($idcard,'***********',3,11));
				$this->db->set('name',$name);
				$this->db->set('is_idcard',1);
				$this->db->set('cardtime',time());
				$this->db->where('id',$info['id']);
				$this->db->update('user')?array(0):array(1,'本次操作有误，请联系客服处理');	
				return 'success';
			}
			else
			{
				sys_log("用户ID为".$info['id']."实名认证失败:".$return[1]);
			    return 'false';	//新浪认证失败
			}
			
		}
	}
	//绑定银行卡
/*	function bind_bank()
	{
		$userinfo = userinfo();	
		if($userinfo['is_idcard'] == 1)
		{
			$bank_name = $this->input->post('bank_name');	
			$bank_num = $this->input->post('bank_num');
			$this->db->set('bank_name',$bank_name);
			$this->db->set('bank_num',$bank_num);
			$this->db->where('id',$userinfo['id']);
			return $this->db->update('user');	
		}
		else
		{
			return false;	
		}
	}*/
	//设置交易密码
	function trading()
	{
		$userinfo = userinfo();	
		$trading = $this->input->post('trading');
		$this->db->set('trading',sha1($trading));
		$this->db->where('id',$userinfo['id']);
		
		return $this->db->update('user');			
	}
	
	//账户操作记录查询
	function record($type = 0,$per_page = 20,$page = 0,$uid)
	{
		
		$userinfo['id'] = $uid;
		$this->db->start_cache();
		$this->db->from('fr_order');
		switch($type)
		{
			case 1://充值
				$this->db->where('type',1);
			break;
			case 2://产品购买
				$this->db->where('type',2);
				$this->db->where('fr_order.static',2);
			break;
			case 5://利息发放
				$this->db->where('type',5);
			break;
			case 7://提现
				$this->db->where('type',7);
			break;
			case 9://购买债券
				$this->db->where('type',9);
			break;
			case 10://转让
				$this->db->where('type',10);
			break;
			default:
			//全部
				$this->db->where_in('type',array(1,2,5,7,9,10));
			break;	
		}
		$this->db->where('uid',$userinfo['id']);
		$this->db->stop_cache();
		$count = $this->db->count_all_results();
		$this->db->order_by('dateline','desc');
		$this->db->limit($per_page,$page);
		if($type == 2)
		{
			$this->db->select('fr_order.*,bulk_standard.is_backed,bulk_standard.title,bulk_standard.static as pstatic,bulk_standard.next_interest');	
			$this->db->join('bulk_standard','bulk_standard.id = fr_order.productid','left');
		}elseif($type == 5){
			$this->db->select('fr_order.*,bulk_standard.is_backed,bulk_standard.title,bulk_standard.static as pstatic,bulk_standard.next_interest');	
			$this->db->join('bulk_standard','bulk_standard.id = fr_order.productid','left');			
		}
		else
		{
			if($type == 9) //投资债券
			{
				$this->db->select('fr_order.*,bulk_standard.is_backed');	
				$this->db->join('bulk_standard','bulk_standard.id = fr_order.productid','left');	
			}
			$this->db->select('fr_order.*');	
		}
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return array($count,$result);
	}
	
	
	//消息中心
	function info($type = 0,$per_page = 20,$page = 0)
	{
		$userinfo = userinfo();
		$this->db->start_cache();
		$this->db->where('user_id',$userinfo['id']); //消息中心
		$this->db->from('user_notice');
		switch($type)
		{
			case 1:
				$this->db->where('static',1);
			break;//未读
			case 2:
				$this->db->where('static',2);
			break;//已读
			default:
			break;//全部	
		}
		$this->db->stop_cache();
		$count = $this->db->count_all_results();
		$this->db->limit($per_page,$page);
		$this->db->order_by('dateline','desc');
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return array($count,$result);
	}
	//删除消息
	function del_info($id = false)
	{
		$userinfo = userinfo();
		$this->db->where('user_id',$userinfo['id']);
		$this->db->where('id',$id);
		$this->db->delete('user_notice');
	}
	//标记为已读
	function info_static($result)
	{
		foreach($result as $key)
		{
			$this->db->set('static',2);
			$this->db->where('id',$key['id']);
			$this->db->update('user_notice');
		}	
	}
	//债券转让列表
	function transfer($per_page = 20,$page = 0)
	{
		$userinfo = userinfo();
		$this->db->start_cache();
		$this->db->from('user_project');
		$this->db->join('user_transfer','user_project.transfer = user_transfer.id','left');
		$this->db->join('bulk_standard','user_project.project_id = bulk_standard.id');
		$this->db->where('user_project.type',2); //散标
		
		$this->db->where('user_project.user_id',$userinfo['id']);
		$this->db->stop_cache();
		$count = $this->db->count_all_results();
		$this->db->select('user_project.amount,user_project.exchange_hour,bulk_standard.static,bulk_standard.starttime,bulk_standard.next_interest,bulk_standard.rate,bulk_standard.each,bulk_standard.endtitme,bulk_standard.day,user_transfer.static as transfer,user_project.id,user_transfer.id as transferid');
		$this->db->limit($per_page,$page);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return array($count,$result);
	}
	
	function ajax_transfer()
	{
		$projectid = $this->input->post('projectid');	
		$monkey = intval($this->input->post('monkey'));	//转让价格
		if(!is_int($monkey) || $monkey <= 0)
		{
			return "请输入正确的转让价格";
		}
		$userinfo = userinfo();
		$return = $this->check_transfer($projectid,$userinfo);
		if($return == "success")
		{
			//获取项目详情 
			$this->db->where('id',$projectid);
			$row = $this->db->get('user_project',1,0)->row_array();
			$start = $row['volume']*0.8;
			if($monkey < $start || $monkey > $row['volume'])
			{
				return "转让价格必须为购买价格的80%-100%之间";	
			}
			else
			{	
				$this->db->set('user_id',$userinfo['id']);
				$this->db->set('projectid',$projectid);
				$this->db->set('static',1);
				$this->db->set('monkey',$monkey);//转让价格
				$this->db->set('cretattime',date('Y-m-d H:i:s'));
				$this->db->insert('user_transfer');
				$transfer = $this->db->insert_id();
				$this->db->set('transfer',$transfer);
				$this->db->where('id',$projectid);
				$this->db->update('user_project');
				return "success";
			}
		}
		else
		{
			return $return;
		}
	}
	
	//检查债券是否可以转让 
	function check_transfer($id = false,$userinfo)
	{
		$this->db->from('user_project');
		$this->db->join('user_transfer','user_project.transfer = user_transfer.id','left');
		$this->db->join('bulk_standard','user_project.project_id = bulk_standard.id');
		$this->db->where('type',2); //散标
		$this->db->select('user_project.amount,user_project.exchange_hour,bulk_standard.static,bulk_standard.starttime,bulk_standard.next_interest,bulk_standard.rate,bulk_standard.each,bulk_standard.endtitme,bulk_standard.day,user_transfer.static as transfer,user_project.id');		
		$this->db->where('user_project.id',$id);
		$this->db->where('user_project.user_id',$userinfo['id']);
		$query = $this->db->get();
		if($query->num_rows()<=0)
		{
			return "项目不存在";	
		}
		$key = $query->row_array();
		if($key['transfer'] != "")  //项目转让中
		{
			return "项目已经在转让中";	
		}
		if($key['day'] <3) //项目月数小于3月不可转让
		{
			return "项目不可转让";	
		}
		if($key['static'] !=2) //项目未还款或已完成不可以转让
		{
			return "项目不可转让";	
		}
		if((time() - $key['starttime']) < 5184000) //项目持有时间小于2月不可转让
		{
			return "持有时间小于2个月";
		}
		if( ($key['next_interest'] - time()) <= 518400) //利息发放日距现在小于6天 不可转让
		{
			return "距离下次利息发放小于6天";
		}
		return "success";	
	}
	
	
	


	
	//判断用户持有产品金额
	function check_user_buy_products($userinfo = false)
	{
		$this->db->where('uid',$userinfo['id']);
		$this->db->where('prostatic',1);
		$this->db->where('static',2);
		return $this->db->count_all_results('user_products');
	}
	
	//查询今日是否提现
	function check_withdraw(){
		$userinfo = userinfo();
		//判断今天是否免费提现过
		
		//$this->db->start_cache();
		$this->db->where('type',7);
		$this->db->where('static != ',3);//不是失败状态的总数统计
		$this->db->where('uid',$userinfo['id']);
		$this->db->where('dateline >=',strtotime(date('Y-m-d')." 00:00:00"));
		$this->db->where('dateline <=',strtotime(date('Y-m-d')." 23:59:59"));
		//$this->db->stop_cache();
		$query = $this->db->get('fr_order');
		$isti = $query->num_rows();
		//$isti = $this->db->count_all_results('fr_order');
		if($isti > 0){
			return 1;
		}else{
			return 0;
		}
		
	}
	
	//
	function binding_list(){
		$userinfo = userinfo();
		//$userinfo['id']
		//$this->db->start_cache();

		//$this->db->stop_cache();
		$this->db->where('user_id',$userinfo['id']);
		//$result1 = $this->db->select('user_bank')
		$query = $this->db->get('user_bank')->result_array();
		//$result = $this->db->get()->result_array();
		
		return $query;
		//$isti = $query->num_rows();
		
		//this->db->flush_cache();
	
	}
	
	//提现手续费计算
	function withdraw($type,$uid,$money)
	{
		// $uid = '500143';
		//获取已结束项目的的本金
		$this->db->where('id',$uid);
		$this->db->select('*');
		$userinfo = $this->db->get('user')->row_array(); 
		if($type == 2){
			
		}else{
			$type = 1;
		}
		$this->order_m->same_monkey($uid);//同步用户金额
		 $monkey = $money; //用户输入的金额
		$quota = $userinfo['quota'];	
		$balance = $userinfo['balance'];
		if(empty($monkey))
		{
			return array(1,"提现金额不能为空");	
		}

		if(!is_numeric($monkey) || $monkey <= 0 || count(explode(".",$monkey)) > 2)
		{
			return array(1,"请输入正确的提现金额");
		}
		$quota_b = $monkey;
		$shouxufei = 0.00;
		
		//判断金额是否大于50完
		if($monkey > 500000)
		{
			return array(1,"单笔最大提现50万");	
		}
		
		//判断今天是否提现过
		$this->db->start_cache();
		$this->db->where('type',7);
		$this->db->where('static !=',3);//不是失败状态的总数统计
		$this->db->where('uid',$uid);
		$this->db->where('dateline >=',strtotime(date('Y-m-d')." 00:00:00"));
		$this->db->where('dateline <=',strtotime(date('Y-m-d')." 23:59:59"));
		$this->db->stop_cache();
		$query = $this->db->get('fr_order');
		$isti = $query->num_rows();
		if($isti > 0)
		{
			//今天提现过
			$shouxufei = 1.5;
			//统计今日提现金额总数
			$this->db->select_sum('monkey');
			$row_t = $this->db->get('fr_order')->row_array();
			$today_monkey = empty($row_t['monkey'])?0:$row_t['monkey'];
			if(($today_monkey - (-$monkey)-(-$shouxufei)) > 500000) 
			{
				return array(1,"日累计提现不能超过50万");		
			}
			if($balance < ($monkey -(-$shouxufei)))
			{
				return array(1,"余额不足");		
			}
		}
		$this->db->flush_cache();
		
		/*if($monkey > $balance)
		{
			return array(1,"您提现的金额大于您的余额");	
		}*/
		/*if($monkey > $quota)
		{
			//金额大于免费额度 计算手续费
			$shouxufei = ($monkey - $quota)*0.005;
			$shouxufei = round($shouxufei,2);
			if($shouxufei > 2)
			{
				//手续费大于2元 大于2元部分代收代付
				$daishou = $shouxufei - 2;
			}
			else
			{
				$shouxufei = 2.00; //手续费为2元
				$daishou = 0;	
			}
			$quota_b = $quota;	
		}
		else
		{
			$shouxufei = 0.00;	
			$quota_b = $monkey;
		}*/
		/*if($monkey-(-$shouxufei) > $balance)
		{
			return array(1,"提现金额加手续费低于账户余额");	
		}*/
		
		
		//获取用户银行卡
		/* 
		$this->db->where('static',2);
		$this->db->where('card_id !=',"");
		$this->db->where('user_id',$userinfo['id']);
		$query = $this->db->get('user_bank',1,0);
		 */
		 
		 //检查用户是否绑定银行卡
		/*if($userinfo['is_bind_bank'] == 1 )
		{
			return array(1,"绑定银行卡无效，请联系管理员");	
		}*/
		//新额度减少
		
		
		
		//if($setp != 1)
		//{
			//$trading = $this->input->post('trading');
			//if($userinfo['trading'] == sha1($trading))
			//{
				//$row = $query->row_array();
				$order = $this->order_m->create_order(7,$uid,$monkey,false,false,false,$quota_b,$shouxufei);
				//$sina_return = $this->sina_m->create_hosting_withdraw($order,$userinfo['id'],$monkey,$row['card_id'],$shouxufei);
				$sina_return = $this->appsina_m->create_hosting_withdraw($order,$uid,$monkey,false,$shouxufei,$type);				
				//exit(json_encode($sina_return));
				if($sina_return[0] == 0)
				{
					/*//减少用户免费提现额度
					$this->db->where('id',$userinfo['id']);
					$this->db->set('quota','quota-'.$quota_b,false);
					$this->db->update('user');
					$this->order_m->same_monkey($userinfo['id']);//同步余额
					//手续费大于0
					if($daishou > 0)
					{
						//生成冻结手续费订单
						$order_dongjie = $this->order_m->create_order(13,$userinfo['id'],$daishou,false,false,$order);
						$dongjie = $this->sina_m->balance_freeze($order_dongjie,$userinfo['id'],$daishou);
						if($dongjie[0] == 1)
						{
							$this->order_m->order_failed($order_dongjie,$dongjie[1]);
							//sys_log("提现订单".$order."冻结手续费失败,原因:".$dongjie[1]);		
						}
						else
						{
							$this->order_m->order_success($order_dongjie);	
						}
						
					}*/
					return array(0,$sina_return[1]);	
				}
				else
				{
					$this->order_m->order_failed($order,$sina_return[1]);
					return array(1,$sina_return[1]);
				}
			//}
			//else
			//{
				//return array(1,'交易密码不正确');
			//}
		//}
		//else
		//{
			//第一步验证 通过
			//return array(0,'success');	
		//}
	}
	
}