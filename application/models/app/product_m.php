<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
		$this->load->model('app/appsina_m');
		$this->load->model('order_m');
		$this->load->model('app/usercenter_m');
		$this->load->helper('front');
    }
	
	
	//新逻辑购买项目代收
	function new_bulk_buy($productid = false,$num = false,$type = 1)
	{
		$userinfo = userinfo();
		if($type == 2){
			
		}else{
			$type = 1;
		}
		
		if(!is_int($num) || $num <= 0)
		{
			return array('code'=>2,'msg'=>'请输入正确的份数');	
		}	
		$this->db->trans_begin(); 
		//事物开始
		$sql = "select * from bulk_standard where id=".$productid." limit 1 for update";
		$query = $this->db->query($sql);
		
		
		if($query->num_rows() <=0)
		{
			$this->db->trans_commit();
			return array('code'=>2,'msg'=>'项目不存在');	
		}
		$row = $query->row_array();
		$userinfo = userinfo();
		if($row['yuyue'] == 2)
		{
			//预告
			$checkyuyue = explode("|",$row['yuyueuid']);
			if(!in_array($userinfo['id'],$checkyuyue))
			{
				$this->db->trans_commit();
				return array('code'=>2,'msg'=>'您不是此项目的预约人');	
			} 
		}
		if($row['is_open'] != 1 and $row['creattime'] > date('Y-m-d H:i:s'))
		{
			//不预告 当前时间小于创建时间
			$this->db->trans_commit();
			return array('code'=>2,'msg'=>'项目不存在');	
		}
		if($row['is_open'] ==1 and $row['creattime'] > date('Y-m-d H:i:s'))
		{
			$this->db->trans_commit();
			return array('code'=>2,'msg'=>'项目未开始');	
		}
		if($row['static'] >=2)
		{
			$this->db->trans_commit();
			return array('code'=>2,'msg'=>'项目已开始或已结束不能进行购买');		
		}
		$restmoney = $row['restmoney']; //剩余金额
		$amount = $row['amount'];//起投份数
		$each = $row['each'];//每份金额
		if($num < $amount)
		{
			$this->db->trans_commit();
			return array('code'=>2,'msg'=>'不能低于最小起投份数');
		}
		
		if( ($num * $each) > $userinfo['balance'])
		{
			$this->db->trans_commit();
			return array('code'=>2,'msg'=>'您的余额不足');
		}		
		
		if( ($num * $each) > $restmoney)
		{
			$this->db->trans_commit();
			return array('code'=>2,'msg'=>'您所购买的份数不够了');
		}
		$user_monkey = $num * $row['each'];
		//判断用户是否3次购买失败此项目
		$this->db->where('uid',$userinfo['id']);
		$this->db->where('productid',$productid);
		$this->db->where('type',2);
		$this->db->where('static',1);
		$count = $this->db->count_all_results('fr_order');
		if($count >= 3) //大于3次
		{
			$this->db->trans_rollback();
			return array('code'=>2,'msg'=>'此项目您3次未付款,已禁止购买！');
		}
		
		
		//通过购买验证了 减少金额
		$this->db->set('restmoney','restmoney-'.$user_monkey.'',false);
		$this->db->where('id',$productid);
		$this->db->update('bulk_standard');
		//创建大订单
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return array('code'=>2,'msg'=>'系统繁忙,请稍后再试');
				
		}
		else
		{
			$order_id = $this->order_m->create_order(2,$userinfo['id'],$user_monkey,false,$productid);
			$sina_return = $this->sina_m->create_hosting_collect_trade($order_id,$productid,$userinfo['id'],$user_monkey,$type);
			 if($sina_return[0] == 0)
			 {
				$this->db->trans_commit(); 
				$this->db->set('content',$sina_return[1]);
				$this->db->set('time',time());
				$this->db->insert('sina_return_log');
				return array('code'=>1,'msg'=>$sina_return[1]); 
			 }
			 else
			 {
				 $this->db->trans_rollback();
				 return array('code'=>2,'msg'=>$sina_return[1]);	 
			 }
		}
		
	}
	
	function app_new_bulk_buy($productid = false,$num = false,$uid)
	{   
 		$type = 1;
		// var_dump($uid);
	     $userinfo = $this->usercenter_m->check_userinfo($uid);
	     // var_dump($userinfo['balance']);
	     if($type == 2){
			
		}else{
			$type = 1;
		}
		
		if(!is_int($num) || $num <= 0)
		{
			return array('code'=>2,'msg'=>'请输入正确的份数');	
		}	
		$this->db->trans_begin(); 
		//事物开始
		$sql = "select * from bulk_standard where id=".$productid." limit 1 for update";
		$query = $this->db->query($sql);
		
		
		if($query->num_rows() <=0)
		{
			$this->db->trans_commit();
			return array('code'=>2,'msg'=>'项目不存在');	
		}
		$row = $query->row_array();
		if($row['yuyue'] == 2)
		{
			//预告
			$checkyuyue = explode("|",$row['yuyueuid']);
			if(!in_array($userinfo['id'],$checkyuyue))
			{
				$this->db->trans_commit();
				return array('code'=>2,'msg'=>'您不是此项目的预约人');	
			} 
		}
		if($row['is_open'] != 1 and $row['creattime'] > date('Y-m-d H:i:s'))
		{
			//不预告 当前时间小于创建时间
			$this->db->trans_commit();
			return array('code'=>2,'msg'=>'项目不存在');	
		}
		if($row['is_open'] ==1 and $row['creattime'] > date('Y-m-d H:i:s'))
		{
			$this->db->trans_commit();
			return array('code'=>2,'msg'=>'项目未开始');	
		}
		if($row['static'] >=2)
		{
			$this->db->trans_commit();
			return array('code'=>2,'msg'=>'项目已开始或已结束不能进行购买');		
		}
		$restmoney = $row['restmoney']; //剩余金额
		$amount = $row['amount'];//起投份数
		$each = $row['each'];//每份金额
		if($num < $amount)
		{
			$this->db->trans_commit();
			return array('code'=>2,'msg'=>'不能低于最小起投份数');
		}
		$balance = $userinfo['balance'];
		if( ($num * $each) > $balance)
		{
			$this->db->trans_commit();
			return array('code'=>2,'msg'=>'您的余额不足');
		}		
		
		if( ($num * $each) > $restmoney)
		{
			$this->db->trans_commit();
			return array('code'=>2,'msg'=>'您所购买的份数不够了');
		}
		$user_monkey = $num * $row['each'];
		//判断用户是否3次购买失败此项目
		$this->db->where('uid',$userinfo['id']);
		$this->db->where('productid',$productid);
		$this->db->where('type',2);
		$this->db->where('static',1);
		$count = $this->db->count_all_results('fr_order');
		if($count >= 3) //大于3次
		{
			$this->db->trans_rollback();
			return array('code'=>2,'msg'=>'此项目您3次未付款,已禁止购买！');
		}
		
		
		//通过购买验证了 减少金额
		$this->db->set('restmoney','restmoney-'.$user_monkey.'',false);
		$this->db->where('id',$productid);
		$this->db->update('bulk_standard');
		//创建大订单
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return array('code'=>2,'msg'=>'系统繁忙,请稍后再试');
				
		}
		else
		{
			$order_id = $this->order_m->create_order(2,$userinfo['id'],$user_monkey,false,$productid);
			$sina_return = $this->appsina_m->create_hosting_collect_trade($order_id,$productid,$userinfo['id'],$user_monkey,$type);
			 if($sina_return[0] == 0)
			 {
				$this->db->trans_commit(); 
				$this->db->set('content',$sina_return[1]);
				$this->db->set('time',time());
				$this->db->insert('sina_return_log');
				return $sina_return[1]; 
			 }
			 else
			 {
				 $this->db->trans_rollback();
				 return $sina_return[1];	 
			 }
		}
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
	}
	
	//使用红包 
	function red_paper($id)
	{
		$userinfo = userinfo();
		//获取用户红包
		$this->db->where('user_id',$userinfo['id']);
		$this->db->where('id',$id);
		$this->db->where('static',1);//未使用的红包
		$query = $this->db->get('user_paper');
		if($query->num_rows() <=0)
		{
			return false;
		}
		else
		{
			$row = $query->row_array();
			$this->db->where('id',$row['paperid']);	
			$query = $this->db->get('red_paper',1,0);
			return $query->row_array();
		}
	}
	function get_red_paper($id,$num)
	{
		//获取散标信息
		$this->db->where('id',$id);
		$this->db->where('is_open',1);//是否开通
		$query = $this->db->get('bulk_standard',1,0);
		$row = $query->row_array();	
		
		
		//计算用户购买金额
		$userinfo = userinfo();
		$count = $row['each']*$num;
		$this->db->select('red_paper.title,red_paper.monkey,user_paper.id');
		$this->db->from('user_paper');
		$this->db->join('red_paper','user_paper.paperid = red_paper.id');	
		$this->db->where('user_paper.user_id',$userinfo['id']);
		$this->db->where('red_paper.min_monkey <=',$count);
		$this->db->where('user_paper.static',1);//未使用
		$query = $this->db->get();
		if($query->num_rows() <=0)
		{
			return false;
		}
		else
		{
			return $query->result_array();	
		}
	}
	
	//散标列表 
	function bulk_standard_list($per_page = 10,$page = 0,$condition = '')
	{		
		$this->db->start_cache();

		
		$this->db->where('((is_open = 1) or (creattime < "'.date('Y-m-d H:i:s').'")) and yuyue = 1'); //是否预告 1为预告2为不预告
		if(isset($condition['cycle']) && $condition['cycle'] != 0){
				
			if($condition['cycle'] == 1){
				$this->db->where('day < 3');
			}elseif($condition['cycle'] == 2){
				$this->db->where('(day > 3 OR day = 3) AND (day < 6 OR day = 6)');
			}else{
				$this->db->where('day > 6');
			}
		}
		if(isset($condition['rate']) && $condition['rate'] != 0){
			if($condition['rate'] == 1){
				$this->db->where('rate < 0.12');
			}elseif($condition['rate'] == 2){
				$this->db->where('(rate > 0.12 OR rate = 0.12) AND (rate < 0.14 OR rate = 0.14 )');
			}else{
				$this->db->where('rate > 0.14');
			}				
		}
		if(isset($condition['total']) && $condition['total'] != 0){
			if($condition['total'] == 1){
				$this->db->where('money <= 100000');
			}elseif($condition['total'] == 2){
				$this->db->where('money > 100000 AND money <= 300000');
			}elseif($condition['total'] == 3){
				$this->db->where('money > 300000 AND money <= 500000');
			}else{
				$this->db->where('money > 500000');
			}			
		}			
		
		
		$this->db->from('bulk_standard');
		$this->db->join('repay_way','repay_way.id = bulk_standard.repayment');
		$this->db->stop_cache();
		$count = $this->db->count_all_results();
		$this->db->select('bulk_standard.*,repay_way.repay as repay');
		$this->db->where('bulk_standard.is_open != 3');
		$this->db->where('bulk_standard.static != 4');
		$this->db->order_by('bulk_standard.restmoney','desc');
		$this->db->order_by('bulk_standard.creattime','desc');
		$result = $this->db->limit($per_page,$page)->get()->result_array();
		
		$this->db->flush_cache();
		//echo $this->db->last_query();
		return array($count,$result);	
		
	}
	//散标内容页
	function bulk_standard($id = false)
	{
		$this->db->select('bulk_standard.*,repay_way.repay as repay');
		$this->db->from('bulk_standard');
		$this->db->join('repay_way','repay_way.id = bulk_standard.repayment');
		$this->db->limit(1,0);
		$this->db->where('bulk_standard.id',$id);
		$query = $this->db->get();	
		if($query->num_rows() <=0)
		{
			return false;
		}	
		else
		{
			$row = $query->row_array();
			if($this->session->userdata('alogin') && $this->session->userdata('auid'))
			{
				return $query->row_array();	
			}
			if($row['is_open'] != 1 and $row['creattime'] > date('Y-m-d H:i:s'))
			{
				//不预告 当前时间小于创建时间
				return false;
			}
			else
			{
				$userinfo = userinfo();
				
				if($row['yuyue'] == 2)
				{
					if(!$userinfo)
					{
						return false;	
					}
					//预告
					$checkyuyue = explode("|",$row['yuyueuid']);
					if(!in_array($userinfo['id'],$checkyuyue))
					{
						return false;	
					} 
				}
				return $query->row_array();
			}
			
		}
	}
	//获取用户投资记录 
	function user_bulk($id = false)
	{
		$this->db->select('user.nickname,user_products.*');	
		$this->db->from('user_products');
		$this->db->join('user','user.id = user_products.uid');
		$this->db->where('user_products.projectid',$id);
		$this->db->where('user_products.type',1);//原始投资
		$this->db->where('(user_products.static = 2 or user_products.static = 4)');
		$this->db->order_by('user_products.dateline','desc');
		return $this->db->get()->result_array();
	}
	
	//自动撤销债券转让
	function revoke_transfer()
	{
		//2天未审核撤销
		$this->db->where('static',1);
		$this->db->where('examine','');
		$this->db->where('cretattime <',date('Y-m-d H:i:s',strtotime('-2 day',time())));
		$result = $this->db->get('user_transfer')->result_array();
		foreach($result as $key)
		{
			$this->db->set('static',3);
			$this->db->where('id',$key['id']);
			$this->db->set('revoketime',date('Y-m-d H:i:s'));
			$this->db->set('reasons','2天未审核');
			$this->db->update('user_transfer');
			$this->db->set('transfer','');
			$this->db->where('id',$key['projectid']);
			$this->db->update('user_project');
		}
		
		//3天未购买撤销
		$this->db->where('static',1);
		$this->db->where('examine !=','');
		$this->db->where('examine <',strtotime('-3 day',time()));
		$result = $this->db->get('user_transfer')->result_array();
		foreach($result as $key)
		{
			$this->db->set('static',3);
			$this->db->where('id',$key['id']);
			$this->db->set('revoketime',date('Y-m-d H:i:s'));
			$this->db->set('reasons','3天未转让成功');
			$this->db->update('user_transfer');
			$this->db->set('transfer','');
			$this->db->where('id',$key['projectid']);
			$this->db->update('user_project');
		}
	}
	//债券转让列表
	function transfer_list($per_page = 10,$page = 0)
	{
		$this->db->start_cache();
		$this->db->where('user_transfer.static !=',3); //不是已撤销状态
		$this->db->where('user_transfer.examine !=','');//审核过才显示
		$this->db->from('user_transfer');
		$this->db->join('user_project','user_project.id = user_transfer.projectid');
		$this->db->join('bulk_standard','user_project.project_id = bulk_standard.id');
		$this->db->join('repay_way','repay_way.id = bulk_standard.repayment');
		$this->db->order_by('user_transfer.examine','desc');
		$this->db->limit($per_page,$page);
		$this->db->stop_cache();
		$count = $this->db->count_all_results();
		$this->db->select('bulk_standard.*,repay_way.repay as repay,user_project.interest as yjsy,user_project.volume as ysjg,user_transfer.monkey as zrjg,user_transfer.static as zhuangtai,user_transfer.id as transferdid');
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return array($count,$result);		
	}
	//债券转让详细
	function transfer_info($id = false)
	{
		$this->db->where('user_transfer.static !=',3); //不是已撤销状态
		$this->db->where('user_transfer.examine !=','');//审核过才显示
		$this->db->where('user_transfer.id',$id);
		$this->db->from('user_transfer');
		$this->db->join('user_project','user_project.id = user_transfer.projectid');
		$this->db->join('bulk_standard','user_project.project_id = bulk_standard.id');
		$this->db->join('repay_way','repay_way.id = bulk_standard.repayment');
		$this->db->order_by('user_transfer.examine','desc');
		$this->db->limit(1,0);
		$this->db->select('bulk_standard.*,repay_way.repay as repay,user_project.interest as yjsy,user_project.volume as ysjg,user_transfer.monkey as zrjg,user_transfer.static as zhuangtai,user_transfer.id as transferdid,user_transfer.examine as jssj');
		$result = $this->db->get();
		if($result->num_rows()<=0)
		{
			return false;	
		}
		return $result->row_array();		
	}
	
	//检查债券转让
	function check_transfer($id = false)
	{
		$userinfo = userinfo();
		$this->db->where('id',$id);
		$query = $this->db->get('user_transfer',1,0);
		if($query->num_rows() <=0)
		{
			return "此项目不存在";	
		}
		$row = $query->row_array();
		if($row['static'] > 1)
		{
			return "此项目已经交易成功或者已撤销";
		}
		if($row['examine'] == "")
		{
			return "此项目未经过审核";	
		}
		if($row['examine'] < strtotime('-3 day',time()))
		{
			return "此项目已过期";	
		}
		if($userinfo['balance']  < $row['monkey'])
		{
			return "余额不足";	
		}
		if($userinfo['id'] == $row['user_id'])
		{
			return "自己不能购买自己发的债券转让";	
		}
		return "success";
	}
	
	//购买债券
	function buy_transfer($id)
	{
		
		//事物开始
		$this->db->trans_begin();
		$userinfo = userinfo();
		$check = $this->check_transfer($id);
		if($check != "success")
		{
			$this->db->trans_rollback();
			return $check;
		}
		$this->db->where('id',$id);
		$query = $this->db->get('user_transfer',1,0);
		$row = $query->row_array(); //债券转让详细信息
		$this->db->where('id',$row['projectid']);
		$query = $this->db->get('user_project',1,0);
		$user_project = $query->row_array();
		
		//债券转让人的金额增加 冻结减少 金额增加转让价格  冻结减少项目金额 
		$this->db->set('balance','balance+'.$row['monkey'].'',false);
		$this->db->set('frozen','frozen-'.$user_project['volume'].'',false);
		$this->db->where('id',$row['user_id']);
		$this->db->update('user');
		//接收债券人 金额减少转让价格 冻结增加项目金额
		$this->db->set('balance','balance-'.$row['monkey'].'',false);
		$this->db->set('frozen','frozen+'.$user_project['volume'].'',false);
		$this->db->where('id',$userinfo['id']);
		$this->db->update('user');
		//更改债券状态
		$this->db->set('static',2);
		$this->db->set('sendee',$userinfo['id']);//接收人uid
		$this->db->set('sendeetime',date('Y-m-d H:i:s')); //转让成功时间
		$this->db->where('id',$id);
		$this->db->update('user_transfer');
		//更新用户项目持有人 
		$this->db->set('user_id',$userinfo['id']);
		$this->db->set('transfer','');//设置转让关联为空
		$this->db->where('id',$user_project['id']);
		$this->db->update('user_project');
		//债券转让人帐号记录
		$this->db->set('type',3);
		$this->db->set('monkey',$row['monkey']);
		$this->db->set('dateline',date('Y-m-d H:i:s'));
		$this->db->set('static',1);
		$this->db->set('remarks','债券成功转让');
		$this->db->set('user_id',$row['user_id']);
		$this->db->insert('user_account_history');
		//接收人帐号记录
		$this->db->set('type',3);
		$this->db->set('monkey',$user_project['volume']);
		$this->db->set('dateline',date('Y-m-d H:i:s'));
		$this->db->set('static',1);
		$this->db->set('remarks','购买债券成功');
		$this->db->set('user_id',$userinfo['id']);
		$this->db->insert('user_account_history');
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return "系统繁忙，稍后再试验";
		}
		else
		{
			$this->db->trans_commit();
			return "success";
		}
			
	}
	
				//计算待收利息
			//$interest = $this->interest($row['rate'],$row['day'],$user_monkey);
			//计算下次发放利息时间
			//$endtime = strtotime('+'.$row['day'].' months',time()); //项目结束日期
			//$tmp_time = strtotime('+1 months',time()); //预算下次发利息时间
			//if($tmp_time >= $endtime)
			//{
				//下次发利息时间大于项目结束时间
				//$next_interest = $endtime;
			//}
			//else
			//{
				//$next_interest = $tmp_time;	
			//}
			//是否使用红包
/*			if($red_paper !=0)
			{
				//使用了红包  扣除余额 应减少
				$red_paper1 = $this->red_paper($red_paper);
				if(!$red_paper1)
				{
					$this->db->trans_rollback();
					return "红包不存在";
				}	
				else
				{
					if($red_paper1['min_monkey'] > $user_monkey)	
					{
						$this->db->trans_rollback();
						return "此红包未达到使用条件";
					}
					else
					{
						$yue = $user_monkey - $red_paper1['monkey'];	
					}
				}
			}
			else
			{
				//未使用红包 扣除全额
				$yue = $user_monkey;
			}*/
			
			
			
			//红包状态更改
/*			if($red_paper !=0)
			{
				$this->db->set('static',2);
				$this->db->where('id',$red_paper);
				$this->db->update('user_paper');
			}*/
}