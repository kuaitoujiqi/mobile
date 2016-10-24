<form class="form-inline definewidth m20" action="" method="get">  
    <a class="btn btn-success" href="<?php echo admin_url('project/add_red_paper');?>">添加红包</a>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>红包ID</th>
        <th>红包名称</th>
        <th>红包金额</th>
        <th>红包最小使用金额</th>
        <th>操作</th>
    </tr>
    </thead>
    	<?php foreach($result as $key){?>
	     <tr>
            <td><?php echo $key['id'];?></td>
            <td><?php echo $key['title'];?></td>
            <td><?php echo $key['monkey'];?></td>
            <td><?php echo $key['min_monkey'];?></td>
            <td>
                  <a href="<?php echo admin_url('project/edit_red_paper/'.$key['id']);?>">编辑</a>
                  <a href="<?php echo admin_url('project/del_red_paper/'.$key['id']);?>" class="delete">删除</a>
            </td>
        </tr>
        <?php }?>
        </table>

