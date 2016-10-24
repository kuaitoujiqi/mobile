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
		K('.multigraph').click(function() {
					var obj = $(this);
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							clickFn : function(url, title, width, height, border, align) {
								var info = obj.next('[type="hidden"]').val(); //获取图片内容
								if(info == "")
								{
									obj.next('[type="hidden"]').val(url); 	
								}
								else
								{
									obj.next('[type="hidden"]').val(obj.next('[type="hidden"]').val() + '~' + url); 	
								}
								obj.next('[type="hidden"]').next('label').html(obj.next('[type="hidden"]').next('label').html() + '<span style="text-align:center; display:inline-block; margin-right:15px;margin-top:10px"><img src="'+ url +'" width="100" height="200" /><br><a class="del_pic">删除</a></span>');
								editor.hideDialog();
							}
						});
					});
				});
				
			
		});
		
$(document).ready(function(){
	//开始的时候如果hidden 有值显示内容
	$('.picinfo').each(function() {
        var obj = $(this);
		var objinfo = obj.val();
		if(objinfo != "")
		{
			objinfo_arr = objinfo.split("~");
			var labelinfo = "";
			for(i=0;i<objinfo_arr.length;i++)
			{
				labelinfo = labelinfo + '<span style="text-align:center; display:inline-block; margin-right:15px;margin-top:10px"><img src="'+ objinfo_arr[i] +'" width="100" height="200" /><br><a class="del_pic">删除</a></span>';
			}
			obj.next('label').html(labelinfo);
		}
    });
	
	$(document).on("click",".del_pic",function(){
		var index = $(this).parent('span').index();
		var picinfo = $(this).parent('span').parent('label').prev('[type="hidden"]').val();
		var picinfo_arr = picinfo.split("~");
		picinfo_arr.splice(index,1);
		var picinfo_new = picinfo_arr.join("~");
		$(this).parent('span').parent('label').prev('[type="hidden"]').val(picinfo_new);
		$(this).parent('span').remove();
	});
	
		$("#borrower_type").change(function(){
			if($(this).val() == 3){
				$("#companyFrame").hide();
				$("#personalFrame").show();			
			}else if($(this).val() == 2){
				$("#companyFrame").find(".tableleft").html("关联借款个体户");
				$("#companyFrame").show();
				$("#personalFrame").hide();				
			}else{
				$("#companyFrame").find(".tableleft").html("关联借款企业");
				$("#companyFrame").show();
				$("#personalFrame").hide();
			}
		})		
});
		
</script>
<form action="" method="post" class="definewidth m20">
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td class="tableleft" width="15%">项目名称</td>
        <td><input type="text" name="title" value="<?php echo set_value('title');?>"/><?php echo form_error('title');?></td>
    </tr>
     <tr>
      <td class="tableleft">缩略图</td>
      <td><input type="text" id="url1" name="photo" value="<?php echo set_value('photo');?>"  readonly="readonly"/> <a class="btn btn-primary" id="image1">上传图片</a><?php echo form_error('photo');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">项目编号</td>
        <td><input type="text" name="number" value="<?php echo set_value('number');?>"/><?php echo form_error('number');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">项目收益率</td>
        <td><input type="text" name="rate" value="<?php echo set_value('rate');?>"/><?php echo form_error('rate');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">服务费率</td>
        <td><input type="text" name="services" value="<?php echo set_value('services');?>"/><?php echo form_error('services');?></td>
    </tr>
	
	<tr>
		<td class="tableleft" width="15%">借款人类型</td>
		<td>
			<select name="borrower_type" id="borrower_type">
				<option value="1">企业</option>
				<option value="2">个体户</option>
				<option value="3">个人</option>
			</select>
			
			<?php echo form_error('borrower_type');?>
		</td>
	</tr>
    <tr id="companyFrame">
        <td class="tableleft" width="15%">关联借款企业</td>
        <td>
        	<select name="company">
            	<?php foreach($company as $key){?>
            		<option value="<?php echo $key['id'];?>" <?php echo set_select('company',$key['id']);?>><?php echo $key['company_name'];?></option>
                <?php }?>
            </select>
			
        </td>
    </tr>
	
    <tr id="personalFrame" style="display:none;">
        <td class="tableleft" width="15%">借款个人ID</td>
         <td><input type="text" name="borrower_id" value="<?php echo set_value('borrower_id');?>"/><?php echo form_error('borrower_id');?></td>
    </tr>	
	
    <tr>
        <td class="tableleft" width="15%">投资月数</td>
        <td><input type="text" name="day" value="<?php echo set_value('day');?>"/><?php echo form_error('day');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">还款方式</td>
        <td>
        	<?php foreach($repay_way as $val=>$key){?>
            	<input type="radio" name="repayment" value="<?php echo $key['id'];?>" <?php echo set_radio('repayment',$key['id'],$val==0?true:false);?> /><?php echo $key['repay'];?>
            <?php }?>
        </td>
    </tr>
    <tr>
      <td class="tableleft">标题类型</td>
      <td><textarea name="typetitle"><?php echo set_value('typetitle','项目描述|资产状况|风控保证|项目实景|企业执照|企业资产|风控保证
');?></textarea><?php echo form_error('typetitle');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">项目简介</td>
        <td><input type="text" name="introduction" value="<?php echo set_value('introduction');?>"/><?php echo form_error('introduction');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">项目描述</td>
        <td><textarea  name="describe" value="" class="content"/><?php echo set_value('describe');?></textarea><?php echo form_error('describe');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">资产状况</td>
        <td><textarea  name="assets" value="" class="content"/><?php echo set_value('assets');?></textarea><?php echo form_error('assets');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">风控保证</td>
        <td><textarea  name="pledge" value="" class="content"/><?php echo set_value('pledge');?></textarea><?php echo form_error('pledge');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">项目实景</td>
        <td>
        	<a class="btn btn-primary multigraph">上传图片</a>
            <input type="hidden" name="scene" value="<?php echo set_value('scene');?>" class="picinfo"/><?php echo form_error('scene');?>
            <label></label>
        </td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">企业执照</td>
        <td><a class="btn btn-primary multigraph">上传图片</a>
            <input type="hidden" name="certificate" value="<?php echo set_value('certificate');?>" class="picinfo"/><?php echo form_error('certificate');?>
            <label></label></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">企业资产</td>
        <td><a class="btn btn-primary multigraph">上传图片</a>
            <input type="hidden" name="property" value="<?php echo set_value('property');?>" class="picinfo"/><?php echo form_error('property');?>
            <label></label></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">风控保证</td>
        <td><a class="btn btn-primary multigraph">上传图片</a>
            <input type="hidden" name="control" value="<?php echo set_value('control');?>" class="picinfo"/><?php echo form_error('control');?>
            <label></label></td>
    </tr>
    <tr>
      <td class="tableleft">是否担保</td>
      <td><input type="radio"  name="is_backed" value="1" <?php echo set_radio('is_backed',1,true);?>>担保<input type="radio" name="is_backed"  value="2" <?php echo set_radio('is_backed',2);?>/>不担保</td>
    </tr>
    <tr>
      <td class="tableleft">担保机构</td>
      <td><input type="text" name="pact" value="<?php echo set_value('pact');?>" /><?php echo form_error('pact');?> (格式: 担保企业机构名称|注册代码 |隔开)</td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">每份金额</td>
        <td><input type="text" name="each" value="<?php echo set_value('each');?>"/><?php echo form_error('each');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">起投份数</td>
        <td><input type="text" name="amount" value="<?php echo set_value('amount');?>"/><?php echo form_error('amount');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">项目规模</td>
        <td><input type="text" name="money" value="<?php echo set_value('money');?>"/><?php echo form_error('money');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">剩余金额</td>
        <td><input type="text" name="restmoney" value="<?php echo set_value('restmoney');?>"/><?php echo form_error('restmoney');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">项目开始时间</td>
        <td>
        <input type="text" name="creattime" value="<?php echo set_value('creattime',date('Y-m-d H:i:s',time()-(-300)));?>"/><?php echo form_error('creattime');?></td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">是否开通</td>
        <td>
        	<input type="radio" name="is_open" <?php echo set_radio('is_open',1,true);?> value="1">预告
            <input type="radio" name="is_open" <?php echo set_radio('is_open',2);?>  value="2">不预告
        </td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">是否预约</td>
        <td>
        	<input type="radio" name="yuyue" <?php echo set_radio('yuyue',1,true);?> value="1">不预约
            <input type="radio" name="yuyue" <?php echo set_radio('yuyue',2);?>  value="2">预约
        </td>
    </tr>
    <tr>
        <td class="tableleft" width="15%">预约人ID|隔开</td>
        <td>
        	<input type="text" name="yuyueuid" value="<?php echo set_value('yuyueuid');?>"  placeholder="例:30016|30017"/>
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
