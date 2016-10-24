<script language="javascript" type="text/javascript" src="<?php echo static_url();?>js/data/WdatePicker.js"></script>

<form class="form-inline definewidth m20" action="" method="get">  
<a class="btn btn-<?php if($type == 0){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/have_repayment/');?>?type=0">全部</a>
<a class="btn btn-<?php if($type == 1){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/have_repayment/');?>?type=1">3天内</a>
<a class="btn btn-<?php if($type == 2){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/have_repayment/');?>?type=2">5天内</a>
<a class="btn btn-<?php if($type == 3){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/have_repayment/');?>?type=3">10天内</a>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>项目名称</th>
        <th>企业名称</th>
        <th>企业手机号</th>
        <th>还款时间</th>
        <th>还款金额</th>
    </tr>
    </thead>
    	<?php foreach($result as $key){?>
	     <tr>
            <td><?php echo $key['title'];?></td>
            <td>
			<?php echo $key['company_name'];?>
            </td>
            <td><?php echo $key['telephone'];?></td>
            <td><?php echo date('Y-m-d H:i:s',$key['dateline']);?></td>
            <td><?php echo $key['monkey'];?>
            </td>
        </tr>
        <?php }?>
        </table>
<div class="inline pull-right page">
	<?php echo $links;?>
</div>
