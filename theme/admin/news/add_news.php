<script charset="utf-8" src="<?php echo static_url();?>js/kind/kindeditor.js"></script>
<script charset="utf-8" src="<?php echo static_url();?>js/kind/lang/zh_CN.js"></script>
<link rel="stylesheet" href="<?php echo static_url();?>js/kind/themes/default/default.css" />
<script language="javascript">
      KindEditor.ready(function(K) {
        K.create('#content', {
                uploadJson : '<?php echo upload_path;?>',
				allowFileManager : true
        	});
		var editor = K.editor({
				uploadJson : '<?php echo upload_path;?>',
				allowFileManager : true
		});
		K('#image1').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							imageUrl : K('#url1').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#url1').val(url);
								editor.hideDialog();
							}
						});
					});
				});
		});
</script>
<form action="" method="post" class="definewidth m20">
<input type="hidden" name="uid" value="<?php echo $this->session->userdata('auid');?>" />
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td class="tableleft" width="15%">名称</td>
        <td><input type="text" name="title" value="<?php echo set_value('title');?>"/><?php echo form_error('title');?></td>
    </tr>
    <tr>
      <td class="tableleft">分类</td>
      <td><select name="pid" id="select">
      		<?php foreach($resutl as $key){?>
            	<option value="<?php echo $key['id'];?>" <?php echo set_select('pid',$key['id']);?>><?php echo $key['name'];?></option>
			<?php }?>
          </select></td>
    </tr>
    <tr>
      <td class="tableleft">关键词</td>
      <td><input type="text" name="keyword" value="<?php echo set_value('keyword');?>"/></td>
    </tr>
    <tr>
      <td class="tableleft">描述</td>
      <td>
      
      <textarea name="description"><?php echo set_value('description');?></textarea></td>
    </tr>
    <tr>
      <td class="tableleft">缩略图</td>
      <td><input type="text" id="url1" name="photo" value="<?php echo set_value('photo');?>"  readonly="readonly"/> <a class="btn btn-primary" id="image1">上传图片</a></td>
    </tr>
    <tr>
      <td class="tableleft">时间</td>
      <td>
      <script language="javascript" type="text/javascript" src="<?php echo static_url();?>js/data/WdatePicker.js"></script>
      <input type="text" id="d233" onFocus="WdatePicker({startDate:'<?php echo date('Y-m-d H:i:s');?>',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})" style="width:160px" value="<?php echo set_value('dateline',date('Y-m-d H:i:s'));?>" name="dateline" /></td>
    </tr>
    <tr>
      <td class="tableleft">内容</td>
      <td>
       <textarea name="content" style="width:700px; height:300px" id="content"><?php echo set_value('content');?></textarea>
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
