<form class="form-inline definewidth m20" action="<?php echo admin_url('main/add_invest_org');?>" method="get">  
   <button type="submit" class="btn btn-success" id="addnew">添加机构名称</button>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>id</th>
        <th>名称</th>
        <th>操作</th>
    </tr>
    </thead>
    <?php foreach($result as $key){?>
	     <tr>
            <td><?php echo $key['id'];?></td>
            <td><?php echo $key['org_name'];?></td>
            <td>
                <a href="<?php echo admin_url('main/edit_invest_org/'.$key['id'])?>">编辑</a>  <a href="<?php echo admin_url('main/del_invest_org/'.$key['id'])?>" class="delete">删除</a>
            </td>
            </tr>
<?php }?>
</table>

