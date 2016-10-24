<form action="<?php echo admin_url('main/password');?>" method="post" class="definewidth m20">
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td class="tableleft" width="10%">旧密码</td>
        <td><input type="password" name="oldpass"/><?php echo form_error('oldpass');?></td>
    </tr>
    <tr>
        <td class="tableleft">新密码</td>
        <td><input type="password" name="newpass"/><?php echo form_error('newpass');?></td>
    </tr>
    <tr>
        <td class="tableleft">确认密码</td>
        <td><input type="password" name="compass"/><?php echo form_error('compass');?></td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button">保存</button> &nbsp;&nbsp;
        </td>
    </tr>
</table>
</form>
