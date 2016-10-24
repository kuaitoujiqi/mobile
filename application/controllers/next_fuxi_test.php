<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Next_fuxi_test extends Front_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->model('sina_m');
		//$this->load->model('public_m');
		//$this->load->model('order_m');
		//$this->load->helper('front');
	}
	
	function test($nexttime = false) //wyjrDMhShiWVOktt
	{
			if(!$nexttime)
			{
				$now = strtotime(date('Y-m-d',time()-(-86400)));	
			}
			else
			{
				$now = strtotime($nexttime." 00:00:00");	
			}
			

			//$now = strtotime(date('Y-m-d',time()-(-86400)));
			$this->db->where('static',2);
			$this->db->where('next_interest <= ',$now);
			$result = $this->db->get('bulk_standard')->result_array();
			//sys_log($this->db->last_query());
			$count = 0;
			foreach($result as $key)
			{
				//sys_log($key['title'].'开始执行');
				
				$tmp_next_interest = $key['send_num'] - (-1); //计算下次还款时间
				if($tmp_next_interest >= $key['day'])
				{
					$tmp = $this->_send_bulk_standard($key,2,$key['endtitme']);
					echo $key['id'].":".$key['title']."付息".$tmp."<br>";
					$count = $count - (-$tmp);	
				
				}
				else
				{
					$tmp = $this->_send_bulk_standard($key,1,$tmp_next_interest);
					echo $key['id'].":".$key['title']."付息".$tmp."<br>";
					$count = $count - (-$tmp);		
				}
			}
			echo "总计".$count;
		
		//循环结束
	}
	//发放利息  key为当前利息发放的项目表详情
 	function _send_bulk_standard($key,$is_end,$tmp_next_interest)
	{
		$get_user = $this->_get_user_products($key['id']);
		$send_count = 0;
		foreach($get_user as $key_s)
		{
			//计算发放利息
			$send = $this->_send_lixi($key['rate'],$key_s['monkey'],$key['services'],$is_end);//利息 用户金额 服务费率 是否最后一次
			$send_count = $send_count - (-$send[2]);
		}
		return $send_count;
		
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
	
	


	
	

	
	


	

}