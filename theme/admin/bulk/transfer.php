<form class="form-inline definewidth m20" action="" method="get">  
     
    <a class="btn btn-<?php if($type == 0){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('bulk_standard/transfer/0');?>">全部</a>
    <a class="btn btn-<?php if($type == 1){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('bulk_standard/transfer/1');?>">已发布</a>
    <a class="btn btn-<?php if($type == 2){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('bulk_standard/transfer/2');?>">已审核</a>
    <a class="btn btn-<?php if($type == 3){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('bulk_standard/transfer/3');?>">已转让</a>
    <a class="btn btn-<?php if($type == 4){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('bulk_standard/transfer/4');?>">已撤销</a>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>ID</th>
        <th>状态</th>
        <th>项目ID/用户投资ID</th>
        <th>发布时间</th>
        <th>审核时间</th>
        <th>发布用户ID</th>
        <th>购买用户ID</th>
        <th>转让价格</th>
        <th>项目原价</th>
        <th>购买时间</th>
        <th>备注</th>
        <th>状态(买方/卖方)</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($result as $key){?>
    <tr>
        <td><?php echo $key['id'];?></td>
        <td>
        	<?php switch($key['static'])
			{
				case 1:echo "已发布";break;	
				case 2:echo "已审核";break;
				case 3:echo "已转让";break;
				case 4:echo "已撤销";break;
			}?>
        </td>
        <td><?php echo "<a href='".site_url('product/bulk_standard/'.$key['pro_id'])."' target='_blank'>".$key['pro_id']."</a>/".$key['projectid'];?></td>
        <td><?php echo date('Y-m-d H:i:s',$key['cretattime']);?></td>
        <td><?php  if($key['examine'] != ""){echo date('Y-m-d H:i:s',$key['examine']);}?></td>
        <td><?php echo $key['user_id'];?></td>
        <td><?php echo $key['sendee'];?></td>
        <td><?php echo $key['monkey'];?></td>
        <td><?php echo $key['holding'];?></td>
        <td><?php echo $key['sendeetime'];?></td>
        <td><?php echo $key['reasons'];?></td>
       	<td>
		<?php if($key['static'] == 3){?>
		<?php if($key['buystatic'] == 2){echo "正常";}else{echo "<font style='color:red'>异常</font>";}?>/<?php  if($key['sellstatic'] == 2){echo "正常";}else{echo "<font style='color:red'>异常</font>";}?>
        <?php }?>
        </td>
        <td>
		<?php if($key['static'] < 2){?>
			<?php if($key['static'] != 2){?>
            	<a href="<?php echo admin_url('bulk_standard/shenhe_transfer/'.$key['id']."/".$type."/".$page);?>" onclick="return confirm('确定审核，审核后不可更改状态?')">审核</a>
			<?php }?>  
            <a href="<?php echo admin_url('bulk_standard/del_transfer/'.$key['id']."/".$type."/".$page);?>" class="delete">撤销</a>
			
		<?php }?>
	</td>
    </tr>
    <?php }?>
    </tbody>
    	
        </table>
<div class="inline pull-right page">
	<?php echo $links;?>
</div>
