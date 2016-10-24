<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>提现-快投机器</title>
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
			/*
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
					console.log(shouxufei);
					if(shouxufei <= 2)
					{
						shouxufei = 1.5;
					}
					
					$(this).val(monkey);
					$('#shouxufei').text('手续费:'+shouxufei.toFixed(2));
				}
			}
			*/
		});
		/*
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
		*/
		
		$('#tixian').click(function(){
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
					document.write(data_json[1]);
				}
				else
				{
					alert(data_json[1]);	
					$('#tixian').attr("disabled",false);
					$('#tixian').text('确认提现');
				}
			});
		});
	});
    </script>
</head>


<body class="index">

<?php $this->load->view('m/usercenter/menu_back',array('title'=>'提现','url'=>site_url('m/usercenter'))); ?>
<!--选项菜单--------------------------------------------------------------------------------------------->
<!-----
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
---->

<!--导航块--------------------------------------------------------------------------------------------->
<div class="container">
    <form id="recharge_form" class=" col-lg-8" style="margin-top: 50px;padding-left: 0" method="post" onSubmit="return false">
		<p class="alert alert-warning" style="margin-bottom: 5px;">注:单笔提现最大为5万，每日提现上限为50万！</p>
		<?php $userinfo = userinfo();?>
		<input type="hidden" id="mianfeiedu" value="<?php echo $userinfo['quota'];?>">
        <div class="form-group" id="inputmonkey" style="margin-top:20px;">
            <div class="input-group col-lg-4">
                <div class="input-group-addon"><i class="glyphicon glyphicon-yen"></i></div>
                <input type="text" class="form-control input-lg" id="exampleInputAmount" placeholder="" name="monkey" value="">
            </div>
        </div>
        <div class="form_group" style="margin-top:10px;">
			<?php if($shouxufei == 0){;?>
				<span class="text-success"><span style="text-decoration:line-through;">￥1.50</span> 由平台支付</span>
			<?php }else{?>
				<div>手续费 <span class="text-success" style="font-size:20px;">￥1.50</span></div>
				<div><span class="text-danger" style="line-height:14px;">今日免费提现次数用完</span></div>
			<?php }?>		
        </div>

        <div class="form-group" style="margin-top: 20px">
            <button type="submit" class="btn btn-lg btn-success btn-block" id="tixian">提现</button>
            <button type="button" class="header_btn btn btn-default" data-toggle="modal" data-target="#buyModal" id="ljgm_step2" style="display:none">提现第二步</button>
        </div>
    </form>

</div>



<!--最近操作--------------------------------------------------------------------------------------------->
<?php $this->load->view('m/footer');?>

</body>
</html>

