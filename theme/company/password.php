<div class="sysinfo">
<p class="sinfotit">密码修改</p>
<div class="exec">
<form class="form-horizontal" id="form_bind" method="post">
<table width="900" border="0" cellpadding="8" cellspacing="0">

  <tr>
    <td width="122"> 旧密码</td>
    <td width="258"><input type="password" name="oldpass" class="form-control" value=""></td>
    <td width="272" style="color:#f00"><?php echo form_error('oldpass');?></td>
  </tr>
	<tr>
    <td width="122"> 新密码</td>
    <td width="258"><input type="password" name="newpass" class="form-control" value=""></td>
    <td width="272" style="color:#f00"><?php echo form_error('newpass');?></td>
  </tr>
  <tr>
    <td width="122"> 确认密码</td>
    <td width="258"><input type="password" name="compass" class="form-control" value=""></td>
    <td width="272" style="color:#f00"><?php echo form_error('compass');?></td>
  </tr>
  <tr>
    <td colspan="3"><button type="submit" class="btn btn-primary">提交</button></td>
   </tr>

</table>
</form>	
<?php if(isset($error)){?>
<div style="height:30px; color:#f00"><?php echo $error;?></div>	
<?php }?>
</div>
</div>
</div>

