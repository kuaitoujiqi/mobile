 <script language="javascript" type="text/javascript" src="<?php echo static_url();?>js/data/WdatePicker.js"></script>
<form class="form-inline definewidth m20" action="" method="get">    
    用户ID：<input type="text" name="user_id" id="username"class="abc input-default" placeholder="" value="<?php echo $this->input->get('user_id')?$this->input->get('user_id'):"";?>" style="width:100px">				    &nbsp;&nbsp; 
     订单号：<input type="text" name="order_id" id="order_id"class="abc input-default" placeholder="" value="<?php echo $this->input->get('order_id')?$this->input->get('order_id'):"";?>" style="width:100px">	 &nbsp;&nbsp; 

    时间范围：<input id="d4311" class="Wdate" type="text" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4312\')||\'2050-10-01\'}'})" style="width:110px" name="starttime" value="<?php echo $this->input->get('starttime')?$this->input->get('starttime'):"";?>"/>到 
	<input id="d4312" class="Wdate" type="text" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4311\')}',maxDate:'2050-10-01'})" style="width:110px" name="endtime" value="<?php echo $this->input->get('endtime')?$this->input->get('endtime'):"";?>">
    
           <button type="submit" class="btn btn-primary">查询</button>
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
     <tr>
        <th>订单号</th>
        <th>用户昵称（企业名称）</th>
        <th>提现时间</th>
        <th>提现状态</th>
        <th>提现金额</th>
        <th>提现手续费</th>
    </tr>
    </thead>
    	 <?php foreach($result as $key){?>
	     <tr>
            <td><?php echo $key['id'];?></td>
            <td><?php echo $key['nickname'];?></td>
             <td><?php echo date('Y-m-d H:i:s',$key['dateline']);?></td>
            <td <?php if($key['static'] == 3){?>style="color:red"<?php }?>><?php if($key['static']==1){echo "处理中";}?>
				<?php if($key['static']==2){echo "成功";}?>
                <?php if($key['static']==3){echo "失败";}?></td>
            <td><?php echo $key['monkey'];?></td>
            <td><?php echo $key['poundage'];?></td>
        </tr>	
        <?php }?>
</table>
<div class="inline pull-right page">
<?php echo $links;?>
</div>
