<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>网银支付-快投机器</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
<?php $this->load->view('m/usercenter/menu_back',array('title'=>'充值','url'=>site_url('m/usercenter'))); ?>
<!--选项菜单--------------------------------------------------------------------------------------------->
<div class="container" style="margin-top: 10px;">
    
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default" onclick="javascript:location='<?php echo site_url('m/usercenter/recharge/quick_pay');?>';">快捷支付</button>
            <button type="button" class="btn btn-danger" onclick="javascript:location='<?php echo site_url('m/usercenter/recharge/online_bank');?>';">网银在线</button>
        </div>
</div>

<div class="container">
	 <?php if($userinfo['is_idcard'] != 0){?>
    <form id="regesiter_form" class=" col-lg-8" style="margin-top: 10px;padding-left: 0" method="post">
        <div class="form-group ">
            <label for="inputEmail3" class="text-muted">请输入你的充值金额：</label>
            <div class="input-group col-lg-4">
                <div class="input-group-addon"><i class="glyphicon glyphicon-yen"></i></div>
                <input type="text" class="form-control input-lg" id="exampleInputAmount" placeholder="" name="monkey" value="">
            </div>
        </div>
        <?php if(form_error('monkey')!=""){?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
               	您输入的金额有误.
                </div>
		<?php }?> 

        <div class="form-group" style="margin-top: 10px;">
        <label for="inputEmail3" class="text-muted">选择银行：</label>
        <select class="form-control input-lg" name="optionsRadios">
        	<?php foreach($bankinfo as $val=>$key){?>
            <option value="<?php echo $val;?>" <?php echo set_select('optionsRadios',$val,$val == "ICBC"?true:false);?>><?php echo $key;?></option>
            <?php }?>
        </select>

        </div>


        <div class="form-group" style="margin-top: 20px">
            <button type="submit" class="btn btn-lg btn-success btn-block" id="regesiter_btn">充值</button>
        </div>
    </form>
    <?php }else{?>
    <p class="lead">您还没有通过实名认证无法进行充值！前往<u><a href="<?php echo site_url('m/usercenter/safe');?>">实名认证</a></u></p>
    <?php }?>

</div>




<!--最近操作--------------------------------------------------------------------------------------------->

<?php $this->load->view('m/footer');?>
</body>
</html>