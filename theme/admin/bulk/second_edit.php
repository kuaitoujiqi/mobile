<script charset="utf-8" src="<?php echo static_url();?>js//kind/kindeditor.js"></script>
<script charset="utf-8" src="<?php echo static_url();?>js//kind/lang/zh_CN.js"></script>
<style type="text/css">
.content{ height:350px; width:730px}
</style>
<script language="javascript">
      KindEditor.ready(function(K) {
        K.create('.content', {
                uploadJson : '<?php echo upload_path;?>',
				allowFileManager : true
        	});
		var editor = K.editor({
				uploadJson : '<?php echo upload_path;?>',
				allowFileManager : true
		});
	  });
</script>
<form action="" method="post" class="definewidth m20">
<table class="table table-bordered table-hover definewidth m10">

    <tr>
        <td class="tableleft" width="15%">项目描述</td>
        <td><textarea  name="describe" value="" class="content"/><?php echo set_value('describe',$row['describe']);?></textarea><?php echo form_error('describe');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">资产状况</td>
        <td><textarea  name="assets" value="" class="content"/><?php echo set_value('assets',$row['assets']);?></textarea><?php echo form_error('assets');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">风控保证</td>
        <td><textarea  name="pledge" value="" class="content"/><?php echo set_value('pledge',$row['pledge']);?></textarea><?php echo form_error('pledge');?></td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button" name="submit">保存</button> &nbsp;&nbsp;
        </td>
    </tr>
    

</table>
</form>
