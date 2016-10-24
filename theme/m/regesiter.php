<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>用户注册-快投机器</title>
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
		var img_code = $('#regesiter_form #piccode').val();
		var shengyu_b = $('#sendcode').attr('data');
		if(shengyu_b <=0)
		 { 
			 $.get("/m/welcome/sendmessage/" + telphone + '/' + img_code,function(data,status){
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


<body class="index" style="background:#337ab7;">


<div style="height:30px;"></div>
<div class="container" style="padding-bottom: 20px;">
    <div class="row" style="margin-top: 10px;">
        <form class="col-xs-12" id="regesiter_form" method="post">
			<div class="text-center">
				<img src="<?php echo base_url();?>style/img/m/m_logo.png" width="150"/>
			</div>
		
        	<?php if(isset($error)){?><p class="alert alert-danger"><?php echo $error;?></p><?php }?>
            <div class="form-group" style="margin-top:20px;">
                <input type="text" class="form-control input-lg" name="nickname" id="nickname" placeholder="用户名为4-26个字符组成" value="<?php echo set_value('nickname');?>">
                <?php echo form_error('nickname');?>
            </div>
            <div class="form-group">
                <input type="text" class="form-control input-lg" placeholder="请输入您的手机号" name="mobile" id="mobile" value="<?php echo set_value('mobile');?>">
                <?php echo form_error('mobile');?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-7">
                        <input type="text" class="form-control input-lg" placeholder="验证码" name="piccode" id="piccode">
                    </div>
                    <div class="col-xs-5">
                        <img src="<?php echo site_url('m/welcome/regesiter_code')?>"  alt="点击刷新,不分大小写"  style="cursor:pointer;width:100px;" class="piccode"/>
                    </div>
                </div>
                <?php echo form_error('piccode');?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-7">
                        <input type="text" class="form-control input-lg" placeholder="手机验证码" name="phonecode" id="phonecode" value="<?php echo set_value('phonecode');?>">
                    </div>
                    <div class="col-xs-5">
                        <button type="button" class="btn btn-primary btn-lg" id="sendcode" data="0">发送验证码</button>
                    </div>
                </div>
                <?php echo form_error('phonecode');?>
            </div>
            <div class="form-group">
                <input type="password" class="form-control input-lg" placeholder="请输入您的密码" name="password" id="password" value="<?php echo set_value('password');?>">
                <?php echo form_error('password');?>
            </div>
            <div class="form-group">
                <input type="password" class="form-control input-lg" placeholder="再次确认您的密码" name="matches_password" id="matches_password">
               <?php echo form_error('matches_password');?>
            </div>
        
    </div>


    <button class="btn btn-block btn-primary btn-lg" type="submit"  id="regesiter_btn">注册</button>
</form>
<style>
.haveAccount a{
	color:#fff;
}
.haveAccount a:hover{
	color:#fff;
}
.alert{
	margin-top:10px;
}
.form-group{
	margin-bottom:15px;
}
.form-group input{
	background:#f4fdff;
}
#regesiter_btn{
	background-color:#337ab7;
	border-color:#90daf7;
}
#sendcode{
	background-color:#337ab7;
	border-color:#90daf7;	
}
</style>
    <div class="row" style="margin-top: 10px;">
        <div class="col-xs-6">
        </div>
        <div class="col-xs-6 haveAccount" style="text-align: right;">
            <a href="<?php echo site_url('m/welcome/login');?>">已有账号，<span style="text-decoration:underline;">立即登录</span></a>
        </div>
    </div>
</div>


<!--最近操作--------------------------------------------------------------------------------------------->
<?php $this->load->view('m/footer');?>

</body>
</html>
