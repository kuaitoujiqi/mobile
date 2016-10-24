<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta name="baidu-site-verification" content="aKNhxbN0m7"/>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <?php /*?><link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo base_url();?>style/img/iphoneico.ico"><?php */?>
    <link rel="apple-touch-icon" href="<?php echo base_url();?>style/img/iphoneico.png"/>  
    <meta name="apple-mobile-web-app-title" content="快投机器">
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
			<div class="col-xs-7">
				<h3 style="font-size: 14px;margin-bottom:2px;margin-top:10px;color:#666;"> <?php echo $key['title'];?></h3>
			</div>
			<div class="col-xs-5">
				<h3 style="font-size:10px;color:#999;margin-bottom:2px;margin-top:12px;"><?php echo $key['creattime']; ?></h3>
			</div>
        </div>	
		<div>
			<hr style="margin-top:2px;" />
		</div>
        <div class="row list_one_count">
			<div class="col-xs-4 text-center">
				<span style="font-size:14px;color:#666;"><?php echo $key['rate']*100;?></span>%
				<br />
				<span style="font-size:12px;color:#999;">年化收益率</span>
			</div>
			<div class="col-xs-4" style="text-align: center;border-left: 1px solid #eee;border-right: 1px solid #eee;">
				<span style="font-size:14px;color:#666;"><?php echo $key['restmoney'];?></span>元
				<br />
				<span style="font-size:12px;color:#999;">可购余额</span>
			</div>
			<div class="col-xs-4 text-center">
				<span style="font-size:14px;color:#666;"><?php echo $key['day'];?></span>个月
				<br />
				<span style="font-size:12px;color:#999;">还款期限</span>
			</div>		
        </div>
		<div class="row" style="margin-top:10px;">
			<div class="col-xs-12 text-center">
				<p style="font-size:10px;">
            	<?php if($key['static'] == 1){?>
                <?php if($key['restmoney'] == 0){?>
                	<a class="btn  btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="border:1px solid #337ab7;color:#337ab7;">审核中</a>
                <?php }else{?>
                	<?php if($key['is_open'] == 1 and $key['creattime'] > date('Y-m-d H:i:s')){?>
                		<a class="btn btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="background-color:#337ab7;color:#fff;">即将上线</a>
                    <?php }else{?>
                    	<a class="btn  btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="background-color:#f68121;border:0px;color:#fff;">立即购买</a>
					<?php }?>
                <?php }?>
                <?php }?>
                <?php if($key['static'] == 2){?>
                	<a class="btn  btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="background-color:#cbd3de;border:0px;color:#fff;">还款中</a>	
                <?php }?>
                <?php if($key['static'] == 3){?>
                	<a class="btn btn-defalut btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">已结束</a>	
                <?php }?>			
				</p>
				
			</div>				
		</div>			
		<div class="row">
			<div class="col-xs-6 text-left">
				<span style="font-size:10px;color:#999;"><?php echo $key['introduction'];?></span>
			</div>
			<div class="col-xs-6 text-right"><span style="font-size:10px;color:#999;"><?php echo $key['repay'];?></span></div>
		</div>
    </div>
    <?php }?>

	<div class="" style="background:#fff;margin-top:10px;height:130px;padding-top:30px;">
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-5">
				<img src="<?php echo base_url();?>style/img/m/aliyun.png" width="100%" />
			</div>
			<div class="col-xs-5">
				<img src="<?php echo base_url();?>style/img/m/xinlang.png" width="100%" />	
			</div>
			<div class="col-xs-1"></div>
		</div>
		<div class="row" style="margin-top:20px;font-size:10px;">
			<div class="col-xs-2"></div>
			<div class="col-xs-8 text-center">
<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=3030954862&amp;site=qq&amp;menu=yes" style="opacity: 1;">
	<img src="<?php echo base_url();?>style/img/m/QQ.jpg" width="77" height="22">
</a>
				<!---
				<a href="<?php echo site_url('m/news/article/178');?>">关于我们</a>
				&nbsp;|&nbsp;
				<a href="<?php echo site_url('m/news/article/179');?>">安全保障</a>
				&nbsp;|&nbsp;
				<a href="<?php echo site_url('m/news/article/180');?>">风控体系</a>
				&nbsp;|&nbsp;
				<a href="<?php echo site_url('m/news/article/181');?>">联系我们</a>
				--->
				
			</div>
			<div class="col-xs-2"></div>
		</div>
	</div>
<?php $this->load->view('m/footer');?>
</body>
</html>



