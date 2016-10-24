<form class="form-inline definewidth m20" action="<?php echo admin_url('project/project_list');?>" method="get">  
     
    <a class="btn btn-success" href="<?php echo admin_url('project/add_invest');?>">添加项目</a>&nbsp;&nbsp;
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>ID</th>
        <th>机构名称</th>
        <th>项目名称</th>
        <th>还款方式</th>
        <th>投资金额</th>
        <th>投资收益率</th>
        <th>投资期限</th>
        <th>操作</th>
    </tr>
    </thead>
    	<?php foreach($result as $key){?>
	     <tr>
            <td><?php echo $key['id'];?></td>
            <td><?php echo $key['org_name'];?></td>
            <td><?php echo $key['invest_name'];?></td>
            <td><?php echo $key['repay'];?></td>
            <td><?php echo $key['invest_money'];?></td>
            <td><?php echo $key['invest_yield'];?></td>
            <td><?php echo $key['invest_due'];?></td>
            <td>
                  <a href="<?php echo admin_url('project/edit_invest/'.$key['id']);?>">编辑</a>
                  <a href="<?php echo admin_url('project/edit_invest/'.$key['id']);?>" class="delete">删除</a>
            </td>
        </tr>
        <?php }?>
        </table>
<div class="inline pull-right page">
	<?php echo $links;?>
</div>
