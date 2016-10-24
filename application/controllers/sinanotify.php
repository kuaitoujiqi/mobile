<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sinanotify extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		include_once FCPATH. "key/api/weibopay.class.php";
		$this->load->model('order_m');
		$this->load->model('sina_m');
		$this->load->helper('front');
	}
	
	//个人账户充值异步通知接收处理
	function recharge()
	{
		$post = $this->input->post();
		ksort($post);
		$weibopay = new Weibopay ();
		if ($weibopay->checkSignMsg($post, @$post["sign_type"] )) {
			if ($post["deposit_status"] == 'SUCCESS') 
			{
				$out_trade_no = $post['outer_trade_no'];
				$row = $this->order_m->single_order($out_trade_no);
				if(!$row)
				{
					$content = "用户充值：订单号为".$out_trade_no."不存在，充值成功，本地余额未到帐";
					sys_log($content);
				}
				else
				{
					if($row['static'] == 1)
					{
						$this->db->where('id',$out_trade_no);
						$this->db->set('static',2);
						$this->db->update('fr_order');
						//同步金额
						$this->order_m->same_monkey($row['uid']);
					}
				}
				
			
			} else if($post["deposit_status"]=='PROCESSING'){

			}else
			{
				$out_trade_no = $post['outer_trade_no'];
				$row = $this->order_m->single_order($out_trade_no);
				if(!$row)
				{
					$content = "用户充值：订单号为".$out_trade_no."不存在，充值失败，状态更改失败";
					sys_log($content);
				}
				else
				{
					if($row['static'] == 1)
					{
						//交易失败
						$out_trade_no = $post['outer_trade_no'];
						$this->db->where('id',$out_trade_no);
						$this->db->set('static',3); //状态变为失败
						$this->db->update('fr_order');
					}
				}
			}
			// 如果回调成功，需要输出SUCCESS告知我新浪回调服务器，已经收到异步通知。
			echo 'SUCCESS';
		} else {
			die ( "非法请求" );
		}	
	}
	
	
	//企业提现
	function withdraw()
	{
		$post = $this->input->post();	
		ksort($post);
		$weibopay = new Weibopay ();
		if ($weibopay->checkSignMsg($post, @$post["sign_type"] )) 
		{
			$order = $post['outer_trade_no'];
			$row = $this->order_m->single_order($order);
			
			
			if ($post["withdraw_status"] == 'SUCCESS') {
				if(!$row)
				{
					$content = "提现成功：订单号为".$order."不存在";
					sys_log($content);	
				}
				else
				{
					$this->order_m->order_success($order);
					$this->order_m->same_monkey($row['uid']);
				}
			}
			if ($post["withdraw_status"] == 'FAILED') {
				$order = $post['outer_trade_no'];
				$row = $this->order_m->single_order($order);
				if(!$row)
				{
					$content = "提现失败：订单号为".$order."不存在";
					sys_log($content);	
				}
				else
				{
					$this->order_m->order_failed($order);
					$this->order_m->same_monkey($row['uid']);
				}
			}
			if ($post["withdraw_status"] == 'RETURNT_TICKET'){ 
				$order = $post['outer_trade_no'];
				$row = $this->order_m->single_order($order);
				if(!$row)
				{
					$content = "提现失败银行退票：订单号为".$order."不存在";
					sys_log($content);	
				}
				else
				{
					$this->order_m->order_failed($order,'银行退票');	
					$this->order_m->same_monkey($row['uid']);
				}
			}
			echo 'SUCCESS';	
		}
		else
		{
			die( "非法请求" );		
		}
			
	}
	
	
	//个人用户提现
	function u_withdraw()
	{
		$post = $this->input->post();	
		ksort($post);
		$weibopay = new Weibopay ();
		if ($weibopay->checkSignMsg($post, @$post["sign_type"] )) 
		{
			$order = $post['outer_trade_no'];
			$row = $this->order_m->single_order($order);
			
			
			if ($post["withdraw_status"] == 'SUCCESS') {
				if(!$row)
				{
					$content = "提现成功：订单号为".$order."不存在";
					sys_log($content);	
				}
				else
				{
					if($row['static'] != 1)
					{
						echo 'SUCCESS';exit();
					}
					$this->order_m->order_success($order);
					/*//解冻手续费
					if(($row['poundage'] - 2) > 0)
					{
						$order_dongjie = $this->order_m->create_order(14,$row['uid'],($row['poundage']-2),false,false,$order);
						$old = $this->order_m->get_ban_order($row['id']);
						$dongjie = $this->sina_m->balance_unfreeze($order_dongjie,$old,$row['uid'],($row['poundage'] - 2));
						if($dongjie[0] == 1)
						{
							
							$this->order_m->order_failed($order_dongjie,$dongjie[1]);	
						}
						else
						{
							$this->order_m->order_success($order_dongjie);
							//代收手续费
							$order_daishou = $this->order_m->create_order(11,$row['uid'],($row['poundage']-2),false,false,$order);
							$sina_return_daishou = $this->sina_m->withdraw_shou($order_daishou,false,$row['uid'],($row['poundage']-2));
							if($sina_return_daishou[0] != 0)
							{
								$this->order_m->order_failed($order_daishou,$sina_return_daishou[1]);
							}
							
						}
					}*/
					$this->order_m->same_monkey($row['uid']);
				}
			}
			if ($post["withdraw_status"] == 'FAILED') {
				$order = $post['outer_trade_no'];
				$row = $this->order_m->single_order($order);
				if(!$row)
				{
					$content = "提现失败：订单号为".$order."不存在";
					sys_log($content);	
				}
				else
				{
					$this->order_m->order_failed($order);
					$this->order_m->same_monkey($row['uid']);
					//返还用户提现额度
					$this->db->where('id',$row['uid']);
					$this->db->set('quota','quota+'.$row['quota'],false);
					$this->db->update('user');
					/*if(($row['poundage'] - 2) > 0)
					{
						$order_dongjie = $this->order_m->create_order(14,$row['uid'],($row['poundage']-2),false,false,$order);
						
						$dongjie = $this->sina_m->balance_unfreeze($order_dongjie,$this->order_m->get_ban_order($row['id']),$row['uid'],($row['poundage'] - 2));
						if($dongjie[0] == 1)
						{
							$this->order_m->order_failed($order_dongjie,$dongjie[1]);	
						}	
					}*/
					
					
				}
			}
			if ($post["withdraw_status"] == 'RETURNT_TICKET'){ 
				$order = $post['outer_trade_no'];
				$row = $this->order_m->single_order($order);
				if(!$row)
				{
					$content = "提现失败银行退票：订单号为".$order."不存在";
					sys_log($content);	
				}
				else
				{
					$this->order_m->order_failed($order,'银行退票');	
					$this->order_m->same_monkey($row['uid']);
					//返还用户提现额度
					$this->db->where('id',$row['uid']);
					$this->db->set('quota','quota+'.$row['quota'],false);
					$this->db->update('user');
					/*if(($row['poundage'] - 2) > 0)
					{
						//解冻
						$order_dongjie = $this->order_m->create_order(14,$row['uid'],($row['poundage']-2),false,false,$order);
						$dongjie = $this->sina_m->balance_unfreeze($order_dongjie,$this->order_m->get_ban_order($row['id']),$row['uid'],($row['poundage'] - 2));
						if($dongjie[0] == 1)
						{
							$this->order_m->order_failed($order_dongjie,$dongjie[1]);	
						}	
					}*/
					
				}
			}
			echo 'SUCCESS';	
		}
		else
		{
			die( "非法请求" );		
		}
			
	}
	//企业资质审核
	function chenck_company()
	{
		$post = $this->input->post();	
		ksort($post);
		$weibopay = new Weibopay ();
		if ($weibopay->checkSignMsg($post,@$post["sign_type"])) {
			
			$audit_order_no = $post['audit_order_no'];
		    $order_check = $this->order_m->single_order($audit_order_no);

			if ($post["audit_status"] == 'SUCCESS') 
			{
				//审核成功
				if($order_check)
				{
					if($order_check['static'] != 3)
					{
						//更新企业表审核状态
						$this->db->set('static',3);	
						$this->db->where('id',$order_check['uid']); //企业ID
						$this->db->update('company_user');
						//更新订单审核状态
						$this->db->set('static',2);
						$this->db->where('id',$audit_order_no);
						$this->db->update('fr_order');
					}
				}
				else
				{
					$content = "企业审核成功：订单号为".$audit_order_no."不存在";
					sys_log($content);	
				}
			}
			if ($post["audit_status"] == 'FAILED') //审核失败
			{
				if($order_check)
				{
					if($order_check['static'] != 4)
					{
						//更新企业表审核状态
						$this->db->set('static',4);	
						$this->db->where('id',$order_check['uid']); //企业ID
						$this->db->set('failed_msg',$post['audit_message']);
						$this->db->update('company_user');
						//更新订单审核状态
						$this->db->set('static',3);
						$this->db->where('id',$audit_order_no);
						$this->db->update('fr_order');
					}
				}
				else
				{
					$content = "企业审核失败：订单号为".$audit_order_no."不存在";
					sys_log($content);	
				}
			}
			echo "SUCCESS";
		}
		else
		{
			die ( "非法请求" );	
		}
		
	}
	
	
	//购买产品
	function buy_product()
	{
		$post = $this->input->post();
		ksort ($post);
		$weibopay = new Weibopay ();
		if ($weibopay->checkSignMsg($post, @$post['sign_type'] )) {
			$outer_trade_no = $post['outer_trade_no'];   //user_account_history ID
		   if ($post["trade_status"] == 'PAY_FINISHED' || $post["trade_status"] == 'TRADE_FINISHED') { // 成功
		   		
				if($post["trade_status"] == 'PAY_FINISHED')
				{
					//交易完成
					echo "SUCCESS";exit();
				}
				echo "SUCCESS";
				sleep(2);
				//交易成功 
				$order_row = $this->order_m->single_order($outer_trade_no); 
				if($order_row)
				{
					if($order_row['static'] == 1) //处理中
					{
						$this->db->trans_begin();
						//事物开始
						$this->db->set('static',2);
						$this->db->where('id',$outer_trade_no);
						$this->db->update('fr_order'); //更新订单状态
						
						$this->db->where('id',$order_row['productid']);
						$row = $this->db->get('bulk_standard',1,0)->row_array();
						
						$interest_new = $this->interest($row['rate'],$row['day'],$order_row['monkey']);
						
						$this->db->set('quota','quota+'.$interest_new-(-$order_row['monkey']).'',false);//增加免费额度
						$this->db->where('id',$order_row['uid']);
						$this->db->update('user');
						
						$this->db->set('projectid',$order_row['productid']); //项目ID
						$this->db->set('uid',$order_row['uid']);
						$this->db->set('monkey',$order_row['monkey']); //交易金额
						$this->db->set('order_id',$outer_trade_no); //交易订单号
						$this->db->set('static',2);//成功
						$this->db->set('prostatic',1);//持有
						$this->db->set('interest',$interest_new);//待收利息
						$this->db->set('day',$row['day']);
						$this->db->set('dateline',time());
						$this->db->set('rate',$row['rate']); //收益率
						$this->db->insert('user_products');
						$products_i_id = $this->db->insert_id();
						//保存项目ID到购买产品user_priducts 到订单
						$this->db->where('id',$outer_trade_no);
						$this->db->set('user_pro_id',$products_i_id);
						$this->db->update('fr_order');
						
						if ($this->db->trans_status() === FALSE)
						{
							$this->db->trans_rollback();	
							sys_log("用户购买项目付款成功,数据执行失败项目ID：".$order_row['productid']."金额:".$order_row['monkey']."用户ID：".$order_row['uid']);
						}
						else
						{
							$this->db->trans_commit();
							//同步用户金额
							$this->order_m->same_monkey($order_row['uid']);	
							
							$this->db->where('id',$order_row['uid']);	
							$result = $this->db->get('user',1,0)->row_array();
							$this->load->model('interface_m');
							$this->interface_m->sendmessage($result['mobile'],6);							
						}
						
					
						
						$this->load->model('public_m');
						$this->public_m->send_notice($order_row['uid'],'您于 '.date('Y-m-d H:i:s',$order_row['dateline'])." 成功购买".$prorow['title'].",金额为".$order_row['monkey']);
					}
					
				}
				else
				{
					$content = "用户购买项目成功：订单号为".$outer_trade_no."不存在";
					sys_log($content);		
				}
				
				
				
		   }else{
				//交易失败
				$order_row = $this->order_m->single_order($outer_trade_no); 
				if($order_row)
				{
					if($order_row['static'] == 1)
					{

						$this->db->trans_begin();
						$this->db->set('static',3);
						$this->db->where('id',$outer_trade_no);
						$this->db->update('fr_order'); //更新订单状态
						
						if ($this->db->trans_status() === FALSE)
						{
							 $this->db->trans_rollback();
							 $content = "用户购买项目失败：订单号为".$outer_trade_no."执行失败";
							sys_log($content);
						}
						else
						{
							$this->db->set('restmoney','restmoney+'.$order_row['monkey'].'',false);
							$this->db->where('id',$order_row['productid']);
							$this->db->update('bulk_standard');
							$this->db->trans_commit();	
						}
					}
				}
				else
				{
					$content = "用户购买项目失败：订单号为".$outer_trade_no."不存在";
					sys_log($content);		
				}
				
			}
			echo 'success';
		}
		else
		{
			die ("sign error");	
		}
	}	
	
	
	//计算利息
	function interest($rate = false,$day = false,$monkey = false)
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
	
	
	//审标状态审核 代付到企业账户
	function check_bulk()
	{
		$post = $this->input->post();	
		ksort($post);
		$weibopay = new Weibopay ();
		if ($weibopay->checkSignMsg($post,@$post["sign_type"])) {
			$outer_trade_no = $post['outer_trade_no'];
			if ($post["trade_status"] == 'TRADE_FINISHED')
			{

				//交易成功
				$order_row = $this->order_m->single_order($outer_trade_no); 
				if($order_row)
				{
					if($order_row['static'] == 1) //此次交易订单状态为处理中可进行处理
					{
						$this->order_m->order_success($outer_trade_no);//处理订单状态为成功
						
						$this->db->where('id',$order_row['productid']);
						$row_p = $this->db->get('bulk_standard',1,0)->row_array();
						$this->db->set('static',2); //设置状态为还款中
						$starttime = time()-(-86400);
						$this->db->set('starttime',$starttime ); //设置项目开始时间
						//$next_interest = strtotime('+1 months',time())-172800;
						$next_interest = next_time($starttime,0)-86400;
						$this->db->set('next_interest',$next_interest); //下次还款时间
						$this->db->set('endtitme',strtotime('+'.(30*$row_p['day']).' day',$starttime)-86400);//项目结束时间
						$this->db->where('id',$order_row['productid']);
						$this->db->update('bulk_standard');	
					}
					
				}
				else
				{
					$content = "审核标的成功：订单号为".$outer_trade_no."不存在";
					sys_log($content);	
				}
			}
			if ($post["trade_status"] == 'TRADE_FAILED') //审核失败
			{
				$order_row = $this->order_m->single_order($outer_trade_no); 
				if($order_row)
				{
					$this->order_m->order_failed($outer_trade_no);//处理订单状态为失败
				}
				else
				{
					$content = "审核标的失败：订单号为".$outer_trade_no."不存在";
					sys_log($content);		
				}
			}
			echo "SUCCESS";
		}
		else
		{
			die ( "非法请求" );	
		}
		
	}
	
	//企业还款
	function pay_repayment()
	{
		$post = $this->input->post();
		ksort ($post);
		$weibopay = new Weibopay ();
		if ($weibopay->checkSignMsg($post, @$post['sign_type'] )) {
			$outer_trade_no = $post['outer_trade_no'];   //user_account_history ID
		   if ($post["trade_status"] == 'PAY_FINISHED' || $post["trade_status"] == 'TRADE_FINISHED') { // 成功
		   		if($post["trade_status"] == 'TRADE_FINISHED')
				{
					//交易完成
					echo "SUCCESS";exit();
				}
				//交易成功 				
				$order_row = $this->order_m->single_order($outer_trade_no); 
				if($order_row)
				{
					if($order_row['static'] == 1)
					{
						$this->order_m->order_success($outer_trade_no);//处理订单状态为成功
						$this->db->where('id',$order_row['productid']);
						$this->db->set('repayment_this',2);
						$this->db->set('repayment_num','repayment_num+1',false);
						$this->db->update('bulk_standard');
					}
				}
				else
				{
					$content = "企业还款成功：订单号为".$outer_trade_no."不存在";
					sys_log($content);		
				}
		   }else{
				//交易失败
				$order_row = $this->order_m->single_order($outer_trade_no); 
				if($order_row)
				{
					if($order_row['static'] == 1)
					{
						$this->order_m->order_failed($outer_trade_no);//处理订单状态为失败
					}
				}
				else
				{
					$content = "企业还款失败：订单号为".$outer_trade_no."不存在";
					sys_log($content);
				}
				
			}
			echo 'SUCCESS';
		}
		else
		{
			die ("请求非法");	
		}
	}	
	//用户利息发放 单个订单处理
	function send_user_lixi()
	{
		$post = $this->input->post();
		$weibopay = new Weibopay ();	
		ksort ($post);
		if ($weibopay->checkSignMsg($post, @$post['sign_type'] )) {
			$outer_trade_no = $post['outer_trade_no'];
			if ($post["trade_status"] == 'PAY_FINISHED' || $post["trade_status"] == 'TRADE_FINISHED') 
			{ 
				if($post["trade_status"] == 'PAY_FINISHED')
				{
					//交易完成
					echo "SUCCESS";exit();
				}
				else
				{
					//$this->db->trans_begin();
					$order_row = $this->order_m->single_order($outer_trade_no); 
					if($order_row)
					{
						if($order_row['pid'] != 0 && $order_row['static'] == 1)
						{
							$this->order_m->order_success($outer_trade_no);
							//同步用户金额
							$this->order_m->same_monkey($order_row['uid']);
							//获取用户项目
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
							
							$this->db->where('id',$order_row['uid']);	
							$result = $this->db->get('user',1,0)->row_array();
							$this->load->model('interface_m');
							$this->interface_m->sendinterestmessage($result['mobile'],$prorow['title'],$order_row['monkey'],7);
						}
					}
					else
					{
						$content = "用户利息发放成功：订单号为".$outer_trade_no."不存在";
						sys_log($content);	
					}
				}
				//$this->db->trans_commit();
				
			}
			else
			{
				$order_row = $this->order_m->order_failed($outer_trade_no); 
				if($order_row)
				{
					if($order_row['pid'] != 0 && $order_row['static'] == 1)
					{
						$this->order_m->order_failed($outer_trade_no);//交易失败
						$this->load->model('public_m');
						$this->public_m->send_notice($order_row['uid'],'系统于 '.date('Y-m-d H:i:s',$order_row['dateline'])." 还款失败,失败项目：".$prorow['title'].",金额为".$order_row['monkey']);
					}
				}
				else
				{
					$content = "用户利息发放失败：订单号为".$outer_trade_no."不存在";
					sys_log($content);	
				}
			}
			echo "SUCCESS";exit();
		}
		else
		{
			die('请求非法');	
		}
	}
	
	
	//提现代收
	function withdraw_shou()
	{
		$post = $this->input->post();
		ksort ($post);
		$weibopay = new Weibopay ();
		if ($weibopay->checkSignMsg($post, @$post['sign_type'] )) {
		$outer_trade_no =  $post['outer_trade_no']; 
		   if ($post["trade_status"] == 'PAY_FINISHED' || $post["trade_status"] == 'TRADE_FINISHED') { // 成功
		   		
				if($post["trade_status"] == 'PAY_FINISHED')
				{
					//交易完成
					echo "SUCCESS";exit();
				}
				//更新债券数据
				$row = $this->order_m->single_order($outer_trade_no); //获取订单数据
				if($row['static'] != 1)
				{
					echo "SUCCESS";exit();	
				}
				//更改订单状态为成功
				$this->order_m->order_success($outer_trade_no);
				
				if(!$row)
				{
					$content = "提现手续费扣除成功：订单号为".$outer_trade_no."不存在";
					sys_log($content);
					echo "SUCCESS";exit();
				}
				
				//发起代付交易
				$order_fu = $this->order_m->create_order(12,0,$row['monkey'],false,false,$row['pid']);
				if(!$order_fu)
				{
					$content = "提现手续费代付失败生成订单失败";
					sys_log($content);
					echo "SUCCESS";exit();	
				}
				$return = $this->sina_m->withdraw_fu($order_fu,$row['monkey']);
				if($return[0] == 1)
				{
					$content = "提现手续费代付失败".$return[1];
					sys_log($content);
					echo "SUCCESS";exit();	
				}
				$this->sina_m->same_monkey($row['uid']); //同步余额
				echo "SUCCESS";exit();	
		   }
		   else
		   {
				//交易失败
				$this->order_m->order_failed($outer_trade_no);
				$row = $this->order_m->single_order($outer_trade_no); //获取订单数据
				if(!$row)
				{
					$content = "提现手续费扣除失败：订单号为".$outer_trade_no."不存在";
					sys_log($content);
					echo "SUCCESS";exit();
				}
				  
		   }
		   echo 'SUCCESS';
		}
		else
		{
			die ("sign error");		
		}
	}
	
	//债券装让代付
	function withdraw_fu()
	{
		$post = $this->input->post();
		ksort ($post);
		$weibopay = new Weibopay ();
		if ($weibopay->checkSignMsg($post, @$post['sign_type'] )) 
		{
			$outer_trade_no = $post['outer_trade_no'];   //user_account_history ID
		   if ($post["trade_status"] == 'PAY_FINISHED' || $post["trade_status"] == 'TRADE_FINISHED') { // 成功
		   		
				if($post["trade_status"] == 'PAY_FINISHED')
				{
					echo "SUCCESS";exit();
				}
				//交易完成
				//更改订单状态为成功
				$this->order_m->order_success($outer_trade_no);
				//更新债券数据
				$row = $this->order_m->single_order($outer_trade_no); //获取订单数据
				if(!$row)
				{
					$content = "提现手续费代付成功：订单号为".$outer_trade_no."不存在";
					sys_log($content);
					echo "SUCCESS";exit();
				}
		   }
		   else
		   {
				//交易失败
				$this->order_m->order_failed($outer_trade_no);
				$content = "提现手续费代付失败：订单号为".$outer_trade_no;
				sys_log($content);
				echo "SUCCESS";exit();
				  
		   }
		   echo 'SUCCESS';
		}
		else
		{
			die ("sign error");		
		}	
	}
	
}