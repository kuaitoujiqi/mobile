<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>找回密码-蜂融网</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1,initial-scale=1,minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
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
	<script language="javascript">
    $(document).ready(function(){
		$('.piccode').click(function(){
			$(this).attr('src',"<?php echo site_url('m/welcome/regesiter_code');?>?temp=" + Math.random());
		});
		//发送短信验证码
		$('#regesiter_form #sendcode').click(function(){
		var telphone = $('#regesiter_form #mobile').val();
		var shengyu_b = $('#sendcode').attr('data');
		if(shengyu_b <=0)
		 { 
			 $.get("/m/welcome/fogetsend/" + telphone,function(data,status){
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

<!--主导航--------------------------------------------------------------------------------------------->
<?php $this->load->view('m/head'); ?>
<div class="container" style="padding-bottom: 20px;">
<h3 class="page-header">找回密码</h3>
    <div class="row" style="margin-top: 10px;">
        <form class="col-xs-12" id="regesiter_form" method="post">
        	<?php if(isset($error)){?><p class="alert alert-danger"><?php echo $error;?></p><?php }?>
            <div class="form-group">
                <label for="message-text">手机号：</label>
                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="请输入您的手机号" value="<?php echo set_value('mobile');?>">
                <?php echo form_error('mobile');?>
            </div>
            <div class="form-group">
                <label for="message-text">手机验证码：</label>
                <div class="row">
                    <div class="col-xs-7">
                        <input type="text" class="form-control" placeholder="手机验证码" name="phonecode" id="phonecode" value="<?php echo set_value('phonecode');?>">
                    </div>
                    <div class="col-xs-5">
                        <button type="button" class="btn btn-default" id="sendcode" data="0">发送手机验证码</button>
                    </div>
                </div>
                <?php echo form_error('phonecode');?>
            </div>
            <div class="form-group">
                <label for="message-text">新登录密码：</label>
                <input type="password" class="form-control" placeholder="请输入您的新密码" name="password" id="password" value="<?php echo set_value('password');?>">
                <?php echo form_error('password');?>
            </div>
            <div class="form-group">
                <label for="message-text">确认密码：</label>
                <input type="password" class="form-control" placeholder="再次确认您的密码" name="matches_password" id="matches_password">
               <?php echo form_error('matches_password');?>
            </div>
    </div>
    <button class="btn btn-block btn-success btn-lg" type="submit"  id="regesiter_btn" style="margin-top:10px">提交</button>
</form>
</div>


<!--最近操作--------------------------------------------------------------------------------------------->
<?php $this->load->view('m/footer');?>

</body>
</html>
