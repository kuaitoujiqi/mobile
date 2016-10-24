<style type="text/css">
table td{ text-align:center}
</style>
<form class="form-inline definewidth m20" action="" method="get">    
    用户：<input type="text" name="uid" id="username"class="abc input-default" placeholder="" value="<?php echo $this->input->get('uid')?$this->input->get('uid'):"";?>" style="width:200px">&nbsp;&nbsp;
    
           <button type="submit" class="btn btn-primary">查询</button>
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th>银行编码</th>
        <th>用户ID</th>
        <th>交易请求号</th>
        <th>状态</th>
        <th>TICKET</th>
        <th>提交时间</th>
        <th>卡类型</th>
        <th>邦卡ID</th>
        <th>备注</th>
    </tr>
    </thead>
    	 <?php foreach($result as $key){?>
	     <tr>
            <td><?php echo $key['bank_code'];?></td>
           
            <td><?php echo $key['user_id'];?></td>
            <td><?php echo $key['order_id'];?></td>
            <td>
            	<?php switch($key['static']){
					case 1:echo "处理中";break;
					case 2:echo "成功";break;
					case 3:echo "<span style='color:red'>未绑定</span>";break;	
				}?>
                
            </td>
            <td><?php echo $key['ticket'];?></td>
            <td><?php echo date('Y-m-d H:i:s',$key['dateline']);?></td>
            <td><?php echo $key['verify_mode'] == 1?"支付提现卡":"提现卡";?></td>
            <td><?php if($key['card_id'] != "" and $key['static'] == 2){echo "正常";}?><?php if($key['card_id'] == "" and $key['static'] == 2){echo "<font style='color:red'>空卡号异常</font>";}?><?php if($key['card_id'] <= 0 and $key['static'] == 2){echo "<font style='color:red'>卡号为0异常</font>";}?></td>
            <td><?php echo $key['msg'];?></td>
        </tr>	
        <?php }?>
</table>
<div class="inline pull-right page">
<?php echo $links;?>
</div>
