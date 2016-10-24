<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script src="<?php echo base_url();?>style/js/jquery-1.9.1.min.js"></script>
<script language="javascript">
$(document).ready(function(){
	
	function test(a)
	{
		$.get('/product/test_buy_bulk',function(data){
			console.log(a +'返回' + data);
		});	
	}
	setTimeout(test(1),5000); 
	setTimeout(test(2),5000);
	setTimeout(test(3),5000);
	setTimeout(test(4),5000);
	setTimeout(test(5),5000);
	setTimeout(test(6),5000);
	setTimeout(test(7),5000);
	setTimeout(test(8),5000);
	setTimeout(test(9),5000);
	setTimeout(test(10),5000);
	setTimeout(test(11),5000);
	setTimeout(test(12),5000);
});
</script>
</head>

<body>
</body>
</html>