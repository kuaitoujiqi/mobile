<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>安全中心-蜂融网</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
    <link href="" rel="apple-touch-icon-precomposed">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/mbase.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url();?>style/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>style/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>style/js/mwork.js"></script>
	<script language="javascript">
    $(document).ready(function(){
		
		$('#regesiter_btn').click(function(){
			$(this).attr('disabled',true);
			$(this).text('提交处理中');
			$('#regesiter_form').submit();
		});
	});
    </script>
</head>
<body class="index">
<?php $this->load->view('m/head'); ?>
<?php $this->load->view('m/usercenter/menu'); ?>
<div class="container" style="margin-top: 0px;">
    <h3 class="page-header">修改密码</h3>
</div>
<div class="container" style="padding-bottom: 20px;">
    <div class="row" style="margin-top: 10px;">
        <form class="col-xs-12" id="regesiter_form" method="post">
            <div class="form-group">
                <label for="message-text">原密码：</label>
                <input type="password" class="form-control" name="oldpass" id="oldpass" placeholder="请输入您的原密码" value="<?php echo set_value('oldpass');?>">
                <?php echo form_error('oldpass');?>
            </div>
            <div class="form-group">
                <label for="recipient-name">新密码：</label>
                <input type="password" class="form-control" placeholder="请输入您的新密码" name="newpass" id="newpass" value="<?php echo set_value('newpass');?>">
                <?php echo form_error('newpass');?>
            </div>
			<div class="form-group">
                <label for="recipient-name">确认密码：</label>
                <input type="password" class="form-control" placeholder="请输入您的确认密码" name="matches_password" id="matches_password" value="">
                <?php echo form_error('matches_password');?>
            </div>
    </div>


    <button class="btn btn-block btn-success btn-lg" type="submit"  id="regesiter_btn" style="margin-top:10px">提交</button>
</form>
</div>
<?php $this->load->view('m/footer');?>
</body>
</html>