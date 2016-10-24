<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>快捷支付-蜂融网</title>
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

<!--主导航--------------------------------------------------------------------------------------------->
<?php $this->load->view('m/head'); ?>
<?php $this->load->view('m/usercenter/menu'); ?>

<!--选项菜单--------------------------------------------------------------------------------------------->
<div class="container" style="margin-top: 0px;">
    <h3 class="page-header">充值</h3>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-danger" onclick="javascript:location='<?php echo site_url('m/usercenter/recharge/quick_pay');?>';">快捷支付</button>
            <button type="button" class="btn btn-default" onclick="javascript:location='<?php echo site_url('m/usercenter/recharge/online_bank');?>';">网银在线</button>
        </div>
        <?php if(count($bank) <=0) {?>
        <p class="lead">您还没有绑定的银行卡！前往<u><a href="<?php echo site_url('m/usercenter/addbindbank');?>">绑定银行卡</a></u></p>
     <?php }else{?>
</div>


<!--导航块--------------------------------------------------------------------------------------------->
<div class="container">
    <form id="regesiter_form" class=" col-lg-8" style="margin-top: 10px;padding-left: 0" method="post">
        <div class="form-group ">
            <label for="inputEmail3" class="text-muted">请输入你的充值金额：</label>
            <div class="input-group col-lg-4">
                <div class="input-group-addon"><i class="glyphicon glyphicon-yen"></i></div>
                <input type="text" class="form-control input-lg" id="exampleInputAmount" placeholder="" name="monkey" value="">
            </div>
            <?php if(form_error('monkey')!=""){?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
               	您输入的金额有误.
            </div><?php }?> 
            <?php if(isset($error) !=""){?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
               	<?php echo $error;?>.
            </div><?php }?> 
        </div>

        <div class="form-group">
            <p class="text-muted" style="margin-top: 5px;">平台支付充值费用( 详情请参考<a href="<?php echo site_url('news/article/11');?>" target="_blank">《费用说明 》</a> )</p>
            <?php $bank_tishi = require('./data/bankinfo.php');$bank_tishi = $bank_tishi['q_pay_info'];?>
            <p class="text-danger" style="font-size:16px"><?php echo $bank_tishi[$bank_row['bank_code']];?></p>
            <p class="text-danger" style="font-size:16px">网银在线支付限额与您在银行开通的网银支付额度一致，可咨询银行。</p>

        </div>

        <div class="form-group" style="margin: 20px 0px">
            <button type="submit" class="btn btn-lg btn-success btn-block" id="regesiter_btn">充值</button>
        </div>
    </form>

</div>

<?php }?>


<!--最近操作--------------------------------------------------------------------------------------------->

<?php $this->load->view('m/footer');?>
</body>
</html>



