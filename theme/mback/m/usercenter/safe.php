<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="renderer" content="webkit" />
    <link type="image/x-icon" href="<?php echo base_url();?>favicon.ico"/>
    <title>安全中心-蜂融网</title>
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
</head>


<body class="index">
<!--主导航--------------------------------------------------------------------------------------------->
<?php $this->load->view('m/head'); ?>
<?php $this->load->view('m/usercenter/menu'); ?>
<!--选项菜单--------------------------------------------------------------------------------------------->

<div class="container" style="margin-top: 0px;">
    <h3 class="page-header">安全中心</h3>

</div>

<!--导航块--------------------------------------------------------------------------------------------->


<table class="table table-bordered safe_table">
    <tbody>
    <tr class="success">
        <td class="text-success">用户名</td>
        <td><?php echo $userinfo['nickname'];?></td>
        <td><i class="glyphicon glyphicon-ok-sign text-success"></i> </td>
        <td></td>
    </tr>
    <tr class="success">
        <td class="text-success">绑定手机</td>
        <td><?php echo substr_replace($userinfo['mobile'],'*****',3,5);?></td>
        <td><i class="glyphicon glyphicon-ok-sign text-success"></i> </td>
        <td><button type="button" class="btn btn-sm btn-success" onClick="javascript:location.href='<?php echo site_url('m/usercenter/change_phone');?>'">修改</button></td>
    </tr>
    <tr class="success">
        <td class="text-success">登陆密码</td>
        <td>已单向加密存储</td>
        <td><i class="glyphicon glyphicon-ok-sign text-success"></i> </td>
        <td><button type="button" class="btn btn-sm btn-success" onClick="javascript:location.href='<?php echo site_url('m/usercenter/change_password');?>'">修改</button></td>
    </tr>
    <?php if($userinfo['is_idcard'] == 1){?>
    <tr class="<?php if($userinfo['trading'] == ""){echo "danger";}else{echo "success";}?>">
        <td class="text-success">交易密码</td>
        <td><?php if($userinfo['trading'] == ""){echo "未设置";}else{echo "已设置";}?></td>
        <td><i class="<?php if($userinfo['trading'] == ""){echo "glyphicon glyphicon-question-sign text-danger";}else{echo "glyphicon glyphicon-ok-sign text-success";}?>"></i> </td>
        <td><button type="button" class="<?php if($userinfo['trading'] != ""){?>btn btn-sm btn-success<?php }else{?>btn btn-sm btn-danger<?php }?>" onClick="javascript:location.href='<?php echo site_url('m/usercenter/trading');?>'"><?php if($userinfo['trading'] == ""){echo "添加";}else{echo "修改";}?></button></td>
    </tr>
    <?php }?>
    <?php if($userinfo['is_idcard'] != 1){?>
    <tr class="danger">
        <td class="text-success">实名认证</td>
        <td>未认证</td>
        <td><i class="glyphicon glyphicon-question-sign text-danger"></i> </td>
        <td><button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#authentication">实名认证</button></td>
    </tr>
	<?php }?>
    <?php if($userinfo['is_idcard'] == 1){?>
    <tr class="success">
        <td class="text-success">实名认证</td>
        <td><?php echo $userinfo['name'];?>（<?php echo $userinfo['idcard'];?>）</td>
        <td><i class="glyphicon glyphicon-ok-sign text-success"></i> </td>
        <td></td>
    </tr>
    <?php }?>
    </tbody>
</table>


<!--最近操作--------------------------------------------------------------------------------------------->

<?php $this->load->view('m/footer');?>
</body>
</html>


