<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transfer extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		include_once FCPATH. "key/api/weibopay.class.php";
		$this->load->model('order_m');
		$this->load->helper('front');
		$this->load->model('sina_m');
	}
	//债券转让代收
	function buy_transfer()
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
				//查询订单状态 
				sleep(3);
				
				$row_ss = $this->order_m->single_order($outer_trade_no); 
				if(!$row_ss)
				{
					$content = "购买债券成功代收不存在：订单号为".$outer_trade_no."不存在";
					sys_log($content);
					echo "SUCCESS";exit();
				}
				
				if($row_ss['static'] == 2) //处理过了
				{
					echo "SUCCESS";exit();	
				}
				
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
						//$sina_sell = $this->sina_m->sell_transfer($create_sell_order,$user_transfer['user_id'],$user_transfer['monkey'],$user_transfer['pro_id']);
						//新浪代付
						$money = $user_transfer['monkey'];
						$fenzhang = $user_transfer['user_id']."^"."UID^SAVING_POT^"."kuaitoujiqi@sina.com"."^EMAIL^BASIC^".$user_transfer['poundage']."^债权转让^";
						// $trade_list = $create_sell_order."~".$user_transfer['sendee']."~UID~SAVING_POT~".$user_transfer['monkey']."~"."$fenzhang"."~债权转让放款~~~".$user_transfer['pro_id']."~";
						$uid = $user_transfer['user_id'];
						$sina_sell = $this->sina_m->sell_transfer($create_sell_order,$money,$uid,$fenzhang);
						
						if($sina_sell[0] != 0)
						{
							$content = "债券转让代付提交新浪失败：交易订单号为".$outer_trade_no."返回错误".$sina_sell[1];
							
							$sinaReturnLog['type'] = 1;
							$sinaReturnLog['content'] = json_encode($sina_sell[1]);
							$sinaReturnLog['time'] = date('Y-m-d H:i:s');
							$this->db->insert('sina_return_log',$sinaReturnLog);
							
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
		   }
		   else
		   {
				//交易失败
				$this->order_m->order_failed($outer_trade_no);
				$row = $this->order_m->single_order($outer_trade_no); //获取订单数据
				if(!$row)
				{
					$content = "购买债券失败：订单号为".$outer_trade_no."不存在";
					sys_log($content);
					echo "SUCCESS";exit();
				}
				$this->db->trans_begin();
				$transfer = $this->db->query('select * from user_transfer id ='.$row['transfer_id']." for update")->row_array();
				$this->db->set('sendeetime',''); //转让时间
				$this->db->set('sendee','');//转让接收人
				$this->db->set('static',2); //已经转让
				$this->db->where('id',$row['transfer_id']);
				$this->db->update('user_transfer');
				if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
					$content = "购买债券失败：订单号为".$outer_trade_no."处理失败";
					sys_log($content);
					echo "SUCCESS";exit();
				}
				else
				{
					$this->db->trans_commit();	
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
	function sell_transfer()
	{
		$post = $this->input->post();
		$sinaReturnLog['type'] = 2;
		$sinaReturnLog['content'] = json_encode($sina_sell[1]);
		$sinaReturnLog['time'] = date('Y-m-d H:i:s');
		$this->db->insert('sina_return_log',$sinaReturnLog);
		
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
				sleep(3);
				//查看订单状态
				$row_ss = $this->order_m->single_order($outer_trade_no);
				if(!$row_ss)
				{
					$content = "购买债券成功代付不存在：订单号为".$outer_trade_no."不存在";
					sys_log($content);
					echo "SUCCESS";exit();
				}
				
				if($row_ss['static'] == 2) //处理过了
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
					$content = "购买代付成功：订单号为".$outer_trade_no."不存在";
					sys_log($content);
					echo "SUCCESS";exit();
				}
				$this->db->set('sellstatic',2);
				$this->db->where('id',$row['transfer_id']);
				$this->db->update('user_transfer');
				
		   }
		   else
		   {
				//交易失败
				$content = "购买债券代付失败：订单号为".$outer_trade_no;
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