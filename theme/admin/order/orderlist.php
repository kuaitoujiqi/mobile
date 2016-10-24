<script language="javascript" type="text/javascript" src="<?php echo static_url();?>js/data/WdatePicker.js"></script>

<form class="form-inline definewidth m20" action="" method="get">  
<a class="btn btn-<?php if($type == 0){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/orderlist/');?>?type=0">全部</a>
<a class="btn btn-<?php if($type == 1){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/orderlist/');?>?type=1">充值</a>
<a class="btn btn-<?php if($type == 2){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/orderlist/');?>?type=2">投资</a>
<a class="btn btn-<?php if($type == 3){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/orderlist/');?>?type=3">借款</a>
<a class="btn btn-<?php if($type == 4){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/orderlist/');?>?type=4">还款</a>
<a class="btn btn-<?php if($type == 5){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/orderlist/');?>?type=5">付息</a>
<a class="btn btn-<?php if($type == 7){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/orderlist/');?>?type=7">提现</a>
<a class="btn btn-<?php if($type == 9){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/orderlist/');?>?type=9">购债</a>
<a class="btn btn-<?php if($type == 10){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/orderlist/');?>?type=10">转让</a>
<a class="btn btn-<?php if($type == 11){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/orderlist/');?>?type=11">提现代收</a>
<a class="btn btn-<?php if($type == 12){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/orderlist/');?>?type=12">提现代付</a>
<a class="btn btn-<?php if($type == 13){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/orderlist/');?>?type=13">冻结手续费</a>
<a class="btn btn-<?php if($type == 14){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/orderlist/');?>?type=14">解冻手续费</a><br /><br />
<input type="hidden" name="type" value="<?php echo $type;?>" />
   用户ID：<input type="text" name="uid" id="rolename"class="abc input-default" placeholder="" value="<?php echo $this->input->get('uid')?$this->input->get('uid'):"";?>" style="width:80px">&nbsp;&nbsp;项目Id：<input type="text" name="productid" id="rolename"class="abc input-default" placeholder="" value="<?php echo $this->input->get('productid')?$this->input->get('productid'):"";?>" style="width:150px">&nbsp;&nbsp; 交易时间：<input id="d4311" class="Wdate" type="text" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4312\')||\'2050-10-01\'}'})" style="width:110px" name="starttime" value="<?php echo $this->input->get('starttime')?$this->input->get('starttime'):"";?>"/>到 
	<input id="d4312" class="Wdate" type="text" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4311\')}',maxDate:'2050-10-01'})" style="width:110px" name="endtime" value="<?php echo $this->input->get('endtime')?$this->input->get('endtime'):"";?>"> 
    <button type="submit" class="btn btn-primary">查询</button>
</form>


<script>
$(function(){
	$("#refundPay").click(function(){
		var productid = $(this).attr("productid");
		var uid = $(this).attr("uid");
		var userproid = $(this).attr("userproid");
		var money = $(this).attr("money");
		if(confirm("确认退款")){
			$.post("/G1dJRHPnziWZDo0Y/order/refund_pay/", {
				productid:productid,
				uid:uid,
				userproid:userproid,
				money:money
			},function(data) {
				var obj = JSON.parse(data);
				if (obj.code == 2) {
					alert("退款失败");
				}else{
					alert("退款正在处理");
				}
			})			
			
		}
	})
})	
</script>




<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>订单ID</th>
        <th>交易类型</th>
        <th>交易用户ID</th>
        <th>交易金额</th>
        <th>充值渠道</th>
        <th>项目ID</th>
        <th>用户项目ID</th>
        <th>状态</th>
        <th>交易时间</th>
        <th>备注</th>
		<th>操作</th>
    </tr>
    </thead>
    	<?php foreach($result as $key){?>
	     <tr>
            <td><?php echo $key['id'];?></td>
            <td>
			<?php if($key['type']==1){echo "充值";}?>
            <?php if($key['type']==2){echo "投资";}?>
            <?php if($key['type']==3){echo "借款";}?>
            <?php if($key['type']==4){echo "还款";}?>
            <?php if($key['type']==5){echo "付息";}?>
            <?php if($key['type']==7){echo "提现";}?>
            <?php if($key['type']==9){echo "购债";}?>
            <?php if($key['type']==10){echo "转让";}?>
            <?php if($key['type']==11){echo "手续费代收";}?>
            <?php if($key['type']==12){echo "手续费代付";}?>
            <?php if($key['type']==13){echo "手续费冻结";}?>
            <?php if($key['type']==14){echo "手续费解冻";}?>
			<?php if($key['type']==15){echo "退款";}?>
            </td>
            <td><?php echo $key['uid'];?></td>
            <td><?php echo $key['monkey'];?></td>
            <td>
            	<?php if($key['rechargetype']==1){echo "网银";}?>
                <?php if($key['rechargetype']==2){echo "快捷";}?>
            </td>
            <td><?php echo $key['productid'];?></td>
            <td><?php echo $key['user_pro_id'];?></td>
            
            
            <td <?php if($key['static'] == 3){?>style="color:red"<?php }?>>
				<?php if($key['static']==1){echo "处理中";}?>
				<?php if($key['static']==2){echo "成功";}?>
                <?php if($key['static']==3){echo "失败";}?>
            </td>
            <td>
               <?php echo date('Y-m-d H:i:s',$key['dateline']);?>
            </td>
            <td>
               <?php echo $key['remark'];?>
            </td>
			<td>
				<?php if($key['static']==2 && $key['type']==2){ ?>
				<button id="refundPay" productid="<?php echo $key['id'];?>" uid="<?php echo $key['uid'];?>" money="<?php echo $key['monkey'];?>"  userproid="<?php echo $key['user_pro_id'];?>" class="btn btn-warning">退款</button>
				<?php } ?>
			</td>
        </tr>
        <?php }?>
        </table>
<div class="inline pull-right page">
	<?php if($sum!=""){?>总金额:<?php echo $sum; }?><?php echo $links;?>
</div>
