<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title><?php echo $row['title'];?>_快投机器</title>
    <meta name="keywords" content="<?php echo $row['keyword'];?>" />
    <meta name="description" content="<?php echo $row['description'];?>" />
    <link href="" rel="apple-touch-icon-precomposed">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?fcd37886b18b856cbd75a8a25d09fbad";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>	
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
        <div class="col-xs-12 col-md-2 about_nav">	
			<a href="<?php echo site_url('news/article_about');?>"><img src="/../style/img/article/about.png" height="50" /> 关于我们</a>
			<a href="<?php echo site_url('news/article_safety');?>"><img src="/../style/img/article/safety.png" height="50" /> 安全保障</a>
			<a href="<?php echo site_url('news/article_control');?>"><img src="/../style/img/article/control.png" height="50" /> 风控体系</a>
			<a href="<?php echo site_url('news/article_mode');?>"><img src="/../style/img/article/platform.png" height="50" /> 平台模式</a>
			<a href="<?php echo site_url('news/article_transfer');?>"><img src="/../style/img/article/debt.png" height="50" /> 债权转让</a>
			<a href="<?php echo site_url('news/article_partener');?>"><img src="/../style/img/article/cooperation.png" height="50" /> 合作伙伴</a>
			<a href="<?php echo site_url('news/article_fee');?>"><img src="/../style/img/article/fee.png" height="50" /> 费用标准</a>
			<a href="<?php echo site_url('news/article_novice');?>"><img src="/../style/img/article/novice.png" height="50" /> 新手指引</a>
			<a href="<?php echo site_url('news/newslist/1');?>" <?php if($category['id'] == 1){?>class="active"<?php }?>><img src="/../style/img/article/repay<?php if($category['id'] == 1){?>_<?php }?>.png" height="50" /> 还款公告</a>
			<a href="<?php echo site_url('news/newslist/11');?>" <?php if($category['id'] == 11){?>class="active"<?php }?>><img src="/../style/img/article/website<?php if($category['id'] == 11){?>_<?php }?>.png" height="50" /> 网站公告</a>
			<a href="<?php echo site_url('news/newslist/3');?>" <?php if($category['id'] == 3){?>class="active"<?php }?>><img src="/../style/img/article/media<?php if($category['id'] == 3){?>_<?php }?>.png" height="50" /> 媒体报道</a>
			<a href="<?php echo site_url('news/newslist/7');?>" <?php if($category['id'] == 7){?>class="active"<?php }?>><img src="/../style/img/article/help<?php if($category['id'] == 7){?>_<?php }?>.png" height="50" /> 帮助中心</a>
			<a href="<?php echo site_url('news/article_contact');?>"><img src="/../style/img/article/contact.png" height="50" /> 联系我们</a>		
        </div>

        <div class="col-xs-12 col-md-10">
            <div class="about_con clearfix">
            	<?php if($row['pid'] == 6){?>
                <h3 class="about_title"><span><?php echo $row['title']?></span></h3>
                <?php }else{?>
                <h3 class="about_title" style="text-align:center"><span style="border-bottom:none; padding-bottom:0px"><?php echo $row['title']?></span><br>
                <p class="text-right"><span style="font-size:14px; font-weight:normal; height:30px; line-height:30px; padding-top:0px; border-bottom:none">时间:<?php echo substr($row['dateline'],0,10);?></span></p>
                </h3>
                <?php }?>
<style>
.new_content p{
	line-height:2.5em;
}
.new_content img{
	width:100%;
}
</style>				
				<div class="new_content" style="padding:30px; line-height:1.7em;font-size:14px;color:#666"><?php echo $row['content'];?><br>
                <span class="pull-left news_one_title" >上一篇:<?php if(count($prev) >0){?><a href="<?php echo site_url('news/article/'.$prev['id']);?>"><?php echo $prev['title'];?></a><?php }else{ echo "没有了";}?></span><br>
                <span class="pull-left news_one_title" >下一篇:<?php if(count($next) >0){?><a href="<?php echo site_url('news/article/'.$next['id']);?>"><?php echo $next['title'];?></a><?php }else{ echo "没有了";}?></span>
                </div>
                
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('front/footer');?>
</body>
</html>
