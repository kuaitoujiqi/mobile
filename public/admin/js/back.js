// JavaScript Document
$(document).ready(function(){

	change_height();
	$(window).resize(function(){
		change_height();
	});
	
	$('.bigmenu li').click(function(){
		var bid = $(this).index();
		var text = $(this).text();
		$('.bigmenu li').each(function(i) {
            if(bid == i)
			{
				$('.bigmenu li').eq(i).addClass("hover");
				$('.main .left .title span').text(text);
				$('.main .left .leftmenu').each(function(a) {	
					if(bid == a)
					{
						$('#l'+a).show();
					}
					else
					{
						$('#l'+a).hide();	
					}
				});
			}
			else
			{
				$('.bigmenu li').eq(i).removeClass("hover");	
			}
        });
	});
	
	
	$('.main .left dl dd').click(function(){
		var bid = $(this).index();
		var url = $(this).attr('url');
		var text = $(this).text();
		var dlid = $(this).parent('dl').attr('data');
		$('.main .left #l'+dlid+' dl dd').each(function(i) {
			if(bid == i)
			{
				$('.main .left #l'+ dlid + ' dl dd').eq(i).addClass("hover");		
				$('.main .right #iframe').attr('src',url);
				$('.right .righttab span').text(text);
			}
			else
			{
				$('.main .left #l'+ dlid + ' dl dd').eq(i).removeClass("hover");	
			}
		});
	});
	
	//自适应代码
	function change_height()
	{
		var height = $(window).height(); //浏览器高度
		var topheight = $('.top').outerHeight(true);
		$('.main').height(height-topheight-10);//设置内容区域高度
		var width = $(window).width(); //浏览器宽度
		var leftwidth = $('.main .left').outerWidth();
		$('.main .right').width(width - leftwidth);//设置右侧区域宽度
		var righttabh = $('.main .right .righttab').outerHeight(true);
		$('.main .right .rightcon #iframe').width(width - leftwidth);//设置右侧ifranme 宽度
		$('.main .right .rightcon #iframe').height(height-topheight-righttabh);
	}
	
	$('#htindex').click(function(){
		$('.main .right #iframe').attr('src',$(this).attr('url'));
		$('.right .righttab span').text($(this).text());
	});
	
	$('.delete').click(function(){
		if(confirm('确认要删除吗？')){
			
		}
		else
		{
			return false;	
		}
	});
});