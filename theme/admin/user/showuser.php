<div class="definewidth m20">
<table class="table table-bordered table-hover m10">
    <tr>
        <td class="tableleft" width="10%">ID</td>
        <td><?php echo $row['id'];?>
        </td>
    </tr>
    <tr>
        <td class="tableleft">昵称</td>
        <td>
        <?php echo $row['nickname'];?></td>
    </tr>
    <tr>
        <td class="tableleft">手机</td>
        <td><?php echo $row['mobile'];?></td>
    </tr>
    <tr>
        <td class="tableleft">身份证</td>
        <td><?php echo $row['idcard'];?> <?php if($row['cardtime'] != ""){echo "认证时间：".date('Y-m-d H:i:s',$row['cardtime']);}?></td>
    </tr>
    <tr>
        <td class="tableleft">姓名</td>
        <td><?php echo $row['name'];?></td>
    </tr>
    <tr>
        <td class="tableleft">邮箱</td>
        <td><?php echo $row['email'];?></td>
    </tr>
    <tr>
        <td class="tableleft">手机验证</td>
        <td><?php echo $row['is_mobile']==0?"未验证":"已验证";?></td>
    </tr>
    <tr>
        <td class="tableleft">身份证验证</td>
        <td>
        <?php echo $row['is_idcard']==0?"未验证":"已验证";?>
       </td>
    </tr>
    <tr>
        <td class="tableleft">邮箱验证</td>
        <td><?php echo $row['is_email']==0?"未验证":"已验证";?></td>
    </tr>
  
    <tr>
        <td class="tableleft"></td>
        <td>
           <a class="btn btn-success" href="<?php echo $_SERVER['HTTP_REFERER'];?>">返回列表</a>
        </td>
    </tr>
</table>
</div>

