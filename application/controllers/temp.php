<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temp extends Front_Controller {
	function __construct()
	{
		parent::__construct();
		include_once FCPATH. "key/api/weibopay.class.php";
		$this->load->model('sina_m');
		$this->load->model('public_m');
		$this->load->model('order_m');
		$this->load->helper('front');
	}

 	/*把用户项目变为已结束且发送短信通知*/
/*	function failed_pro($proid = false)
	{
		//148 437 151 439
		$this->db->from('user_products');
		$this->db->join('bulk_standard','user_products.projectid = bulk_standard.id');
		$this->db->join('user','user.id = user_products.uid');
		$this->db->where('user_products.projectid',$proid);
		$this->db->select('bulk_standard.title,user.name,user.mobile,user_products.id');
		$query = $this->db->get();
		foreach($query->result_array() as $key)
		{
			$msg = '尊敬的蜂融网会员'.$key['name'].',您好。您所投资的项目（'.$key['title'].'），由于企业提前还款，已于2016年1月31日汇入您的账户，请及时关注并管理您的账户。如有问题请于我们联系。【蜂融网】';
			$this->_sms_send_fuxi($key['mobile'],$msg);
			$this->db->set('static',5);
			$this->db->where('id',$key['id']);	
			$this->db->update('user_products');
		}	
	}
	
	function _sms_send_fuxi($phone = false,$content = "")
	{
		$this->load->model('interface_m');
		return $this->interface_m->send_public_message($phone,$content);
	}*/
	
	
	
	/*把用户项目变为已结束完毕*/
	/*function same()
	{
		$this->order_m->same_monkey(30018);	
	}*/
	
	/*临时代收2001 还款专用账户*/
	/*function tmp_daishou($proid)
	{
		//148 437 151 439
		$userid = 30018;
		//获取项目详情
		$this->db->where('id',$proid);
		$products = $this->db->get('bulk_standard',1,0)->row_array();
		//生成订单号
		$order_id = $this->order_m->create_order(2,$userid,$products['money'],false,$proid);
		//计算利息
		$interest = $this->_interest($products['rate'],1,$products['money']);
		$interest_new = $interest-(-$products['money']);
		
		//更新用户账户
		$this->db->set('balance','balance-'.$products['money'].'',false); //减少账户余额
		$this->db->set('quota','quota+'.$interest_new.'',false);//增加免费额度
		$this->db->where('id',$userid);
		$this->db->update('user');
		
		//加入项目表
		$this->db->set('projectid',$proid); //项目ID
		$this->db->set('uid',$userid);
		$this->db->set('monkey',$products['money']); //交易金额
		$this->db->set('order_id',$order_id); //交易金额
		$this->db->set('static',2);//处理中
		$this->db->set('interest',$interest);//待收利息
		$this->db->set('day',$products['day']);
		$this->db->set('dateline',time());
		$this->db->set('rate',$products['rate']); //收益率
		$this->db->insert('user_products');
		$products_i_id = $this->db->insert_id();
		//保存项目ID到购买产品user_priducts 到订单
		$this->db->where('id',$order_id);
		$this->db->set('user_pro_id',$products_i_id);
		$this->db->update('fr_order');
		
		//更新项目
		$this->db->where('id',$proid);
		$this->db->set('static',2);
		$this->db->set('next_interest',next_time($products['starttime'],$products['send_num']) - 86400);
		$this->db->update('bulk_standard');
		
		//执行代收 这里是1002 支付到还款账户 不是投资账户
		
		//执行递交到新浪
		$post['out_trade_no'] = $order_id;
		$post['out_trade_code'] =  1002; //待收还款金
		$post['summary'] = $proid."手工债券转让";
		$post['goods_id'] = $proid; //散标ID
		$post['payer_id'] = $userid;//付款用户ID
		$post['payer_identity_type'] = "UID";
		$post['pay_method'] = "balance^".$products['money']."^SAVING_POT"; //余额支付  存钱罐支付
		$post['can_repay_on_failed'] = "N";//交易失败后不能再次发起交易
		$post['service'] = "create_hosting_collect_trade";
		$post['notify_url'] = 'https://www.kuaitoujiqi.com/temp/notify_daishou';//异步跳转
		$return = $this->_interface_submit($post,'mas');
		sys_log(json_encode($return));
	}
	
	function notify_daishou()
	{
		$post = $this->input->post();
		ksort ($post);
		$weibopay = new Weibopay ();
		if ($weibopay->checkSignMsg($post, @$post['sign_type'] )) 
		{
			if ($post["trade_status"] == 'PAY_FINISHED' || $post["trade_status"] == 'TRADE_FINISHED') 
			{
				if($post["trade_status"] == 'TRADE_FINISHED')
				{
					//交易完成
					echo "SUCCESS";exit();
				}
				
				echo "SUCCESS";exit();
				
				
			}
			else
			{
				//失败了
					
			}
		}
		else
		{
			die ("请求非法");	
		}
	}
	
	//计算代收利息
	function _interest($rate=false,$day = false,$monkey = false)
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
	
	
	
	/*function test($aa = "fdsfds")
	{
		echo sinapay_system;
	}*/
	
	//付息失败的重新付息
/*	function again_fuxi($proid = false)
	{
		switch($proid)
		{
			case 328:$isend = 2;break;
			case 546:$isend = 2;break;
			case 547:$isend = 1;break;
			case 441:$isend = 1;break;
			case 330:$isend = 2;break;
			case 442:$isend = 1;break;
			case 154:$isend = 1;break;	
		}
		$this->db->from('fr_order');
		$this->db->where('fr_order.dateline >',1454083200);
		$this->db->where('fr_order.type',5);
		$this->db->where('fr_order.static',3);
		$this->db->where('fr_order.productid',$proid);//项目
		$this->db->join('user_products','fr_order.user_pro_id = user_products.id');
		$this->db->join('user','fr_order.uid = user.id');
		$this->db->join('bulk_standard','bulk_standard.id = fr_order.productid');
		$this->db->select('fr_order.monkey,user.id as userid,user_products.id as proid,fr_order.productid,user.name,user.mobile,bulk_standard.rate,bulk_standard.services,user_products.monkey as uermonkey,bulk_standard.title');
		$query = $this->db->get();
		$count = 0;//付息总数
		$count1 =0 ;//付息加分账
		$create = $this->order_m->create_order(5,0,0,false,$proid); //生成大订单
		$sina_array = array();
		foreach($query->result_array() as $key)
		{
			
			$send = $this->_send_lixi($key['rate'],$key['uermonkey'],$key['services'],$isend);
			$count = $count-(-$send[0]);
			$count1 = $count1-(-$send[2]);
			$create_small = $this->order_m->create_order(5,$key['userid'],$send[0],false,$key['productid'],$create,false,false,$key['proid']);
			if(!$create_small)
			{
				sys_log($key['productid'].'发放利息失败,生成小订单失败'.$create_small);	
				return;		
			}
			$fenzhang = $key['userid']."^"."UID^SAVING_POT^".sinapay_system."^EMAIL^BASIC^".$send[1]."^".$key['title']."用户分账";//分账信息组合 
			$trade_list = $create_small."~".$key['userid']."~UID~SAVING_POT~".$send[2]."~".$fenzhang."~".$key['title']."利息发放~~~".$key['id']."~";
			array_push($sina_array,$trade_list);
		}
		$this->order_m->order_success($create);
		$trade_list = implode("$",$sina_array);
		$sina_return = $this->_create_batch_hosting_pay_trade($create,$trade_list);
		if($sina_return[0] == 0)
		{
			sys_log($key['title'].'发放提交利息成功补交');
			echo $count."付息加分账".$count1;
			return;
		}
		else
		{
			//$this->db->trans_rollback();	
			sys_log($key['title'].'发放利息失败,提交新浪请求失败补交'.$sina_return[1]);
			return;
		}		
		
	}*/
	//代付信息
/*	function _create_batch_hosting_pay_trade($out_trade_no = false,$trade_list = false)
	{
		$post['out_pay_no'] = $out_trade_no;
		$post['out_trade_code'] = 2002;	
		$post['trade_list'] = $trade_list;
		$post['notify_method'] = "single_notify";
		$post['notify_url'] = 'https://www.kuaitoujiqi.com/sinanotify/send_user_lixi';//异步跳转
		$post['service'] = "create_batch_hosting_pay_trade";
		return $this->_interface_submit($post,'mas');
	}
	*/
	//生成付息订单
	/*function _create_order($userid = false,$proid,$monkey,$userproid)
	{
		$this->db->set('type',20);//
		$this->db->set('uid',$userid);
		$this->db->set('monkey',$monkey);
		$this->db->set('static',1);
		$this->db->set('dateline',time());
		$this->db->set('remark','代收回款');
		$this->db->set('productid',$proid);
		$this->db->set('user_pro_id',$userproid);
		if($this->db->insert('fr_order'))
		{
			return $this->db->insert_id();	
		}
		else
		{
			return false;	
		}	
	}*/
	
	
	//代付回调
	/*function notify_fuxi()
	{
			
	}*/
	
	//处理订单
/*	function _order_status($orderid = false,$status = false)
	{
		$this->db->where('id',$orderid);
		$this->db->set('static',$status);
		$this->db->update('fr_order');	
	}*/
	
	//计算分账利息啥的
/*	function _send_lixi($rate = false,$monkey = false,$services = false,$is_end = false)
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
	
	/*function tmp_widthaw($proid)
	{
		$this->db->from('fr_order');
		$this->db->where('fr_order.dateline >',1454083200);
		$this->db->where('fr_order.type',5);
		$this->db->where('fr_order.productid',$proid);//项目
		$this->db->join('user_products','fr_order.user_pro_id = user_products.id');
		$this->db->join('user','fr_order.uid = user.id');
		$this->db->select('user_products.monkey,user.id as userid,user_products.id as proid,fr_order.productid,user.name,user.mobile');
		$query = $this->db->get();
		echo '<table width="700" border="0">
  <tr>
    <td>用户名</td>
    <td>金额</td>
    <td>电话</td>
  </tr>
';
		foreach($query->result_array() as $key)
		{
			echo '  <tr>
    <td>'.$key['name'].'</td>
    <td>'.$key['monkey'].'</td>
    <td>'.$key['mobile'].'</td>
  </tr>';	
		}
		echo '</table>';
	}*/
	
	
	
	/*function tmp($proid = 100)
	{
		$orderid = $this->_create_order($key['userid'],$key['productid'],$key['monkey'],$key['proid']);
		if($orderid)
		{
			$sina_return = $this->_pay_repayment($orderid,$key['productid'],$key['userid'],$key['monkey']);
			if($sina_return[0] == 0)
			{
						
			}
			else
			{
				//失败
				$this->_order_status($orderid,3);	
				sys_log('代收新浪返回失败,'.json_encode($key)."失败原因".$sina_return[1]);	
			}
		}
		else
		{
			sys_log('代收生成订单失败,'.json_encode($key));	
		}
	}*/
	
	//企业还款代收
	
	
	//生成订单
	/*function _create_order($userid = false,$proid,$monkey,$userproid)
	{
		$this->db->set('type',2);
		$this->db->set('uid',$userid);
		$this->db->set('monkey',$monkey);
		$this->db->set('static',1);
		$this->db->set('dateline',time());
		$this->db->set('remark','代收回款');
		$this->db->set('productid',$proid);
		$this->db->set('user_pro_id',$userproid);
		if($this->db->insert('fr_order'))
		{
			return $this->db->insert_id();	
		}
		else
		{
			return false;	
		}	
	}*/
	//订单失败
/*	function _order_status($orderid = false,$status = false)
	{
		$this->db->where('id',$orderid);
		$this->db->set('static',$status);
		$this->db->update('fr_order');	
	}*/
	
	//代收异步通知
/*	function notify()
	{
		$post = $this->input->post();
		ksort ($post);
		$weibopay = new Weibopay ();
		if ($weibopay->checkSignMsg($post, @$post['sign_type'] )) {
			$outer_trade_no = $post['outer_trade_no'];   //user_account_history ID
			if ($post["trade_status"] == 'PAY_FINISHED' || $post["trade_status"] == 'TRADE_FINISHED') {
				if($post["trade_status"] == 'TRADE_FINISHED')
				{
					echo "SUCCESS";exit();	
				}
				$this->_order_status($orderid,2);
				
			}
			else
			{
				//状态失败
				$this->_order_status($orderid,3);
			}
		}
	}*/
	
	//代收新浪提交
/*	function _pay_repayment($out_trade_no = false,$goodsid = "",$uid = false,$total = false)
	{
		$post['out_trade_no'] = $out_trade_no;
		$post['out_trade_code'] =  1002; //待收还款金
		$post['summary'] = $goodsid."代收回款";
		$post['goods_id'] = $goodsid; //散标ID
		$post['payer_id'] = $uid;//付款用户ID
		$post['payer_identity_type'] = "UID";
		$post['pay_method'] = "balance^".$total."^BASIC"; //余额支付  存钱罐支付
		$post['can_repay_on_failed'] = "N";//交易失败后不能再次发起交易
		$post['service'] = "create_hosting_collect_trade";
		$post['notify_url'] = site_url('temp/notify');//异步跳转
		return $this->_interface_submit($post,'mas');
	}*/
	
	function _interface_submit($post=false,$type = "mgs")
	{
		//公用post信息
		$post['version'] = "1.0";	
		$post['request_time'] = date("YmdHis");
		$post['partner_id'] = sinapay_partner_id;
		$post['_input_charset'] = sinapay_input_charset;
		$post['sign_type'] = "MD5";
		//公共post结束
		if($type == "mgs")
		{
			$url = 	sinapay_wpay_url;
		}
		else
		{
			$url = sinapay_pay_url;	
		}
		$weibopay = new Weibopay ();
		ksort($post);
		$post['sign'] = $weibopay->getSignMsg($post,$post['sign_type']);
		$data = $weibopay->createcurl_data($post);
		$result = $weibopay->curlPost($url,$data); // 使用模拟表单提交进行数据提交
		$result = urldecode ($result);
		$splitdata = array ();
		$splitdata = json_decode($result,true);
		$sign_type = $splitdata ['sign_type'];//签名方式
		ksort($splitdata); // 对签名参数据排序
		if ($weibopay->checkSignMsg ($splitdata,$sign_type)) {
			if ($splitdata["response_code"] == 'APPLY_SUCCESS') { // 成功
					return array(0,$splitdata);//exit();
				} else {	//失败
					return array(1,$splitdata['response_message']);
					//exit();
				}
			} 
			else {
				return array(1,$splitdata['response_message']);//exit();
		}
	}
	
}

