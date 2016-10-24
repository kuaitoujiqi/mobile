<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title>用户中心 - 绑定银行卡</title>
    <meta name="keywords" content="投资理财,网络理财,固定收益,本息保障,网络融资,互联网理财,互联网金融,P2P,P2C,P2P投资,P2P理财,网贷" />
    <meta name="description" content="提供安全、方便、快捷的投资理财服务，预期收益率10%-18%，第三方资金托管，科学风控，安全保障。" />
    <link href="" rel="apple-touch-icon-precomposed">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/member.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url();?>style/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>style/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>style/js/base.js"></script>
    <script language="javascript">
	$(document).ready(function() {
		$('.recharge_bank input').change(function(){
			$('.recharge_bank a').removeClass('label-success');
			$('.recharge_bank a').addClass('label-default');
			$(this).next('a').removeClass('label-default');
			$(this).next('a').addClass('label-success');
		});
	});
    </script>
</head>
<body>

<?php $this->load->view('usercenter/header');?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <?php $this->load->view('usercenter/left');?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h3 class="page-header">您绑定的银行卡</h3>
            <?php if($userinfo['is_idcard'] != 0){?>
            <p style="color:red">温馨提示:<br>
1、用户只能绑定一张储蓄卡作为提现唯一安全卡，用户余额大于0或持有产品均无法解绑银行卡，如发生银行卡丢失换必须换卡的情况，请联系客服，提交相关申请。<br>
2、绑定银行卡需为用户本人银行卡，持卡人姓名需与快投机器实名认证姓名一致，否则无法绑定成功。<br>
3、绑卡短信验证码有效期为15分钟，如未输入验证码，则15分钟内无法再次提交绑定。<br>
4、绑定银行卡可以快捷充值，除绑定银行卡外充值需使用网银支付。<br>
5、因快投机器使用新浪支付资金托管系统，绑定银行卡会收到【新浪微博钱包】验证码。
            </p>
			<div style="margin-top: 20px">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-danger" onclick="javascript:location='<?php echo site_url('usercenter/addbindbank');?>';">添加银行卡</button>  
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped" style="margin-top: 10px">
                    <thead>
                    <tr>
                        <th>日期</th>
                        <th>银行名称</th>
                        <th>省市</th>
                        <th>卡号</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $bankinfo = require('./data/bankinfo.php'); ?>
                    <?php foreach($bank as $key){?>
                    <tr>
                    	<td><?php echo date('Y-m-d',$key['dateline']);?></td>
                        <td><?php echo $bankinfo['q_pay'][$key['bank_code']];?></td>
                        <td><?php echo $key['province'].$key['city'];?></td>
                    	<td><?php echo $key['bank_account_no'];?></td>
                    	<td><?php echo $key['static']==1?"校验中":"已绑定";?></td>
                        <td>
						<?php if($key['static'] == 1){ ?>
                        <a href="<?php echo site_url('usercenter/binding_advance/'.$key['order_id']."/".$key['ticket']);?>"  class="btn btn-danger btn-sm">短信校验</a>
                        <?php }?>
						<?php if($key['static'] == 2){ ?>
                        <a href="<?php echo site_url('usercenter/ubind_bank/'.$key['id']);?>"  class="btn btn-danger btn-sm" onClick="return confirm('确定解除绑定？');">解除绑定</a>
							<?php }?>
                        </td>
           			</tr>
                    <?php }?>
                    </tbody>
                </table>
                </div>
             <?php }else{?>
             	<p class="lead">您还没有通过实名认证暂无法绑定银行卡！前往<u><a href="<?php echo site_url('usercenter/safe');?>">实名认证</a></u></p>
			 <?php }?>
        </div>
    </div>
</div>


</body>
</html>