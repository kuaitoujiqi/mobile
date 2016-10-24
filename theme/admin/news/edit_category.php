<form action="<?php echo admin_url('news/edit_category/'.$row['id']);?>" method="post" class="definewidth m20">
<input type="hidden" name="id" value="<?php echo $row['id'];?>">
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td class="tableleft" width="15%">名称</td>
        <td><input type="text" name="name" value="<?php echo set_value('name',$row['name']);?>"/><?php echo form_error('name');?></td>
    </tr>
    <tr>
        <td class="tableleft">排序（越大越往前）</td>
        <td><input type="text" name="sort" value="<?php echo set_value('sort',$row['sort']);?>"/><?php echo form_error('sort');?></td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button" name="submit">保存</button> &nbsp;&nbsp;
        </td>
    </tr>
</table>
</form>
