<form action="" method="post" class="definewidth m20">
<style type="text/css">
#roler{ margin:0px; padding:0px; margin-bottom:10px; height:auto; overflow:hidden}
#roler dt{ font-size:14px; margin-bottom:5px}
#roler dd{ display:inline-block; float:left; margin-right:10px; margin-left:0px; width:140px}

</style>
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td width="10%" class="tableleft">用户组名</td>
        <td><input type="text" name="name" value="<?php echo set_value('name',$row['name']);?>"/><?php echo form_error('name');?></td>
    </tr>
    <tr>
        <td class="tableleft">权限选择</td>
        <td>
        	<?php 
			//当前用户组权限
			$roler = $row['roler'];
			$roler = unserialize($roler);
			foreach($menulist as $key){
				if($key['pid'] == 0){	
			?>
        	<dl id="roler">
            	<dt><input type="checkbox" value="<?php echo $key['id'];?>" name="roler[]" <?php echo set_checkbox('roler[]',$key['id'],in_array($key['id'],$roler)?true:false);?>/> <?php echo $key['name'];?></dt>
                <?php foreach($menulist as $key_s){
					if($key_s['pid'] == $key['id']){
				?>
                <dd><input type="checkbox" value="<?php echo $key_s['id'];?>" name="roler[]" <?php echo set_checkbox('roler[]',$key_s['id'],in_array($key_s['id'],$roler)?true:false);?>/> <?php echo $key_s['name'];?></dd>
                <?php } }?>
            </dl>
            <?php } }?>
          <?php echo form_error('roler');?>
        </td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button">保存</button> &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
        </td>
    </tr>
</table>
</form>

