<form action="" method="post" class="definewidth m20">
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td class="tableleft" width="15%">投资机构</td>
        <td>
        <select name="org_id">
        	<?php foreach($tzjg as $key){?>
        	<option value="<?php echo $key['id'];?>" <?php echo set_radio('org_id',$key['id'],$row['org_id'] == $key['id']?true:false);?>><?php echo $key['org_name'];?></option>
            <?php }?>
        </select>
        </td>
    </tr>
    <tr>
      <td class="tableleft">项目名称</td>
      <td>
      <input type="text" name="invest_name" value="<?php echo set_value('invest_name',$row['invest_name']);?>"/><?php echo form_error('invest_name');?>
      </td>
    </tr>
    <tr>
      <td class="tableleft">还款方式</td>
      <td>
      <?php foreach($hkfs as $val=>$key){?>
      <input type="radio" name="repay_way" value="<?php echo $key['id'];?>" <?php echo set_radio('repay_way',$key['id'],$row['repay_way'] == $key['id']?true:false);?>><?php echo $key['repay'];?>
      <?php }?>
      </td>
    </tr>
    <tr>
      <td class="tableleft">投资金额</td>
      <td>
       <input type="text" name="invest_money" value="<?php echo set_value('invest_money',$row['invest_money']);?>"/><?php echo form_error('invest_money');?>
       </td>
    </tr>
        <tr>
      <td class="tableleft">投资收益率</td>
      <td>
       <input type="text" name="invest_yield" value="<?php echo set_value('invest_yield',$row['invest_yield']);?>"/><?php echo form_error('invest_yield');?>
       </td>
    </tr>
        <tr>
      <td class="tableleft">投资期限</td>
      <td>
        <script language="javascript" type="text/javascript" src="<?php echo static_url();?>js/data/WdatePicker.js"></script>
      <input type="text" id="d233" onFocus="WdatePicker({startDate:'<?php echo date('Y-m-d');?>',dateFmt:'yyyy-MM-dd',alwaysUseStartDate:true})" style="width:160px" value="<?php echo set_value('invest_due',$row['invest_due']);?>" name="invest_due" readonly/><?php echo form_error('invest_due');?>
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
