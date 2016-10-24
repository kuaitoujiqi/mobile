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
		//发送短信验证码
		$('#regesiter_form #sendcode').click(function(){
		var shengyu_b = $('#sendcode').attr('data');
		var newphone = $('#newphone').val();
		if(shengyu_b <=0)
		 { 
			 $.get("/m/usercenter/sendphoncode/edit_phone/" + newphone,function(data,status){
				if(data == "success")
				{
					alert('短信已发送,3分钟有效');
					$('#sendcode').attr('data',59);
					$('#sendcode').text("重新发送(59)");
					daojishi = setInterval(function(){
						var shengyu_text = $('#sendcode').attr('data')-1;
						var shengyu = $('#sendcode').attr('data',shengyu_text);
						if(shengyu_text >=0)
						{
							$('#sendcode').text("重新发送("+shengyu_text+")");
						}else
						{
							window.clearInterval(daojishi);	
							$('#sendcode').text("点击获取验证码");
						}
					},1000);
					
				}
				else
				{
					alert(data);
				}
			});
		 }

		});
		
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
    <h3 class="page-header">修改手机号</h3>
</div>
<div class="container" style="padding-bottom: 20px;">
    <div class="row" style="margin-top: 10px;">
        <form class="col-xs-12" id="regesiter_form" method="post">
            <div class="form-group">
                <label for="message-text">原手机号：</label>
                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="请输入您的原手机号" value="<?php echo set_value('mobile');?>">
                <?php echo form_error('mobile');?>
            </div>
            <div class="form-group">
                <label for="recipient-name">新手机号：</label>
                <input type="text" class="form-control" placeholder="请输入您的新手机号" name="newphone" id="newphone" value="<?php echo set_value('newphone');?>">
                <?php echo form_error('newphone');?>
            </div>
            <div class="form-group">
                <label for="recipient-name">手机验证码：</label>
                <div class="row">
                 <div class="col-xs-7">
                <input type="text" class="form-control" placeholder="请输入您收到的验证码" name="phonecode" id="phonecode" value="<?php echo set_value('phonecode');?>">
                </div>
                 <div class="col-xs-5">
                <button type="button" class="btn btn-default" id="sendcode" data="0">发送手机验证码</button>
                </div>
                </div>
                <?php echo form_error('phonecode');?>
            </div>
    </div>


    <button class="btn btn-block btn-success btn-lg" type="submit"  id="regesiter_btn" style="margin-top:10px">提交</button>
</form>
</div>
<?php $this->load->view('m/footer');?>
</body>
</html>