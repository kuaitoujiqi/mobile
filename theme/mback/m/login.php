<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>登录-蜂融网</title>
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

</head>


<body class="index">

<!--主导航--------------------------------------------------------------------------------------------->
<?php $this->load->view('m/head'); ?>

<!--导航块--------------------------------------------------------------------------------------------->
<div class="container">
    <form action="" method="post">
    	
        <div class="form-group" id="login_error">
        	
           <?php if(isset($error)){?> <p class="alert alert-danger my_alert" style="margin-top:20px">用户名或密码错误！</p> <?php }else{?>
           <p style="height:20px"></p>
           <?php }?>
        </div>
       
        <div class="form-group <?php if(form_error('username')!=""){echo "has-error";}?>">
            <label for="recipient-name">用户名：</label>
            <input type="text" class="form-control input-lg" id="recipient-name"  placeholder="请输入注册时的用户名或手机号" id="username" name="username"/>
        </div>
        <div class="form-group <?php if(form_error('password')!=""){echo "has-error";}?>" style="margin-top: 10px;">
            <label for="message-text">密码：</label>
            <input type="password" class="form-control input-lg"  id="login_password" name="password"/>
        </div>
   
    <button class="btn btn-block btn-success btn-lg" style="margin-top: 10px;" type="submit">登录</button>
    <a class="btn btn-block btn-warning btn-lg" style="margin-top: 10px; " href="<?php echo site_url('m/welcome/regesiter');?>">还没有账号，去注册！</a>
	 </form>
    <div class="row" style="margin-top: 10px;">
        <div class="col-xs-6">
            <a href="<?php echo site_url('m/welcome/forget');?>">忘记密码？</a>
        </div>
       <?php /*?> <div class="col-xs-6" style="text-align: right;">
            <a href="<?php echo site_url('m/welcome/regesiter');?>">还没有账号，去注册！</a>
        </div><?php */?>
    </div>
</div>


<!--最近操作--------------------------------------------------------------------------------------------->

<?php $this->load->view('m/footer');?>
</body>
</html>



