<form action="" method="post" class="definewidth m20">
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td class="tableleft" width="15%">SMTP地址</td>
        <td><input type="text" name="smtp_host" value="<?php echo set_value('smtp_host',$row['smtp_host']);?>"/><?php echo form_error('smtp_host');?></td>
    </tr>
    <tr>
        <td class="tableleft">SMTP端口</td>
        <td>
        <input type="radio" name="smtp_port"  value="25" <?php echo set_radio('smtp_port',25,$row['smtp_port'] == "" || $row['smtp_port']=="25"?true:false);?>/>25
        <input type="radio" name="smtp_port"  value="465" <?php echo set_radio('smtp_port',465,$row['smtp_port']=="465"?true:false);?>/>465
		<input type="radio" name="smtp_port"  value="587" <?php echo set_radio('smtp_port',587,$row['smtp_port']=="587"?true:false);?>/>587
		<?php echo form_error('smtp_port');?></td>
    </tr>
    <tr>
        <td class="tableleft">SMTP用户</td>
        <td><input type="text" name="smtp_user"  value="<?php echo set_value('smtp_user',$row['smtp_user']);?>"/><?php echo form_error('smtp_user');?>
        </td>
    </tr>
    <tr>
      <td class="tableleft">SMTP密码</td>
      <td><input type="password" name="smtp_pass"  value="<?php echo set_value('smtp_pass',$row['smtp_pass']);?>"/>
      <?php echo form_error('smtp_pass');?></td>
    </tr>
    <tr>
      <td class="tableleft">发信人地址</td>
      <td><input type="text" name="senduser" value="<?php echo set_value('senduser',$row['senduser']);?>"/>
      <?php echo form_error('senduser');?></td>
    </tr>
    <tr>
      <td class="tableleft">发信人名称</td>
      <td><input type="text" name="sendname" value="<?php echo set_value('sendname',$row['sendname']);?>"/>
      <?php echo form_error('sendname');?></td>
    </tr>
     <tr>
      <td class="tableleft">测试人地址</td>
      <td><input type="text" name="testname" value="<?php echo set_value('testname',$row['testname']);?>"/>
      <?php echo form_error('testname');?></td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button" name="submit">保存</button> &nbsp;&nbsp;<a class="btn btn-success" href="<?php echo admin_url('main/email/test');?>">测试发送邮件</a>
        </td>
    </tr>
</table>
</form>
