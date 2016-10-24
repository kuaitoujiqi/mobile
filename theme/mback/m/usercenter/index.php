<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>用户中心-蜂融网</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
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

</head>


<body class="index">

<!--主导航--------------------------------------------------------------------------------------------->
<?php $this->load->view('m/head'); ?>

<!--数值--------------------------------------------------------------------------------------------->
<div class="container wallet_top_wrap">
    <div class="row wallet_top" style="padding-top: 20px;">
        <div class="col-xs-5">
            账户余额
        </div>
        <div class="col-xs-7">
            ￥<?php echo strval($userinfo['balance']);?>
        </div>
    </div>
    <div class="row wallet_top" style="padding-top: 5px">
        <div class="col-xs-5">
            持有产品金额
        </div>
        <div class="col-xs-7">
            ￥<?php echo strval($cyje['monkey'])==""?0.00:strval(number_format($cyje['monkey'],2));?>
        </div>
    </div>
    <div class="row wallet_top" style="padding-top: 5px;">
        <div class="col-xs-5">
            免费提现额度
        </div>
        <div class="col-xs-7">
            ￥<?php echo strval($userinfo['quota']);?>
        </div>
    </div>
    <div class="row wallet_top" style="padding-top: 5px;padding-bottom: 20px;">
        <div class="col-xs-5">
            预期收益
        </div>
        <div class="col-xs-7">
            ￥<?php echo strval($lsje['interest'])==""?0.00:strval(number_format($lsje['interest'],2));?>
        </div>
    </div>
</div>


<!--导航块--------------------------------------------------------------------------------------------->
<?php $this->load->view('m/usercenter/menu'); ?>

<!--最近操作--------------------------------------------------------------------------------------------->
<div class="container">
    <div class="row">
        <h5 style="margin-left: 8px;"><span class="glyphicon glyphicon-list-alt"> </span> 最近操作记录</h5>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>日期</th>
                <th>操作类型</th>
                <th>金额</th>
                <th>状态</th>
                <th>详情</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($czjl[1] as $key){?>
            <tr>
                <td><?php echo date('Y-m-d',$key['dateline']);?></td>
                <td><?php 
							switch($key['type'])
							{
								case 1:echo "充值";break;
								case 2:echo "投资";break;
								case 5:echo "还款";break;
								case 7:echo "提现";break;
								case 9:echo "投资债权";break;
								case 10:echo "转让债权";break;
							}
						?></td>
                <td><?php echo $key['monkey'];?></td>
                <td><?php if($key['static'] == 1){echo "处理中";}if($key['static'] == 2){echo "成功";}if($key['static'] == 3){echo "失败";}?></td>
                <td><?php switch($key['type'])
							{
								case 2:case 5:case 9:echo anchor('m/product/bulk_standard/'.$key['productid'],'查看详情',array('target'=>'_blank'));break;
								default:echo $key['remark'];break;	
							}?></td>
            </tr>
            <?php }?>
            </tbody>
        </table>
    </div>

</div>

<?php $this->load->view('m/footer');?>



