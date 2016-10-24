<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title><?php echo $row['name'];?>_快投机器</title>
    <meta name="keywords" content="投资理财,网络理财,固定收益,本息保障,网络融资,互联网理财,互联网金融,P2P,P2C,P2P投资,P2P理财,网贷" />
    <meta name="description" content="" />
    <link href="" rel="apple-touch-icon-precomposed">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/base.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/index.css">
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
	$(function(){
		$('.about_nav').find("a").not(".active").hover(function(){
			var imgSrc = $(this).find("img").attr("src");
			var srcArr = imgSrc.split(".");
			srcArr[2] = srcArr[2]+"_";
			var src;
			src = srcArr.join(".");
			$(this).css("color","#00aac6");
			 $(this).find("img").attr("src",src);
		},function(){
			var imgSrc = $(this).find("img").attr("src");
			var srcArr = imgSrc.split("_");
			var src;
			src = srcArr.join("");
			 $(this).find("img").attr("src",src);	
			 $(this).css("color","#666");
		})		
		
	})		
    </script>
</head>
<body class="grey_body">
<?php $this->load->view('front/header');?>

<div class="container">
    <div class="row">
        <div class="col-xs-2 about_nav">
			<!------
            <a href="<?php echo site_url('news/article/9');?>"><span class="glyphicon glyphicon-user"></span> 关于我们</a>
            <a href="<?php echo site_url('news/article/8');?>"><span class="glyphicon glyphicon-lock"></span> 安全保障</a>
            <a href="<?php echo site_url('news/article/6');?>"><span class="glyphicon glyphicon-certificate"></span> 平台模式</a>
            <a href="<?php echo site_url('news/article/13');?>"><span class="glyphicon glyphicon-retweet"></span> 债权转让</a>
            <a href="<?php echo site_url('news/article/12');?>"><span class="glyphicon glyphicon-globe"></span> 合作伙伴</a>
            <a href="<?php echo site_url('news/article/11');?>"><span class="glyphicon glyphicon-list"></span> 费用标准</a>
            <a href="<?php echo site_url('news/article/7');?>"><span class="glyphicon glyphicon-book"></span> 新手指引</a>
            <a href="<?php echo site_url('news/newslist/1');?>" <?php if($id == 1){?>class="active"<?php }?>><span class="glyphicon glyphicon-usd"></span> 还款公告</a>
            <a href="<?php echo site_url('news/newslist/11');?>" <?php if($id == 11){?>class="active"<?php }?>><span class="glyphicon glyphicon-volume-down"></span> 网站公告</a>
            <a href="<?php echo site_url('news/newslist/3');?>" <?php if($id == 3){?>class="active"<?php }?>><span class="glyphicon glyphicon-camera"></span> 媒体报道</a>
             <a href="<?php echo site_url('news/newslist/7');?>" <?php if($id == 7){?>class="active"<?php }?>><span class="glyphicon glyphicon-question-sign"></span> 帮助中心</a>
            <a href="<?php echo site_url('news/article/10');?>"><span class="glyphicon glyphicon-phone-alt"></span> 联系我们</a>
			-------->
			<a href="<?php echo site_url('news/article_about');?>"><img src="/../style/img/article/about.png" height="50" /> 关于我们</a>
			<a href="<?php echo site_url('news/article_safety');?>"><img src="/../style/img/article/safety.png" height="50" /> 安全保障</a>
			<a href="<?php echo site_url('news/article_control');?>"><img src="/../style/img/article/control.png" height="50" /> 风控体系</a>
			<a href="<?php echo site_url('news/article_mode');?>"><img src="/../style/img/article/platform.png" height="50" /> 平台模式</a>
			<a href="<?php echo site_url('news/article_transfer');?>"><img src="/../style/img/article/debt.png" height="50" /> 债权转让</a>
			<a href="<?php echo site_url('news/article_partener');?>"><img src="/../style/img/article/cooperation.png" height="50" /> 合作伙伴</a>
			<a href="<?php echo site_url('news/article_fee');?>"><img src="/../style/img/article/fee.png" height="50" /> 费用标准</a>
			<a href="<?php echo site_url('news/article_novice');?>"><img src="/../style/img/article/novice.png" height="50" /> 新手指引</a>
			<a href="<?php echo site_url('news/newslist/1');?>" <?php if($id == 1){?>class="active"<?php }?>><img src="/../style/img/article/repay<?php if($id == 1){?>_<?php }?>.png" height="50" /> 还款公告</a>
			<a href="<?php echo site_url('news/newslist/11');?>" <?php if($id == 11){?>class="active"<?php }?>><img src="/../style/img/article/website<?php if($id == 11){?>_<?php }?>.png" height="50" /> 网站公告</a>
			<a href="<?php echo site_url('news/newslist/3');?>" <?php if($id == 3){?>class="active"<?php }?>><img src="/../style/img/article/media<?php if($id == 3){?>_<?php }?>.png" height="50" /> 媒体报道</a>
			<a href="<?php echo site_url('news/newslist/7');?>" <?php if($id == 7){?>class="active"<?php }?>><img src="/../style/img/article/help<?php if($id == 7){?>_<?php }?>.png" height="50" /> 帮助中心</a>
			<a href="<?php echo site_url('news/article_contact');?>"><img src="/../style/img/article/contact.png" height="50" /> 联系我们</a>				
        </div>

        <div class="col-xs-10">
            <div class="about_con clearfix">
                <h3 class="about_title"><span><?php echo $row['name']?></span></h3>
				<?php foreach($result as $key){?>
                <div class="news_con">
                    <div class="news_one">
                        <h4 class="clearfix"><a class="pull-left news_one_title" href="<?php echo site_url('news/article/'.$key['id']);?>" target="_blank"><?php echo $key['title'];?></a><span class="pull-right news_one_time"><?php echo $key['dateline'];?></span></h4>
                        <p class="news_one_tip"><?php echo $key['description'];?></p>
                    </div>
                </div>
     			<?php }?>


                <div class="pagination pull-right about_page">
             		<?php echo $links;?>
                </div>


            </div>
        </div>
    </div>
</div>
<?php $this->load->view('front/footer');?>
</body>
</html>
