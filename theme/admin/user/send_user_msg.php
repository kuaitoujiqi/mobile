<script language="javascript">
$(document).ready(function(){
	$('#search').click(function(){
		
	});
});
</script>

<form action="" method="post" class="definewidth m20">
<table class="table table-bordered table-hover m10">
<?php /*?>    <tr>
        <td class="tableleft">检索用户</td>
        <td><input type="text" name="search" id="search" value="" placeholder="请输入用户名或用户ID或用户姓名或用户手机或用户邮箱检索">
        </td>
    </tr><?php */?>
      <tr>
        <td class="tableleft">用户ID</td>
        <td><textarea  name="uid" /><?php echo set_value('uid');?></textarea> (1,2,3以逗号隔开)<?php echo form_error('uid');?>
     </td>
    </tr>
       <tr>
        <td class="tableleft">消息内容</td>
        <td><textarea name="content" /><?php echo set_value('content');?></textarea><?php echo form_error('content');?>
     </td>
    </tr>
     <tr>
        <td class="tableleft"></td>
        <td>
 		<button type="submit" class="btn btn-primary"  name="submit">保存</button>
 </td></tr>
</table>

 </form>