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
        <th>ID</th>
        <th>姓名</th>
        <th>昵称</th>
        <th>手机</th>
        <th>余额</th>
        <th>身份证验证</th>
        <th>银行卡</th>
        <th>注册时间</th>
        <th>最后登录时间</th>
        <th>操作</th>
    </tr>
    </thead>
    	 <?php foreach($result as $key){?>
	     <tr>
            <td><?php echo $key['id'];?></td>
            <td><?php echo $key['name'];?></td>
            <td><?php echo $key['nickname'];?></td>
            <td><?php echo $key['mobile'];?></td>
            <td><?php echo $key['balance'];?></td>
            
            <td><?php echo $key['is_idcard'] == 0?"未验证":"已验证";?></td>
            <td><?php echo $key['is_bind_bank'] == 1?"未绑定":"已绑定";?></td>
            <td><?php echo $key['dateline'];?></td>
            <td><?php if($key['lastlogin'] != ""){echo date('Y-m-d H:i:s',$key['lastlogin']);}?></td>
            <td><a href="<?php echo admin_url('user/showuser/'.$key['id']);?>">查看</a>
            <a href="<?php echo admin_url('user/showuserall/'.$key['id']);?>">详细</a></td>
        </tr>	
        <?php }?>
</table>
<div class="inline pull-right page">
<?php echo $links;?>
</div>
