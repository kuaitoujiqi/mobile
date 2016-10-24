$(document).ready(function(){
	var header_scroller_height = $('#header_scroller').outerHeight(true);
	$('#wrapper').css('top',header_scroller_height);
	$(window).resize(function() {
		var header_scroller_height = $('#header_scroller').outerHeight(true);
		$('#wrapper').css('top',header_scroller_height);
	});
	var myScroll;
	var move_y;
	var is_load = 1;//1不加载 2加载
	myScroll = new IScroll('#wrapper',{
		scrollbars: true,
		click:true,
		mouseWheel: true,
		probeType: 3
	});
	myScroll.on('scroll',function(){
		move_y = Math.abs(this.y);
		if (move_y - Math.abs(this.maxScrollY) > 10) 
		{
			is_load	= 2;
		}
	});
	
	myScroll.on('scrollEnd', function(){
		if (this.directionY == 1 && is_load == 2) 
		{
			  var static = $('#static').val();
			  var isend = $('#isend').val();
			  if(static == 1 && isend == 1)
			  {
				  $('#pullUp .pullUpLabel').html('加载中...');
				  $('#static').val(2); //加载处理中
				  var page = $('#page').val() - (-1);
				  var url = $('#url').val();
				  $.get(url + page + '/ajax',function(data,status){
					  if(status != "success")
					  {
							 $('#static').val(1);
							 $('#pullUp .pullUpLabel').html('加载失败');	
							 is_load = 1;
							 myScroll.refresh(); 	  
					  }
					  else
					  {
						  var json = JSON.parse(data);
						  if(json[0] == 0) //加载成功
						  {
							  $('#pullUp').before(json[1]);
							  $('#page').val(page);
							  $('#static').val(1);
							  $('#pullUp .pullUpLabel').html('上拉加载更多');	
							  is_load = 1;
							  myScroll.refresh();
						  }
						  else  //最后一页
						  {
							  $('#isend').val(2);
							  $('#pullUp .pullUpLabel').html('没有内容了');	
						  }
					  }
					  
				  });	
			  }
		}
	});
	document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
});