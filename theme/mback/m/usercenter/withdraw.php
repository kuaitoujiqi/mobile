<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>提现-蜂融网</title>
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
    $(document).ready(function() {
		$('#inputmonkey').on("keyup","#exampleInputAmount",function(){
			var monkey = $(this).val();
			if(isNaN(monkey) || monkey < 0)
			{
				$(this).val(0);
				$('#shouxufei').text('手续费:0.00'); //提现金额小于手续费额度		
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

				var edu =new Number($('#mianfeiedu').val());
				if(monkey <= edu)
				{
					$(this).val(monkey);
					$('#shouxufei').text('手续费:0.00'); //提现金额小于手续费额度	
				}
				else
				{
					var shouxufeimonkey = monkey - edu;
					var shouxufei = shouxufeimonkey * 0.005;
					if(shouxufei <= 2)
					{
						shouxufei = 2;
					}
					
					$(this).val(monkey);
					$('#shouxufei').text('手续费:'+shouxufei.toFixed(2));
				}
			}
		});
		$('#tixian').click(function(){
			var arg = {};
			arg['monkey'] = $('#exampleInputAmount').val();
			arg['setp'] = 1;
			$.post('<?php echo site_url('usercenter/form_withdraw');?>',arg,function(data,status){
				var data_json = JSON.parse(data);
				if(data_json[0] == 0)
				{
					$('[data-target="#buyModal"]').click(); //验证通过	
				}
				else
				{
					alert(data_json[1]);	
				}
			});
			//
		});
		
		$('#tixian_buy').click(function(){
			$(this).attr("disabled",true);
			$(this).text('提现处理中，请稍等');
			var arg = {};
			arg['monkey'] = $('#exampleInputAmount').val();
			arg['trading'] = $('#jjmm').val();
			arg['setp'] = 2;
			$.post('<?php echo site_url('m/usercenter/form_withdraw');?>',arg,function(data,status){
				var data_json = JSON.parse(data);
				if(data_json[0] == 0)
				{
					alert('提交成功');
					location.href = '<?php echo site_url('m/usercenter/record/7');?>';	
				}
				else
				{
					alert(data_json[1]);	
					$('#tixian_buy').attr("disabled",false);
					$('#tixian_buy').text('确认提现');
				}
			});
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
    <h3 class="page-header">提现</h3>
	<?php if(count($bank) <=0) {?>
                <p class="lead">您还没有绑定的银行卡！前往<u><a href="<?php echo site_url('m/usercenter/addbindbank');?>">绑定银行卡</a></u></p>
     <?php }else{?>
</div>
 <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">提现</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mt10" onSubmit="return false">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label col-lg-2">交易密码：</label>
                        <div class="col-lg-4">
                            <input type="password" class="form-control" placeholder="请输入您的交易密码" id="jjmm">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            	<a class="btn btn-warning pull-left" href="<?php echo site_url('usercenter/safe/jymm');?>" target="_blank">忘记交易密码?</a>
                <button type="button" class="btn btn-success col-lg-4 pull-right" id="tixian_buy">确认提现</button>
            </div>
        </div>
    </div>
</div>

<!--导航块--------------------------------------------------------------------------------------------->
<div class="container">
    <form id="recharge_form" class=" col-lg-8" style="margin-top: 10px;padding-left: 0" method="post" onSubmit="return false">
    <?php $userinfo = userinfo();?>
<input type="hidden" id="mianfeiedu" value="<?php echo $userinfo['quota'];?>">
        <div class="form-group" id="inputmonkey">
            <label for="inputEmail3" class="text-muted">请输入你的提现金额：</label>
            <div class="input-group col-lg-4">
                <div class="input-group-addon"><i class="glyphicon glyphicon-yen"></i></div>
                <input type="text" class="form-control input-lg" id="exampleInputAmount" placeholder="" name="monkey" value="">
            </div>
        </div>
        <div class="form_group">
        	 <p id="shouxufei">手续费:0.00</p>
        </div>

        <div class="form-group">
            <p class="text-muted" style="margin-top: 5px;">将为您支付提现手续费( 详情请参考<a href="https://www.kuaitoujiqi.com/news/article/11.html" target="_blank">《费用说明 》</a> )</p>
            <p class="text-danger" style="font-size:16px">注:单笔提现最大为5万，每日提现上限为50万！</p>

        </div>

        <div class="form-group" style="margin-top: 20px">
            <button type="submit" class="btn btn-lg btn-success btn-block" id="tixian">提现</button>
            <button type="button" class="header_btn btn btn-default" data-toggle="modal" data-target="#buyModal" id="ljgm_step2" style="display:none">提现第二步</button>
        </div>
    </form>

</div>


<?php }?>

<!--最近操作--------------------------------------------------------------------------------------------->
<?php $this->load->view('m/footer');?>

</body>
</html>

