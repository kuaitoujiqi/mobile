<form action="" method="post" class="definewidth m20">
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td class="tableleft" width="15%">项目名称</td>
        <td>
        	<select name="project_id">
            	<?php foreach($project as $key){?>
            	<option value="<?php echo $key['id'];?>" <?php echo set_select('project_id',$key['id']);?>><?php echo $key['title'];?></option>
                <?php }?>
            </select>
        </td>
    </tr>
    <tr>
      <td class="tableleft">日期</td>
      <td>
      <script language="javascript" type="text/javascript" src="<?php echo static_url();?>js/data/WdatePicker.js"></script>
      <input type="text" id="d233" onFocus="WdatePicker({startDate:'<?php echo date('Y-m-d');?>',dateFmt:'yyyy-MM-dd',alwaysUseStartDate:true})" style="width:160px" value="<?php echo set_value('current_hour',date('Y-m-d'));?>" name="current_hour" readonly/><?php echo form_error('current_hour');?>
      </td>
    </tr>
    <tr>
      <td class="tableleft">当日金额</td>
      <td>
     	 <input type="text" name="size" value="<?php echo set_value('size');?>"/><?php echo form_error('size');?>
         <input type="hidden" name="done_size" value="0">
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
