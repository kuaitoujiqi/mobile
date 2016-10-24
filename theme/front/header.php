<script language="javascript" src="<?php echo base_url();?>style/js/work.js"></script>
<?php $this->load->view('front/header_model');?>
<div class="header">
<!--
    <div class="container">
            <a class="header_logo col-xs-12 col-md-2 pull-left" href="<?php echo base_url();?>"><img src="/style/ads/header_logo.png"/></a>
            <div class="header_nav col-xs-12 col-md-7 " >
            	<?php $header_uri = $this->uri->segment(1,'null'); //product news
					  $news_uri = $this->uri->segment(2,'null');//article
					  $news_uri_3 = $this->uri->segment(3,'null');//6 7 8
				?>
                <a <?php if($header_uri == "null"){?>id="active"<?php }?> href="<?php echo base_url();?>" class="col-md-2 col-xs-12">首页</a>
                <a <?php if($header_uri == "product"){?>id="active"<?php }?> href="<?php echo site_url('product/bulk_standard_list');?>" class="col-md-2 col-xs-12">投资列表</a>
                <a <?php if($news_uri == "article" and $news_uri_3 == 6){?>id="active"<?php }?> href="<?php echo site_url('news/article/6');?>" class="col-md-2 col-xs-12">平台模式</a>
                <a <?php if($news_uri == "article" and $news_uri_3 == 7){?>id="active"<?php }?> href="<?php echo site_url('news/article/7');?>" class="col-md-2 col-xs-12">
				
				
				、
				
				
				</a>
                <a <?php if($news_uri == "article" and $news_uri_3 == 8){?>id="active"<?php }?> href="<?php echo site_url('news/article/8');?>" class="col-md-2 col-xs-12">安全保障</a>
            </div>
            <div class="header_tool col-md-3 col-xs-12">
            	<input type="hidden" name="uid"  id="uid" value="<?php echo $this->session->userdata('uid')?$this->session->userdata('uid'):0;?>" />
                <span class="header_word">欢迎您,<?php if($this->session->userdata('uid')){echo " ，".userinfo('nickname'); }?></span>
                <?php if(!$this->session->userdata('uid')){?>
                <button type="button" class="header_btn btn btn-default" data-toggle="modal" data-target="#loginModal">登录</button>			<?php }?>
                <?php if($this->session->userdata('uid')){?>
                <button type="button" class="header_btn btn btn-default" onclick="javascript:location='<?php echo site_url('usercenter')?>';">我的账户</button>
                <?php }?>
                <?php if(!$this->session->userdata('uid')){?>
                <button type="button" class="header_btn btn btn-default" data-toggle="modal" data-target="#registerModal">免费注册</button> 
                <button type="button" class="header_btn btn btn-default" data-toggle="modal" data-target="#getpasswordModal" style="display:none" id="header_getpassword">忘记密码</button>
                <?php }?>
            </div>
    </div> -->
	
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-6">
				<img src="<?php echo base_url();?>style/img/header/top_tel_icon.png" width="20" /> 客服热线：400-677-7505 &nbsp;|&nbsp;
				<a href="http://weibo.com/p/1006065833446993" rel="nofollow" target="_blank"><img src="<?php echo base_url();?>style/img/header/top_wb_icon.png" width="19" height="17" /> 官方微博</a>
					&nbsp;&nbsp;
				<a data-toggle="modal" data-target="#weixinModal" style="cursor:pointer"><img src="<?php echo base_url();?>style/img/header/top_wx_icon.png" width="19" height="17" />官方微信</a> 			
			</div>	
			<div class="col-xs-12 col-md-2"></div>
			<div class="col-xs-12 col-md-4 text-right">
				<input type="hidden" name="uid"  id="uid" value="<?php echo $this->session->userdata('uid')?$this->session->userdata('uid'):0;?>" />
				<?php if($this->session->userdata('uid')){ ?>
				<span class="header_word">欢迎您,<?php echo userinfo('nickname'); ?></span>
					&nbsp;|&nbsp;
				<?php }?>
				<?php if(!$this->session->userdata('uid')){?>
					<a href="<?php echo site_url('welcome/login_frame');?>">登录</a>
					&nbsp;|&nbsp;
				<?php }?>
					
				<?php if($this->session->userdata('uid')){?>
					<a href="<?php echo site_url('usercenter/index');?>">个人中心</a>
					&nbsp;|&nbsp;
				<?php }?>
				<?php if($this->session->userdata('uid')){?>
					<a href="<?php echo site_url('welcome/exit_login');?>">退出</a>
				<?php }?>				
					
				<?php if(!$this->session->userdata('uid')){?>
					<a href="<?php echo site_url('welcome/register_frame');?>">注册</a>
				<?php }?>
			</div>	
		</div>
	</div>	
</div>
	<script src="<?php echo base_url();?>style/js/jquery.easing.min.js"></script>
	<script src="<?php echo base_url();?>style/js/jquery.lavalamp.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#box-lanrenzhijia").lavaLamp({
                fx: "backout", 
                speed: 700,
                click: function(event, menuItem) {
                    return false;
                }
            });
        });
    </script>
<div class="navigation" style="background:#fff;border-bottom:1px solid #00aac6;">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-xs-12  pull-left" >
				<a class="col-xs-12 col-md-12" href="<?php echo site_url('');?>"><img height="80" src="<?php echo base_url();?>style/img/header/logo.jpg"></a>
			</div>	
			<div class="col-md-8 col-xs-12 pull-right" >	
				<ul class="box-lanrenzhijia" id="box-lanrenzhijia">
				   <li><a href="<?php echo base_url();?>">首&nbsp;&nbsp;&nbsp;&nbsp;页</a></li>
				   <li><a href="<?php echo site_url('product/bulk_standard_list');?>">投资列表</a></li>
				   <li><a href="<?php echo site_url('news/article_safety');?>">安全保障</a></li>
				   <li><a href="<?php echo site_url('news/article_novice');?>">新手指引</a></li>
				   <li><a href="<?php echo site_url('news/article_about');?>">关于快投</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>