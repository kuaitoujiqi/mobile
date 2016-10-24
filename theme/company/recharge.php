<div class="sysinfo">
<p class="sinfotit">充值还款</p>
<div class="exec">
<form class="form-horizontal" id="form_bind" method="post">
    <table width="900" border="0" cellpadding="8" cellspacing="0">
  <tr>
    <td colspan="3">备注信息：单笔充值不能大于</td>
  </tr>

  <tr>
    <td width="122"> 充值金额</td>
    <td width="258"><input type="text" name="monkey" class="form-control" value="<?php echo set_value('monkey');?>"></td>
    <td width="272" style="color:#f00"><?php echo form_error('monkey');?></td>
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

