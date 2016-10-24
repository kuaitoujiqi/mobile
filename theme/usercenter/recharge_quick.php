<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title>用户中心 - 充值</title>
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
		$('#submit_add').click(function(){
			$(this).attr("disabled",true);
			$('#recharge_form').submit();
		});
		
		
		$('#inputmonkey').on("keyup","#exampleInputAmount",function(){
			var monkey = $(this).val();
			if(isNaN(monkey) || monkey < 0)
			{
				$(this).val(0);	
			}
			else
			{
				var dot = monkey.indexOf(".");
				if(dot != -1){
					var dotCnt = monkey.substring(dot+1,monkey.length);
					if(dotCnt.length > 2){
						var num = new Number(monkey);
						monkey = new Number(num.toFixed(2));	
					}
				}
				$(this).val(monkey);
			}
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
            <h3 class="page-header">充值</h3>
            <?php if($userinfo['is_idcard'] != 0){?>
			<div style="margin-top: 20px">
                <strong>交易类型：</strong>
                <div class="btn-group" role="group">
                <button type="button" class="btn btn-danger" onclick="javascript:location='<?php echo site_url('usercenter/recharge/quick_pay');?>';">快捷支付</button>  
                    <button type="button" class="btn btn-default" onclick="javascript:location='<?php echo site_url('usercenter/recharge/online_bank');?>';">网银在线</button>
                      
                </div>
            </div>
			<?php if(count($bank) <=0) {?>
            
                <p class="lead">您还没有绑定的银行卡！前往<u><a href="<?php echo site_url('usercenter/addbindbank');?>">绑定银行卡</a></u></p>
            <?php }else{?>
            <?php if($bank_row['verify_mode'] == 2){?>
				 <p class="lead">您绑定的银行卡只能提现!前往<u><a href="<?php echo site_url('usercenter/recharge/online_bank');?>">网银充值</a></u></p>
			<?php }else{?>
            <form id="recharge_form" class=" col-lg-8" style="margin-top: 10px;padding-left: 0" method="post">
                <div class="form-group <?php if(form_error('monkey')!=""){?>has-error<?php }?>" id="inputmonkey">
                    <label for="inputEmail3" class="text-muted">请输入你的充值金额：</label>
                    <div class="input-group col-lg-4">
                        <div class="input-group-addon"><i class="glyphicon glyphicon-yen"></i></div>
                        <input type="text" class="form-control" id="exampleInputAmount" placeholder="" name="monkey" value="">                  
                         </div>
                </div>
				<?php if(form_error('monkey')!=""){?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
               	您输入的金额有误.
                </div><?php }?> 
                <div class="form-group">
                    <p class="text-muted">将为您支付充值手续费( 详情请参考<a href="<?php echo site_url('news/article/11');?>" target="_blank">《费用说明 》</a> )。</p>
                    <?php $bank_tishi = require('./data/bankinfo.php');$bank_tishi = $bank_tishi['q_pay_info'];?>
                    <p class="text-muted" style="color:red; font-size:18px">您绑定银行卡支付限额说明:<?php echo $bank_tishi[$bank_row['bank_code']];?></p>
                    <p class="text-muted" style="color:red; font-size:18px">网银在线支付限额与您在银行开通的网银支付额度一致，可咨询银行。</p>
                    

                </div>
                
                <div class="form-group" style="margin-top: 50px">
                        <button type="button" class="btn btn-lg btn-success col-lg-6" id="submit_add">充值</button>
                </div>
                 <?php if(isset($error)){?>
            		<div class="alert alert-danger" role="alert" style="margin-top:120px"><?php echo $error;?></div>
           		 <?php }?>
            </form><?php } }?>
 <?php }else{?>
    	<p class="lead">您还没有通过实名认证无法进行充值！前往<u><a href="<?php echo site_url('usercenter/safe');?>">实名认证</a></u></p>
    <?php }?>
        </div>
    </div>
</div>


</body>
</html>