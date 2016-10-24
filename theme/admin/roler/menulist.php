<form class="form-inline definewidth m20" action="<?php echo admin_url('roler/addmenu');?>" method="post">
    <button type="submit" class="btn btn-success" id="addnew">新增菜单</button> (排序越小越往前)
</form>
<form action="<?php echo admin_url('roler/menusotr');?>" method="post">
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th>菜单标题</th>
        <th>控制器方法</th>
        <th>是否显示</th>
        <th>排序</th>
        <th>管理操作</th>
    </tr>
    </thead>
	    <?php foreach($menulist as $key){?>
        <?php if($key['pid'] == 0){?>
        <tr>
            <td colspan="4"><strong><?php echo $key['name'];?></strong></td>
            <td><a href="<?php echo admin_url('roler/editmenu/'.$key['id']);?>">编辑</a>
            	<a href="<?php echo admin_url('roler/delmenu/'.$key['id']);?>" class="delete" title="需要无下级分类">删除</a>
            </td>
        </tr>
        	<?php foreach($menulist as $key_s){
				if($key_s['pid'] == $key['id']){	
			?>
            <tr>
                <td>----<?php echo $key_s['name'];?></td>
                <td><?php echo $key_s['uri'];?></td>
                <td><?php echo $key_s['show'] == 0 ? "显示":"不显示";?></td>
                <td><input type="text" name="sort[]" value="<?php echo $key_s['sort'];?>" style="width:40px"/>
                <input type="hidden" name="id[]" value="<?php echo $key_s['id'];?>" />
                </td>
                <td><a href="<?php echo admin_url('roler/editmenu/'.$key_s['id']);?>">编辑</a>
                	<a href="<?php echo admin_url('roler/delmenu/'.$key_s['id']);?>" class="delete">删除</a>
                </td>
            </tr>
            <?php }}?>
        
        <?php }?>
        <?php }?>
         <tr>
            <td colspan="5"><input type="submit" name="submit"  value="更新排序"/></td>
        
        </tr>
        </table>
        </form>

