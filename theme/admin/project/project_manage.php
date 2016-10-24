<form class="form-inline definewidth m20" action="" method="get">  
     
    <a class="btn btn-success" href="<?php echo admin_url('project/add_project_manage');?>">添加标的</a>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>ID</th>
        <th>项目名称</th>
        <th>日期</th>
        <th>当日金额</th>
        <th>完成金额</th>
        <th>操作</th>
    </tr>
    </thead>
    	<?php foreach($result as $key){?>
	     <tr>
             <td><?php echo $key['id'];?></td>
            <td><?php echo $key['title'];?></td>
            <td><?php echo $key['current_hour'];?></td>
             <td><?php echo $key['size'];?></td>
            <td><?php echo $key['done_size'];?></td>
            <td>
                  <a href="<?php echo admin_url('project/edit_project_manage/'.$key['id']);?>">编辑</a>
                  <a href="<?php echo admin_url('project/del_project_manage/'.$key['id']);?>" class="delete">删除</a>
            </td>
        </tr>
        <?php }?>
        </table>
<div class="inline pull-right page">
	<?php echo $links;?>
</div>
