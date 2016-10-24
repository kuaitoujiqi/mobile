<form action="" method="post" class="definewidth m20">
<table class="table table-bordered table-hover m10">
<?php /*?>    <tr>
        <td class="tableleft">检索用户</td>
        <td><input type="text" name="search" id="search" value="" placeholder="请输入用户名或用户ID或用户姓名或用户手机或用户邮箱检索">
        </td>
    </tr><?php */?>
      <tr>
        <td class="tableleft">用户ID</td>
        <td><textarea  name="uid" /><?php echo set_value('uid');?></textarea> (1,2,3以逗号隔开)<?php echo form_error('uid');?>
     </td>
    </tr>
       <tr>
        <td class="tableleft">选择红包</td>
        <td><select name="paperid" style="width:500px">
        		<option value="" <?php echo set_select('paperid','',true);?>>请选择红包</option>
                <?php foreach($paper as $key){?>
                <option value="<?php echo $key['id'];?>" <?php echo set_select('paperid',$key['id']);?>><?php echo $key['title'];?> 金额 <?php echo $key['monkey'];?> 最少<?php echo $key['min_monkey'];?>使用</option>
                <?php }?>
            </select>
            <?php echo form_error('paperid');?>
        </td>
    </tr>
     <tr>
        <td class="tableleft"></td>
        <td>
 		<button type="submit" class="btn btn-primary"  name="submit">保存</button>
 </td></tr>
</table>

 </form>