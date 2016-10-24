<form action="<?php echo admin_url('main/sysconfig');?>" method="post" class="definewidth m20">
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td class="tableleft" width="15%">首页标题</td>
        <td><input type="text" name="indextitle" value="<?php echo set_value('indextitle',$row['indextitle']);?>"/><?php echo form_error('indextitle');?></td>
    </tr>
    <tr>
        <td class="tableleft">关键词</td>
        <td><input type="text" name="keyword"  value="<?php echo set_value('keyword',$row['keyword']);?>"/><?php echo form_error('keyword');?></td>
    </tr>
    <tr>
        <td class="tableleft">描述</td>
        <td><textarea name="description"><?php echo set_value('description',$row['description']);?></textarea><?php echo form_error('description');?></td>
    </tr>
    <tr>
      <td class="tableleft">网站名称</td>
      <td><input type="text" name="sitetitle"  value="<?php echo set_value('sitetitle',$row['sitetitle']);?>"/>
      <?php echo form_error('sitetitle');?></td>
    </tr>
    <tr>
      <td class="tableleft">推荐返现率</td>
      <td><input type="text" name="present" value="<?php echo set_value('present',$row['present']);?>"/>
      <?php echo form_error('present');?></td>
    </tr>
    <tr>
      <td class="tableleft">还款执行时间设置</td>
      <td><input type="text" name="repayment" value="<?php echo set_value('repayment',$row['repayment']);?>"/>
      <?php echo form_error('repayment');?></td>
    </tr>
    <tr>
      <td class="tableleft">后台登录路径</td>
      <td><input type="text" name="admin_url" value="<?php echo set_value('admin_url',$row['admin_url']);?>"/>
      <?php echo form_error('admin_url');?></td>
    </tr>
    <tr>
      <td class="tableleft">债权转让是否审核</td>
      <td><input type="radio" name="debenture"  value="0" <?php echo set_radio('debenture','0',$row['debenture']==0?true:false); ?>/>
      审核
        <input type="radio" name="debenture"  value="1" <?php echo set_radio('debenture','1',$row['debenture']==1?true:false); ?>/>
       不审核</td>
    </tr>
    <tr>
      <td class="tableleft">用户注册奖励金额</td>
      <td><input type="text" name="regesiter" value="<?php echo set_value('regesiter',$row['regesiter']);?>"/>
      <?php echo form_error('regesiter');?></td>
    </tr>
    <tr>
      <td class="tableleft">风险备付金额度</td>
      <td><input type="text" name="quota" value="<?php echo set_value('quota',$row['quota']);?>"/>
      <?php echo form_error('quota');?></td>
    </tr>
    <tr>
      <td class="tableleft">债权转让有效转让天数</td>
      <td><input type="text" name="transfer" value="<?php echo set_value('transfer',$row['transfer']);?>"/>
      <?php echo form_error('transfer');?></td>
    </tr>
    <tr>
      <td class="tableleft">平台承担的提现手续费</td>
      <td><input type="text" name="platform" value="<?php echo set_value('platform',$row['platform']);?>"/>
      <?php echo form_error('platform');?></td>
    </tr>
    <tr>
      <td class="tableleft">用户提现的手续费</td>
      <td><input type="text" name="usermention" value="<?php echo set_value('usermention',$row['usermention']);?>"/>
      <?php echo form_error('usermention');?></td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button" name="submit">保存</button> &nbsp;&nbsp;
        </td>
    </tr>
</table>
</form>
