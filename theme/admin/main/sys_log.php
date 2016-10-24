<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>ID</th>
        <th>内容</th>
        <th>时间</th>
    </tr>
    </thead>
    	<?php foreach($result as $key){?>
	     <tr>
            <td><?php echo $key['id'];?></td>
            <td><?php echo $key['content'];?></td>
            <td><?php echo $key['dateline'];?></td>
        </tr>
        <?php }?>
        </table>
<div class="inline pull-right page">
	<?php echo $links;?>
</div>
