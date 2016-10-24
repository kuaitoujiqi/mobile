<form action="" method="post" class="definewidth m20">
<table class="table table-bordered table-hover m10">
    <tr>
        <td class="tableleft">ID</td>
        <td><?php echo $row['id'];?>
        <input type="hidden" name="id" value="<?php echo $row['id'];?>" />
        </td>
    </tr>
    <tr>
        <td class="tableleft">昵称</td>
        <td>
        <input type="text" name="nickname" value="<?php echo set_value('nickname',$row['nickname']);?>"/><?php echo form_error('nickname');?></td>
    </tr>
    <tr>
        <td class="tableleft">密码(不修改为空)</td>
        <td><input type="text" name="password" value="<?php echo set_value('password');?>"/><?php echo form_error('password');?></td>
    </tr>
    <tr>
        <td class="tableleft">手机</td>
        <td><input type="text" name="mobile" value="<?php echo set_value('mobile',$row['mobile']);?>"/><?php echo form_error('mobile');?></td>
    </tr>
    <tr>
        <td class="tableleft">身份证</td>
        <td><input type="text" name="idcard" value="<?php echo set_value('idcard',$row['idcard']);?>"/><?php echo form_error('idcard');?></td>
    </tr>
    <tr>
        <td class="tableleft">姓名</td>
        <td><input type="text" name="name" value="<?php echo set_value('name',$row['name']);?>"/><?php echo form_error('name');?></td>
    </tr>
    <tr>
        <td class="tableleft">邮箱</td>
        <td><input type="text" name="email" value="<?php echo set_value('email',$row['email']);?>"/><?php echo form_error('email');?></td>
    </tr>
    <tr>
        <td class="tableleft">手机验证</td>
        <td><input type="radio" name="is_mobile" value="0" <?php echo set_radio('is_mobile',0,$row['is_mobile']==0?true:false);?>> 未验证
        	<input type="radio" name="is_mobile" value="1" <?php echo set_radio('is_mobile',1,$row['is_mobile']==1?true:false);?>> 已验证
        <?php echo form_error('is_mobile');?></td>
    </tr>
    <tr>
        <td class="tableleft">身份证验证</td>
        <td><input type="radio" name="is_idcard" value="0" <?php echo set_radio('is_idcard',0,$row['is_idcard']==0?true:false);?>> 未验证
        	<input type="radio" name="is_idcard" value="1" <?php echo set_radio('is_idcard',1,$row['is_idcard']==1?true:false);?>> 已验证 <?php echo form_error('is_idcard');?></td>
    </tr>
    <tr>
        <td class="tableleft">邮箱验证</td>
        <td><input type="radio" name="is_email" value="0" <?php echo set_radio('is_email',0,$row['is_email']==0?true:false);?>> 未验证
        	<input type="radio" name="is_email" value="1" <?php echo set_radio('is_email',1,$row['is_email']==1?true:false);?>> 已验证 <?php echo form_error('is_email');?></td>
    </tr>
    
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary"  name="submit">保存</button> &nbsp;&nbsp;<a class="btn btn-success" href="<?php echo admin_url('user/userlist');?>">返回列表</a>
        </td>
    </tr>
</table>
</form>
