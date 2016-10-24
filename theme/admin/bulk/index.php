<form class="form-inline definewidth m20" action="" method="get">  
     
    <a class="btn btn-success" href="<?php echo admin_url('bulk_standard/add_bulk');?>">添加散标</a>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>ID</th>
        <th>项目名称</th>
        <th>项目收益率</th>
        <th>服务费率</th>
        <th>投资月数</th>
        <th>下次发利息时间</th>
        <th>项目规模</th>
        <th>剩余金额</th>
        <th>开通状态</th>
        <th>项目状态</th>
        <th>企业还款</th>
        <th>利息发放</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($result as $key){?>
    <tr>
        <td><?php echo $key['id'];?></td>
        <td><?php echo $key['title'];?></td>
        <td><?php echo $key['rate'];?></td>
        <td><?php echo $key['services'];?></td>
        <td><?php echo $key['day'];?></td>
        <td><?php if($key['next_interest'] != ""){echo date('Y-m-d H:i:s',$key['next_interest']);}?></td>
        <td><?php echo $key['money'];?></td>
        <td><?php echo $key['restmoney'];?></td>
        <td><?php echo $key['is_open'] == 1?"开通":"未开通";?></td>
        <td>
        	<?php switch($key['static'])
			{
				case 1:echo "购买中";break;
				case 2:echo "还款中";break;
				case 3:echo "已完成";break;
				case 4:echo "审核中";break;		
			}?>
        </td>
        <td><?php echo $key['repayment_num'];?>/<?php echo $key['day'];?></td>
        <td><?php echo $key['send_num'];?>/<?php echo $key['day'];?></td>
        <td><a href="<?php echo admin_url('bulk_standard/examine/'.$key['id']);?>" onclick="return confirm('确定更改项目状态为还款中？');">审核</a> <a href="<?php echo admin_url('bulk_standard/edit_bulk/'.$key['id']);?>">编辑</a> <a href="<?php echo admin_url('bulk_standard/del_bulk/'.$key['id']);?>" class="delete">删除</a> 
        <?php if($key['sina_check'] == 1){?>
        	<a href="<?php echo admin_url('bulk_standard/create_p2p_product/'.$key['id']);?>">创建标的</a>
        <?php }?>
        <a href="<?php echo admin_url('bulk_standard/second_edit/'.$key['id']);?>">简介</a>
        <a href="<?php echo site_url('product/bulk_standard/'.$key['id']);?>" target="_blank">预览</a>
        </td>
    </tr>
    <?php }?>
    </tbody>
    	
        </table>
<div class="inline pull-right page">
	<?php echo $links;?>
</div>
