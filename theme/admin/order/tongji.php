<script language="javascript" type="text/javascript" src="<?php echo static_url();?>js/data/WdatePicker.js"></script>
<form class="form-inline definewidth m20" action="" method="get">  
交易时间：<input id="d4311" class="Wdate" type="text" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4312\')||\'2050-10-01\'}'})" style="width:110px" name="starttime" value="<?php echo $this->input->get('starttime')?$this->input->get('starttime'):"";?>"/>到 
	<input id="d4312" class="Wdate" type="text" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4311\')}',maxDate:'2050-10-01'})" style="width:110px" name="endtime" value="<?php echo $this->input->get('endtime')?$this->input->get('endtime'):"";?>"> 
    <button type="submit" class="btn btn-primary">查询</button>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>统计名称</th>
        <th>统计金额</th>
    </tr>
    </thead>
    	<?php foreach($tongji as $key){?>
	     <tr>
            <td><?php echo $key['name'];?></td>
            <td>
			<?php echo $key['monkey'];?>
            </td>
        </tr>
        <?php }?>
        </table>