<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>安全中心-快投机器</title>
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

<div id="xghead" style="background:#337ab7;color:#fff;">
	<div class="container has-feedback">
    	<div class="gback"><a href="<?php echo site_url('m/usercenter/safe')?>"><span class="glyphicon glyphicon-menu-left" style="color:#fff;"></span></a></div>
        <div class="text-center">绑定身份证号</div>
    </div>
</div>
<div class="container" style="padding-bottom: 20px;">
    <div class="row" style="margin-top: 10px;">
        <form class="col-xs-12" id="regesiter_form" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="name" id="name" placeholder="请输入您的姓名" value="<?php echo set_value('name');?>" style="height:46px; line-height:46px">
                <span class="glyphicon glyphicon-user form-control-feedback text-success" style="height:46px; line-height:46px"></span>
                <?php echo form_error('name');?>
            </div>
            <div class="form-group has-feedback" style="margin-top:10px">
                <input type="text" class="form-control" placeholder="请输入您的身份证号" name="idcard" id="idcard" value="<?php echo set_value('idcard');?>" style="height:46px; line-height:46px">
                <span class="glyphicon glyphicon-credit-card form-control-feedback text-success" style="height:46px; line-height:46px;"></span>
                <?php echo form_error('idcard');?>
            </div>
            <p></p>
            <button class="btn btn-block  btn-success btn-lg" type="submit"  id="regesiter_btn">开始绑定</button>
            <p></p>
            <p style="color:#F49600; font-size:14px; line-height:24px">温馨提示:</p>
            <p style="font-size:12px; line-height:20px; color:#88898B">1.实名认证后不可更改!</p>
            <p style="font-size:12px;line-height:20px; color:#88898B">2.实名认证过程遇到问题,请联系客服</p>
            <p style="color:#F49600;line-height:20px"><a href="tel:400-999-7956" style="color:#F49600">400-677-7505</a></p>
    </div>


    
</form>
</div>
<?php $this->load->view('m/footer');?>
</body>
</html>