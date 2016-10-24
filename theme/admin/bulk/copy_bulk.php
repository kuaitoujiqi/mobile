<form action="" method="post" class="definewidth m20">
<table class="table table-bordered table-hover definewidth m10">
    <tr>
      <td class="tableleft">复制项目ID</td>
      <td><input type="text" name="copyid" value="<?php echo set_value('copyid');?>"/><?php echo form_error('copyid');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">项目名称</td>
        <td><input type="text" name="title" value="<?php echo set_value('title');?>"/><?php echo form_error('title');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">项目规模</td>
        <td><input type="text" name="money" value="<?php echo set_value('money');?>"/><?php echo form_error('money');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">项目开始时间</td>
        <td>
        <input type="text" name="creattime" value="<?php echo set_value('creattime',date('Y-m-d H:i:s',time()-(-3000)));?>"/><?php echo form_error('creattime');?></td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button" name="submit">保存</button> &nbsp;&nbsp;
        </td>
    </tr>
    

</table>
</form>
