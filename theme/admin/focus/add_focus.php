<script charset="utf-8" src="<?php echo static_url();?>js/kind/kindeditor.js"></script>
<script charset="utf-8" src="<?php echo static_url();?>js/kind/lang/zh_CN.js"></script>
<link rel="stylesheet" href="<?php echo static_url();?>js/kind/themes/default/default.css" />
<script language="javascript">
KindEditor.ready(function(K) {
		var editor = K.editor({
				uploadJson : '<?php echo upload_path;?>',
				allowFileManager : true
		});
		K('#image1').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							imageUrl : K('#photo').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#photo').val(url);
								editor.hideDialog();
							}
						});
					});
				});
		
		K('#image2').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							imageUrl : K('#photo2').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#photo2').val(url);
								editor.hideDialog();
							}
						});
					});
				});
	
		
		});
</script>
<form action="" method="post" class="definewidth m20">
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td class="tableleft" width="15%">焦点图名称</td>
        <td><input type="text" name="title" value="<?php echo set_value('title');?>"/><?php echo form_error('title');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">图片</td>
        <td><input type="text" name="photo" id="photo" value="<?php echo set_value('photo');?>"/><?php echo form_error('photo');?> <a class="btn btn-primary" id="image1">上传图片</a></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">手机图片</td>
        <td><input type="text" name="m_photo" id="photo2" value="<?php echo set_value('m_photo');?>"/><?php echo form_error('m_photo');?> <a class="btn btn-primary" id="image2">上传图片</a></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">URL</td>
        <td><input type="text" name="url" value="<?php echo set_value('url');?>"/><?php echo form_error('url');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">手机URL</td>
        <td><input type="text" name="m_url" value="<?php echo set_value('m_url');?>"/><?php echo form_error('m_url');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">是否手机显示</td>
        <td>
        <input type="radio" name="is_phone" value="1" <?php echo set_radio('is_phone',1,true);?>/>显示
        <input type="radio" name="is_phone" value="2" <?php echo set_radio('is_phone',2);?>/>不显示
        <?php echo form_error('m_url');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">SORT（越小越靠前）</td>
        <td><input type="text" name="sort" value="<?php echo set_value('sort',0);?>"/><?php echo form_error('sort');?></td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button" name="submit">保存</button> &nbsp;&nbsp;
        </td>
    </tr>
</table>
</form>
