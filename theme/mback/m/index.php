<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <?php /*?><link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo base_url();?>style/img/iphoneico.ico"><?php */?>
    <link rel="apple-touch-icon" href="<?php echo base_url();?>style/img/iphoneico.png"/>  
    <meta name="apple-mobile-web-app-title" content="蜂融网">
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    
    
    <title><?php echo $title;?></title>
    <meta name="keywords" content="<?php echo $keyword;?>" />
    <meta name="description" content="<?php echo $description;?>" />
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
<?php /*?>    <script type="text/javascript">
with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
    </script>
	<script language="javascript">
	window._bd_share_config = {
		share : [{
			"bdSize" : 32
		}]
	}
	</script>
	<script language="javascript">
    $(document).ready(function(){
		$('.reset_share').click(function(){
			$('.cshare').hide();
			$('.opendiv').hide();
		});
		$('#share_button').click(function(){
			$('.cshare').show();
			$('.opendiv').show();
		});
	});
    </script><?php */?>
	<style>

.bdshare-button-style0-32 { width:200px; margin:0 auto}
.opendiv{position:absolute; width:100%; height:100%; z-index:800;  opacity:0.3; background-color:#000}
.cshare{position:fixed;width:226px;margin:0 auto; bottom:20%; z-index:820; text-align:center; background-color:#f6f6f6; display:block; overflow:hidden; padding:20px; left:0px; right:0px}
.reset_share{ border:1px solid #c5c5c5; color:#666; border-radius:2px; height:40px; line-height:40px;background:-webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#eaeaea));background:-moz-linear-gradient(top, #ffffff,#eaeaea); margin-top:10px}
.index_list_one .row{ margin-left:0px; margin-right:0px}
    </style>
</head>


<body class="index">

<!--主导航--------------------------------------------------------------------------------------------->
<?php $this->load->view('m/head'); ?>

<!--焦点图--------------------------------------------------------------------------------------------->
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
        	<?php foreach($focus as $val=>$key){?>
            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $val;?>" class="active"></li>
            <?php }?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
        	<?php foreach($focus as $val=>$key){?>
            <div class="item <?php if($val ==0){?>active<?php }?>">
                <a href="<?php echo $key['m_url'];?>"><img src="<?php echo base_url().$key['m_photo'];?>" alt=""></a>
                <div class="carousel-caption">
                    ...
                </div>
            </div>
			<?php }?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
	

    <?php foreach($bulk as $val=>$key){?>
    <div class="index_list_one">
        <div class="row">
            <h3 class="col-xs-12" style="font-size: 16px;font-weight: bold;"> <?php echo $key['title'];?></h3>
        </div>
        <div class="row">
            <p class="col-xs-12 text-muted" style="font-size: 12px;"><?php echo $key['introduction'];?></p>
        </div>
        <div class="row list_one_count">
            <div class="col-xs-4">
                <?php echo $key['rate']*100;?>%/年
            </div>
            <div class="col-xs-4" style="text-align: center;border-left: 1px solid #eee;border-right: 1px solid #eee;">
                <?php echo $key['day'];?>个月
            </div>
            <div class="col-xs-4" style="text-align: right">
                <?php echo $key['money'];?>元
            </div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-xs-6 text-muted" style="font-size: 12px;">
                <?php echo $key['repay'];?>
            </div>
            <div class="col-xs-6">
            	<?php if($key['static'] == 1){?>
                <?php if($key['restmoney'] == 0){?>
                	<a class="btn btn-primary pull-right" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">审核中</a>
                <?php }else{?>
                	<?php if($key['is_open'] == 1 and $key['creattime'] > date('Y-m-d H:i:s')){?>
                		<a class="btn btn-success pull-right" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">即将上线</a>
                    <?php }else{?>
                    	<a class="btn btn-danger pull-right" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">余<?php echo $key['restmoney'];?>元</a>
					<?php }?>
                <?php }?>
                <?php }?>
                <?php if($key['static'] == 2){?>
                	<a class="btn btn-warning pull-right" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">还款中</a>	
                <?php }?>
                <?php if($key['static'] == 3){?>
                	<a class="btn btn-defalut pull-right" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">已结束</a>	
                <?php }?>
            </div>
        </div>
        <?php $buy_load = floor((($key['money'] - $key['restmoney'])/$key['money'])*100);//进度?>
        <div class="progress" style="margin-top: 10px;">
            <div class="progress-bar progress-bar-success progress-bar-striped pull-left" role="progressbar" aria-valuenow="<?php echo $buy_load;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $buy_load;?>%;line-height: 12px;">
               <?php echo $buy_load;?>%
            </div>
        </div>
	
    </div>
    <?php }?>



<!--推荐标的--------------------------------------------------------------------------------------------->

<?php /*?><div class="opendiv" style="display:none"></div>
<div class="cshare" style="display:none">
    <div class="bdsharebuttonbox bdshare-button-style0-32">
        <a data-cmd="weixin" class="bds_weixin">微信</a>
        <a data-cmd="sqq" class="bds_sqq">QQ好友</a>
        <a data-cmd="qzone" class="bds_qzone">QQ空间</a>
        <a data-cmd="tsina" class="bds_tsina">新浪微博</a>
        <a data-cmd="tqq" class="bds_tqq">腾讯微博</a>
    </div>
    <div class="reset_share">取消</div>
</div><?php */?>
<?php $this->load->view('m/footer');?>
</body>
</html>



