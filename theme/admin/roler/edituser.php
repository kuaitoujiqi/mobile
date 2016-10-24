<form action="" method="post" class="definewidth m20">
<table class="table table-bordered table-hover m10">
    <tr>
        <td class="tableleft">用户名</td>
        <td><?php echo $row['username'];?></td>
    </tr>
    <tr>
        <td class="tableleft">用户组</td>
        <td>
		<select name="group">
        	<option value="0" <?php echo set_select('group',0,$row['group']==0?true:false);?>>超级管理员</option>
            <?php foreach($group as $key){?>
            	<option value="<?php echo $key['id'];?>" <?php echo set_select('group',$key['id'],$row['group']==$key['id']?true:false);?>><?php echo $key['name'];?></option>
            <?php }?>
        </select>
		<?php echo form_error('group');?></td>
    </tr>
    <tr>
      <td class="tableleft">密码</td>
      <td>
      <input type="text" name="password" value="<?php echo set_value('password');?>"/><?php echo form_error('password');?>
      </td>
    </tr>
    <tr>
        <td class="tableleft">姓名</td>
        <td><input type="text" name="name" value="<?php echo set_value('name',$row['name']);?>"/><?php echo form_error('name');?></td>
    </tr>
     <tr>
        <td class="tableleft">状态</td>
        <td><input type="radio" name="static" value="1" <?php echo set_radio('static',1,$row['static']==1?true:false); ?>/>启用
     	    <input type="radio" name="static" value="2" <?php echo set_radio('static',2,$row['static']==2?true:false); ?>/>禁用
		 <?php echo form_error('static');?></td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary"  name="submit">保存</button> &nbsp;&nbsp;<a class="btn btn-success" href="<?php echo admin_url('roler/userlist');?>">返回列表</a>
        </td>
    </tr>
</table>
</form>
