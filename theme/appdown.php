

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Resource-type" content="Document" />
<title>蜂融手机端介绍</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=2, minimum-scale=0.5, user-scalable=yes;" name="viewport" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>style/app/css/main.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>style/app/css/jquery.fullPage.css" />
<style type="text/css">
.navbg{ position:fixed; left:0px; top:0px; width:100%; height:90px; z-index:999; font-size:18px; color:#fff; background:url(<?php echo base_url();?>style/app/images/navbg.png);}
.navbg img{ margin-top:19px;}
.navbg a{ color: #fff; line-height: 90px;}
#fullpage{ width:100%;}
.section{ position:relative; width:100%; height:100%;}
#section0{ background:url(<?php echo base_url();?>style/app/images/page1.jpg); background-size:100% 100%;}
#section1{ background:url(<?php echo base_url();?>style/app/images/page2.jpg); background-size:100% 100%;}
#section2{ background:url(<?php echo base_url();?>style/app/images/page3.jpg); background-size:100% 100%;}
#section3{ background:url(<?php echo base_url();?>style/app/images/page4.jpg); background-size:100% 100%;}
#fp-nav{ height: 100px; position: fixed; right: 50px; top: 50%; margin-top:-50px; width: 16px; z-index: 111;}
#fp-nav li{ background:url(<?php echo base_url();?>style/app/images/page-cur.png) no-repeat scroll left -30px; cursor: pointer; float: left; height: 16px; margin-bottom: 9px; overflow: hidden; width:16px; text-indent:-9000px;}
#fp-nav li.active{ background-position: left top;}

.mobile,.dialog,.iphone,.android{ position:absolute; top:0px; left:0px; background-image:url(<?php echo base_url();?>style/app/images/bgr.png);}
.erweima{position:absolute; top:0px; left:0px; background-image:url(<?php echo base_url();?>style/app/images/1.png);}

.img{ position:absolute; top:0px; left:0px;}

.dcenter{ position:relative; height:497px;}
.img img{ display:block; margin:0 auto;}

#section0 .dcenter{ width:860px; margin-top:90px;}
#section0 .mobile{ width:268px; height:497px; background-position:-804px 0;}
#section0 .dialog{ width:127px; height:118px; background-position:-1227px 0; left:160px; top:328px;}
#section0 .iphone{ width:280px; height:66px; background-position:-1074px -367px; left:336px; top:270px;}
#section0 .android{ width:280px; height:66px; background-position:-1074px -434px; left:336px; top:363px;}
#section0 .erweima{ width:336px; height:187px; /*background-position:-1196px -118px;*/ left:636px; top:270px;}
#section0 .img{ left:325px; top:50px; width:531px; height:188px;}
#section1 .dcenter{ width:800px; margin-top:90px;}
#section1 .mobile{ width:268px; height:497px; background-position:-536px 0;}
#section1 .iphone{ width:280px; height:66px; background-position:-1074px -367px; left:336px; top:270px;}
#section1 .android{ width:280px; height:66px; background-position:-1074px -434px; left:336px; top:363px;}
#section1 .erweima{ width:158px; height:187px; background-position:-1196px -118px; left:636px; top:270px;}
#section1 .img{ left:325px; top:50px; width:482px; height:150px;}
#section2 .dcenter{ width:920px; margin-top:90px;}
#section2 .mobile{ width:268px; height:497px; background-position:-268px 0;}
#section2 .iphone{ width:280px; height:66px; background-position:-1074px -367px; left:336px; top:270px;}
#section2 .android{ width:280px; height:66px; background-position:-1074px -434px; left:336px; top:363px;}
#section2 .erweima{ width:158px; height:187px; background-position:-1196px -118px; left:636px; top:270px;}
#section2 .img{ left:325px; top:50px; width:601px; height:213px;}
#section3 .dcenter{ width:940px; margin-top:90px;}
#section3 .mobile{ width:268px; height:497px; background-position:0 0;}
#section3 .iphone{ width:280px; height:66px; background-position:-1074px -367px; left:336px; top:270px;}
#section3 .android{ width:280px; height:66px; background-position:-1074px -434px; left:336px; top:363px;}
#section3 .erweima{ width:158px; height:187px; background-position:-1196px -118px; left:636px; top:270px;}
#section3 .img{ left:325px; top:50px; width:636px; height:182px;}
@media (min-width: 320px) and (max-width:900px) {
	.dcenter{ position:relative; height:248px; width:350px;}
	.img img{ display:block; margin:0;}
	#fp-nav{right: 20px;}
	.mobile,.dialog,.iphone,.android,.erweima{ position:absolute; top:0px; left:0px; background-image:url(images/bgr.png); background-size:677px 250px;}
    #section0 .dcenter{ width:350px; margin-top:90px;}
	#section0 .mobile{ width:134px; height:248px; background-position:-402px 0;}
	#section0 .dialog{ width:63px; height:59px; background-position:-613px 0; left:80px; top:164px;}
	#section0 .iphone{ width:140px; height:33px; background-position:-537px -183px; left:168px; top:135px;}
	#section0 .android{ width:140px; height:33px; background-position:-537px -217px; left:168px; top:181px;}
	#section0 .erweima{ width:79px; height:93px; background-position:-598px -59px; left:318px; top:135px; display:none;}
	#section0 .img{ left:162px; top:25px; width:265px; height:94px;}
	#section1 .dcenter{ width:350px; margin-top:90px;}
	#section1 .mobile{ width:134px; height:248px; background-position:-268px 0;}
	#section1 .iphone{ width:140px; height:33px; background-position:-537px -183px; left:168px; top:135px;}
	#section1 .android{ width:140px; height:33px; background-position:-537px -217px; left:168px; top:181px;}
	#section1 .erweima{ width:79px; height:93px; background-position:-598px -59px; left:318px; top:135px; display:none;}
	#section1 .img{ left:162px; top:25px; width:241px; height:75px;}
	/*****************************************************************/
	#section2 .dcenter{ width:350px; margin-top:90px;}
	#section2 .mobile{ width:134px; height:248px; background-position:-134px 0;}
	#section2 .iphone{ width:140px; height:33px; background-position:-537px -183px; left:168px; top:135px;}
	#section2 .android{ width:140px; height:33px; background-position:-537px -217px; left:168px; top:181px;}
	#section2 .erweima{ width:79px; height:93px; background-position:-598px -59px; left:318px; top:135px; display:none;}
	#section2 .img{ left:162px; top:25px; width:300px; height:106px;}
	#section3 .dcenter{ width:350px; margin-top:45px;}
	#section3 .mobile{ width:134px; height:248px; background-position:0 0;}
	#section3 .iphone{ width:140px; height:33px; background-position:-537px -183px; left:168px; top:135px;}
	#section3 .android{ width:140px; height:33px; background-position:-537px -217px; left:168px; top:181px;}
	#section3 .erweima{ width:79px; height:93px; background-position:-598px -59px; left:218px; top:135px; display:none;}
	#section3 .img{ left:162px; top:25px; width:318px; height:91px;}
}
</style>
</head>
<body>
<div class="navbg">
<div class="dcenter"><a href="<?php echo base_url();?>" class="fl"><img src="<?php echo base_url();?>style/app/images/applogo.png" /></a><a class="fr" href="<?php echo base_url();?>">返回首页</a></div>
</div>
<div id="fullpage">
    	<div class="section" id="section0">
    	<div class="dcenter">
            <div class="mobile"></div>
            <div class="dialog"></div>
            <div class="img"><img src="<?php echo base_url();?>style/app/images/text1.png" /></div>
            <a href="https://itunes.apple.com/cn/app/feng-rong-wang/id1056917223?mt=8"  class="iphone" target="_blank" style="z-index:999"></a>
            <a href="http://www.kuaitoujiqi.com/download/fengrongv1.apk" class="android"></a>
            <div class="erweima"></div>
        </div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>style/app/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>style/app/js/jquery-ui.min.js"></script>

<script type="text/javascript">
$(function(){
	var scren = $(window).width();
	$('#fullpage').fullpage({
		sectionsColor: ['#3e4d33', '#0f192c', '#bf9937', '#c8cacc'],
		anchors: ['firstPage', 'secondPage', '3rdPage', '4thpage'],
		menu: '#fp-nav',
		easing: 'easeOutExpo',
		afterLoad: function(anchorLink, index){
			if(anchorLink == "firstPage"){
				first_animate();
			}else{
				first_init();
			}
			if(anchorLink == "secondPage"){
				other_animate("#section1");
			}else{
				other_init("#section1");
			}
			if(anchorLink == "3rdPage"){
				other_animate("#section2");
			}else{
				other_init("#section2");
			}
			if(anchorLink == "4thpage"){
				other_animate("#section3");
			}else{
				other_init("#section3");
			}
		}
	});
	function first_animate(){
		var anique = function(){$("#section0").dequeue("myqueue");}
		var funarr;
		if(scren>900){
			funarr = [
				function(){
					$("#section0 .mobile").animate({left:0,opacity:1},1000,'easeOutQuint',anique);
					$("#section0 img").animate({width:"100%",height:"100%",opacity:1},1000,'easeOutQuint',anique);
					$("#section0 .iphone").animate({top:270,opacity:1},1000,'easeOutQuint',anique);
					$("#section0 .android").animate({top:363,opacity:1},1000,'easeOutQuint',anique);
					$("#section0 .erweima").animate({left:636,opacity:1},1000,'easeOutQuint',anique);
				},
				function(){
					$("#section0 .dialog").animate({left:160,opacity:1},1000,'easeOutQuint',anique);
				}
			];
		}else{
			funarr = [
				function(){
					$("#section0 .mobile").animate({left:0,opacity:1},1000,'easeOutQuint',anique);
					$("#section0 img").animate({width:"60%",height:"60%",opacity:1},1000,'easeOutQuint',anique);
					$("#section0 .iphone").animate({top:135,opacity:1},1000,'easeOutQuint',anique);
					$("#section0 .android").animate({top:181,opacity:1},1000,'easeOutQuint',anique);
				},
				function(){
					$("#section0 .dialog").animate({left:80,opacity:1},1000,'easeOutQuint',anique);
				}
			];	
		}
		$("#section0").queue("myqueue",funarr);
		anique();
	}
	function first_init(){
		if(scren>900){
			$("#section0 .mobile").css({left:-50,opacity:.8});
			$("#section0 img").css({width:0,height:0,opacity:0});
			$("#section0 .iphone").css({top:320,opacity:0});
			$("#section0 .android").css({top:413,opacity:0});
			$("#section0 .erweima").css({left:666,opacity:0});
			$("#section0 .dialog").css({left:165,opacity:0});
		}else{
			$("#section0 .mobile").css({left:-50,opacity:.8});
			$("#section0 img").css({width:0,height:0,opacity:0});
			$("#section0 .iphone").css({top:160,opacity:0});
			$("#section0 .android").css({top:206,opacity:0});
			$("#section0 .dialog").css({left:82,opacity:0});
		}
	}
	first_init();
	first_animate();
	other_init("#section1");
	other_init("#section2");
	other_init("#section3");
	function other_init(section_name){
		if(scren>900){
			$(section_name).find(".mobile").css({left:-50,opacity:.8});
			$(section_name).find("img").css({width:0,height:0,opacity:0});
			$(section_name).find(".iphone").css({top:320,opacity:0});
			$(section_name).find(".android").css({top:413,opacity:0});
			$(section_name).find(".erweima").css({left:686,opacity:0});
		}else{
			$(section_name).find(".mobile").css({left:-50,opacity:.8});
			$(section_name).find("img").css({width:0,height:0,opacity:0});
			$(section_name).find(".iphone").css({top:160,opacity:0});
			$(section_name).find(".android").css({top:206,opacity:0});
		}
	}
	function other_animate(section_name){
		if(scren>900){
			$(section_name).find(".mobile").animate({left:0,opacity:1},1000,'easeOutQuint');
			$(section_name).find("img").animate({width:"100%",height:"100%",opacity:1},1000,'easeOutQuint');
			$(section_name).find(".iphone").animate({top:270,opacity:1},1000,'easeOutQuint');
			$(section_name).find(".android").animate({top:363,opacity:1},1000,'easeOutQuint');
			$(section_name).find(".erweima").animate({left:636,opacity:1},1000,'easeOutQuint');
		}else{
			$(section_name).find(".mobile").animate({left:0,opacity:1},1000,'easeOutQuint');
			$(section_name).find("img").animate({width:"60%",height:"60%",opacity:1},1000,'easeOutQuint');
			$(section_name).find(".iphone").animate({top:135,opacity:1},1000,'easeOutQuint');
			$(section_name).find(".android").animate({top:181,opacity:1},1000,'easeOutQuint');
		}
	}
});
</script>
<!--baidu-->
<div class="dn">
</div>
<!--end-->
</body>
</html>
