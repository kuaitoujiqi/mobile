<form class="form-inline definewidth m20" action="<?php echo admin_url('news/news_list');?>" method="get">  
     
    <a class="btn btn-success" href="<?php echo admin_url('news/add_news');?>">添加文章</a>&nbsp;&nbsp; 文章标题：<input type="text" name="liketitle" id="rolename"class="abc input-default" placeholder="" value="<?php echo $this->input->get('liketitle')?$this->input->get('liketitle'):"";?>">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>ID</th>
        <th>标题</th>
        <th>分类</th>
        <th>发布人</th>
        <th>发布时间</th>
        <th>操作</th>
    </tr>
    </thead>
    	<?php foreach($result as $key){?>
	     <tr>
            <td><?php echo $key['id'];?></td>
            <td><?php echo $key['title'];?></td>
            <td><?php echo $key['cate'];?></td>
             <td><?php echo $key['name'];?></td>
            <td><?php echo $key['dateline'];?></td>
            <td>
                  <a href="<?php echo admin_url('news/edit_news/'.$key['id']);?>">编辑</a>
                  <a href="<?php echo admin_url('news/del_news/'.$key['id']);?>" class="delete">删除</a>
            </td>
        </tr>
        <?php }?>
        </table>
<div class="inline pull-right page">
	<?php echo $links;?>
</div>
