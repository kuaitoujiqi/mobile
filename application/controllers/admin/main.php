<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends Admin_Controller {
	
	function __construct()
 	{
  		parent::__construct();
		$this->load->model('admin/main_m');
		$this->load->model('admin/public_m');
 	}
	//欢迎页
	function index()
	{
		echo "helloword";
		$uid = $this->_uid();
		$this->db->where('id',$uid);
		$user = $this->db->get('admin',1,0)->row_array();
		if($user['group'] == 0)
		{
			//账户大于1000平台资金统计
			$this->db->where('balance >=',1000);	
			$this->db->where('type',1);	
			$this->db->select_sum('balance');
			$query = $this->db->get('user')->row_array();
			echo "<br>账户大于等于1000余额资金统计:".$query['balance'];
			
		}
	}
	//登录成功
	function logined()
	{
		$uid = $this->_uid();
		$this->db->where('id',$uid);
		$user = $this->db->get('admin',1,0)->row_array();		
		$data['user'] = $user;
		
		$data['menulist'] = $this->main_m->menulist();;
		$this->load->view('admin/public',$data);	
	}
	//网站设置
	function sysconfig()
	{
		$this->form_validation->set_rules('indextitle', '首页标题', 'trim|required');
		$this->form_validation->set_rules('keyword', '关键词', 'trim|required');
		$this->form_validation->set_rules('description', '描述', 'trim|required');
		$this->form_validation->set_rules('sitetitle', '网站标题', 'trim|required');
		$this->form_validation->set_rules('present', '推荐返现率', 'trim|required');
		$this->form_validation->set_rules('repayment', '还款执行时间设置', 'trim|required');
		$this->form_validation->set_rules('admin_url', '后台路径', 'trim|required');
		$this->form_validation->set_rules('debenture', '债权转让是否审核', 'trim|required');
		$this->form_validation->set_rules('regesiter', '用户注册奖励金额', 'trim|required');
		$this->form_validation->set_rules('quota', '风险备付金额度', 'trim|required');
		$this->form_validation->set_rules('transfer', '债权转让有效转让天数', 'trim|required');
		$this->form_validation->set_rules('platform', '平台承担的提现手续费', 'trim|required');
		$this->form_validation->set_rules('usermention', '提现手续费', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$data['row'] = $this->main_m->get_sysconfig();
			$this->_view('main/sysconfig',$data);
			//$this->sysconfig();	
		}
		else
		{
			if($this->main_m->form_sysconfig())	
			{
				$this->_message('提交成功',admin_url('main/sysconfig'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('main/sysconfig'),2);		
			}
		}
	}
	//密码修改
	function password()
	{
		if(!$this->main_m->form_pass())
		{
			$this->_view('main/password');	
		}
		else
		{
			$this->_message('提交成功',admin_url('main/password'));	
		}
	}
	//友情连接
	function link()
	{
		$data['result'] = $this->main_m->link();
		$this->_view('main/link',$data);	
	}
	function add_link()
	{
		$this->form_validation->set_rules('name', '名称', 'trim|required');
		$this->form_validation->set_rules('url', '连接地址', 'trim|required');
		$this->form_validation->set_rules('sort', '排序', 'trim|required|integer');
		if ($this->form_validation->run() == FALSE)
		{
			$this->_view('main/add_link');
		}
		else
		{
			if($this->main_m->add_link())
			{
				$this->_message('提交成功',admin_url('main/add_link'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('main/add_link'),2);	
			}	
		}
	}
	function edit_link($id = false)
	{
		$this->form_validation->set_rules('name', '名称', 'trim|required');
		$this->form_validation->set_rules('url', '连接地址', 'trim|required');
		$this->form_validation->set_rules('sort', '排序', 'trim|required|integer');
		if ($this->form_validation->run() == FALSE)
		{
			$data['row'] = $this->db->where('id',$id)->get('link',1,0)->row_array();
			$this->_view('main/edit_link',$data);
		}
		else
		{
			if($this->main_m->edit_link())
			{
				$this->_message('提交成功',admin_url('main/edit_link/'.$id));	
			}
			else
			{
				$this->_message('提交失败',admin_url('main/edit_link/'.$id),2);	
			}	
		}
	}
	function del_link($id = false)
	{
		if($this->main_m->del_link($id))
		{
			$this->_message('提交成功',admin_url('main/link'));	
		}
		else
		{
			$this->_message('提交失败',admin_url('main/link'),2);	
		}		
	}
	
	//邮箱设置
	function email($test = false)
	{
		if($test)
		{
			$row = $this->main_m->get_email();
			$return = send_email($row['testname'],'测试收信人姓名','测试邮件','测试内容');
			if($return == "success")
			{
				$this->_message('发信成功，请查收',admin_url('main/email'));	
			}
			else
			{
				$this->_message('发信失败,请检查配置'.$return,admin_url('main/email'));		
			}
		}
		
		
		$this->form_validation->set_rules('smtp_host', 'SMTP地址', 'trim|required');
		$this->form_validation->set_rules('smtp_port', 'SMTP端口', 'trim|required');
		$this->form_validation->set_rules('smtp_user', 'SMTP用户名', 'trim|required');
		$this->form_validation->set_rules('smtp_pass', 'SMTP密码', 'trim|required');	
		$this->form_validation->set_rules('senduser', '发信人地址', 'trim|required|valid_email');
		$this->form_validation->set_rules('sendname', '发信人名称', 'trim|required');
		$this->form_validation->set_rules('testname', '测试人地址', 'trim|required|valid_email');
		if ($this->form_validation->run() == FALSE)
		{
			$data['row'] = $this->main_m->get_email();
			$this->_view('main/email',$data);	
		}
		else
		{
			if($this->main_m->email())
			{
				$this->_message('提交成功',admin_url('main/email'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('main/email'),2);		
			}	
		}
	}
	//还款方式列表 
	function repay_way_list()
	{
		$data['result'] = $this->public_m->result('repay_way');
		$this->_view('main/repay_way_list',$data);		
	}
	//还款方式设置
	function add_repay_way()
	{
		$this->form_validation->set_rules('repay', '还款方式', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->_view('main/add_repay_way');	
		}
		else
		{
			if($this->public_m->add('repay_way'))
			{
				$this->_message('提交成功',admin_url('main/repay_way_list'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('main/add_repay_way'),2);		
			}		
		}
	}
	//修改还款方式
	function edit_repay_way($id = false)
	{
		$this->form_validation->set_rules('repay', '还款方式', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$data['row'] = $this->public_m->row('repay_way',$id);
			$this->_view('main/edit_repay_way',$data);	
		}
		else
		{
			if($this->public_m->edit('repay_way',$id))
			{
				$this->_message('提交成功',admin_url('main/edit_repay_way/'.$id));	
			}
			else
			{
				$this->_message('提交失败',admin_url('main/edit_repay_way/'.$id),2);		
			}		
		}	
	}
	//删除还款方式
	function del_repay_way($id = false)
	{
		if($this->public_m->del('repay_way',$id))
		{
			$this->_message('提交成功',admin_url('main/repay_way_list/'.$id));	
		}
		else
		{
			$this->_message('提交失败',admin_url('main/repay_way_list/'.$id),2);		
		}		
	}
	
	//机构名称列表 
	function invest_org_list()
	{
		$data['result'] = $this->public_m->result('invest_org');
		$this->_view('main/invest_org_list',$data);		
	}
	//添加机构名称
	function add_invest_org()
	{
		$this->form_validation->set_rules('org_name', '机构名称', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->_view('main/add_invest_org');	
		}
		else
		{
			if($this->public_m->add('invest_org'))
			{
				$this->_message('提交成功',admin_url('main/invest_org_list'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('main/add_invest_org'),2);		
			}		
		}
	}
	//编辑机构名称
	function edit_invest_org($id = false)
	{
		$this->form_validation->set_rules('org_name', '机构名称', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$data['row'] = $this->public_m->row('invest_org',$id);
			$this->_view('main/edit_invest_org',$data);	
		}
		else
		{
			if($this->public_m->edit('invest_org',$id))
			{
				$this->_message('提交成功',admin_url('main/edit_invest_org/'.$id));	
			}
			else
			{
				$this->_message('提交失败',admin_url('main/edit_invest_org/'.$id),2);		
			}		
		}	
	}
	//删除机构名称
	function del_invest_org($id = false)
	{
		if($this->public_m->del('invest_org',$id))
		{
			$this->_message('提交成功',admin_url('main/invest_org_list/'.$id));	
		}
		else
		{
			$this->_message('提交失败',admin_url('main/invest_org_list/'.$id),2);		
		}		
	}
	
	//添加短信模板
	function add_sms_model()
	{
		$this->form_validation->set_rules('name', '模板名称', 'trim|required');
		$this->form_validation->set_rules('content', '模板内容', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->_view('main/add_sms_model');
		}
		else
		{
			if($this->public_m->add('sms_model'))
			{
				$this->_message('提交成功',admin_url('main/sms_model'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('main/add_sms_model'),2);		
			}		
		}
				
	}
	//修改短信模板
	function edit_sms_model($id = false)
	{
		$this->form_validation->set_rules('name', '模板名称', 'trim|required');
		$this->form_validation->set_rules('content', '模板内容', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$data['row'] = $this->public_m->row('sms_model',$id);
			$this->_view('main/edit_sms_model',$data);
		}
		else
		{
			if($this->public_m->edit('sms_model',$id))
			{
				$this->_message('提交成功',admin_url('main/edit_sms_model/'.$id));	
			}
			else
			{
				$this->_message('提交失败',admin_url('main/edit_sms_model/'.$id),2);		
			}		
		}	
	}
	//短信模板列表
	function sms_model()
	{
		$data['result'] = $this->public_m->result('sms_model');
		$this->_view('main/sms_model_list',$data);			
	}
	//删除短信模板
	function del_sms__model($id = false)
	{
		if($this->public_m->del('sms_model',$id))
		{
			$this->_message('提交成功',admin_url('main/sms_model/'));	
		}
		else
		{
			$this->_message('提交失败',admin_url('main/sms_model/'),2);		
		}			
	}
	
	function sys_log($page = 0)
	{
		
		$count = $this->db->count_all_results('sys_log');
		$this->load->library('pagination');
		$get = $this->public_m->page_url();
		$config['base_url'] = admin_url('main/sys_log');
		$config['page_query_string'] = false;
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$config['total_rows'] = $count;
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		$this->db->order_by('id','desc');
		$data['result'] = $this->db->get('sys_log',$config['per_page'],$page)->result_array();
		$this->_view('main/sys_log',$data);		
	}
	
	//焦点图列表
	function focus()
	{
		$this->db->order_by('sort','asc');
		$data['result'] = $this->db->get('focus')->result_array();
		$this->_view('focus/focus',$data);
	}
	//增加焦点图
	function add_focus()
	{
		$this->form_validation->set_rules('photo', '图片', 'trim|required');
		$this->form_validation->set_rules('m_photo', '手机图片', 'trim|required');
		$this->form_validation->set_rules('m_url', '手机url', 'trim|required');
		$this->form_validation->set_rules('title', '焦点图名称', 'trim|required');
		$this->form_validation->set_rules('sort', '排序', 'trim|required');
		$this->form_validation->set_rules('url', '路径不能为空', 'trim|required');
		$this->form_validation->set_rules('is_phone', '是否手机端显示', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->_view('focus/add_focus');
		}
		else
		{
			if($this->public_m->add('focus'))
			{
				$this->_message('提交成功',admin_url('main/focus'));	
			}
			else
			{
				$this->_message('提交失败',admin_url('main/add_focus'),2);		
			}		
		}
	}
	//编辑焦点图
	function edit_focus($id = false)
	{
		$this->form_validation->set_rules('photo', '图片不能为空', 'trim|required');
		$this->form_validation->set_rules('m_photo', '手机图片', 'trim|required');
		$this->form_validation->set_rules('m_url', '手机url', 'trim|required');
		$this->form_validation->set_rules('title', '焦点图名称', 'trim|required');
		$this->form_validation->set_rules('sort', '排序', 'trim|required');
		$this->form_validation->set_rules('url', '路径不能为空', 'trim|required');
		$this->form_validation->set_rules('is_phone', '是否手机端显示', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$data['row'] = $this->public_m->row('focus',$id);
			$this->_view('focus/edit_focus',$data);
		}
		else
		{
			if($this->public_m->edit('focus',$id))
			{
				$this->_message('提交成功',admin_url('main/edit_focus/'.$id));	
			}
			else
			{
				$this->_message('提交失败',admin_url('main/edit_focus/'.$id),2);		
			}		
		}	
	}
	//删除焦点图
	function del_focus($id = false)
	{
		if($this->public_m->del('focus',$id))
		{
			$this->_message('提交成功',admin_url('main/focus/'));	
		}
		else
		{
			$this->_message('提交失败',admin_url('main/focus/'),2);		
		}				
	}
	
}