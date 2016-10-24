<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_planning extends Front_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('order_m');
		$this->load->helper('front');
	}
	
	/*购买产品处理中*/
	/*function test()
	{
		$outer_trade_no = '509264'; 
		$order_row = $this->order_m->single_order($outer_trade_no); 
				if($order_row)
				{
					if($order_row['static'] == 1)
					{
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
					
				}
				else
				{
					$content = "用户购买项目成功：订单号为".$outer_trade_no."不存在";
					sys_log($content);		
				}	
	}*/
	
	//付息手动通知
	function test()
	{
		$start_order = 548778; //开始ID
		$end_order = 548813; //结束ID
		for($i=0;$i<=100;$i++)
		{
			$order = $start_order - (-$i);
			if($order <= $end_order)
			{
				$this->_send_user_lixi($order);
			}
			else
			{
				break;
			}
		}	
	}
	function _send_user_lixi($outer_trade_no = false)
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
						}
					}
					else
					{
						$content = "用户利息发放成功：订单号为".$outer_trade_no."不存在";
						sys_log($content);	
					}
				}
}