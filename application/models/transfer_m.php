<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Transfer_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
		$this->load->model('welcome_m');
		$this->load->model('sina_m');
		$this->load->model('order_m');
		$now = time();
		$this->start_time = strtotime('-2 months',$now);//持有时间 -2 months
		$this->fuxi_time =  strtotime('+6 day',$now);//距离下次付息时间6天前
    }
	
	//获取用户债券可转让列表
	function user_transfer_list($per_page,$page=0,$uid = false)
	{
		$now = time();
		$this->db->start_cache();
		$this->db->select('user_products.*,bulk_standard.starttime,bulk_standard.next_interest,bulk_standard.endtitme');
		$this->db->from('user_products');
		$this->db->join('bulk_standard','user_products.projectid = bulk_standard.id');
		$this->db->where('user_products.static',2); //购买成功
		$this->db->where('user_products.prostatic',1);	//持有状态
		$this->db->where('user_products.type',1);	//原始投资
		$this->db->where('transfer',1);//未发布转让
		//$this->db->where('bulk_standard.starttime <',$this->start_time); //持有超过2个月
		$this->db->where('bulk_standard.send_num >=',2); //付息超过2次
		$this->db->where('bulk_standard.next_interest >',$this->fuxi_time); //距离下个月发利息时间6天前
		$this->db->where('user_products.uid',$uid);
		$this->db->stop_cache();
		$count = $this->db->count_all_results();
		$this->db->order_by('user_products.id','desc');
		$result = $this->db->limit($per_page,$page)->get()->result_array();
		$this->db->flush_cache();
		return array($count,$result);
	}
	//获取用户债券转让记录
	function user_transfer_history($per_page,$page = 0,$uid = false)
	{
		$this->db->start_cache();
		$this->db->where('user_id',$uid);
		$this->db->stop_cache();
		$count = $this->db->count_all_results('user_transfer');
		$this->db->order_by('cretattime','desc');
		$result = $this->db->get('user_transfer',$per_page,$page)->result_array();
		$this->db->flush_cache();
		return array($count,$result);
	}
	
	
	
	//债券转让按钮交易  写入user_transfer  monkey 输入的金额
	function transfer()
	{
		$this->db->trans_begin();
		$monkey = trim($this->input->post('monkey',true));
		$product_id = trim($this->input->post('projectid',true));
		$userinfo = userinfo();
		$uid = $userinfo['id'];
		$this->load->library('form_validation');
		if(!$this->form_validation->is_natural_no_zero($monkey))
		{
			return "您输入的金额不是整数";
		}
		//锁住此行
		$this->db->query('select * from user_products where id='.$product_id.' for update');
		
		$now = time();
		$this->db->select('user_products.*,bulk_standard.starttime,bulk_standard.next_interest');
		$this->db->from('user_products');
		$this->db->where('transfer',1);//未发布转让
		$this->db->join('bulk_standard','user_products.projectid = bulk_standard.id');	
		$this->db->where('user_products.id',$product_id);
		$this->db->where('user_products.uid',$uid);
		$this->db->where('user_products.static',2); //购买成功
		$this->db->where('user_products.prostatic',1);	//持有状态
		$this->db->where('user_products.type',1);	//原始投资
		//$this->db->where('bulk_standard.starttime <',$this->start_time); //持有超过2个月
		$this->db->where('bulk_standard.send_num >=',2); //付息超过2次
		$this->db->where('bulk_standard.next_interest >',$this->fuxi_time); //距离下个月发利息时间5天前
		$query = $this->db->limit(1)->get();
		if($query->num_rows() <=0)
		{
			$this->db->trans_rollback();
			return "您持有的本产品未达到转让条件";	
		}
		else
		{
			$row = $query->row_array();
			$min_monkey = $row['monkey'] * 0.8;
			$max_monkey = $row['monkey'];
			if($monkey < $min_monkey || $monkey > $max_monkey)
			{
				$this->db->trans_rollback();
				return "折让区间必须为0-20%";	
			}
			else
			{
				
				
				$array = array(
					'user_id' => $uid,//用户ID
					'projectid' => $product_id,//用户持有产品ID
					'static' => 1, //已经发布
					'cretattime' => time(),//债券转让发布时间 更改varchar
					'monkey' => $monkey,//转让金额
					'pro_id'=> $row['projectid'],
					'holding'=> $row['monkey'],
					'rate'=> $row['rate']
				);
				$this->db->set($array);
				$this->db->insert('user_transfer');  //添加债券转让列表
				
				//标记user_products 为转让发布
				$this->db->where('id',$row['id']);
				$this->db->set('transfer',2);
				$this->db->update('user_products');
				
				if ($this->db->trans_status() === FALSE)
				{
				 	$this->db->trans_rollback();
					return "提交失败,请稍后在试";
				}
				else
				{
					 $this->db->trans_commit();
					 return "success";	
				}
				
			}
		}
	}
	
	//用户撤销债券转让
	function del_transfer($userinfo,$id = false)
	{
		$uid = $userinfo['id'];
		$this->db->where('id',$id);
		$query = $this->db->get('user_transfer',1,0);
		if($query->num_rows() <=0)
		{
			return array(1,"无此数据");	
		}	
		$row = $query->row_array();
		if($row['user_id'] != $uid)
		{
			return array(1,"您无权限操作它人的数据");
		}
		if($row['static'] !=1 and $row['static'] !=2)
		{
			return array(1,"当前状态不可撤销");
		}
		$this->db->trans_begin();
		//把状态变味撤销原因 用户撤销
		$this->db->where('id',$id);
		$this->db->set('static',4);
		$this->db->set('reasons',"用户撤销");
		$this->db->set('revoketime',date('Y-m-d H:i:s'));//撤销时间
		$this->db->update('user_transfer');
		
		$this->db->set('transfer',1);//变为未发布转让
		$this->db->where('id',$row['projectid']);
		$this->db->update('user_products');
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return array(0,"失败");
		}
		else
		{
			$this->db->trans_commit();	
			return array(0,"成功");
		}
	}
	//债券装让预审核
	function check_transfer($id = false)
	{
		$userinfo = userinfo();	
		$this->db->trans_begin();
		$transfer = $this->db->query('select * from user_transfer where id ='.$id." for update")->row_array();
		if($transfer['static'] != 2) //不是已审核状态
		{
			$this->db->trans_rollback();
			return array(1,'当前状态不允许购买');	
		}
		$this->order_m->same_monkey($userinfo['id']); //同步余额
		if($userinfo['balance'] < $transfer['monkey']) 
		{
			$this->db->trans_rollback();
			return array(1,'余额不足,请充值');
		}
		if($userinfo['id'] == $transfer['user_id'])
		{
			//自己的不能转让自己
			$this->db->trans_rollback();
			return array(1,'自己不能购买自己的债券');	
		}
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return array(1,'系统繁忙');
		}
		else
		{
			$this->db->trans_commit();
			return array(0,'');			
		}
	}
	
	//债券转让用户购买交易
	function trade_transfer($id)
	{
		$userinfo = userinfo();
		$this->db->trans_begin();
		$transfer = $this->db->query('select * from user_transfer where id ='.$id." for update")->row_array();
		if($transfer['static'] != 2) //不是已审核状态
		{
			$this->db->trans_rollback();
			return array(1,'当前状态不允许购买');	
		}
		$this->order_m->same_monkey($userinfo['id']); //同步余额
		if($userinfo['balance'] < $transfer['monkey']) 
		{
			$this->db->trans_rollback();
			return array(1,'余额不足,请充值');
		}
		if($userinfo['id'] == $transfer['user_id'])
		{
			//自己的不能转让自己
			$this->db->trans_rollback();
			return array(1,'自己不能购买自己的债券');	
		}
		$create_buy_order = $this->order_m->create_order(9,$userinfo['id'],$transfer['monkey'],false,$transfer['pro_id'],false,false,false,false,$transfer['id']);  //创建购买待收订单
		//$create_sell_order = $this->order_m->create_order(9,$transfer['user_id'],$transfer['monkey'],false,false,false,false,false,false,$transfer['id']); //创建购买代付订单

		if(!$create_buy_order)
		{
			
			$this->db->trans_rollback();	
			return array(1,'生成订单失败,请稍后再试');
		}
		//更新user_transfer 
		$this->db->set('sendeetime',date('Y-m-d H:i:s')); //转让时间
		$this->db->set('sendee',$userinfo['id']);//转让接收人
		$this->db->set('static',3); //已经转让
		$this->db->where('id',$id);
		$this->db->update('user_transfer');
		if ($this->db->trans_status() === FALSE)
		{
			
			$this->db->trans_rollback();
			return array(1,'系统繁忙请稍后再试');
			
		}
		else
		{
			$sina_buy = $this->sina_m->buy_transfer($create_buy_order,$transfer['pro_id'],$userinfo['id'],$transfer['monkey']);//新浪代收
			if($sina_buy[0] == 0)
			{
				$this->db->trans_commit();	
				return array(0,"购买成功");
			}
			else
			{
				$this->db->trans_rollback();
				return array(1,'系统繁忙请稍后再试');	
			}
			//
			
		}
	}
	
	
	
	//执行已经失效的债券转让
	function task_transfer_list()
	{
		$time = time();
		$this->load->helper('front');
		$this->db->where('examine <',strtotime('-3 day',$time)); //审核时间小于当前时间减3天
		$this->db->where('static',2);
		$query = $this->db->get('user_transfer',1,0);
		if($query->num_rows() > 0)
		{
			foreach($query->result_array() as $key)
			{
				//更新user_products
				$this->db->trans_begin();
				$this->db->query('select * from user_transfer where id = '.$key['id'].' for update');
				$this->db->set('transfer',1);//未转让债券状态
				$this->db->set('type',1);//原始投资
				$this->db->where('id',$key['projectid']);
				$this->db->update('user_products');
				//更新user_transfer
				$this->db->set('static',4);//撤销状态
				$this->db->set('revoketime',date('Y-m-d H:i:s'));//撤销时间
				$this->db->set('reasons',"系统自动撤销");//撤销原因
				$this->db->where('id',$key['id']);
				$this->db->update('user_transfer');
				if ($this->db->trans_status() === FALSE)
				{
					
					$this->db->trans_rollback();
					sys_log("系统自动撤销债券转让失败,债券ID为".$key['id']."用户项目ID为".$key['projectid']);
				}
				else
				{
					$this->db->trans_commit();	
				}	
			}
		}
	}
	
	//前台获取债券列表
	function front_transfer_list($per_page = 0,$page=0)
	{
		$this->db->start_cache();
		$this->db->where('static !=',1);//不是已发布
		$this->db->where('static !=',4);//不是撤销
		$this->db->stop_cache();	
		$count = $this->db->count_all_results('transfer_list');
		
		$result = $this->db->get('transfer_list',$per_page,$page)->result_array();
		$this->db->flush_cache();
		return array($count,$result);
	}
	//债券转让内页
	function transfer_info($id = false)
	{
		$this->db->where('static !=',1);//不是已发布
		$this->db->where('static !=',4);//不是撤销
		$this->db->where('id',$id);
		$result = $this->db->get('transfer_list',1,0)->row_array();
		if(count($result) <=0 )
		{
			return false;	
		}
		$this->db->where('id',$result['pro_id']);
		$bulk_info = $this->db->get('bulk_standard',1,0)->row_array();
		//获取用户pro
		$this->db->where('id',$result['projectid']);
		$pro_info = $this->db->get('user_products',1,0)->row_array();
		return array($result,$bulk_info,$pro_info);
	}
}