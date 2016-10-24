<?php foreach($result as $key){?>
    <div class="record_one">
        <div class="row">
            <div class="col-xs-4">交易号：</div>
            <div class="col-xs-8"><?php echo $key['id'];?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">日期：</div>
            <div class="col-xs-8"><?php echo date('Y-m-d H:i',$key['dateline']);?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">操作类型：</div>
            <div class="col-xs-8"><?php 
							switch($key['type'])
							{
								case 1:echo "充值";break;
								case 2:echo "投资";break;
								case 5:echo "还款";break;
								case 7:echo "提现";break;
								case 9:echo "投资债权";break;
								case 10:echo "转让债权";break;
							}
						?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">金额（元)：</div>
            <div class="col-xs-8"><?php echo $key['monkey'];?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">手续费：</div>
            <div class="col-xs-8"><?php echo $key['poundage'];?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">状态：</div>
            <div class="col-xs-8"><?php if($key['static'] == 1){echo "处理中";}if($key['static'] == 2){echo "成功";}if($key['static'] == 3){echo "失败";}?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">详情：</div>
            <div class="col-xs-8"><?php switch($key['type'])
							{
								case 2:case 5:case 9:echo anchor('m/product/bulk_standard/'.$key['productid'],'项目详情',array('target'=>'_blank'));break;
								default:echo $key['remark'];break;	
							}?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">电子合同：</div>
            <div class="col-xs-8"><?php if($key['type'] == 2 && $key['static'] == 2 && check_pro_static($key['productid']) ){?>
								<a href="<?php echo site_url('usercenter/pact/'.$key['id'].'/1');?>" target="_blank">服务协议</a> <?php if($key['is_backed'] == 1){?><a href="<?php echo site_url('usercenter/pact/'.$key['id'].'/2');?>" target="_blank">保证合同</a><?php }?>
							<?php }?>
                            <?php if($key['type'] == 9 && $key['static'] == 2){?>
								<a href="<?php echo site_url('usercenter/pact/'.$key['id'].'/1');?>" target="_blank">服务协议</a> <a href="<?php echo site_url('usercenter/pact/'.$key['id'].'/2');?>" target="_blank">保证合同</a>
							<?php }?></div>
        </div>
    </div>
    <?php }?>
