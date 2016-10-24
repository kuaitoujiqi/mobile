<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>绑定银行卡推进-快投机器</title>
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

</head>


<body class="index">

<!--主导航--------------------------------------------------------------------------------------------->
<?php $this->load->view('m/head'); ?>
<?php $this->load->view('m/usercenter/menu_back',array('title'=>'绑定银行卡','url'=>site_url('m/usercenter'))); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            
           
            <form class="form-horizontal" id="form_bind" method="post">
                <div class="form-group <?php if(form_error('valid_code') != ""){echo "has-error"; }?>">
   		 			<label class="control-label col-sm-2">短信验证码</label>
                    <div class="col-sm-5">
    					<input type="text" name="valid_code" class="form-control" placeholder="请输入收到验证码">
                    </div>
 				</div>
                 <div class="form-group">
   		 			<label class="control-label col-sm-2"></label>
                    <div class="col-sm-5">
    					 <button type="submit" class="btn btn-primary">提交</button>
                    </div>
 				</div>
               
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('m/footer');?>
</body>
</html>