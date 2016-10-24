<form class="form-inline definewidth m20" action="<?php echo admin_url('project/project_list');?>" method="get">  
     
    <a class="btn btn-success" href="<?php echo admin_url('project/add_project');?>">添加项目</a>&nbsp;&nbsp; 项目名称：<input type="text" name="liketitle" id="rolename"class="abc input-default" placeholder="" value="<?php echo $this->input->get('liketitle')?$this->input->get('liketitle'):"";?>">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>项目ID</th>
        <th>项目名称</th>
        <th>项目年化收益率</th>
        <th>项目期限</th>
        <th>可转让期限</th>
        <th>操作</th>
    </tr>
    </thead>
    	<?php foreach($result as $key){?>
	     <tr>
            <td><?php echo $key['id'];?></td>
            <td><?php echo $key['title'];?></td>
            <td><?php echo $key['yield'];?></td>
             <td><?php echo $key['deadline'];?></td>
            <td><?php echo $key['assignment_hour'];?></td>
            <td>
                  <a href="<?php echo admin_url('project/edit_project/'.$key['id']);?>">编辑</a>
                  <a href="<?php echo admin_url('project/del_project/'.$key['id']);?>" class="delete">删除</a>
            </td>
        </tr>
        <?php }?>
        </table>
<div class="inline pull-right page">
	<?php echo $links;?>
</div>
