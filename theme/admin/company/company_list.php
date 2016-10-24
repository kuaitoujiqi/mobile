<form class="form-inline definewidth m20" action="<?php echo admin_url('news/news_list');?>" method="get">  
    <a class="btn btn-success" href="<?php echo admin_url('company/add_company');?>">添加企业会员</a>  
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>企业ID</th>
        <th>企业名称</th>
        <th>企业电话</th>
        <th>状态</th>
        <th>创建时间</th>
        <th>操作</th>
    </tr>
    </thead>
    	<?php foreach($result as $key){?>
	     <tr>
            <td><?php echo $key['id'];?></td>
            <td><?php echo $key['company_name'];?></td>
            <td><?php echo $key['telephone'];?></td>
             <td><?php 
			 switch($key['static'])
			 {
				case 1:echo "创建";break;
				case 2:echo "审核中";break;
				case 3:echo "审核通过";break;
				case 4:echo "审核失败";break;	 
			 }
			 ?></td>
            <td><?php echo $key['dateline'];?></td>
            <td>
                  <?php if($key['static'] == 1 || $key['static'] == 4){?>
                  <a href="<?php echo admin_url('company/edit_company/'.$key['id']);?>">编辑</a>
                  <a href="<?php echo admin_url('company/check_company/'.$key['id']);?>">审核</a>
                  <?php }?>
                  <?php if($key['static'] == 4){
                  	echo $key['failed_msg']; }?>
                    <?php if($key['static'] == 2){
                  	echo "<a href='".admin_url('company/check_company_show/'.$key['id']."/".$key['checkid'])."' target='_blank'>审核中</a>"; }?>
            <a href="<?php echo admin_url('company/show_company/'.$key['id'])?>">查看企业信息</a>
            </td>
            
        </tr>
        <?php }?>
        </table>
<div class="inline pull-right page">
	<?php echo $links;?>
</div>
