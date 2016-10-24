<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="favicon.ico" type="image/x-icon"/>
    <title>保证合同书</title>
    <meta name="keywords" content="投资理财,网络理财,固定收益,本息保障,网络融资,互联网理财,互联网金融,P2P,P2C,P2P投资,P2P理财,网贷" />
    <meta name="description" content="提供安全、方便、快捷的投资理财服务，预期收益率10%-18%，第三方资金托管，科学风控，安全保障。" />
    <link href="" rel="apple-touch-icon-precomposed">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/member.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url();?>style/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>style/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>style/js/base.js"></script>
</head>
<body>

<div class="container" style="width: 800px; margin:0 auto">

    <h2 style="text-align: center;font-weight: bold;">保证函</h2>

    <div style="margin-top: 30px;">
		<p>致：编号为<?php echo $info[2]['number'];?>《网络借款协议》项下的各出借方：</p>
    	<?php $ex = explode("|",$info[2]['pact']);?>
        <p>保证人：<?php echo $ex[0];?>（以下简称甲方）</p>
        <p>注册号：<?php echo $ex[1];?></p>
        <p>被保证人：<?php echo $info[3]['company_name'];?>（以下简称乙方）</p>
        <p>注册号：<?php echo $info[3]['license_no'];?></p>
    </div>
    <br>
    <p>甲方同意为乙方按期偿还上述合同项下的借款提供保证担保。</p>
    <p>甲方保证乙方依照合同规定按期偿还全部合同项下的金额，包括主债的本息、违约金及其他负担。如乙方不能按期偿还，甲方将承担被担保人承担的全部偿付义务。</p>
    <br>
    <p style="text-align: right">保证人：<?php echo $ex[0];?></p>
    <p style="text-align: right"><?php echo date('Y年m月d日',$info[2]['starttime']);?></p>

</div>
</body>
</html>