
<?php if($this->session->userdata('from') != "app" && $this->input->get('from') != "app"){?>

<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?a2aad39940de7ed92710480dd9ee941a";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

<nav class="navbar navbar-default navbar-reverse" style="border-bottom:1px solid #337ab7;">
    <div class="container-fluid">	
        <div class="navbar-header">
			<?php if($this->session->userdata('uid')){ ?>
				<a role="button" class="navbar-toggle navbar-primary collapsed" href="<?php echo site_url('m/usercenter/index'); ?>">
					<span class="glyphicon glyphicon-user" style="color:#337ab7;"></span> 欢迎您,<?php echo userinfo('nickname'); ?>
				</a>
			<?php }else{ ?>
				<a role="button" class="navbar-toggle navbar-primary collapsed" href="<?php echo site_url('m/welcome/login'); ?>">
					登录
				</a>			
				<a role="button" class="navbar-toggle navbar-primary collapsed" href="<?php echo site_url('m/welcome/regesiter'); ?>">
					注册
				</a>				
			<?php }?>
            <a class="navbar-brand" href="<?php echo site_url('m');?>" style="padding: 0;"><img src="<?php echo base_url();?>style/img/header_logo.png" height="50"/> </a>
        </div>
		<input type="hidden" name="uid"  id="uid" value="<?php echo $this->session->userdata('uid')?$this->session->userdata('uid'):0;?>" />
    </div>
</nav>
<?php }?>