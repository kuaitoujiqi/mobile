<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Company_m extends CI_Model {
	function __construct()
    {
        parent::__construct();
		$this->load->model('admin/sina_m');
		$this->load->model('order_m');
		//类型 1投资人充值 2投资人购买标的待收交易 3代付到借款人审标 4借款人还款待收 5投资人利息代付 6 邦卡请求 7提现请求 8 审核企业
    }
	//审核企业
	function check_company($id = false)
	{
		$this->db->where('id',$id); //查询企业
		$query = $this->db->get('company_user',1,0); 
		if($query->num_rows()<=0)
		{
			
			return "exits"; //企业不存在
		}
		else
		{
			
			$row = $query->row_array(); //企业信息
			if($row['static'] == 1 || $row['static'] == 4) //创建或审核失败的企业可以再次发起审核
			{
				
				if($this->upload_file($row['fileName']))	
				{
					
					$order_id = $this->order_m->create_order(8,$id,0);
					if($order_id)
					{
						$this->db->set('checkid',$order_id); //订单ID
						$this->db->where('id',$id);
						$this->db->update('company_user'); //更新订单ID
						$row['digest'] = $this->digest($row['fileName']);
						$check = $this->sina_m->audit_member_infos($row,$order_id); //提交新浪
						if($check[0] ==0) 
						{
							//审核中更改状态
							$this->db->where('id',$id);
							$this->db->set('static',2);  //更改为审核中
							$this->db->update('company_user'); 
							return "success";
						}
						else
						{
							return $check[1];
						}
					}
					else
					{
						
						return "本地数据创建失败";	
					}
				}
				else
				{
					
					//传输资质文件失败
					return "uploaderror";	
				}
				
			}
			else
			{
				//状态为审核中和审核通过此项目不能提交审核
				return "static";	
			}
		}
	}
	//创建企业用户
	function create_company_user()
	{
		$post = $this->input->post();
		$this->db->trans_begin();
		//添加用户到user表
		$this->db->set('nickname',$post['company_name']);
		$this->db->set('mobile',$post['telephone']);
		$this->db->set('type',2);//企业用户
		$this->db->set('password',sha1($post['telephone']));//默认密码为手机号
		$this->db->set('dateline',date('Y-m-d H:i:s'));
		$this->db->insert('user'); //用户表返回ID
		$insert_user = $this->db->insert_id();
		
		//添加企业信息到company_user表
		$post['dateline'] = date('Y-m-d H:i:s');
		$post['id'] = $insert_user;
		unset($post['submit']);
		unset($post['select_file']);
		$this->db->set($post);
		$this->db->insert('company_user');
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return array(1,"本地添加数据失败");
		}
		else
		{
			$return = $this->sina_m->create_activate_member($insert_user);
			if($return[0] == 0)
			{
				$this->db->trans_commit();	
				return array(0);
			}
			else
			{
				$this->db->trans_rollback();
				return array(1,$return[1]); //新浪创建用户失败
			}
		}	
	}
	//编辑企业
	function edit_company($id = false)
	{
		$post = $this->input->post();
		$post['dateline'] = date('Y-m-d H:i:s');
		unset($post['submit']);
		unset($post['select_file']);
		$this->db->set($post);		
		$this->db->where('id',$id);
		return $this->db->update('company_user');
		
	}
	
	
	//上传资质 /upload/file/2015/04/29/2015042904463919743.zip
	function upload_file($filename = false)
	{
		
		$explode = explode("/",$filename);
		$fileName = $explode[count($explode) - 1];
		include_once FCPATH. "key/api/weibopay.class.php";
		$weibopay = new Weibopay ();	
		return $weibopay->sftp_upload($filename,$fileName); //路径文件名
	}
	
	//文件摘要
	function digest($filename = false)
	{
		include_once FCPATH. "key/api/weibopay.class.php";
		$weibopay = new Weibopay();
		return $weibopay->md5_file(FCPATH.$filename);//文件摘要	
	}
	//查看企业审核结果
	function query_audit_result($id,$audit_order_no)
	{
		return $this->sina_m->query_audit_result($id,$audit_order_no);	
	}
}