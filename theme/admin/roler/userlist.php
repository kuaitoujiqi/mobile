<form class="form-inline definewidth m20" action="<?php echo admin_url('roler/adduser');?>" method="post">  
   <button type="submit" class="btn btn-success" id="addnew">添加用户</button>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>用户ID</th>
        <th>用户名</th>
        <th>用户组</th>
        <th>用户姓名</th>
        <th>状态</th>
        <th>管理操作</th>
    </tr>
    </thead>
    <?php foreach($result as $key){?>
	     <tr>
            <td><?php echo $key['id'];?></td>
            <td><?php echo $key['username'];?></td>
            <td>
            	<?php if($key['groupname'] == "")
				{
					echo $key['group'] == 0?"超级管理员":"用户组不存在";	
				}
				else
				{
					echo $key['groupname'];	
				}?>
            </td>
            <td><?php echo $key['name'];?></td>
            <td><?php echo $key['static']==1?"启用":"禁用";?></td>
            <td>
                  <a href="<?php echo admin_url('roler/edituser/'.$key['id']);?>">编辑</a>
                  <a href="<?php echo admin_url('roler/deluser/'.$key['id']);?>" class="delete">删除</a>
            </td>
        </tr>
      <?php }?>
      </table>
<div class="inline pull-right page">
<?php echo $links;?>
</div>
