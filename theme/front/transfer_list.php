<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title>债权转让列表</title>
    <meta name="keywords" content="投资理财,网络理财,固定收益,本息保障,网络融资,互联网理财,互联网金融,P2P,P2C,P2P投资,P2P理财,网贷" />
    <meta name="description" content="提供安全、方便、快捷的投资理财服务，预期收益率10%-18%，第三方资金托管，科学风控，安全保障。" />
    <link href="" rel="apple-touch-icon-precomposed">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/base.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/index.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url();?>style/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>style/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>style/js/base.js"></script>
    <script>
        $('.carousel').carousel({
            interval: 2000
        })
    </script>
</head>
<body>
<?php $this->load->view('front/header');?>

<!-- --------------------------- 项目列表-------------------->
<div class="container mt10">
    <div class="btn-group">
        <a  href="<?php echo site_url('product/bulk_standard_list');?>" class="btn-default btn">项目列表</a>
        <a class="btn btn-danger" href="<?php echo site_url('product/transfer_list');?>">债权转让</a>
    </div>
</div>
<div class="container mt10" style="padding-bottom: 20px">

   	   <?php foreach($result as $key){?>
    <div class="list_one row" style="background:#fff">
        <div class="col-lg-3">
            <img class="list_img" src="<?php echo $key['photo'];?>" width="270" height="180"/>
        </div>
        <div class="col-lg-9" >
        	<?php if($key['static'] == 2){?>
            <a class="btn btn-danger pull-right mt20" href="<?php echo site_url('product/transfer/'.$key['id']);?>" target="_blank">购买</a>
            <?php }?>
            <?php if($key['static'] == 3){?>
            <a class="btn btn-default pull-right mt20" disabled="disabled">已完成</a>
            <?php }?>
            <a href="<?php echo site_url('product/transfer/'.$key['id']);?>" class="list_title" target="_blank"><?php echo $key['title'];?></a>
            <p class="list_tip"><?php echo $key['introduction'];?></p>
            <table class="table table-striped">
                <tbody>

                <tr class="list_ini">
                    <td><?php echo $key['rate']*100;?>%</td>
                    <td><?php echo date('Y-m-d',$key['endtitme']-86400);?></td>
                    <td><?php echo $key['holding'];?></td>
                    <td><?php echo $key['monkey'];?></td>
                    <td><?php echo $key['interest'];?></td>
                    <td>按月付息/到期还本</td>
                </tr>
                <tr class="list_label">
                    <td>年化收益率</td>
                    <td>项目还本日期</td>
                    <td>项目原始价格</td>
                    <td>项目转让价格</td>
                    <td>预计收益</td>
                    <td>还款方式</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php }?>
       <nav>
            	<ul class="pagination">
                	<?php echo $links;?>
                </ul>
            </nav>
</div>

<?php $this->load->view('front/footer');?>
</body>
</html>
