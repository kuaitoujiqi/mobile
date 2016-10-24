<script language="javascript" type="text/javascript" src="<?php echo static_url();?>js/data/WdatePicker.js"></script>

<form class="form-inline definewidth m20" action="" method="get">  

    
   用户ID：<input type="text" name="name" id="rolename"class="abc input-default" placeholder="" value="<?php echo $this->input->get('name')?$this->input->get('name'):"";?>" style="width:80px">&nbsp;&nbsp;项目Id：<input type="text" name="project" id="rolename"class="abc input-default" placeholder="" value="<?php echo $this->input->get('project')?$this->input->get('project'):"";?>" style="width:150px">&nbsp;&nbsp; 用户项目Id：<input type="text" name="user_pro_id" id="rolename"class="abc input-default" placeholder="" value="<?php echo $this->input->get('user_pro_id')?$this->input->get('user_pro_id'):"";?>" style="width:150px">&nbsp;&nbsp;交易时间：<input id="d4311" class="Wdate" type="text" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4312\')||\'2050-10-01\'}'})" style="width:110px" name="starttime" value="<?php echo $this->input->get('starttime')?$this->input->get('starttime'):"";?>"/>到 
	<input id="d4312" class="Wdate" type="text" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4311\')}',maxDate:'2050-10-01'})" style="width:110px" name="endtime" value="<?php echo $this->input->get('endtime')?$this->input->get('endtime'):"";?>"> 
    <button type="submit" class="btn btn-primary">查询</button>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>ID</th>
        <th>用户ID</th>
        <th>项目ID</th>
        <th>交易订单号</th>
        <th>交易时间</th>
        <th>交易额</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    </thead>
    	<?php foreach($result as $key){?>
	     <tr>
            <td><?php echo $key['id'];?></td>
            <td><?php echo $key['uid'];?></td>
            <td><?php echo $key['projectid'];?></td>
            <td><?php echo $key['order_id'];?></td>
            <td><?php echo date('Y-m-d H:i:s',$key['dateline']);?></td>
            <td><?php echo $key['monkey'];?></td>
            <td <?php if($key['static'] == 3){?>style="color:red"<?php }?>>
				<?php if($key['static']==1){echo "处理中";}?>
				<?php if($key['static']==2){echo "成功";}?>
                <?php if($key['static']==3){echo "失败";}?>
                <?php if($key['static']==4){echo "已转让";}?>
                <?php if($key['static']==5){echo "已结束临时状态";}?>
            </td>
            <td>
               <?php /*?>   <a href="<?php echo admin_url('project/status_user_project/'.$key['id']);?>"><?php echo $key['status']==0?"生效":"未生效";?></a>
                  <a href="<?php echo admin_url('project/del_user_project/'.$key['id']);?>" class="delete">删除</a><?php */?>
            </td>
        </tr>
        <?php }?>
        </table>
<div class="inline pull-right page">
	<?php echo $links;?>
</div>
