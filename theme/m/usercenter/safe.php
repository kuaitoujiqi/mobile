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
</head>


<body class="index">

<!--选项菜单--------------------------------------------------------------------------------------------->

<?php $this->load->view('m/usercenter/menu_back',array('title'=>'安全中心','url'=>site_url('m/usercenter'))); ?>

<!--导航块--------------------------------------------------------------------------------------------->

<div>
	<div class="row" style="margin-top:20px;">
		<div class="col-xs-2"></div>
		<div class="col-xs-8">
			<?php if($userinfo['is_bind_bank'] == 1){ ?>
				<img src="<?php echo base_url();?>style/img/m/safe_4.png" width="100%" />
			<?php }elseif($userinfo['trading'] == 1){ ?>
				<img src="<?php echo base_url();?>style/img/m/safe_3.png" width="100%" />
			<?php }elseif($userinfo['is_idcard'] == 1){ ?>
				<img src="<?php echo base_url();?>style/img/m/safe_2.png" width="100%" />
			<?php }else{ ?>
				<img src="<?php echo base_url();?>style/img/m/safe_1.png" width="100%" />
			<?php } ?>		
		</div>
		<div class="col-xs-2"></div>
	</div>
	<div class="row">
		<div class="col-xs-1"></div>
		<div class="col-xs-11">
				<div class="row has-feedback" style="height:50px;line-height:50px;">
					<div class="col-xs-5">
						<img src="<?php echo base_url();?>style/img/m/person_icon_1.png" height="20" />
						<span style="margin-left:5px;font-size:14px;">实名认证</span>
					</div>
					<?php if($userinfo['is_idcard'] == 1){?>
					<div class="col-xs-7 text-right">
						<?php echo $userinfo['name'];?>（<?php echo $userinfo['idcard'];?>）
					</div>	
					<?php }?>
					<?php if($userinfo['is_idcard'] != 1){?>
					<div class="col-xs-4 text-danger">
						未认证
					</div>
					<div class="col-xs-3 text-right">
						<a role="bbtn" class="btn btn-sm btn-primary" href="<?php echo site_url('m/usercenter/idcard')?>">去认证</a>
					</div>
					<?php }?>
				</div>
				<hr style="clear:both;margin:0;"/>
				<div class="row has-feedback" style="height:50px;line-height:50px;">
					<div class="col-xs-5">
						<img src="<?php echo base_url();?>style/img/m/person_icon_5.png" height="20" />
						<span style="margin-left:5px;font-size:14px;">手机认证</span>
					</div>
					<div class="col-xs-4 text-success">
						<span>已认证</span>
					</div>					
					<div class="col-xs-3 text-right">
						<a role="bbtn" class="btn btn-sm btn-primary" href="<?php echo site_url('m/usercenter/change_phone')?>">修改</a>
					</div>
				</div>
				<hr style="clear:both;margin:0;"/>
				<div class="row has-feedback" style="height:50px;line-height:50px;">
					<div class="col-xs-4">
						<img src="<?php echo base_url();?>style/img/m/person_icon_3.png" height="20" />
						<span style="margin-left:5px;font-size:14px;">登录密码</span>
					</div>
					<div class="col-xs-5 text-success">
						<span>已单向加密存储</span>
					</div>
					<div class="col-xs-3 text-right">
						<a role="bbtn" class="btn btn-sm btn-primary" href="<?php echo site_url('m/usercenter/change_password')?>">修改</a>
					</div>
				</div>
				<hr style="clear:both;margin:0;"/>
				<div class="row has-feedback" style="height:50px;line-height:50px;">
					<div class="col-xs-5">
						<img src="<?php echo base_url();?>style/img/m/person_icon_2.png" height="20" />
						<span style="margin-left:5px;font-size:14px;">支付密码</span>
					</div>
					<div class="col-xs-4 text-success">
						<span><?php if($userinfo['trading'] == ""){echo "未设置";}else{echo "已设置";}?></span>
					</div>						
					<div class="col-xs-3 text-right">
						<?php if($userinfo['trading'] == ""){ ?> 
							<a role="btn" href="<?php echo site_url('m/usercenter/trading');?>" class="btn btn-sm btn-danger" target="_blank">添加</a>
						<?php }else{?> 
							<a role="btn" href="<?php echo site_url('m/usercenter/change_trading');?>" class="btn btn-sm btn-primary" target="_blank">修改</a>
						<?php } ?>			
						<!---<button type="button" class="" data-toggle="modal" data-target="#trading"></button>---->
					</div>
				</div>
		</div>		
	</div>
	<div class="row" style="height:10px;background:#eee;">
		<div class="col-xs-12"></div>
	</div>
	<div class="row">
		<div class="col-xs-1"></div>
		<div class="col-xs-11">
				<div class="row has-feedback" style="height:50px;line-height:50px;">
					<div class="col-xs-5">
						<img src="<?php echo base_url();?>style/img/m/person_icon_4.png" height="20" />
						<span style="margin-left:5px;font-size:14px;">银行卡</span>
					</div>
					<div class="col-xs-4 text-success">
						<span><?php if($userinfo['trading'] == ""){echo "未设置";}else{echo "已设置";}?></span>
					</div>
					<div class="col-xs-3 text-right">
						<a role="bbtn" class="btn btn-sm btn-primary" href="<?php echo site_url('m/usercenter/binding')?>">点击进入</a>
					</div>
				</div>			
		</div>
	</div>
</div>
<div style="height:50px;line-height:50px;color:#ff0000;background:#eee;">
	<div class="row">
		<div class="col-xs-12 text-center">
			修改交易密码将跳转新浪支付进行修改
		</div>
	</div>
</div>

<!--最近操作--------------------------------------------------------------------------------------------->

<?php $this->load->view('m/footer');?>
</body>
</html>


