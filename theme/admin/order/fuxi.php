<script language="javascript" type="text/javascript" src="<?php echo static_url();?>js/data/WdatePicker.js"></script>
<form class="form-inline definewidth m20" action="" method="get">  
交易时间：<input id="d4311" class="Wdate" type="text" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4312\')||\'2050-10-01\'}'})" style="width:110px" name="starttime" value="<?php echo $this->input->get('starttime')?$this->input->get('starttime'):"";?>"/>到 
	<input id="d4312" class="Wdate" type="text" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4311\')}',maxDate:'2050-10-01'})" style="width:110px" name="endtime" value="<?php echo $this->input->get('endtime')?$this->input->get('endtime'):"";?>"> 
    <button type="submit" class="btn btn-primary">查询</button>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>项目名称</th>
        <th>项目金额</th>
        <th>还款期数/项目期数</th>
        <th>收益率</th>
        <th>付息时间</th>
        <th>付息金额</th>
    </tr>
    </thead>
    	<?php 
		function send_lixi($rate = false,$monkey = false)
		{
			//用户利息
			$year_rate = $rate * $monkey;//计算一年的利息
			$day_rate = number_format($year_rate/12,2,'.','');//计算每月的利息
			return $day_rate;
		}
		foreach($fuxi as $key){?>
	     <tr>
            <td><?php echo $key['title'];?></td>
            <td><?php echo $key['xmje'];?></td>
            <td><?php echo $key['send_num'];?>/<?php echo $key['day'];?></td>
            <td><?php echo $key['rate'];?></td>
            <td><?php echo date('Y-m-d',$key['dateline']);?></td>
            <td><?php 
			$lixi = send_lixi($key['rate'],$key['xmje']);
			if($key['send_num'] == $key['day']){ echo $lixi-(-$key['xmje']);}else{echo $lixi;}?></td>
        </tr>
        <?php }?>
        </table>