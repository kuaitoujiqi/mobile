<form action="" method="post" class="definewidth m20">
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td class="tableleft" width="15%">项目名称</td>
        <td><input type="text" name="title" value="<?php echo set_value('title',$row['title']);?>"/><?php echo form_error('title');?></td>
    </tr>
    <tr>
      <td class="tableleft">项目年华收益率</td>
      <td>
      <input type="text" name="yield" value="<?php echo set_value('yield',$row['yield']);?>"/><?php echo form_error('yield');?>
      </td>
    </tr>
    <tr>
      <td class="tableleft">项目期限</td>
      <td>
      <input type="radio" name="deadline" value="30" <?php echo set_radio('deadline',30,$row['deadline']==30?true:false);?>>30天
      <input type="radio" name="deadline" value="90" <?php echo set_radio('deadline',90,$row['deadline']==90?true:false);?>>90天
      <input type="radio" name="deadline" value="180" <?php echo set_radio('deadline',180,$row['deadline']==180?true:false);?>>180天
      <input type="radio" name="deadline" value="360" <?php echo set_radio('deadline',360,$row['deadline']==360?true:false);?>>360天
      </td>
    </tr>
    <tr>
      <td class="tableleft">可转让期限</td>
      <td>
       <input type="text" name="assignment_hour" value="<?php echo set_value('assignment_hour',$row['assignment_hour']);?>"/><?php echo form_error('assignment_hour');?>
       </td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button" name="submit">保存</button> &nbsp;&nbsp;
        </td>
    </tr>
</table>
</form>
