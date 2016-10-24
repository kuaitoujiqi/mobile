<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>快捷支付-快投机器</title>
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
		/*
		$('#regesiter_btn').click(function(){
			$(this).attr('disabled',true);
			$(this).text('提交处理中');
			$('#regesiter_form').submit();
		});
		*/
		$("#regesiter_btn").click(function(){
			$(this).attr('disabled',true);
			$(this).text('提交处理中');			
			var money =  $('#exampleInputAmount').val();	
			$.post('/m/usercenter/send_recharge',{
				monkey:money
			},function(data){
				var obj = JSON.parse(data);
				
				if(obj.error == 0){
					document.write(obj.msg);
				}else{
					alert(obj.msg);
				}	
			})
		})		
	});
	</script>
</head>


<body class="index">

<?php $this->load->view('m/usercenter/menu_back',array('title'=>'充值','url'=>site_url('m/usercenter'))); ?>

<!--导航块--------------------------------------------------------------------------------------------->
<div class="container">
    <form id="regesiter_form" class=" col-lg-8" style="margin-top: 50px;padding-left: 0" method="post">
		<p class="alert alert-warning" style="margin-bottom: 5px;">网银在线支付限额与您在银行开通的网银支付额度一致，可咨询银行。</p>
        <div class="form-group" style="margin-top:20px;">
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
		<!---
            <p class="text-muted" style="margin-top: 5px;">平台支付充值费用( 详情请参考<a href="<?php echo site_url('news/article/11');?>" target="_blank">《费用说明 》</a> )</p>
		--->
            <?php //$bank_tishi = require('./data/bankinfo.php');$bank_tishi = $bank_tishi['q_pay_info'];?>
            <p class="text-danger" style="font-size:16px"><?php //echo $bank_tishi[$bank_row['bank_code']];?></p>
          
            

        </div>

        <div class="form-group" style="margin: 20px 0px">
            <button type="button" class="btn btn-lg btn-danger btn-block" id="regesiter_btn">充值</button>
        </div>
    </form>

</div>


<!--最近操作--------------------------------------------------------------------------------------------->

<?php $this->load->view('m/footer');?>
</body>
</html>



