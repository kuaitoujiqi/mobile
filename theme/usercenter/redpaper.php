<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title>用户中心 - 我的红包</title>
    <meta name="keywords" content="投资理财,网络理财,固定收益,本息保障,网络融资,互联网理财,互联网金融,P2P,P2C,P2P投资,P2P理财,网贷" />
    <meta name="description" content="提供安全、方便、快捷的投资理财服务，预期收益率10%-18%，第三方资金托管，科学风控，安全保障。" />
    <link href="" rel="apple-touch-icon-precomposed">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/member.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url();?>style/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>style/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>style/js/base.js"></script>
</head>
<body>

<?php $this->load->view('usercenter/header');?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
      <?php $this->load->view('usercenter/left');?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h3 class="page-header">我的红包</h3>
            <div style="margin-top: 20px">
                <strong>红包类型：</strong>
                <div class="btn-group" role="group">
                    <button type="button" class="btn <?php if($type ==0){echo "btn-danger";}else{echo "btn-default";}?>" onClick="javascript:location='<?php echo site_url('usercenter/redpaper/0');?>';">全部红包</button>
                    <button type="button" class="btn <?php if($type ==1){echo "btn-danger";}else{echo "btn-default";}?>" onClick="javascript:location='<?php echo site_url('usercenter/redpaper/1');?>';">未使用</button>
                    <button type="button" class="btn <?php if($type ==2){echo "btn-danger";}else{echo "btn-default";}?>" onClick="javascript:location='<?php echo site_url('usercenter/redpaper/2');?>';">已使用</button>
                </div>
            </div>

            <div class="row red_wrap">
				<?php foreach($result as $key){?>
                <?php if($key['static'] == 1){ //未使用?>
                <div class="col-sm-6 col-lg-2">
                    <div class="thumbnail">
                        <button type="button" class="btn btn-danger btn-block"><?php echo $key['monkey'];?><small>元</small></button>
                        <div class="caption" style="text-align: center">
                            <h4><?php echo $key['title'];?></h4>
                            <p class="text-muted">【<?php echo substr($key['dateline'],0,10);?>】</p>
                        </div>
                    </div>
                </div>
				<?php }else{?>

                <div class="col-sm-6 col-lg-2">
                    <div class="thumbnail">
                        <button type="button" class="btn btn-default btn-block"><?php echo $key['monkey'];?><small>元</small></button>
                        <div class="caption" style="text-align: center">
                            <h4><?php echo $key['title'];?></h4>
                            <p class="text-muted">【<?php echo substr($key['dateline'],0,10);?>】</p>
                        </div>
                    </div>
                </div>
                <?php }?>
				<?php }?>
            </div>

        </div>
    </div>
</div>


</body>
</html>