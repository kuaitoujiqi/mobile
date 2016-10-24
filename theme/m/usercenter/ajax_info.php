<?php foreach($result as $key){?>
    <div class="record_one">
        <h4 class=" text-muted">
            [<?php echo date('Y年m月d日 H:i',strtotime($key['dateline']));?>]
            <button type="button" class="btn btn-sm btn-danger pull-right" onClick="javascript:location='<?php echo site_url('m/usercenter/del_info/'.$key['id']);?>'">删除</button>
        </h4>
        <p><?php echo $key['content'];?></p>
    </div>
	<?php }?>