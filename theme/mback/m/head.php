
<?php if($this->session->userdata('from') != "app" && $this->input->get('from') != "app"){?>
<nav class="navbar navbar-default navbar-reverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <?php /*?><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span><?php */?>
                菜单
            </button>
            <a class="navbar-brand" href="<?php echo site_url('m');?>" style="padding: 0;"><img src="<?php echo base_url();?>style/img/header_logo.png"/> </a>
        </div>
		<input type="hidden" name="uid"  id="uid" value="<?php echo $this->session->userdata('uid')?$this->session->userdata('uid'):0;?>" />
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="row">
                <a class="active col-xs-3" href="<?php echo base_url();?>m"><span class="glyphicon glyphicon-home"></span><br> 首页</a>
                <a class="col-xs-3" href="<?php echo site_url('m/product/bulk_standard_list');?>"><span class="glyphicon glyphicon-th-list"></span> <br> 投资列表</a>
                <?php if($this->session->userdata('uid')){?>
                	<a class="col-xs-3" href="<?php echo site_url('m/usercenter');?>"><span class="glyphicon glyphicon-user"></span><br>  我的账户</a>
                <?php }else{?>
                	<a class="col-xs-3" href="<?php echo site_url('m/welcome/login');?>"><span class="glyphicon glyphicon-user"></span><br>  登录</a>
				<?php }?>
                <a class="col-xs-3" href="<?php echo site_url('m/news');?>"><span class="glyphicon glyphicon-option-vertical"></span> <br> 更多</a>
            </div>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<?php }?>