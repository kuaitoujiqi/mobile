<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>银行卡管理-蜂融网</title>
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
<?php $this->load->view('m/usercenter/menu'); ?>
<div class="container" style="margin-top: 0px;">
    <h3 class="page-header">绑定银行卡</h3>


    <p class="alert alert-danger" style="margin-bottom: 5px;">温馨提示:<br>
        1、用户只能绑定一张储蓄卡作为提现的唯一银行卡，用户余额大于0，无法解除绑定。<br>
        2、绑定银行卡需为用户本人银行卡，持卡人姓名需与蜂融网实名认证姓名一致，否则无法绑定成功。<br>
        3、绑卡短信验证码有效期为15分钟，如未输入验证码，则15分钟内无法再次提交绑定。<br>
        4、绑定银行卡可以快捷充值，除绑定银行卡外充值需使用网银支付。<br>
        5、因蜂融网使用新浪支付资金托管系统，绑定银行卡会收到【新浪微博钱包】验证码。
    </p>
    <button type="button" class="btn btn-danger" onclick="javascript:location='<?php echo site_url('m/usercenter/addbindbank');?>';">添加银行卡</button>

	<?php $bankinfo = require('./data/bankinfo.php'); ?>
    <?php foreach($bank as $key){?>
    <div class="record_one">
        <div class="row">
            <div class="col-xs-4">日期：</div>
            <div class="col-xs-8"><?php echo date('Y-m-d',$key['dateline']);?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">银行名称：</div>
            <div class="col-xs-8"><?php echo $bankinfo['q_pay'][$key['bank_code']];?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">省市：</div>
            <div class="col-xs-8"><?php echo $key['province'].$key['city'];?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">卡号：</div>
            <div class="col-xs-8"><?php echo $key['bank_account_no'];?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">状态：</div>
            <div class="col-xs-8"><?php echo $key['static']==1?"校验中":"已绑定";?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">操作：</div>
            <div class="col-xs-8">
            <?php if($key['static'] == 1){ ?>
            <a href="<?php echo site_url('m/usercenter/binding_advance/'.$key['order_id']."/".$key['ticket']);?>"  class="btn btn-danger btn-sm">短信校验</a>
           <?php }?>
		   <?php if($key['static'] == 2){ ?>
           <a href="<?php echo site_url('m/usercenter/ubind_bank/'.$key['id']);?>"  class="btn btn-danger btn-sm" onClick="return confirm('确定解除绑定？');">解除绑定</a>
		  <?php }?>
          </div>
        </div>
    </div>
	<?php }?>

</div>

<!--导航块--------------------------------------------------------------------------------------------->





<!--最近操作--------------------------------------------------------------------------------------------->
<?php $this->load->view('m/footer');?>

</body>
</html>
