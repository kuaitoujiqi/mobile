<form class="form-inline definewidth m20" action="<?php echo admin_url('main/add_focus');?>" method="get">  
   <button type="submit" class="btn btn-success" id="addnew">添加焦点图</button>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>id</th>
        <th>名称</th>
        <th>图片</th>
        <th>排序</th>
        <th>连接</th>
        <th>操作</th>
    </tr>
    </thead>
    <?php foreach($result as $key){?>
	     <tr>
            <td><?php echo $key['id'];?></td>
            <td><?php echo $key['title'];?></td>
            <td><img src="<?php echo $key['photo'];?>" width="200" height="100"></td>
            <td><?php echo $key['sort'];?></td>
            <td><a href="<?php echo $key['url'];?>" target="_blank">预览连接</a></td>
            <td><a href="<?php echo admin_url('main/edit_focus/'.$key['id'])?>">编辑</a>  <a href="<?php echo admin_url('main/del_focus/'.$key['id'])?>" class="delete">删除</a></td>
            
            </tr>
<?php }?>
</table>

