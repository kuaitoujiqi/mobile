<form action="" method="post" class="definewidth m20">
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td class="tableleft" width="15%">红包名称</td>
        <td><input type="text" name="title" value="<?php echo set_value('title',$row['title']);?>"/><?php echo form_error('title');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">红包金额</td>
        <td><input type="text" name="monkey" value="<?php echo set_value('monkey',$row['monkey']);?>"/><?php echo form_error('monkey');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">红包最小使用金额</td>
        <td><input type="text" name="min_monkey" value="<?php echo set_value('min_monkey',$row['min_monkey']);?>"/><?php echo form_error('min_monkey');?></td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button" name="submit">保存</button> &nbsp;&nbsp;
        </td>
    </tr>
</table>
</form>
