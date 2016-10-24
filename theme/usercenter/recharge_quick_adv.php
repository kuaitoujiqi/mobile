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
	$('#adv').click(function(){
		$(this).attr("disabled",true);
		$('#form_bind').submit();
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
            <h3 class="page-header">快捷支付充值</h3>
           
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
    					 <button type="button" class="btn btn-primary" id="adv">提交</button>
                    </div>
 				</div>
               
            </form>
        </div>
    </div>
</div>


</body>
</html>