<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title><?php echo $row['title'];?></title>
    <meta name="keywords" content="投资理财,网络理财,固定收益,本息保障,网络融资,互联网理财,互联网金融,P2P,P2C,P2P投资,P2P理财,网贷" />
    <meta name="description" content="提供安全、方便、快捷的投资理财服务，预期收益率10%-18%，第三方资金托管，科学风控，安全保障。" />
    <link href="" rel="apple-touch-icon-precomposed">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/base.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/index.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/lightbox.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url();?>style/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>style/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>style/js/base.js"></script>
    <script src="<?php echo base_url();?>style/js/lightbox.js"></script>
    <script>
        $('.carousel').carousel({
            interval: 2000
        })
    </script>
    <script language="javascript">
    $(document).ready(function(){
		$('#ljgm_step1').click(function(){
			var transferdid = $('#transferdid').val();
			$.get('/product/form_transfer/' + transferdid + "/1",function(data,status){
				if(data == "success")
				{
					$('#ljgm_step2').click();
				}
				else
				{
					alert(data);	
				}
			});
		});
		$(document).on('click', '#product_buy', function() {
			$('#product_buy').attr('disabled',true);
			$('#product_buy').text('处理中');
			var transferdid = $('#transferdid').val();
			var arg = {};
			arg['jjmm'] = $('#jjmm').val();
			$.post('/product/form_transfer/' + transferdid + "/2",arg,function(data,status){
				if(data == "success")
				{
					alert('购买成功');
					location.href = "<?php echo site_url('/usercenter');?>";
				}
				else
				{
					alert(data);
					$('#product_buy').attr('disabled',false);
					$('#product_buy').text('确认购买');	
				}
			});
		});
	});
	
	
    </script>
</head>
<body>
 <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">产品购买</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mt10">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label col-lg-2">交易密码：</label>
                        <div class="col-lg-4">
                            <input type="password" class="form-control" placeholder="请输入您的交易密码" id="jjmm">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success col-lg-4 pull-right" id="product_buy">确认购买</button>
            </div>
        </div>
    </div>
</div>



<?php $this->load->view('front/header');?>

<!-- --------------------------- 项目列表-------------------->

<div class="container detail_top">

    <h3 class="detail_title"><?php echo $row['title'];?></h3>
    <div class="col-xs-12">
        <div class="row" style="margin-right: -30px;">
            <div class="mt10 col-xs-12 col-md-9 detail_top_left">
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <img width="100%" class="detail_img" src="<?php echo $row['photo'];?>"/>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                <p class="detail_label">年化收益率</p>
                                <p class="detail_ini"><?php echo $row['rate']*100;?>%</p>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <p class="detail_label">项目期限</p>
                                <p class="detail_ini"><?php echo $row['day'];?>个月</p>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <p class="detail_label">项目规模</p>
                                <p class="detail_ini"><?php echo $row['money'];?></p>
                            </div>
                        </div>

                        <hr>
                        <p class="row" >
                            <span class="col-md-6 col-xs-12"><i class="glyphicon glyphicon-tags"></i> 项目编号：<?php echo $row['number'];?></span>
                            <span class="col-md-6 col-xs-12"><i class="glyphicon glyphicon-hourglass"></i> 发布日期：<?php echo date('Y年m月d日 H:i',strtotime($row['creattime']));?></span>
                        </p>

                        <p class="row">
                            <span class="detail_tip col-md-6 col-xs-12"><i class="glyphicon glyphicon-tower"></i> <?php echo $row['introduction'];?></span>
                            <span class="col-md-6 col-xs-12"><i class="glyphicon glyphicon-yen"></i>按月付息/到期还本</span>
                        </p>

                    </div>
                </div>
            </div>

        <div class="col-xs-3">
            <div class="detail_top_right">
            	<input type="hidden" id="transferdid" value="<?php echo $transfer['id'];?>">
            	<p class="mt10">项目还本日期：<b class="text-success" id="restmoney"><?php echo date('Y-m-d',$row['endtitme']-86400);?></b></p>
                <p class="mt10">项目原始价格：<b class="text-success" id="restmoney"><?php echo $transfer['holding'];?></b></p>
                <p class="mt10">项目转让价格：<b class="text-success" id="restmoney"><?php echo $transfer['monkey'];?></b></p>
                <p class="mt10">预计收益：<b class="text-success" id="restmoney"><?php echo $pro_info['interest'];?></b></p>
                <?php if($transfer['static'] == 3){?>
                <p class="mt10">转让时间：<b class="text-success" id="restmoney"><?php echo $transfer['sendeetime'];?></b></p>
				<?php }else{?>
                <p class="mt10">结束时间：<b class="text-success" id="restmoney"><?php echo date('Y-m-d H:i:s',$transfer['examine']-(-259200));?></b></p>
                <?php }?>
                
               <?php if($transfer['static'] == 2){?>
               <input type="button" class="btn btn-danger btn-block btn-lg mt10" id="ljgm_step1" value="立即购买">
               <?php }else{?>
               <a  class="btn btn-default btn-block btn-lg mt10">已完成</a>
			   <?php }?>
               <button type="button" class="header_btn btn btn-default" data-toggle="modal" data-target="#buyModal" id="ljgm_step2" style="display:none">购买</button>
            </div>
        </div>
    </div>

</div>
</div>

<div class="container detail_main">

	<?php $ex = explode('|',$row['typetitle']);?>
    <div class="col-xs-12 detail_main_left">
        <div class="row">
            <div class="col-xs-12 detail_con">
            	<?php if($row['describe'] !=""){?>
                <h3><?php echo $ex[0];?></h3>
                <hr>
                <?php echo $row['describe'];?>
                
                <?php }?>
				<?php if($row['scene'] !=""){?>
                <h3><?php echo $ex[3];?></h3>
                <hr>
                <div class="row">
               <?php foreach(explode("~",$row['scene']) as $key){?>
                   <div class="col-md-2 col-xs-6">
                       <a href="<?php echo $key;?>" data-lightbox="xmsj"  style="height:160px;display: inline-block;overflow: hidden;margin-bottom: 10px;border:1px solid #ddd;">
                           <img src="<?php echo $key;?>" width="100%"/>
                       </a>
                   </div>
               	<?php }?>
				</div>
                <?php }?>
            </div>

        </div>
        <div class=" row">
            <div class="col-xs-12 detail_con">
            	<?php if($row['assets'] !=""){?>
                <h3><?php echo $ex[1];?></h3>
                <hr>
                 <?php echo $row['assets'];?>
				<?php }?>
                
                <?php if($row['property'] !=""){?>
                <h3><?php echo $ex[5];?></h3>
                <hr>
                <?php foreach(explode("~",$row['property']) as $key){?>
                        <div class="col-md-2 col-xs-6">
                            <a href="<?php echo $key;?>" data-lightbox="xmsj"  style="height:160px;display: inline-block;overflow: hidden;margin-bottom: 10px;border:1px solid #ddd;">
                                <img src="<?php echo $key;?>" width="100%"/>
                            </a>
                        </div>
               	<?php }?>
                <?php }?>
            </div>
        </div>
        <div class=" row">
            <div class="col-xs-12 detail_con">
            	<?php if($row['pledge'] !=""){?>
                <h3><?php echo $ex[2];?></h3>
                <hr>
                 <?php echo $row['pledge'];?>
 				<?php }?>
                
                <?php if($row['control'] !=""){?>
                <h3><?php echo $ex[6];?></h3>
                <hr>
                <?php foreach(explode("~",$row['control']) as $key){?>
                        <div class="col-md-2 col-xs-6">
                            <a href="<?php echo $key;?>" data-lightbox="xmsj"  style="height:160px;display: inline-block;overflow: hidden;margin-bottom: 10px;border:1px solid #ddd;">
                                <img src="<?php echo $key;?>" width="100%"/>
                            </a>
                        </div>
               	<?php }?>
                 	<?php }?>
            </div>
        </div>
        <div class=" row">
            <div class="col-xs-12 detail_con">
            	<?php if($row['certificate'] !=""){?>
                <h3><?php echo $ex[4];?></h3>
                <hr>
                <?php foreach(explode("~",$row['certificate']) as $key){?>
                        <div class="col-md-2 col-xs-6">
                            <a href="<?php echo $key;?>" data-lightbox="xmsj"  style="height:160px;display: inline-block;overflow: hidden;margin-bottom: 10px;border:1px solid #ddd;">
                                <img src="<?php echo $key;?>" width="100%"/>
                            </a>
                        </div>
               	<?php }?>
               
 				<?php }?>
            </div>
        </div>
       <?php /*?> <div class=" row">
            <div class="col-xs-12 detail_con">
                <h3>投资记录</h3>
                <hr>
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th>用户名</th>
                        <th>购买金额</th>
                        <th>购买时间</th>
                    </tr>
                    <?php foreach($userproject as $key){?>
                    <tr>
                        <td><?php echo mb_substr($key['nickname'],0,3,'utf-8');?>****</td>
                        <td><?php echo $key['monkey'];?></td>
                        <td><?php echo date('Y-m-d H:i',$key['dateline']);?></td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div><?php */?>
    </div>

</div>

<?php $this->load->view('front/footer');?>
</body>
</html>
