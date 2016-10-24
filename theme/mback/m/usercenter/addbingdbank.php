<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>绑定银行卡-蜂融网</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
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
   <script language="javascript" src="<?php echo base_url();?>style/js/jquery.cityselect.js"></script>
    <script language="javascript">
	$(document).ready(function() {
		$('.recharge_bank input').change(function(){
			$('.recharge_bank a').removeClass('label-success');
			$('.recharge_bank a').addClass('label-default');
			$(this).next('a').removeClass('label-default');
			$(this).next('a').addClass('label-success');
		});
	});
	
	$(function(){ 
	$("#form_bind").citySelect({
		url:{"citylist":[{"p":"\u4e0a\u6d77\u5e02","c":[{"n":"\u4e0a\u6d77\u5e02"}]},{"p":"\u4e91\u5357\u7701","c":[{"n":"\u4e34\u6ca7\u5e02"},{"n":"\u4e3d\u6c5f\u5e02"},{"n":"\u4fdd\u5c71\u5e02"},{"n":"\u5927\u7406\u767d\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u5fb7\u5b8f\u50a3\u65cf\u666f\u9887\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u6012\u6c5f\u5088\u50f3\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u6587\u5c71\u58ee\u65cf\u82d7\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u6606\u660e\u5e02"},{"n":"\u662d\u901a\u5e02"},{"n":"\u666e\u6d31\u5e02"},{"n":"\u66f2\u9756\u5e02"},{"n":"\u695a\u96c4\u5f5d\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u7389\u6eaa\u5e02"},{"n":"\u7ea2\u6cb3\u54c8\u5c3c\u65cf\u5f5d\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u897f\u53cc\u7248\u7eb3\u50a3\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u8fea\u5e86\u85cf\u65cf\u81ea\u6cbb\u5dde"}]},{"p":"\u5185\u8499\u53e4\u81ea\u6cbb\u533a","c":[{"n":"\u4e4c\u5170\u5bdf\u5e03\u5e02"},{"n":"\u4e4c\u6d77\u5e02"},{"n":"\u5174\u5b89\u76df"},{"n":"\u5305\u5934\u5e02"},{"n":"\u547c\u4f26\u8d1d\u5c14\u5e02"},{"n":"\u547c\u548c\u6d69\u7279\u5e02"},{"n":"\u5df4\u5f66\u6dd6\u5c14\u5e02"},{"n":"\u8d64\u5cf0\u5e02"},{"n":"\u901a\u8fbd\u5e02"},{"n":"\u9102\u5c14\u591a\u65af\u5e02"},{"n":"\u9521\u6797\u90ed\u52d2\u76df"},{"n":"\u963f\u62c9\u5584\u76df"}]},{"p":"\u5317\u4eac\u5e02","c":[{"n":"\u5317\u4eac\u5e02"}]},{"p":"\u5409\u6797\u7701","c":[{"n":"\u5409\u6797\u5e02"},{"n":"\u56db\u5e73\u5e02"},{"n":"\u5ef6\u8fb9\u671d\u9c9c\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u677e\u539f\u5e02"},{"n":"\u767d\u57ce\u5e02"},{"n":"\u767d\u5c71\u5e02"},{"n":"\u8fbd\u6e90\u5e02"},{"n":"\u901a\u5316\u5e02"},{"n":"\u957f\u6625\u5e02"}]},{"p":"\u56db\u5ddd\u7701","c":[{"n":"\u4e50\u5c71\u5e02"},{"n":"\u5185\u6c5f\u5e02"},{"n":"\u51c9\u5c71\u5f5d\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u5357\u5145\u5e02"},{"n":"\u5b9c\u5bbe\u5e02"},{"n":"\u5df4\u4e2d\u5e02"},{"n":"\u5e7f\u5143\u5e02"},{"n":"\u5e7f\u5b89\u5e02"},{"n":"\u5fb7\u9633\u5e02"},{"n":"\u6210\u90fd\u5e02"},{"n":"\u6500\u679d\u82b1\u5e02"},{"n":"\u6cf8\u5dde\u5e02"},{"n":"\u7518\u5b5c\u85cf\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u7709\u5c71\u5e02"},{"n":"\u7ef5\u9633\u5e02"},{"n":"\u81ea\u8d21\u5e02"},{"n":"\u8d44\u9633\u5e02"},{"n":"\u8fbe\u5dde\u5e02"},{"n":"\u9042\u5b81\u5e02"},{"n":"\u963f\u575d\u85cf\u65cf\u7f8c\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u96c5\u5b89\u5e02"}]},{"p":"\u5929\u6d25\u5e02","c":[{"n":"\u5929\u6d25\u5e02"}]},{"p":"\u5b81\u590f\u81ea\u6cbb\u533a","c":[{"n":"\u4e2d\u536b\u5e02"},{"n":"\u5434\u5fe0\u5e02"},{"n":"\u56fa\u539f\u5e02"},{"n":"\u77f3\u5634\u5c71\u5e02"},{"n":"\u94f6\u5ddd\u5e02"}]},{"p":"\u5b89\u5fbd\u7701","c":[{"n":"\u4eb3\u5dde\u5e02"},{"n":"\u516d\u5b89\u5e02"},{"n":"\u5408\u80a5\u5e02"},{"n":"\u5b89\u5e86\u5e02"},{"n":"\u5ba3\u57ce\u5e02"},{"n":"\u5bbf\u5dde\u5e02"},{"n":"\u5de2\u6e56\u5e02"},{"n":"\u6c60\u5dde\u5e02"},{"n":"\u6dee\u5317\u5e02"},{"n":"\u6dee\u5357\u5e02"},{"n":"\u6ec1\u5dde\u5e02"},{"n":"\u829c\u6e56\u5e02"},{"n":"\u868c\u57e0\u5e02"},{"n":"\u94dc\u9675\u5e02"},{"n":"\u961c\u9633\u5e02"},{"n":"\u9a6c\u978d\u5c71\u5e02"},{"n":"\u9ec4\u5c71\u5e02"}]},{"p":"\u5c71\u4e1c\u7701","c":[{"n":"\u4e1c\u8425\u5e02"},{"n":"\u4e34\u6c82\u5e02"},{"n":"\u5a01\u6d77\u5e02"},{"n":"\u5fb7\u5dde\u5e02"},{"n":"\u65e5\u7167\u5e02"},{"n":"\u67a3\u5e84\u5e02"},{"n":"\u6cf0\u5b89\u5e02"},{"n":"\u6d4e\u5357\u5e02"},{"n":"\u6d4e\u5b81\u5e02"},{"n":"\u6dc4\u535a\u5e02"},{"n":"\u6ee8\u5dde\u5e02"},{"n":"\u6f4d\u574a\u5e02"},{"n":"\u70df\u53f0\u5e02"},{"n":"\u804a\u57ce\u5e02"},{"n":"\u83b1\u829c\u5e02"},{"n":"\u83cf\u6cfd\u5e02"},{"n":"\u9752\u5c9b\u5e02"}]},{"p":"\u5c71\u897f\u7701","c":[{"n":"\u4e34\u6c7e\u5e02"},{"n":"\u5415\u6881\u5e02"},{"n":"\u5927\u540c\u5e02"},{"n":"\u592a\u539f\u5e02"},{"n":"\u5ffb\u5dde\u5e02"},{"n":"\u664b\u4e2d\u5e02"},{"n":"\u664b\u57ce\u5e02"},{"n":"\u6714\u5dde\u5e02"},{"n":"\u8fd0\u57ce\u5e02"},{"n":"\u957f\u6cbb\u5e02"},{"n":"\u9633\u6cc9\u5e02"}]},{"p":"\u5e7f\u4e1c\u7701","c":[{"n":"\u4e1c\u839e\u5e02"},{"n":"\u4e2d\u5c71\u5e02"},{"n":"\u4e91\u6d6e\u5e02"},{"n":"\u4f5b\u5c71\u5e02"},{"n":"\u5e7f\u5dde\u5e02"},{"n":"\u60e0\u5dde\u5e02"},{"n":"\u63ed\u9633\u5e02"},{"n":"\u6885\u5dde\u5e02"},{"n":"\u6c55\u5934\u5e02"},{"n":"\u6c55\u5c3e\u5e02"},{"n":"\u6c5f\u95e8\u5e02"},{"n":"\u6cb3\u6e90\u5e02"},{"n":"\u6df1\u5733\u5e02"},{"n":"\u6e05\u8fdc\u5e02"},{"n":"\u6e5b\u6c5f\u5e02"},{"n":"\u6f6e\u5dde\u5e02"},{"n":"\u73e0\u6d77\u5e02"},{"n":"\u8087\u5e86\u5e02"},{"n":"\u8302\u540d\u5e02"},{"n":"\u9633\u6c5f\u5e02"},{"n":"\u97f6\u5173\u5e02"}]},{"p":"\u5e7f\u897f\u81ea\u6cbb\u533a","c":[{"n":"\u5317\u6d77\u5e02"},{"n":"\u5357\u5b81\u5e02"},{"n":"\u5d07\u5de6\u5e02"},{"n":"\u6765\u5bbe\u5e02"},{"n":"\u67f3\u5dde\u5e02"},{"n":"\u6842\u6797\u5e02"},{"n":"\u68a7\u5dde\u5e02"},{"n":"\u6cb3\u6c60\u5e02"},{"n":"\u7389\u6797\u5e02"},{"n":"\u767e\u8272\u5e02"},{"n":"\u8d35\u6e2f\u5e02"},{"n":"\u8d3a\u5dde\u5e02"},{"n":"\u94a6\u5dde\u5e02"},{"n":"\u9632\u57ce\u6e2f\u5e02"}]},{"p":"\u65b0\u7586\u81ea\u6cbb\u533a","c":[{"n":"\u4e4c\u9c81\u6728\u9f50\u5e02"},{"n":"\u4f0a\u7281\u54c8\u8428\u514b\u81ea\u6cbb\u5dde"},{"n":"\u514b\u5b5c\u52d2\u82cf\u67ef\u5c14\u514b\u5b5c\u81ea\u6cbb\u5dde"},{"n":"\u514b\u62c9\u739b\u4f9d\u5e02"},{"n":"\u535a\u5c14\u5854\u62c9\u8499\u53e4\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u5410\u9c81\u756a\u5730\u533a"},{"n":"\u548c\u7530\u5730\u533a"},{"n":"\u54c8\u5bc6\u5730\u533a"},{"n":"\u5580\u4ec0\u5730\u533a"},{"n":"\u56fe\u6728\u8212\u514b\u5e02"},{"n":"\u5854\u57ce\u5730\u533a"},{"n":"\u5df4\u97f3\u90ed\u695e\u8499\u53e4\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u660c\u5409\u56de\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u77f3\u6cb3\u5b50\u5e02"},{"n":"\u963f\u514b\u82cf\u5730\u533a"},{"n":"\u963f\u52d2\u6cf0\u5730\u533a"},{"n":"\u963f\u62c9\u5c14\u5e02"}]},{"p":"\u6c5f\u82cf\u7701","c":[{"n":"\u5357\u4eac\u5e02"},{"n":"\u5357\u901a\u5e02"},{"n":"\u5bbf\u8fc1\u5e02"},{"n":"\u5e38\u5dde\u5e02"},{"n":"\u5f90\u5dde\u5e02"},{"n":"\u626c\u5dde\u5e02"},{"n":"\u65e0\u9521\u5e02"},{"n":"\u6cf0\u5dde\u5e02"},{"n":"\u6dee\u5b89\u5e02"},{"n":"\u76d0\u57ce\u5e02"},{"n":"\u82cf\u5dde\u5e02"},{"n":"\u8fde\u4e91\u6e2f\u5e02"},{"n":"\u9547\u6c5f\u5e02"}]},{"p":"\u6c5f\u897f\u7701","c":[{"n":"\u4e0a\u9976\u5e02"},{"n":"\u4e5d\u6c5f\u5e02"},{"n":"\u5357\u660c\u5e02"},{"n":"\u5409\u5b89\u5e02"},{"n":"\u5b9c\u6625\u5e02"},{"n":"\u629a\u5dde\u5e02"},{"n":"\u65b0\u4f59\u5e02"},{"n":"\u666f\u5fb7\u9547\u5e02"},{"n":"\u840d\u4e61\u5e02"},{"n":"\u8d63\u5dde\u5e02"},{"n":"\u9e70\u6f6d\u5e02"}]},{"p":"\u6cb3\u5317\u7701","c":[{"n":"\u4fdd\u5b9a\u5e02"},{"n":"\u5510\u5c71\u5e02"},{"n":"\u5eca\u574a\u5e02"},{"n":"\u5f20\u5bb6\u53e3\u5e02"},{"n":"\u627f\u5fb7\u5e02"},{"n":"\u6ca7\u5dde\u5e02"},{"n":"\u77f3\u5bb6\u5e84\u5e02"},{"n":"\u79e6\u7687\u5c9b\u5e02"},{"n":"\u8861\u6c34\u5e02"},{"n":"\u90a2\u53f0\u5e02"},{"n":"\u90af\u90f8\u5e02"}]},{"p":"\u6cb3\u5357\u7701","c":[{"n":"\u4e09\u95e8\u5ce1\u5e02"},{"n":"\u4fe1\u9633\u5e02"},{"n":"\u5357\u9633\u5e02"},{"n":"\u5468\u53e3\u5e02"},{"n":"\u5546\u4e18\u5e02"},{"n":"\u5b89\u9633\u5e02"},{"n":"\u5e73\u9876\u5c71\u5e02"},{"n":"\u5f00\u5c01\u5e02"},{"n":"\u65b0\u4e61\u5e02"},{"n":"\u6d1b\u9633\u5e02"},{"n":"\u6f2f\u6cb3\u5e02"},{"n":"\u6fee\u9633\u5e02"},{"n":"\u7126\u4f5c\u5e02"},{"n":"\u8bb8\u660c\u5e02"},{"n":"\u90d1\u5dde\u5e02"},{"n":"\u9a7b\u9a6c\u5e97\u5e02"},{"n":"\u9e64\u58c1\u5e02"}]},{"p":"\u6d59\u6c5f\u7701","c":[{"n":"\u4e3d\u6c34\u5e02"},{"n":"\u53f0\u5dde\u5e02"},{"n":"\u5609\u5174\u5e02"},{"n":"\u5b81\u6ce2\u5e02"},{"n":"\u676d\u5dde\u5e02"},{"n":"\u6e29\u5dde\u5e02"},{"n":"\u6e56\u5dde\u5e02"},{"n":"\u7ecd\u5174\u5e02"},{"n":"\u821f\u5c71\u5e02"},{"n":"\u8862\u5dde\u5e02"},{"n":"\u91d1\u534e\u5e02"}]},{"p":"\u6d77\u5357\u7701","c":[{"n":"\u4e09\u4e9a\u5e02"},{"n":"\u6d77\u53e3\u5e02"}]},{"p":"\u6e56\u5317\u7701","c":[{"n":"\u5341\u5830\u5e02"},{"n":"\u6f5c\u6c5f\u5e02"},{"n":"\u54b8\u5b81\u5e02"},{"n":"\u5b5d\u611f\u5e02"},{"n":"\u5b9c\u660c\u5e02"},{"n":"\u6069\u65bd\u571f\u5bb6\u65cf\u82d7\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u6b66\u6c49\u5e02"},{"n":"\u8346\u5dde\u5e02"},{"n":"\u8346\u95e8\u5e02"},{"n":"\u8944\u6a0a\u5e02"},{"n":"\u9102\u5dde\u5e02"},{"n":"\u968f\u5dde\u5e02"},{"n":"\u9ec4\u5188\u5e02"},{"n":"\u9ec4\u77f3\u5e02"}]},{"p":"\u6e56\u5357\u7701","c":[{"n":"\u5409\u9996\u5e02"},{"n":"\u5a04\u5e95\u5e02"},{"n":"\u5cb3\u9633\u5e02"},{"n":"\u5e38\u5fb7\u5e02"},{"n":"\u5f20\u5bb6\u754c\u5e02"},{"n":"\u6000\u5316\u5e02"},{"n":"\u682a\u5dde\u5e02"},{"n":"\u6c38\u5dde\u5e02"},{"n":"\u6e58\u6f6d\u5e02"},{"n":"\u76ca\u9633\u5e02"},{"n":"\u8861\u9633\u5e02"},{"n":"\u90b5\u9633\u5e02"},{"n":"\u90f4\u5dde\u5e02"},{"n":"\u957f\u6c99\u5e02"}]},{"p":"\u7518\u8083\u7701","c":[{"n":"\u4e34\u590f\u56de\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u5170\u5dde\u5e02"},{"n":"\u5609\u5cea\u5173\u5e02"},{"n":"\u5929\u6c34\u5e02"},{"n":"\u5b9a\u897f\u5e02"},{"n":"\u5e73\u51c9\u5e02"},{"n":"\u5e86\u9633\u5e02"},{"n":"\u5f20\u6396\u5e02"},{"n":"\u6b66\u5a01\u5e02"},{"n":"\u7518\u5357\u85cf\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u767d\u94f6\u5e02"},{"n":"\u9152\u6cc9\u5e02"},{"n":"\u91d1\u660c\u5e02"},{"n":"\u9647\u5357\u5e02"}]},{"p":"\u798f\u5efa\u7701","c":[{"n":"\u4e09\u660e\u5e02"},{"n":"\u5357\u5e73\u5e02"},{"n":"\u53a6\u95e8\u5e02"},{"n":"\u5b81\u5fb7\u5e02"},{"n":"\u6cc9\u5dde\u5e02"},{"n":"\u6f33\u5dde\u5e02"},{"n":"\u798f\u5dde\u5e02"},{"n":"\u8386\u7530\u5e02"},{"n":"\u9f99\u5ca9\u5e02"}]},{"p":"\u897f\u85cf\u81ea\u6cbb\u533a","c":[{"n":"\u5c71\u5357\u5730\u533a"},{"n":"\u62c9\u8428\u5e02"},{"n":"\u65e5\u5580\u5219\u5730\u533a"},{"n":"\u660c\u90fd\u5730\u533a"},{"n":"\u6797\u829d\u5730\u533a"},{"n":"\u6a1f\u6728\u53e3\u5cb8\u9547"},{"n":"\u90a3\u66f2\u5730\u533a"},{"n":"\u963f\u91cc\u5730\u533a"}]},{"p":"\u8d35\u5dde\u7701","c":[{"n":"\u516d\u76d8\u6c34\u5e02"},{"n":"\u5b89\u987a\u5e02"},{"n":"\u6bd5\u8282\u5730\u533a"},{"n":"\u8d35\u9633\u5e02"},{"n":"\u9075\u4e49\u5e02"},{"n":"\u94dc\u4ec1\u5730\u533a"},{"n":"\u9ed4\u4e1c\u5357\u82d7\u65cf\u4f97\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u9ed4\u5357\u5e03\u4f9d\u65cf\u82d7\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u9ed4\u897f\u5357\u5e03\u4f9d\u65cf\u82d7\u65cf\u81ea\u6cbb\u5dde"}]},{"p":"\u8fbd\u5b81\u7701","c":[{"n":"\u4e39\u4e1c\u5e02"},{"n":"\u5927\u8fde\u5e02"},{"n":"\u629a\u987a\u5e02"},{"n":"\u671d\u9633\u5e02"},{"n":"\u672c\u6eaa\u5e02"},{"n":"\u6c88\u9633\u5e02"},{"n":"\u76d8\u9526\u5e02"},{"n":"\u8425\u53e3\u5e02"},{"n":"\u846b\u82a6\u5c9b\u5e02"},{"n":"\u8fbd\u9633\u5e02"},{"n":"\u94c1\u5cad\u5e02"},{"n":"\u9526\u5dde\u5e02"},{"n":"\u961c\u65b0\u5e02"},{"n":"\u978d\u5c71\u5e02"}]},{"p":"\u91cd\u5e86\u5e02","c":[{"n":"\u4e07\u5dde\u5e02"},{"n":"\u6daa\u9675\u5e02"},{"n":"\u91cd\u5e86\u5e02"},{"n":"\u9ed4\u6c5f\u5e02"}]},{"p":"\u9655\u897f\u7701","c":[{"n":"\u54b8\u9633\u5e02"},{"n":"\u5546\u6d1b\u5e02"},{"n":"\u5b89\u5eb7\u5e02"},{"n":"\u5b9d\u9e21\u5e02"},{"n":"\u5ef6\u5b89\u5e02"},{"n":"\u6986\u6797\u5e02"},{"n":"\u6c49\u4e2d\u5e02"},{"n":"\u6e2d\u5357\u5e02"},{"n":"\u897f\u5b89\u5e02"},{"n":"\u94dc\u5ddd\u5e02"}]},{"p":"\u9752\u6d77\u7701","c":[{"n":"\u679c\u6d1b\u85cf\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u6d77\u4e1c\u5730\u533a"},{"n":"\u6d77\u5317\u85cf\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u6d77\u5357\u85cf\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u6d77\u897f\u8499\u53e4\u65cf\u85cf\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u7389\u6811\u85cf\u65cf\u81ea\u6cbb\u5dde"},{"n":"\u897f\u5b81\u5e02"},{"n":"\u9ec4\u5357\u85cf\u65cf\u81ea\u6cbb\u5dde"}]},{"p":"\u9ed1\u9f99\u6c5f\u7701","c":[{"n":"\u4e03\u53f0\u6cb3\u5e02"},{"n":"\u4f0a\u6625\u5e02"},{"n":"\u4f73\u6728\u65af\u5e02"},{"n":"\u53cc\u9e2d\u5c71\u5e02"},{"n":"\u54c8\u5c14\u6ee8\u5e02"},{"n":"\u5927\u5174\u5b89\u5cad\u5730\u533a"},{"n":"\u5927\u5e86\u5e02"},{"n":"\u7261\u4e39\u6c5f\u5e02"},{"n":"\u7ee5\u5316\u5e02"},{"n":"\u9e21\u897f\u5e02"},{"n":"\u9e64\u5c97\u5e02"},{"n":"\u9ed1\u6cb3\u5e02"},{"n":"\u9f50\u9f50\u54c8\u5c14\u5e02"}]}]},
		<?php if(set_value('prov') != ""){?>
			prov:"<?php echo set_value('prov');?>",
			city:"<?php echo set_value('city');?>",
		<?php }else{?>
		prov:"上海市",
		city:"上海市",
		<?php }?>
		dist:"",
		nodata:"none"
	});
	
	var bank_code = $('[name="bank_code"]').val();
	if(bank_code == "HXB" || bank_code == "SPDB" || bank_code == "CMBC")
	{
		$('#tishi').html($('[name="bank_code"] option[value="'+bank_code+'"]').attr('data') + ' 请尽量不用绑定此银行卡，以免影响您的投资。');
	}
	else
	{
		$('#tishi').html($('[name="bank_code"] option[value="'+bank_code+'"]').attr('data'));
	}
	$('[name="bank_code"]').change(function(){
		var bank_code1 = $('[name="bank_code"]').val();
		if(bank_code1 == "HXB" || bank_code1 == "SPDB" || bank_code1 == "CMBC")
		{
			$('#tishi').html($('[name="bank_code"] option[value="'+bank_code1+'"]').attr('data') + ' 请尽量不用绑定此银行卡，以免影响您的投资。');
		}
		else
		{
			$('#tishi').html($('[name="bank_code"] option[value="'+bank_code1+'"]').attr('data'));	
		}
		
	});	
	
	$('#submit_add').click(function(){
		$(this).attr("disabled",true);
		$('#form_bind').submit();
	});

	
});
    </script>
</head>


<body class="index">

<!--主导航--------------------------------------------------------------------------------------------->
<?php $this->load->view('m/head'); ?>
<?php $this->load->view('m/usercenter/menu'); ?>
<div class="container">
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h3 class="page-header">绑定银行卡</h3>
            
            <?php if($userinfo['is_idcard'] != 0){?>
           <?php if(isset($error)){?>
            <div class="alert alert-danger" role="alert"><?php echo $error;?></div>
            <?php }?>
            <form class="form-horizontal" id="form_bind" method="post">
            	<div class="form-group">
   		 			<label class="control-label col-sm-2">选择银行</label>
    				<div class="col-sm-5">
                        <select class="form-control" name="bank_code">
                        	<?php $bank_tishi = require('./data/bankinfo.php');$bank_tishi = $bank_tishi['q_pay_info'];?>
                        	
                        	<?php foreach($bankinfo as $val=>$key){?>
                        	<option value="<?php echo $val;?>" <?php echo set_select('bank_code',$val);?> data="<?php echo $bank_tishi[$val];?>"><?php echo $key;?></option>
                            <?php }?>
                        </select>
                    </div>
 				</div>
                <div class="form-group has-error" >
                    <p class="col-sm-10" style="padding-top:7px; color:#a94442" id="tishi"></p>
                </div>
                <div class="form-group <?php if(form_error('verify_mode') != ""){echo "has-error"; }?>">
   		 			<label class="control-label col-sm-2">绑卡类型</label>
                    <div class="col-sm-5">
                    <select name="verify_mode" class="form-control">
                    	<option value="1" <?php echo set_select('verify_mode',1,true);?>>支付提现卡</option>
                        <option <?php echo set_select('verify_mode',2);?> value="2">提现卡</option>
                    </select>
    			
                    </div>
 				</div>
                <div class="form-group <?php if(form_error('bank_account_no') != ""){echo "has-error"; }?>">
   		 			<label class="control-label col-sm-2">银行卡号</label>
                    <div class="col-sm-5">
    					<input type="text" name="bank_account_no" class="form-control" placeholder="请输入本人的借记银行卡号" value="<?php echo set_value('bank_account_no');?>">
                    </div>
 				</div>
                <div class="form-group <?php if(form_error('phone_no') != ""){echo "has-error"; }?>">
   		 			<label class="control-label col-sm-2">预留手机号</label>
                    <div class="col-sm-5">
    					<input type="text" name="phone_no" class="form-control" placeholder="请输入银行预留手机号码" value="<?php echo set_value('phone_no');?>">
                    </div>
 				</div>
                <div class="form-group">
   		 			<label class="control-label col-sm-2">开户行所在省</label>
                    <div class="col-sm-3">
    					<select class="form-control prov" name="prov"></select>
                    </div>
 				</div>
                <div class="form-group">
   		 			<label class="control-label col-sm-2">开户行所在市</label>
                    <div class="col-sm-3">
    					<select class="form-control city" name="city"></select>
                    </div>
 				</div>
                <div class="form-group <?php if(form_error('bank_branch') != ""){echo "has-error"; }?>">
   		 			<label class="control-label col-sm-2">支行名称</label>
                    <div class="col-sm-5">
    					<input type="text" name="bank_branch" class="form-control" value="<?php echo set_value('bank_branch');?>">
                    </div>
 				</div>
                 <div class="form-group">
   		 			<label class="control-label col-sm-2"></label>
                    <div class="col-sm-5">
    					 <button type="button" class="btn btn-primary" id="submit_add">提交</button>
                    </div>
 				</div>
            </form>
            
             <?php }else{?>
             	<p class="lead">您还没有通过实名认证暂无法绑定银行卡！前往<u><a href="<?php echo site_url('usercenter/safe');?>">实名认证</a></u></p>
			 <?php }?>
        </div>
    </div>
</div>
<?php $this->load->view('m/footer');?>
</body></html>