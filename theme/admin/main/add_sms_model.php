<form action="" method="post" class="definewidth m20">
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td class="tableleft" width="15%">模板名称</td>
        <td><input type="text" name="name" value="<?php echo set_value('name');?>"/><?php echo form_error('name');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">模板内容</td>
        <td><input type="text" name="content" value="<?php echo set_value('content');?>"/><?php echo form_error('content');?></td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button" name="submit">保存</button> &nbsp;&nbsp;
        </td>
    </tr>
</table>
</form>
