<style type="text/css">
table td{ text-align:center}
</style>
<form class="form-inline definewidth m20" action="" method="get">    
    用户ID/email/moblie/姓名：<input type="text" name="text" id="username"class="abc input-default" placeholder="" value="<?php echo $this->input->get('text')?$this->input->get('text'):"";?>" style="width:200px">&nbsp;&nbsp;
    	   <select name="monkey">
           		<option value="1" <?php if($this->input->get('monkey') == 1){?> selected="selected" <?php }?>>默认</option>
                <option value="2" <?php if($this->input->get('monkey') == 2){?> selected="selected" <?php }?>>金额倒序</option>
           </select>
           <button type="submit" class="btn btn-primary">查询</button>
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
		<th>订单ID</th>
        <th>用户ID</th>
        <th>姓名</th>
        <th>手机</th>
        <th>购买时间</th>
		<th>购买项目</th>
        <th>购买金额</th>
        <th>最后登录时间</th>
		<th>推荐人</th>
        <th>操作</th>
    </tr>
    </thead>
    	 <?php foreach($result as $key){?>
	     <tr>
			<td><?php echo $key['frid'];?></td>
            <td><?php echo $key['id'];?></td>
            <td><?php echo $key['name'];?></td>
            <td><?php echo $key['mobile'];?></td>
			<td><?php echo $key['dateline'];?></td>
			<td><?php echo $key['productid'];?></td>
            <td><?php echo $key['monkey'];?></td>
            
            <td><?php if($key['lastlogin'] != ""){echo date('Y-m-d H:i:s',$key['lastlogin']);}?></td>
			<td><?php echo $key['recommender'];?></td>
            <td>
				<a role="btn" uid="<?php echo $key['id'];?>" class="btn btn-danger createRedPacket">生成红包</a>
				<a role="btn" uid="<?php echo $key['id'];?>" class="btn btn-warning sendRedPacket">发送红包</a>
			</td>
        </tr>	
        <?php }?>
</table>
<script>
$(function(){
	$(".sendRedPacket").click(function(){
		var uid = $(this).attr("uid");
		$.post("/832BB7C4398238F3/user/sendRedPackets/", {
			uid:uid,
			type:1
		},function(data) {
			var obj = JSON.parse(data);
			if (obj.code == 2) {
				alert("发送失败");
			}else{
				alert("发送红包正在处理");
			}
		})	
	})
	
	$(".createRedPacket").click(function(){
		var uid = $(this).attr("uid");
		$.post("/832BB7C4398238F3/user/createRedPackets/", {
			uid:uid
		},function(data) {
			var obj = JSON.parse(data);
			if (obj.code == 2) {
				alert("生成失败");
			}else{
				alert("生成红包正在处理");
			}
		})	
	})	
})
</script>
<div class="inline pull-right page">
<?php echo $links;?>
</div>
