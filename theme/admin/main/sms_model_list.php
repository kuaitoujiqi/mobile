<form class="form-inline definewidth m20" action="<?php echo admin_url('main/add_sms_model');?>" method="get">  
   <button type="submit" class="btn btn-success" id="addnew">添加短信模板</button>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>id</th>
        <th>名称</th>
        <th>模板内容</th>
        <th>操作</th>
    </tr>
    </thead>
    <?php foreach($result as $key){?>
	     <tr>
            <td><?php echo $key['id'];?></td>
            <td><?php echo $key['name'];?></td>
            <td><?php echo $key['content'];?></td>
            <td>
                <a href="<?php echo admin_url('main/edit_sms_model/'.$key['id'])?>">编辑</a>  <a href="<?php echo admin_url('main/del_sms_model/'.$key['id'])?>" class="delete">删除</a>
            </td>
            </tr>
<?php }?>
</table>

