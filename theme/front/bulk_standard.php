<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title><?php echo $row['title'];?>_快投机器</title>
    <meta name="keywords" content="投资理财,网络理财,固定收益,本息保障,网络融资,互联网理财,互联网金融,P2P,P2C,P2P投资,P2P理财,网贷" />
    <meta name="description" content="投资理财,网络理财,固定收益,本息保障,网络融资,互联网理财,互联网金融,P2P,P2C,P2P投资,P2P理财,网贷" />
    <!--<meta name="viewport" content="width=device-width"> -->
    <link href="" rel="apple-touch-icon-precomposed">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/base.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/index.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/lightbox.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
   	<script src="<?php echo base_url();?>style/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>style/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url();?>style/js/base.js"></script>
   <script>
        $('.carousel').carousel({
            interval: 2000
        })
    </script>
    <script language="javascript">
    $(document).ready(function(){
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
		
		//

		//弹出提示框以后
		$("#ljgm_step1").click(function(){
			var arg = {};
			arg['num'] = parseInt($('#amount').val());
			$.post('<?php echo site_url('usercenter/check_balance/');?>',{
			},function(data){
				if(arg['num']*100 > data){
					
					$("#show_faild").click();
				}else{
					
					$("#show_success").click();
				}	
			})	
		})
		
		//去充值
		$("#goRecharge").click(function(){
			location.href = "/usercenter/recharge.html"
		})
		
		//去支付
		$("#submitBulk").click(function(){
			var arg = {};
			arg['num'] = parseInt($('#amount').val());
			$.post('<?php echo site_url('product/buy_bulk/'.$row['id']);?>',arg,function(data,status){
				var obj = JSON.parse(data);
				if(obj.code == 2)
				{
					$("#show_faild").click();
				}else{
					document.write(obj.msg);
				}
			});	
		});	

		
		$('#ljgm_step2').click(function(){
			//获取红包
			var num =parseInt($('#amount').val());
			$.get('/product/red_paper/<?php echo $row['id'];?>/' + num,function(data,status){
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
			});
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
				$('#jjmm').val('');
				$('#buyModal').modal('hide');
				if(data != "success")
				{
					$('#info_tishi .content').css('color','#D9534F');
					$('#info_tishi .content').html(data);
					$('#info_tishi .buttons button').removeClass('btn-success');
					$('#info_tishi .buttons button').addClass('btn-danger');
					$('#info_tishi .buttons button').text('关闭');
					$('#info_tishi').attr('data',2);
					$('#info_tishi').modal('show');
					btn_obj.attr("disabled",false);
					btn_obj.text('确认购买');
				}
				else
				{
					$('#info_tishi .content').css('color','#000000');
					$('#info_tishi .content').html('投资成功！');
					$('#info_tishi .buttons button').removeClass('btn-danger');
					$('#info_tishi .buttons button').addClass('btn-success');
					$('#info_tishi .buttons button').text('去查看');
					$('#info_tishi').attr('data',1);
					$('#info_tishi').modal('show');
					
				}
			});
		});
		
		
		$('#info_tishi').on('hidden.bs.modal', function (e) {
			var data = $('#info_tishi').attr('data');
			if(data == 1)
			{
				location.href = "/usercenter/record/2";	
			}
		});
		
		$('#info_tishi .buttons button').click(function(){
			$('#info_tishi').modal('hide');
		});
	});
	
	
    </script>
</head>
<body STYLE="background: #f2f2fd">
<div class="modal fade bs-example-modal-sm in" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="info_tishi" data="1">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="mySmallModalLabel">信息提示</h4>
        </div>
        <div class="modal-body">
          	<div class="content" style="height:70px; line-height:70px; font-size:18px; text-align:center">购买成功!</div>
            <div class="buttons" style="text-align:right"><button class="btn btn-success">去查看</button></div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

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
            	<a class="btn btn-warning pull-left" href="<?php echo site_url('usercenter/safe/jymm');?>" target="_blank">忘记交易密码?</a>
                <button type="button" class="btn btn-success col-lg-4 pull-right" id="product_buy" >确认购买</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('front/header');?>






<style>
.info_text{
	font-size:12px;	
}
#list_select_frame{
	overflow:hidden;
	background: #fff;
	padding:20px 0;
	height:220px;	
}
#list_select_button{
	background:#fff;
	padding:20px 0;
	height:20px;
	font-size:16px;
	border-bottom:2px solid #ccc;
}
.info_text_red{
	color:#ff0000;
}
.info_list>div{
	font-size:12px;
	line-height:30px;
}
.info_list>div:nth-of-type(6){
	width:200px;
}
.list_title_underline{
	width:;
	height:3px;
	background:#00aac6;
	position:relative;
	top:3px;
}
.text-red{
	color:#aa0000;
}
</style>
	
<!----------------------------- 项目详情页-------------------->
		<div class="container detail_top" style="background:#fff;">
            <div class="row" style="margin-bottom:10px;">	
				<div style="margin:20px auto 10px 30px">
				<h4>
					<?php echo $row['title'];?>
				</h4>
				</div>
                <div class="col-xs-12 col-md-3 text-center" style="padding-left: 0;padding-right: 0;overflow:hidden;">
                    <img class="list_img" src="<?php echo $row['photo'];?>"  height="158" style="margin:10px auto auto 20px;">
                </div>
                <div class="col-xs-12 col-md-6" style="padding-left: 0;padding-right: 0;">
					<div class="row info_list" style="margin:20px auto;">
						<div class="col-xs-12 col-md-2 text-center info_list_detail">
							<div class="row" style="margin-top:20px;">
								<span class="info_text">￥<span class="font-size-18"><?php echo $row['money'];?></span></span><br />借款金额
							</div>
						</div>
						<div class="col-xs-12 col-md-2 text-center info_list_detail">
							<div class="row" style="margin-top:20px;">
								<span class="info_text info_text_red"><span class="font-size-18"><?php echo $row['rate']*100;?></span>%</span><br />年化收益率
							</div>
						</div>
						<div class="col-xs-12 col-md-2 text-center info_list_detail">
							<div class="row" style="margin-top:20px;">
								<span class="info_text"><span class="font-size-18"><?php echo $row['day'];?></span>个月</span><br />期限
							</div>
						</div>
						<div class="col-xs-12 col-md-2 text-center info_list_detail">
							<div class="row" style="margin-top:20px;">
								<span class="info_text info_text_red">￥<span class="font-size-18"><?php echo $row['restmoney'];?></span></span><br />可购余额
							</div>
						</div>
						<div class="col-xs-12 col-md-4 text-center">
							<div class="row" style="margin-top:20px;"><?php echo $row['repay'];?><br />还款方式</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-11 col-md-11 text-center">
							<div class="progress progress-striped" style="height:10px;margin-left:20px;width:97%;">
							   <div class="progress-bar progress-bar-info active" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ((int)$row['money']-(int)$row['restmoney'])/(int)$row['money']*100;?>%;">
								  <span class="sr-only"><?php echo ((int)$row['money']-(int)$row['restmoney'])/(int)$row['money']*100;?>%</span>
							   </div>
							</div>
						</div>
						<div class="col-xs-1 col-md-1"></div>
					</div>
                </div>
				
				<div class="mt10 col-md-3 col-xs-12" style="margin:-15px 0 0 -10px;">
					<div class="detail_top_right">
                	<?php if($row['static'] == 1){?>
                    <?php  if($row['restmoney'] == 0){ //审核中?>
                    <input type="button" class="btn btn-primary btn-block btn-lg mt10"   value="审核中" disabled="disabled">
                    <?php }else{?>
                    
                    <?php if($row['is_open'] == 1 and $row['creattime'] > date('Y-m-d H:i:s')){ //预告中?>
                     <input type="button" class="btn btn-success btn-block btn-lg mt10"   value="即将上线" disabled="disabled"> 
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
                    <!--- 
                     <div class="time_count text-red">
                        距开始还有：<span>10</span>小时<span>30</span>分<span>15</span>秒
                    </div>
					--->
					
                    <?php }else{ //开放购买?>
                     <p class="mt10">剩余金额：<b class="text-success" id="restmoney"><?php echo $row['restmoney'];?></b> <span class="text-muted">(<?php echo $row['each'];?>元/份)</span></p>
                    <input type="hidden" name="min_amonut" id="min_amonut" value="<?php echo $row['amount'];?>">
                    <input type="hidden" id="rate" value="<?php echo $row['rate'];?>">
                    <input type="hidden" id="month" value="<?php echo $row['day'];?>">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" id="prev_num">-</button>
                        </span>
                        <input type="text" class="form-control" value="<?php echo $row['amount'];?>" style="text-align: center;z-index:0;" data="<?php echo $row['each'];?>" id="amount">
                        <span class="input-group-btn"><button class="btn btn-default" type="button" id="next_num">+</button></span>
                    </div>
                    <p class="mt10" style="font-size: 12px;">共 <b class="text-success" id="amonut_t"><?php echo $row['amount'];?> </b>份，总计 <b class="text-success" id="countmonkey"> <?php echo $row['amount']*$row['each'];?></b> 元，可赚 <b class="text-success" id="lixi"></b> 元</p>
						<?php if($this->session->userdata('uid')){ ?>
							<!---<input type="button" class="btn btn-danger btn-block btn-lg mt10"  id="ljgm_step1" value="立即购买">--->
							<button type="button" class="btn btn-danger btn-block btn-lg mt10" id="ljgm_step1" >立即购买</button>
							<button type="button" class="btn btn-danger btn-block btn-lg mt10" data-toggle="modal" data-target="#bulkSuccess" id="show_success" style="display:none;" >成功</button>
							<button type="button" class="btn btn-danger btn-block btn-lg mt10" data-toggle="modal" data-target="#bulkFaild" id="show_faild" style="display:none;" >失败</button>
						<?php }else{ ?>
							<a role="btn" class="btn btn-danger btn-block btn-lg mt10" href="<?php echo site_url('welcome/login_frame');?>" target="_blank">请先登录</a>	
						<?php } ?>
                      <button type="button" class="header_btn btn btn-default" data-toggle="modal" data-target="#buyModal" id="ljgm_step2" style="display:none">购买</button>
                    <?php } } }?>
                   
                    
                    <?php if($row['static'] == 2){?>
                    <input type="button" class="btn btn-warning btn-block btn-lg mt10" value="还款中" disabled="disabled">
                    <?php }?>
                    <?php if($row['static'] == 3){?>
                    <input type="button" class="btn btn-default btn-block btn-lg mt10" value="已结束" disabled="disabled">
                    <?php }?>								  
                    <?php if($row['static'] == 4){?>
                    <input type="button" class="btn btn-default btn-block btn-lg mt10" value="初审中" disabled="disabled">
                    <?php }?>								  
					</div>
				</div>					
			</div>	
			<div class="row deal_detail_type">
				<div class="col-md-3">
					<img src="/../style/img/deal_pro_1.png" />
					<span class="">项目编号：<?php echo $row['number'];?></span>
				</div>
				<div class="col-md-3">
					<img src="/../style/img/deal_pro_2.png" />
					<span class="">发布日期：<?php echo date('Y年m月d日 H:i',strtotime($row['creattime']));?></span>
				</div>
				<div class="col-md-3">
					<img src="/../style/img/deal_pro_3.png" />
					<span class="">项目类型：<?php echo $row['introduction'];?></span>
				</div>
				<div class="col-md-3">
					<img src="/../style/img/deal_pro_4.png" />
					<span class="">还款方式：<?php echo $row['repay'];?></span>
				</div>
			</div>
		</div>
		<?php $ex = explode('|',$row['typetitle']);?>
		<?php if($row['describe'] !=""){?>
		<div class="container mt10"  style="background:#fff;margin:20px auto;">
			<div class="row" style="margin:10px;">
				<h4 style="border-left:4px solid #00aac6;padding-left:10px;"><?php echo $ex[0];?></h4>
				<div style="width:98%;border-top:1px solid #888;margin:-7px auto 10px auto;"></div>
				<div style="margin:20px;line-height:20px;">
					<?php echo $row['describe'];?>
				</div>	
			</div>
		</div>
		<?php }?>	
		
		<?php if($row['assets'] !=""){?>
		<div class="container mt10"  style="background:#fff;margin:20px auto;">
			<div class="row" style="margin:10px;">
				<h4 style="border-left:4px solid #00aac6;padding-left:10px;"><?php echo $ex[1];?></h4>
				<div style="width:98%;border-top:1px solid #888;margin:-7px auto 10px auto;"></div>
				<div style="margin:20px;line-height:20px;">
				<?php echo $row['assets'];?>	
				</div>	
			</div>
		</div>		
		<?php }?>
		
		<?php if($row['pledge'] !=""){?>
		<div class="container mt10"  style="background:#fff;margin:20px auto;">
			<div class="row" style="margin:10px;">
				<h4 style="border-left:4px solid #00aac6;padding-left:10px;"><?php echo $ex[2];?></h4>
				<div style="width:98%;border-top:1px solid #888;margin:-7px auto 10px auto;"></div>
				
				<div style="margin:20px;line-height:20px;">
				<?php echo $row['pledge'];?>
				</div>	
			</div>
		</div>
		<?php }?>
        
        <?php if($row['scene'] !=""){?>
		<div class="container mt10 detail_nav_one"  style="background:#fff;margin:20px auto;">
			<div class="row" style="margin:10px;">
				<h4 style="border-left:4px solid #00aac6;padding-left:10px;"><?php echo $ex[3];?></h4>
				<div style="width:98%;border-top:1px solid #888;margin:-7px auto 10px auto;"></div>
				
				<div class="row" style="margin:20px auto;line-height:20px;">
					<?php foreach(explode("~",$row['scene']) as $key){?>
					<div class="col-md-2 col-xs-6 dealImgFrame">
<a href="<?php echo $key;?>" data-lightbox="xmsj" class="example-image-link" data-title=""><img width="100%" src="<?php echo $key;?>"  class="example-image"/></a>
					</div>
					<?php }?>
				</div>	
			</div>
		</div>		
		<?php }?>
        
        <?php if($row['certificate'] !=""){?>
		<div class="container mt10"  style="background:#fff;margin:20px auto;">
			<div class="row" style="margin:10px;">
				<h4 style="border-left:4px solid #00aac6;padding-left:10px;"><?php echo $ex[4];?></h4>
				<div style="width:98%;border-top:1px solid #888;margin:-7px auto 10px auto;"></div>
				
				<div style="margin:20px;line-height:20px;">
					<div class="row" style="margin:20px auto;line-height:20px;">
						<?php foreach(explode("~",$row['certificate']) as $key){?>
						<div class="col-md-2 col-xs-6 dealImgFrame">
							<a href="<?php echo $key;?>" data-lightbox="certificate" class="thumbnail">
								<img src="<?php echo $key;?>" width="100%"/>
							</a>
						</div>
						<?php }?>
					</div>				
				</div>	
			</div>
		</div>		
		<?php }?>	
        
        <?php if($row['property'] !=""){?>
		<div class="container mt10"  style="background:#fff;margin:20px auto;">
			<div class="row" style="margin:10px;">
				<h4 style="border-left:4px solid #00aac6;padding-left:10px;"><?php echo $ex[5];?></h4>
				<div style="width:98%;border-top:1px solid #888;margin:-7px auto 10px auto;"></div>
				
				<div style="margin:20px;line-height:20px;">
					<div class="row" style="margin:20px auto;line-height:20px;">
						<?php foreach(explode("~",$row['property']) as $key){?>
						<div class="col-md-2 col-xs-6 dealImgFrame">
							<a href="<?php echo $key;?>" data-lightbox="property" class="thumbnail">
								<img src="<?php echo $key;?>" width="100%"/>
							</a>
						</div>
						<?php }?>
					</div>				
				</div>	
			</div>
		</div>		
		<?php }?>
        
		<?php if($row['control'] !=""){?>
		<div class="container mt10"  style="background:#fff;margin:20px auto;">
			<div class="row" style="margin:10px;">
				<h4 style="border-left:4px solid #00aac6;padding-left:10px;"><?php echo $ex[6];?></h4>
				<div style="width:98%;border-top:1px solid #888;margin:-7px auto 10px auto;"></div>
				
				<div style="margin:20px;line-height:20px;">
					<div class="row" style="margin:20px auto;line-height:20px;">
						<?php foreach(explode("~",$row['control']) as $key){?>
						<div class="col-md-2 col-xs-6 dealImgFrame">
							<a href="<?php echo $key;?>" data-lightbox="control" class="thumbnail">
								<img src="<?php echo $key;?>" width="100%"/>
							</a>
						</div>
						<?php }?>
					</div>				
				</div>	
			</div>
		</div>		
		<?php }?>		
		
		<div class="container mt10"  style="background:#fff;margin:20px auto;">
			<?php $ex = explode('|',$row['typetitle']);?>
			<div class="row" style="margin:10px;">
				<h4 style="border-left:4px solid #00aac6;padding-left:10px;">投资记录</h4>
				<div style="width:98%;border-top:1px solid #888;margin:-7px auto 10px auto;"></div>
				
				<div style="margin:20px;line-height:20px;">
					<table class="table table-striped" style="border:1px solid #f9f9f9;">
						<thead style="background:#00aac6;color:#fff;">
							<tr>
								<th>用户名</th>
								<th>购买金额</th>
								<th>购买时间</th>
							</tr>
						</thead>
						<tbody>
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
		</div>		

<!-- 投标失败 -->
<div class="modal fade" id="bulkFaild" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header" style="border-bottom:0px solid #000;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <div class="modal-body">
			<div class="row">
				<div class="col-xs-1 col-md-1"></div>
				<div class="col-xs-5 col-md-5">
					<img class="full-left" src="<?php echo base_url();?>style/img/footer/bulkForbbiden.png" width="150" />
					<img class="full-left" src="<?php echo base_url();?>style/img/footer/pline.png" />
					<div class="clear"></div>
				</div>
				<div class="col-xs-5 col-md-5 text-center">
					<p style="margin-top:20px;"><img src="<?php echo base_url();?>style/img/footer/wrong.png" /></p>
					<h3 class="text-danger" style="margin-top:20px;">失败啦！</h3>
					<p style="margin-top:20px;">您的账户余额不足！</p>
					<p style="margin-top:20px;">   
						<div class="row">
							<div class="col-xs-6 col-md-6">
								<button type="button" class="btn btn-info btn-block" id="goRecharge">去 充 值</button>
							</div>
							<div class="col-xs-6 col-md-6">
								<button type="button" class="btn btn-default btn-block" data-dismiss="modal">关 闭</button>	
							</div>
						</div>					
					</p>
				</div>
				<div class="col-xs-1 col-md-1"></div>
			</div>
         </div>
      </div>
   </div>
</div>

<style>
.text-kt{
	color:#00aac6;
}
</style>

<!-- 投标成功 -->
<div class="modal fade" id="bulkSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header" style="border-bottom:0px solid #000;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <div class="modal-body">
			<div class="row" style="margin-top:20px;">
				<div class="col-xs-1 col-md-1"></div>
				<div class="col-xs-5 col-md-5">
					<img class="full-left" src="<?php echo base_url();?>style/img/footer/bulkAlert.png" width="200" />
					<img class="full-left" src="<?php echo base_url();?>style/img/footer/pline.png" />
					<div class="clear"></div>
				</div>
				<div class="col-xs-5 col-md-5 text-center">
					<h4 class="text-kt" style="margin-top:50px;">交易订单锁定 <span class="text-danger" style="font-size:20px;">5分钟</span></h4>
					<p>请尽快完成支付！</p>
					<p style="margin-top:20px;">            
						<button type="button" class="btn btn-info btn-block" id="submitBulk" data-dismiss="modal">
						   确 定
						</button>
					</p>
				</div>
				<div class="col-xs-1 col-md-1"></div>
			</div>
         </div>
      </div>
   </div>
</div>		
		
		
		
<?php $this->load->view('front/footer');?>
<script src="<?php echo base_url();?>style/js/lightbox-plus-jquery.js"></script>
</body>
</html>
