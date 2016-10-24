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
		//发送短信验证码
		$('#regesiter_form #sendcode').click(function(){
		var shengyu_b = $('#sendcode').attr('data');
		if(shengyu_b <=0)
		 { 
			 $.get("/m/usercenter/sendphoncode/trading",function(data,status){
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

<?php /*?><?php $this->load->view('m/usercenter/menu'); ?><?php */?>
<div id="xghead" style="background:#337ab7;color:#fff;">
	<div class="container has-feedback">
    	<div class="gback"><a href="<?php echo site_url('m/usercenter/safe')?>"><span class="glyphicon glyphicon-menu-left" style="color:#fff;"></span></a></div>
        <div class="text-center">修改交易密码</div>
    </div>
</div>
<div class="container change_pas" style="padding-bottom: 20px;">
    <div class="row" style="margin-top: 10px;">
        <form class="col-xs-12" id="regesiter_form" method="post">
            <div class="row" style="height:auto">
                <input type="password" class="form-control xgmminput" name="trading" id="trading" placeholder="请输入您的交易密码" value="<?php echo set_value('trading');?>">
                <?php echo form_error('trading','<p class="alert alert-danger" style="padding:5px;font-size:12px">','</p>');?>
            </div>
            <div class="row" style="height:auto">
                <input type="password" class="form-control qrmminput" placeholder="请确认您的交易密码" name="match_trading" id="match_trading" value="<?php echo set_value('match_trading');?>">
                <?php echo form_error('match_trading','<p class="alert alert-danger" style="padding:5px;font-size:12px">','</p>');?>
            </div>
            <div class="row" style="height:auto; padding-top:3px" >
                 <div class="col-xs-7">
                <input type="text" class="form-control" placeholder="请输入您收到的验证码" name="phonecode" id="phonecode" value="<?php echo set_value('phonecode');?>">
                </div>
                 <div class="col-xs-5">
                <button type="button" class="btn btn-default" id="sendcode" data="0">发送手机验证码</button>
                </div>
               
            </div>
             <div class="row">
                <?php echo form_error('phonecode','<p class="alert alert-danger" style="padding:5px;font-size:12px">','</p>');?>
                </div>
    </div>


    <button class="btn btn-block btn-success btn-lg" type="submit"  id="regesiter_btn" style="margin-top:10px">提交</button>
</form>
</div>
<?php $this->load->view('m/footer');?>
</body>
</html>