<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title><?php echo $row['title'];?>-快投机器</title>
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
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/lightbox.css">
    <script src="<?php echo base_url();?>style/js/lightbox.js"></script>
     <script language="javascript">
    $(document).ready(function(){
		//$('.col-xs-6 a.container').remove(); //删除ligtbox 第一个a
		$('div.detail_nav_one:first h4.col-xs-12,div.detail_nav_one:first div.col-xs-12').show();
		$('div.detail_nav_one div.col-xs-10').click(function(){
			$('div.detail_nav_one h4.col-xs-12,div.detail_nav_one div.col-xs-12').hide();
			var obj = $(this).parent('div.row').parent('div.detail_nav_one');
			obj.find('h4.col-xs-12').show();
			obj.find('div.col-xs-12').show();
		});
		
		$('#next_num').click(function(){
			var val = parseInt($('#amount').val()); //获取当前输入的份数
			update_amount(val-(-1));
		});	
		$('#prev_num').click(function(){
			var val = parseInt($('#amount').val()); //获取当前输入的份数
			update_amount(val-1);
		});
		
		$('#amount').blur(function(){
			var val = parseInt($('#amount').val()); //获取当前输入的份数
			if(val <=0 || val == 'NaN') 
			{
				var min_num = $('#min_amonut').val();//最小份数
			}
			else
			{
				var min_num = val;	
			}
			update_amount(min_num);
		});
		update_amount(parseInt($('#amount').val()));
		function update_amount(num)
		{
			var min_num = $('#min_amonut').val();//最小份数
			if(num < $('#min_amonut').val())
			{
				alert("不能低于最小购买份数");return;	
			}
			var each = parseInt($('#amount').attr('data')); //获取当前没份的金额
			$('#amount').val(num);
			$('#amonut_t').text(num);
			$('#countmonkey').text(num*each);//总金额
			var countmonkey = num*each;
			//计算利息
			var year = num*each*$('#rate').val();
			var lixi = (year/12)*$('#month').val();
			$('#lixi').text(lixi.toFixed(2));
		}
		$('#ljgm_step1').click(function(){
			var arg = {};
			arg['num'] = parseInt($('#amount').val());
			$.post('<?php echo site_url('m/product/buy_bulk/'.$row['id']);?>',arg,function(data,status){
				var obj = JSON.parse(data);

					if(obj.code == 2){
						alert(obj.msg);
						if(obj.msg == '请先登录'){
							location.href = "/m/welcome/login";
						}
						if(obj.msg == '您的余额不足'){
							location.href = "/m/usercenter/recharge";
						}
					}else{
						document.write(obj.msg);
					}	

			});
		});
		
		$('#ljgm_step2').click(function(){
			//获取红包
			var num =parseInt($('#amount').val());
			$('#red_papder_div').hide();	
			/*$.get('/product/red_paper/<?php echo $row['id'];?>/' + num,function(data,status){
				if(data != "")
				{
					
					var html = '<div class="radio"><label><input type="radio"   name="red_paper" class="red_paper" value="0" checked> 不使用</label></div>';
					$('#red_papder_big').html(html + data);	
					$('#red_papder_div').show();
				}
				else
				{
					$('#red_papder_div').hide();	
				}
			});*/
		});
		$('.quick_buy').click(function(){
			$('#amount').val($(this).attr('data'));
			update_amount(parseInt($('#amount').val()));
		});
		
		$(document).on('click', '#product_buy', function() {
			$(this).attr("disabled",true);
			$(this).text('购买处理中，请稍等');
			var btn_obj = $(this);
			var arg = {};
			arg['num'] = parseInt($('#amount').val());
			arg['red_papder'] = parseInt($('.red_paper:checked').val());
			arg['jjmm'] = $('#jjmm').val();
			$.post('<?php echo site_url('product/buy_bulk/'.$row['id']);?>',arg,function(data,status){
				if(data != "success")
				{
					alert(data);
					btn_obj.attr("disabled",false);
					btn_obj.text('确认购买');
				}
				else
				{
					alert('购买成功');
					location.href = "/m/usercenter";
				}
			});
		});
		
		$('#projectInfoBtn').click(function(){
			$("#projectInfo").show();
			$("#buyRecord").hide();
			$("#projectImg").hide();
		})
		$('#buyRecordBtn').click(function(){
			$("#projectInfo").hide();
			$("#buyRecord").show();	
			$("#projectImg").hide();	
		})
		$('#projectImgBtn').click(function(){
			$("#projectInfo").hide();
			$("#buyRecord").hide();	
			$("#projectImg").show();	
		})		
	});
    </script>
    <style type="text/css">
	a.container{ overflow:hidden; display:block; height:auto}
	div.detail_nav_one{ height:auto}
	div.detail_nav_one h4{ display:none}
	div.detail_nav_one div.col-xs-12{ display:none; padding-bottom:10px}
    </style>
    </head>

<body class="index" style="background:#fff;">
<div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">产品购买</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mt10" onSubmit="return false">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label col-lg-2">交易密码：</label>
                        <div class="col-lg-4">
                            <input type="password" class="form-control" placeholder="请输入您的交易密码" id="jjmm">
                        </div>
                    </div>
                    <div class="form-group" id="red_papder_div">
                        <label for="message-text" class="control-label col-lg-2">请选择红包：</label>
                        <div class="col-lg-4" id="red_papder_big">
                            <div class="radio">
                                <label>
                                    <input type="radio"  name="red_paper" class="red_paper" value="0" checked> 不使用
                                </label>
                            </div>                            
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            	<a class="btn btn-warning pull-left" href="<?php echo site_url('m/usercenter/trading');?>" target="_blank">忘记交易密码?</a>
                <button type="button" class="btn btn-success col-lg-4 pull-right" id="product_buy">确认购买</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('m/head'); ?>

<!--列表--------------------------------------------------------------------------------------------->
<!--
<div class="index_list_one" style="height:200px;padding-bottom: 10px;background:url('<?php echo base_url();?>style/img/m/bulk_bg.png');color:#fff;">
-->	
<div class="index_list_one" style="height:200px;padding-bottom: 10px;background:#23527c;color:#fff;">
	<div class="row" style="height:40px;line-height:40px;">
		<div class="col-xs-1"></div>
		<div class="col-xs-11"><?php echo $row['title'];?></div>
	</div>
	<div class="row text-center" style="height:120px;line-height:120px;">
		<div class="col-xs-12">年化收益率 <span style="font-size:25px;"><?php echo $row['rate']*100;?></span>%</div>
	</div>
	<div class="row text-right" style="height:40px;line-height:40px;">
		<div class="col-xs-11"><?php echo $row['repay'];?></div>
		<div class="col-xs-1"></div>
	</div>
</div>

<div>
	<div class="row" style="margin:20px auto;">
		<div class="col-xs-4 text-center">
			<span style="font-size:14px;color:#666;"><?php echo $row['money'];?></span>元
			<br />
			<span style="font-size:12px;color:#999;">项目总额</span>
		</div>
		<div class="col-xs-4 text-center" style="border-left: 1px solid #eee;border-right: 1px solid #eee;">
			<span style="font-size:14px;color:#666;"><?php echo $row['restmoney'];?></span>元
			<br />
			<span style="font-size:12px;color:#999;">可购余额</span>		
		</div>
		<div class="col-xs-4 text-center">
			<span style="font-size:14px;color:#666;"><?php echo $row['day'];?></span>个月
			<br />
			<span style="font-size:12px;color:#999;">还款期限</span>		
		</div>
	</div>
</div>

<div>
	<?php $buy_load = floor((($row['money'] - $row['restmoney'])/$row['money'])*100);//进度?>
    <div class="progress" style="margin-top: 10px;">
        <div class="progress-bar progress-bar-info progress-bar-striped pull-left" role="progressbar" aria-valuenow="<?php echo $buy_load;?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $buy_load;?>%;line-height: 12px;">
            <?php echo $buy_load;?>%
        </div>
    </div>
</div>

<div class="index_list_one">
	<div class="row">
		<div class="col-xs-12">
		



<?php if($row['static'] == 2){?>
<div class="index_list_one" style="padding-top:10px;padding-bottom: 10px;">
	<div class="row" style="margin-top: 10px;">
        <div class="col-xs-12">
            <button class="btn  btn-block" style="background-color:#cbd3de;border:0px;color:#fff;">还款中</button>
        </div>
    </div>
</div>
<?php }?>

<?php if($row['static'] == 3){?>
<div class="index_list_one" style="padding-top:10px;padding-bottom: 10px;">
	<div class="row" style="margin-top: 10px;">
        <div class="col-xs-12">
            <button class="btn btn-default btn-block">已结束</button>
        </div>
    </div>
</div>
<?php }?>

<?php if($row['static'] == 1){?>
<?php  if($row['restmoney'] == 0){ //审核中?>
<div class="index_list_one" style="padding-top:10px;padding-bottom: 10px;">
	<div class="row" style="margin-top: 10px;">
        <div class="col-xs-12">
            <button class="btn  btn-block" style="border:1px solid #337ab7;color:#337ab7;">审核中</button>
        </div>
    </div>
</div>
<?php }else{?>
<?php if($row['is_open'] == 1 and $row['creattime'] > date('Y-m-d H:i:s')){ //预告中?>
<div class="index_list_one" style="padding-top:10px;padding-bottom: 10px;">
	<div class="row" style="margin-top: 10px;">
        <div class="col-xs-12">
            <button class="btn  btn-block" style="background-color:#337ab7;color:#fff;">即将上线</button>
			<!-----
            <script language="javascript" src="<?php echo base_url();?>style/js/jquery.countdownTimer.min.js"></script>
            <script language="javascript">
                    $(function(){
                        $(".time_count").countdowntimer({
                            startDate:"<?php echo date('Y/m/d H:i:s'); ?>",
							dateAndTime : "<?php echo date('Y/m/d H:i:s',strtotime($row['creattime']));?>",
                            size : "lg",
                            regexpMatchFormat: "([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",
                            regexpReplaceWith: "<span>$2</span>小时<span>$3</span>分<span>$4</span>秒",
                            timeUp : timeisUp
                        });
                        function timeisUp() {
                            alert('项目开始了');
							location.reload();
                        }
                    });
                    </script>
                    <div style="margin-top:10px"><span style="float:left">距开始还有：</span>
                    	<div class="time_count" style="float:left">
                        	<span>10</span>小时<span>30</span>分<span>15</span>秒
                    	</div>
                    </div> 
            ----->        
        </div>
    </div>
</div>
<?php }else{ //开放购买?>
		
	<input type="hidden" name="min_amonut" id="min_amonut" value="<?php echo $row['amount'];?>">
	<input type="hidden" id="rate" value="<?php echo $row['rate'];?>">
	<input type="hidden" id="month" value="<?php echo $row['day'];?>">
	<div class="row" style="background-color:#fff;">
			<div class="col-xs-5">
				<div class="input-group">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button" id="prev_num">-</button>
					</span>
					<input id="amount" class="form-control" type="text" style="text-align: center" value="<?php echo $row['amount'];?>" data="<?php echo $row['each'];?>" id="amount"/>
					<span class="input-group-btn">
						<button class="btn btn-default" type="button" id="next_num">+</button>
					</span>
				</div>
			</div>
			<div class="col-xs-7">
				<div style="font-size: 12px;">总计<b class="text-success" id="countmonkey"><?php echo $row['amount']*$row['each'];?></b> 元，可赚<b class="text-success" id="lixi"></b> 元</div>
				<div style="font-size: 12px;"> 剩余金额：<?php echo $row['restmoney'];?> (<?php echo $row['each'];?>元/份)</div>
			</div>
	</div>
	<div class="row" style="margin-top: 10px;background-color:#fff;">
			<div class="col-xs-12">
				<div class="btn-group btn-group-justified" role="group" aria-label="" style=" margin-bottom:10px;">
				<a class="btn btn-default quick_buy" role="button" data="10">10份</a>
				<a class="btn btn-default quick_buy" role="button" data="50">50份</a>
				<a class="btn btn-default quick_buy" role="button" data="100">100份</a>
				<a class="btn btn-default quick_buy" role="button" data="300">300份</a>
				<a class="btn btn-default quick_buy" role="button" data="500">500份</a>
				</div>

			</div>
	</div>
	<div class="row">
			<div class="col-xs-12">
				<button class="btn  btn-block" id="ljgm_step1" style="background-color:#f68121;border:0px;color:#fff;">立即购买</button>
				<button type="button" class="header_btn btn btn-default" data-toggle="modal" data-target="#buyModal" id="ljgm_step2" style="display:none">购买</button>			
			</div>	
	</div>	

<?php } } }?>

		</div>
	</div>
</div>

<div id="footer_scroller"></div>
<style>
.iphone{ width:100%; height:58px; padding-top:5px; padding-bottom:4px; overflow:hidden; background:#FFF; margin:0px auto; position:fixed; bottom:0px; border-top:1px solid #ccc; margin-top:58px; z-index:999}
.iphone div{ width:24.9999%; height:auto; text-align:center; float:left; font-size:12px; line-height:22px;}
.iphone div a{ color:#36404b;}
</style>
<div style="height:0px; overflow:hidden; width:100%"></div>
<div class="iphone">
	<div><a href="<?php echo site_url('m');?>"><img src="<?php echo base_url();?>style/img/phoneimg1.png" width="19"><br>首页</a></div>
	<div><a href="<?php echo site_url('m/product/bulk_standard_list');?>"><img src="<?php echo base_url();?>style/img/phoneimg3.png" width="17"><br>投资列表</a></div>
    <div><a href="<?php echo site_url('m/usercenter');?>"><img src="<?php echo base_url();?>style/img/phoneimg2.png" width="19"><br>个人中心</a></div>
    
    <div><a href="<?php echo site_url('m/news');?>"><img src="<?php echo base_url();?>style/img/phoneimg4.png" width="12"><br>更多</a></div>
</div>

<div class="index_list_one">
	<div class="row">
		<div class="col-xs-12">
			<div class="btn-group btn-group-justified" role="group" aria-label="" style=" margin-bottom:10px;">
				<a id="projectInfoBtn" class="btn btn-default" role="button">项目详情</a>
				<a id="projectImgBtn" class="btn btn-default" role="button">项目资料</a>
				<a id="buyRecordBtn" class="btn btn-default" role="button">投资记录</a>
			</div>		
		</div>
	</div>
</div>

<style>
.info-list{
	padding:0;
	margin:5px 10px;
	list-style-position:inside;
	color:#666;
}
.info-list li{
	height:30px;
	line-height:30px;
	font-size:16px;
}
</style>

<div class="index_list_one" style="padding-bottom:70px;">
	<div class="row">
		<div class="col-xs-12">
			<div id="buyRecord" style="border:1px solid #ccc;border-radius:5px;display:none;">
				<h4 class="col-xs-12">投资记录</h4>
				<div>
					<table class="table table-striped">
						<tbody>
							<tr>
								<th>用户名</th>
								<th>购买金额</th>
								<th>购买时间</th>
							</tr>
							<?php foreach($userproject as $key){?>
							<tr>
								<td><?php echo msubstr($key['nickname'],0,3);?>****</td>
								<td><?php echo $key['monkey'];?></td>
								<td><?php echo date('Y-m-d H:i',$key['dateline']);?></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</div>	
			</div>
		
			<div id="projectInfo" style="border:1px solid #ccc;border-radius:5px;">
				<ul class="info-list">
					<?php $ex = explode('|',$row['typetitle']);?>
					<?php if($row['assets'] !=""){?>
					<li><?php echo $ex[1];?></li>
					<div style='width:100%;'><?php echo $row['assets'];?></div>
					<?php }?>
					
					<?php if($row['pledge'] !=""){?>
					<li><?php echo $ex[2];?></li>
					<div><?php echo $row['pledge'];?></div>
					<?php }?>
					
					<?php if($row['describe'] !=""){?>
					<li><?php echo $ex[0];?></li>
					<div><?php echo $row['describe'];?></div>
					<?php }?>					
				</ul>
			</div>
			
			<div id="projectImg" style="border:0px solid #ccc;border-radius:5px;display:none;">
				<div class="col-xs-12">	
					<ul class="info-list">
						<li><?php echo $ex[4];?></li>
						<div class="row">
							<?php foreach(explode("~",$row['certificate']) as $key){?>
							<div class="col-xs-6 dealImgFrame">
								<a href="https://www.kuaitoujiqi.com<?php echo $key;?>" data-lightbox="certificate" class="thumbnail">
									<img src="https://www.kuaitoujiqi.com<?php echo $key;?>" width="100%"/>
								</a>
							</div>
							<?php }?>												
						</div>						

						<li><?php echo $ex[5];?></li>
						<div class="row">
							<?php foreach(explode("~",$row['property']) as $key){?>
							<div class="col-xs-6 dealImgFrame">
								<a href="https://www.kuaitoujiqi.com<?php echo $key;?>" data-lightbox="certificate" class="thumbnail">
									<img src="https://www.kuaitoujiqi.com<?php echo $key;?>" width="100%"/>
								</a>
							</div>
							<?php }?>							
						</div>	

						<li><?php echo $ex[6];?></li>
						<div class="row">
							<?php foreach(explode("~",$row['control']) as $key){?>
							<div class="col-xs-6 dealImgFrame">
								<a href="https://www.kuaitoujiqi.com<?php echo $key;?>" data-lightbox="certificate" class="thumbnail">
									<img src="https://www.kuaitoujiqi.com<?php echo $key;?>" width="100%"/>
								</a>
							</div>
							<?php }?>												
						</div>						
				
					</ul>
				</div>	
			</div>

		</div>
	</div>
</div>
<script src="<?php echo base_url();?>style/js/lightbox-plus-jquery.js"></script>
</body>
</html>
