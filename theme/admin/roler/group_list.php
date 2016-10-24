<form class="form-inline definewidth m20" action="<?php echo admin_url('roler/addgroup');?>" method="post">    
    <button type="submit" class="btn btn-success" id="addnew">新增用户组</button>
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th width="10%">用户组id</th>
        <th width="20%">用户组名称</th>
        <th>操作</th>
    </tr>
    </thead>
    	<?php foreach($grouplist as $key){?>
	     <tr>
            <td><?php echo $key['id'];?></td>
            <td><?php echo $key['name'];?></td>
            <td>
                <a href="<?php echo admin_url('roler/editgroup/'.$key['id']);?>">编辑</a> <a href="<?php echo admin_url('roler/delgroup/'.$key['id']);?>" class="delete">删除</a>                
            </td>
        </tr>	
        <?php }?>
</table>
