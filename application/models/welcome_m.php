<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
		$this->load->model('sina_m');
    }
	
	//网站公告获取
	function indexnews($category = 1,$num=5)
	{
		$this->db->where('pid',$category);
		$this->db->order_by('dateline','desc');
		return $this->db->get('news',$num,0)->result_array();
	}
	//注册用户
	function regesiter()
	{
		$this->db->trans_begin(); //事物开始
		$this->db->set('nickname',$this->input->post('nickname')); //昵称用户名
		$this->db->set('mobile',$this->input->post('mobile')); //手机号
		$this->db->set('password',sha1($this->input->post('password'))); //密码
		$this->db->set('recommender',$this->input->post('recommender'));//推荐人
		
		$this->db->set('is_mobile',1); //手机验证
		$this->db->set('dateline',date('Y-m-d H:i:s')); //注册时间
		$this->db->set('type',1); //用户类型投资人 普通用户
		$this->db->set('lastlogin',time());
		$this->db->insert('user');
		$insertid = $this->db->insert_id();
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			sys_log('注册失败,数据库写入失败');
			return array('1');	
		}
		else
		{
			//增加新浪用户
			$return = $this->sina_m->create_activate_member($insertid);
			if($return[0] == 0)
			{
				$verify = $this->sina_m->binding_verify($insertid,'MOBILE',$this->input->post('mobile'));
				if($verify[0] == 0)
				{
					$this->db->trans_commit();
				}
				else
				{
					//手机号验证失败注册失败
					$this->db->trans_rollback();
					sys_log('注册失败,手机号验证码失败');
					return array('1');		
				}
			}
			else
			{
				//新浪用户注册失败 mysql回滚
				$this->db->trans_rollback();
				sys_log('注册失败,新浪返回:'.$return[1]);
				return array('1');	
			}
		}
		
		
		//查询注册是否发送红包
/*		$this->db->where('id',1);
		$query = $this->db->get('sysconfig',1,0);
		$row = $query->row_array();
		if($row['regesiter'] != "" && $row['regesiter'] != 0)
		{
			$this->load->model('public_m');
			$this->public_m->send_paper($insertid,$row['regesiter']);
		}*/
		return array(0,$insertid);
	}
	//登录检测
	function login($username,$password)
	{  	
		$where = "password = '".$password."' and (nickname = '".$username."' or mobile = '".$username."')";
		$where .= "and type = 1";//投资人用户类型
		$this->db->where($where);
		$query = $this->db->get('user',1,0);
		$ip = $this->input->ip_address();
		if($query->num_rows()<=0)
		{
			return "faield";	
		}
		else
		{   
			// $this->session->set_userdata('ip',$ip);
			$row = $query->row_array();
			$id = $row['id'];
			$sina_query = $this->sina_m->query_balance($row['id']);
			if($sina_query[0] == 0)
			{
				//新浪查询返回正确结果  同步本地余额和冻结
				$this->db->set('balance',$sina_query[1]['available_balance']); //更新本地余额 可用余额
				//$this->db->set('frozen',$sina_query[1]['balance']-$sina_query[1]['available_balance']);//更新本地冻结余额 余额减去可用余额
				$this->db->set('lastlogin',time());
				$this->db->where('id',$row['id']);
				$this->db->update('user');
			}   
			    $_SESSION['name'] = $row['nickname'];
				$_SESSION['uid'] = $row['id'];
			   $_SESSION['ip'] = $ip;
			
			return "success";
		}
	}
	//找回密码验证手机是否正确 
	function getphone($str)
	{
		$this->db->where('mobile',$str);
		$query = $this->db->get('user',1,0);
		if($query->num_rows()<=0)
		{
			return false;
		}	
		else
		{
			return true;	
		}
	}
	
	//找回密码
	function forget()
	{
		$phone = $this->input->post('mobile');
		$password = $this->input->post('password');
		$this->db->set('password',sha1($password));
		$this->db->where('mobile',$phone);
		return $this->db->update('user');	
	}
	//获取项目列表
	function bulk()
	{
		$this->db->where('is_open',1);
		$this->db->select('bulk_standard.*,repay_way.repay as repay');
		$this->db->from('bulk_standard');
		$this->db->where('bulk_standard.yuyue',1);
		$this->db->where('bulk_standard.static != 4 ');
		$this->db->join('repay_way','repay_way.id = bulk_standard.repayment');
		$this->db->order_by('bulk_standard.restmoney','desc');
		$this->db->order_by('bulk_standard.creattime','desc');
		$this->db->limit(5,0);
		return $this->db->get()->result_array();	
	}
	function bulkApp()
	{
		$this->db->where('is_open',1);
		$this->db->select('bulk_standard.id as fId,bulk_standard.title as fTitle,bulk_standard.rate as fRate,bulk_standard.day as fTime,bulk_standard.restmoney as fMoney,bulk_standard.creattime as fShang,bulk_standard.money as fTotal');
		$this->db->from('bulk_standard');
		$this->db->where('bulk_standard.yuyue',1);
		$this->db->where('bulk_standard.static != 4 ');
		$this->db->join('repay_way','repay_way.id = bulk_standard.repayment');
		$this->db->order_by('bulk_standard.restmoney','desc');
		$this->db->order_by('bulk_standard.creattime','desc');
		$this->db->limit(5,0);
		return $this->db->get()->result_array();	
	}
	function app_bulk_standard_list($per_page = 10,$page = 0,$condition = '')
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
		$this->db->select('bulk_standard.id as fID,bulk_standard.title as fTitle,bulk_standard.rate as fRate,bulk_standard.day as fTime,bulk_standard.restmoney as fMoney,bulk_standard.creattime as fShang,bulk_standard.money as fTotal');
		$this->db->where('bulk_standard.is_open != 3');
		$this->db->where('bulk_standard.static != 4');
		$this->db->order_by('bulk_standard.restmoney','desc');
		$this->db->order_by('bulk_standard.creattime','desc');
		$result = $this->db->get()->result_array();
		
		$this->db->flush_cache();
		//echo $this->db->last_query();
		return array($count,$result);	
		
	}
}