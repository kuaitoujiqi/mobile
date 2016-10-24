<form action="" method="post" class="definewidth m20">
<table class="table table-bordered table-hover m10">
    <tr>
        <td width="15%" class="tableleft">上级</td>
        <td>
            <select name="pid">
            	<option value="0" <?php echo set_select('pid',0,true); ?>>顶级菜单</option>
                <?php foreach($topmenulist as $key){?>
                	<option value="<?php echo $key['id'];?>" <?php echo set_select('pid',$key['id']); ?>>--<?php echo $key['name'];?></option>
                <?php }?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="tableleft">名称</td>
        <td><input type="text" name="name" value="<?php echo set_value('name');?>"/><?php echo form_error('name');?></td>
    </tr>
    <tr>
      <td class="tableleft">是否显示菜单</td>
      <td>
      <input type="radio" name="show" value="0" <?php echo set_radio('show',0,true); ?>/>显示
      <input type="radio" name="show" value="1" <?php echo set_radio('show',1); ?>/>不显示
      </td>
    </tr>
    <tr>
        <td class="tableleft">控制器/方法</td>
        <td><input type="text" name="uri" value="<?php echo set_value('uri');?>"/><?php echo form_error('uri');?></td>
    </tr>
     <tr>
        <td class="tableleft">排序(越小越往前)</td>
        <td><input type="text" name="sort" value="<?php echo set_value('sort',0);?>"/><?php echo form_error('sort');?></td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary"  name="submit">保存</button> &nbsp;&nbsp;<a class="btn btn-success" href="<?php echo admin_url('roler/menulist');?>">返回列表</a>
        </td>
    </tr>
</table>
</form>
