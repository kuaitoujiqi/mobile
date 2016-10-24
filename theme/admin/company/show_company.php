<div class="definewidth m20">
<table class="table table-bordered table-hover m10">
    <tr>
        <td class="tableleft" width="10%">ID</td>
        <td><?php echo $row['id'];?>
        </td>
    </tr>
    <tr>
        <td class="tableleft">公司名称</td>
        <td>
        <?php echo $row['company_name'];?></td>
    </tr>
    <tr>
        <td class="tableleft">企业网址</td>
        <td><?php echo $row['website'];?></td>
    </tr>
    <tr>
        <td class="tableleft">企业地址</td>
        <td><?php echo $row['address'];?></td>
    </tr>
    <tr>
        <td class="tableleft">营业执照号</td>
        <td><?php echo $row['license_no'];?></td>
    </tr>
    <tr>
        <td class="tableleft">营业号所在地</td>
        <td><?php echo $row['license_address'];?></td>
    </tr>
    <tr>
        <td class="tableleft">营业执照日期</td>
        <td><?php echo $row['license_expire_date'];;?></td>
    </tr>
    <tr>
        <td class="tableleft">营业范围</td>
        <td><?php echo $row['business_scope'];;?></td>
    </tr>
    <tr>
        <td class="tableleft">联系电话</td>
        <td><?php echo $row['telephone'];;?></td>
    </tr>
    <tr>
        <td class="tableleft">email</td>
        <td><?php echo $row['email'];;?></td>
    </tr>
    <tr>
        <td class="tableleft">组织机构代码证</td>
        <td><?php echo $row['organization_no'];;?></td>
    </tr>
    <tr>
        <td class="tableleft">企业简介</td>
        <td><?php echo $row['summary'];;?></td>
    </tr>
    <tr>
        <td class="tableleft">企业法人</td>
        <td><?php echo $row['legal_person'];;?></td>
    </tr>
    <tr>
        <td class="tableleft">法人身份证</td>
        <td><?php echo $row['cert_no'];;?></td>
    </tr>
    <tr>
        <td class="tableleft">营业执照日期</td>
        <td><?php echo $row['license_expire_date'];;?></td>
    </tr>
    

 
    <tr>
        <td class="tableleft"></td>
        <td>
           <a class="btn btn-success" href="<?php echo $_SERVER['HTTP_REFERER'];?>">返回列表</a>
        </td>
    </tr>
</table>
</div>

