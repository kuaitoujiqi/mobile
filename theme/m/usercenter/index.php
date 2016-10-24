<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>用户中心-快投机器</title>
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



<!---
<div id="morehead">
	<div class="container has-feedback">
    	<a href="<?php echo site_url('m/usercenter/recharge')?>"><div class="pull-left">充值</div></a>
        <div class="text-center">我的账号<small>（<?php echo $userinfo['nickname'];?>）</small></div>
        <div class="wdzh"><a href="<?php echo site_url('m/usercenter')?>"><span class="glyphicon glyphicon-user "></span></a></div>
    </div>
</div>
--->
<div class="container zcze">
	<div class="row mainFrame">
		<div class="row" style="margin-top:10px;">
			<div class="col-xs-1 text-center"></div>
			<div class="col-xs-1 text-center">
				<div class="wdzh">
					<a href="<?php echo site_url('m/usercenter')?>"><span class="glyphicon glyphicon-user" style="color:#fff;"></span></a>
				</div>		
			</div>
			<div class="col-xs-10 text-left" style="line-height:40px;">
				<?php echo userinfo('nickname'); ?> 
					<?php if(userinfo('nowTimeHours') > -1 && userinfo('nowTimeHours') < 12 ){
						echo "上午好！";
					}elseif(userinfo('nowTimeHours') > 18){
						echo "晚上好！";
					}else{
						echo "下午好！";
					}?>
			</div>
		</div>
		<div class="row" style="margin-top:40px;">
			<div class="col-xs-12 text-center">
				<?php if($cyje['monkey'] == ""){$cyje_n = 0;}else{$cyje_n=$cyje['monkey'];}
				if($lsje['interest'] == ""){$lsje_n = 0;}else{$lsje_n=$lsje['interest'];}?>		
				总资产（元）
			</div>
		</div>
		<div class="row">
		<div class="col-xs-12 text-center" style="line-height:30px;">
			<span style="font-size:20px;"><?php echo strval(number_format($cyje_n-(-$userinfo['balance'])-(-$lsje_n),2));?></span>
		</div>
		</div>
	</div>
	
	<div class="row" style="height:60px;">
		<div class="col-xs-1"></div>
		<div class="col-xs-4" style="margin-top:20px;">
			可用余额(元)
			<br />
			<span style="color:#ffb26e;font-size:20px;font-weight:bold;"><?php echo strval($userinfo['balance']);?></span>	
		</div>
		<div class="col-xs-4 text-right" style="margin-top:20px;">
			<a role="btn" href="<?php echo site_url('m/usercenter/recharge')?>" class="btn btn-primary btn-md">充值</a>
		</div>
		<div class="col-xs-2 text-right" style="margin-top:20px;">
			<a role="btn" href="<?php echo site_url('m/usercenter/withdraw')?>" class="btn btn-default btn-md">提现</a>
		</div>
		<div class="col-xs-1"></div>
	</div>
	<!-----
	<div class="row">
		<div class="col-xs-6 text-center">
				<div class="zczeli">
					<?php if($cyje['monkey'] == ""){$cyje_n = 0;}else{$cyje_n=$cyje['monkey'];}
					if($lsje['interest'] == ""){$lsje_n = 0;}else{$lsje_n=$lsje['interest'];}?>
					<span>资产总额</span>￥<?php echo strval(number_format($cyje_n-(-$userinfo['balance'])-(-$lsje_n),2));?>
				</div>
		</div>
			<div class="col-xs-6 text-center">
				<div class="zczeli">
					<span>存钱罐余额</span>￥<?php echo strval($userinfo['balance']);?>
				</div>
			</div>
	</div>
    
	<div class="row">
    	<div class="col-xs-6 text-center">
        	<div class="zczeli">
            	<span>累计收益</span>￥<?php echo strval($ljsy)==""?0.00:strval(number_format($ljsy,2));?>
            </div>
        </div>
        
        <div class="col-xs-6 text-center">
        	<div class="zczeli">
            	<span>预期收益</span>￥<?php echo strval($lsje['interest'])==""?0.00:strval(number_format($lsje['interest'],2));?>
            </div>
        </div>
        
    </div>
    <div class="row">
		<div class="col-xs-6 text-center">
        	<div class="zczeli">
            	<span>持有产品金额</span>￥<?php echo strval($cyje['monkey'])==""?0.00:strval(number_format($cyje['monkey'],2));?>
            </div>
        </div>
    	<div class="col-xs-6 text-center">
        	<div class="zczeli">
            	<span>免费提现额度</span>￥<?php echo strval($userinfo['quota']);?>
            </div>
        </div>
    </div>
	---->
</div>
<hr />
<style>
.mainFrame{
	height:200px;
	background:url('<?php echo base_url();?>style/img/m/person_bg.png');
	color:#fff;
}	



/**/
.zcze{
	padding-top:0;
}
.wdzh{
	left:0;
}
.aqcenter a{
	color:#666;
}
.aqcenter a:hover{
	color:#666;
	text-decoration:none;
}

</style>
<div class="container aqcenter">
	<div class="row">
		<div class="col-xs-1"></div>
		<div class="col-xs-10">
			<a href="<?php echo site_url('m/usercenter/account')?>">
				<div class="row has-feedback" style="height:50px;line-height:50px;">
					<img src="<?php echo base_url();?>style/img/m/person_icon_1.png" height="20" />
					<span style="margin-left:5px;font-size:18px;">我的账户</span>
					<span class="glyphicon glyphicon-menu-right form-control-feedback" style="margin-top:10px;"></span>
				</div>
			</a>	
			<a href="<?php echo site_url('m/usercenter/record')?>">
				<div class="row has-feedback" style="height:50px;line-height:50px;">
					<img src="<?php echo base_url();?>style/img/m/person_icon_2.png" height="20" />
					<span style="margin-left:5px;font-size:18px;">投资记录</span>
					<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;待收回账/累计收益</span>
					<span class="glyphicon glyphicon-menu-right form-control-feedback" style="margin-top:10px;"></span>
				</div>
			</a>
			<a href="<?php echo site_url('m/usercenter/safe')?>">
				<div class="row has-feedback" style="height:50px;line-height:50px;border-bottom:0px solid #000;">
					<img src="<?php echo base_url();?>style/img/m/person_icon_3.png" height="20" />
					<span style="margin-left:5px;font-size:18px;">安全中心</span>
					<span class="glyphicon glyphicon-menu-right form-control-feedback" style="margin-top:10px;"></span>
				</div>
			</a>
			
			<!----
			<a href="<?php echo site_url('m/usercenter/safe')?>"><div class="row has-feedback">
				安全中心
				<span class="glyphicon glyphicon-menu-right form-control-feedback"></span>
			</div></a>
			<a href="<?php echo site_url('m/usercenter/record')?>"><div class="row has-feedback">
				账户明细
				<span class="glyphicon glyphicon-menu-right form-control-feedback"></span>
			</div></a>
			<a href="<?php echo site_url('m/usercenter/next_shouyi')?>"><div class="row has-feedback">
				下期收益
				<span class="glyphicon glyphicon-menu-right form-control-feedback"></span>
			</div></a>
			<a href="<?php echo site_url('m/usercenter/info')?>"><div class="row has-feedback">
				消息中心
				<span class="glyphicon glyphicon-menu-right form-control-feedback"></span>
			</div></a>
			<a href="<?php echo site_url('m/usercenter/binding')?>">
				<div class="row has-feedback">
					银行卡设置
					<span class="glyphicon glyphicon-menu-right form-control-feedback"></span>
				</div>
			</a>
			<a href="<?php echo site_url('m/usercenter/recharge')?>">
				<div class="row has-feedback">
					充值
					<span class="glyphicon glyphicon-menu-right form-control-feedback"></span>
				</div>
			</a>
			<a href="<?php echo site_url('m/usercenter/withdraw')?>">
				<div class="row has-feedback">
					提现
					<span class="glyphicon glyphicon-menu-right form-control-feedback"></span>
				</div>
			</a>
			---->
			
			
		</div>
		<div class="col-xs-1"></div>
	</div>
	
	<div class="row" style="height:5px;background:#eee;">
		<div class="col-xs-12"></div>
	</div>
	<div class="row">
		<div class="col-xs-1"></div>
		<div class="col-xs-10">
			<a href="<?php echo site_url('m/usercenter/binding')?>">
				<div class="row has-feedback" style="height:50px;line-height:50px;border-bottom:0px solid #000;">
					<img src="<?php echo base_url();?>style/img/m/person_icon_4.png" height="20" />
					<span style="margin-left:5px;font-size:18px;">银行卡管理</span>
					<span class="glyphicon glyphicon-menu-right form-control-feedback" style="margin-top:10px;"></span>
				</div>
			</a>
		</div>	
		<div class="col-xs-1"></div>
	</div>
	<div class="row" style="height:5px;background:#eee;">
		<div class="col-xs-12"></div>
	</div>	
</div>

<div class="container">
	<button class="btn btn-block btn-danger btn-lg" type="submit"  id="regesiter_btn" style="margin-top:10px; margin-bottom:15px" onClick="javascript:location.href='<?php echo site_url('m/welcome/exit_login')?>'">退出登录</button>
</div>

<!--导航块--------------------------------------------------------------------------------------------->
<?php /*?><?php $this->load->view('m/usercenter/menu'); ?>

<!--最近操作--------------------------------------------------------------------------------------------->
<div class="container">
    <div class="row">
        <h5 style="margin-left: 8px;"><span class="glyphicon glyphicon-list-alt"> </span> 最近操作记录</h5>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>日期</th>
                <th>操作类型</th>
                <th>金额</th>
                <th>状态</th>
                <th>详情</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($czjl[1] as $key){?>
            <tr>
                <td><?php echo date('Y-m-d',$key['dateline']);?></td>
                <td><?php 
							switch($key['type'])
							{
								case 1:echo "充值";break;
								case 2:echo "投资";break;
								case 5:echo "还款";break;
								case 7:echo "提现";break;
								case 9:echo "投资债权";break;
								case 10:echo "转让债权";break;
							}
						?></td>
                <td><?php echo $key['monkey'];?></td>
                <td><?php if($key['static'] == 1){echo "处理中";}if($key['static'] == 2){echo "成功";}if($key['static'] == 3){echo "失败";}?></td>
                <td><?php switch($key['type'])
							{
								case 2:case 5:case 9:echo anchor('m/product/bulk_standard/'.$key['productid'],'查看详情',array('target'=>'_blank'));break;
								default:echo $key['remark'];break;	
							}?></td>
            </tr>
            <?php }?>
            </tbody>
        </table>
    </div>

</div><?php */?>

<?php $this->load->view('m/footer');?>



