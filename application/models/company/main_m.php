<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
		$this->load->model('company/sina_m');
		$this->load->model('order_m');
    }
	
	function show_company_info()
	{
		$uid = $this->session->userdata('com_id');
		$this->db->where('id',$uid);
		return $this->db->get('company_user',1,0)->row_array();
	}
	//查询是否设置交易密码 //并保存到本地
	function check_trading()
	{
		$check = $this->sina_m->query_is_set_pay_password($this->session->userdata('com_id'));	
		if(!$check)
		{
			return false;	
		}
		else
		{
			$this->db->set('trading',1);
			$this->db->where('id',$this->session->userdata('com_id'));
			$this->db->update('user');
			return true;	
		}
	}
	
	
	//跳转到设置交易密码
	function set_trading()
	{
		$this->sina_m->set_pay_password($this->session->userdata('com_id'));	
	}
	
	
	//操作记录
	function record($type = 0,$per_page = 20,$page = 0)
	{
		$userinfo = companyinfo();	
		
		$this->db->start_cache();
		//类型 1投资人充值 2投资人购买标的待收交易 3 代付到借款人审标 4借款人还款待收 5投资人利息代付 6 邦卡请求 7提现请求 8审核企业资质
		switch($type)
		{
			case 1://充值
				$this->db->where('type',1);
			break;
			case 3://产品购买
				$this->db->where('type',2);
			break;
			case 4://利息发放
				$this->db->where('type',4);
			break;
			case 7://提现
				$this->db->where('type',7);
			default:
			//全部
				$this->db->where_in('type',array(1,3,4,7));
			break;	
		}
		$this->db->where('uid',$userinfo['id']);
		$this->db->stop_cache();
		$count = $this->db->count_all_results('fr_order');
		$this->db->order_by('dateline','desc');
		$this->db->limit($per_page,$page);
		$result = $this->db->get('fr_order')->result_array();
		$this->db->flush_cache();
		return array($count,$result);
	}
	
	//查询余额
	function query_balance()
	{
		return $this->sina_m->query_balance($this->session->userdata('com_id'));	
	}
	
	function recharge()
	{
		$userinfo = companyinfo();
		$monkey = $this->input->post('monkey');
		$bank_code = "SINAPAY";
		//网银在线充值
		$pay_con = "online_bank^".$monkey."^".$bank_code.",DEBIT,B";	
		$send_pay = array('online_bank',$pay_con);
		 //$this->order_m->create_order(7,$userinfo['id'],$monkey,false,false,false,false,2.00);
		$create_order = $this->order_m->create_order(1,$userinfo['id'],$monkey,1,false,false,false,10);
		if($create_order)
		{
			$this->sina_m->create_hosting_deposit($create_order,$send_pay,$monkey);
		}
		else
		{
			return false;	
		}	
	}
	
	//查询绑定银行卡
	function get_card_id()
	{
		$return = $this->sina_m->query_bank_card();	
		if($return[0] == 0)
		{
			$card_list = $return[1]['card_list'];
			$explode = explode("^",$card_list);
			return $explode[0];
		}
		else
		{
			return false;	
		}
	}
	
	//提现
	function withdraw()
	{
		//$card_id = $this->get_card_id();
		$query_balance = $this->query_balance();
		$userinfo = companyinfo();

		//if($card_id && $query_balance[0] == 0)
		//{
			$monkey = $this->input->post('monkey');
			$balance = $query_balance[1]['available_balance'];// 企业余额
			if($monkey*0.00003 > 0.01){
				$shouxufei = round($monkey*0.00003,2);
			}else{
				$shouxufei = 0.01;
			}	
			
			if($monkey > $balance)
			{
				return array(1,'提现可用余额不足');
			}
			else
			{
				if($monkey-(-2) > $balance) 
				{
					return array(1,"提现金额加手续费低于账户余额");	
				}	
				$create_order = $this->order_m->create_order(7,$userinfo['id'],$monkey,false,false,false,false,$shouxufei);	
				
				if($create_order)
				{
					$return = $this->sina_m->create_hosting_withdraw($create_order,$userinfo['id'],$monkey,$shouxufei);
				
					if($return[0] == 0)
					{
						return array(0,$return[1]);
					}
					else
					{
						$this->order_m->order_failed($create_order);
						return array(1,$return[1]);	
					}
				}
				else
				{
					return array(1,'生成订单失败，请稍后在试');		
				}
			}
		//}
		//else
		//{
		//	return array('1',"获取银行卡或余额信息失败，请稍后在试");	
		//}	
	}
	
	function form_repayment($id = false)
	{
		$uid = $this->session->userdata('com_id');
		/*$query_balance = $this->query_balance();
		if($query_balance[0] != 0)
		{
			return array(1,"获取余额失败，请稍后再试");	
		}*/
		
		
		//$balance = $query_balance[1]['available_balance'];
		$this->db->where('id',$id);
		$this->db->where('company',$uid);	
		$query = $this->db->get('bulk_standard',1,0);
		
		if($query->num_rows() > 0) //项目存在
		{
			//获取是否有处理中的订单
			$check['uid'] = $uid;
			$check['type']  = 4;
			$check['productid'] = $id;
			if(!$this->order_m->order_status($check))
			{
				return array(1,"有处理中的订单");
			}
			
			$row = $query->row_array();
			if($row['static'] == 2 && ($row['repayment_num'] < $row['day']))
			{
				$interest = $this->interest($row['rate'],$row['money'],$row['services'],$row['repayment_num'],$row['day']);
				
				//($type = false,$uid = false,$monkey = false,$rechargetype = 1,$productid = false)
				$cretea = $this->order_m->create_order(4,$uid,$interest,false,$row['id']);
				if($cretea)
				{
					$return = $this->sina_m->pay_repayment($cretea,$row['id'],$uid,$interest);
					if($return[0] == 0)
					{
						return array(0,$return[1]);
					}
					else
					{
						$this->order_m->order_failed($cretea,$return[1]);
						return array(1,$return[1]);
					}
				}
				else
				{
					return array(1,"创建订单失败");		
				}
			}
			else
			{
				return array(1,"项目状态不允许还款");	
			}
		}
		else
		{
			return array(1,"项目不存在");	
		}
	}
	
	//计算还款利息 rate 收益率 monkey 项目总额 services 服务费率 num 还款期数
	function interest($rate= false,$monkey = false,$services = false,$num = false,$day = false)
	{
		//利率等于利率加服务利率
		$rate = $rate-(-$services);
		$year_rate = $rate * $monkey;//总利息
		$day_rate = number_format($year_rate/12,2,'.','');//计算每月的利息
		if($num-(-1) == $day)
		{
			//最后一期
			$return_monkey = $monkey - (-$day_rate);
		} 	
		else
		{
			$return_monkey = $day_rate;		
		}
		
		return number_format($return_monkey,2,'.','');	
	}
}