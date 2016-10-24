	<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>银行卡管理-快投机器</title>
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

<?php $this->load->view('m/usercenter/menu_back',array('title'=>'绑定银行卡','url'=>site_url('m/usercenter'))); ?>
<div class="container" style="margin-top: 10px;">
    <p class="alert alert-warning" style="margin-bottom: 5px;">温馨提示:<br>
        1、用户只能绑定一张储蓄卡作为提现的唯一银行卡，平台账户余额大于0，无法解除绑定。<br>
        2、绑定银行卡需为用户本人银行卡，持卡人姓名需与快投机器实名认证姓名一致，否则无法绑定成功。<br>
        3、绑卡短信验证码有效期为15分钟，如未输入验证码，则15分钟内无法再次提交绑定。<br>
        4、绑定银行卡可以快捷充值，除绑定银行卡外充值需使用网银支付。<br>
        5、因快投机器使用新浪支付资金托管系统，绑定银行卡会收到【新浪微博钱包】验证码。
    </p>
    

	<?php $bankinfo = require('./data/bankinfo.php'); ?>
    <?php foreach($bank as $key){?>
	<div class="record_one">
		<div class="row">
			<div class="col-xs-12" style="border:1px solid #ddd;border-radius:4px 4px 4px 4px;height:130px;margin-right:30px;">
				<div class="row" style="line-height:30px;margin-top:10px;">
					<div class="col-xs-1"></div>
					<div class="col-xs-2">
					</div>
					<div class="col-xs-8"><?php echo $bankinfo['q_pay'][$key['bank_code']];?></div>
				</div>
				<div class="row" style="background:#eee;height:30px;line-height:30px;margin-top:10px;margin-bottom:10px;">
					<div class="col-xs-1"></div>
					<div class="col-xs-10"><?php echo $key['bank_account_no'];?></div>
				</div>
				<div class="row text-center" style="line-height:20px;">
					<div class="col-xs-12">持卡人：<?php echo $userinfo['name']; ?></div>
				</div>
			</div>
		</div>	
	</div>
	
	<?php }?>
	<div class="record_one">
		<button type="button" class="btn btn-danger btn-block btn-lg" onclick="javascript:location='<?php echo site_url('m/usercenter/addbindbank');?>';">添加银行卡</button>
	</div>
</div>

<?php $this->load->view('m/footer');?>

</body>
</html>
