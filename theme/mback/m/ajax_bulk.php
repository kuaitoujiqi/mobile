<?php foreach($result as $key){?>
<div class="index_list_one">
    <div class="row">
        <h3 class="col-xs-12" style="font-size: 16px;font-weight: bold;"> <?php echo $key['title'];?></h3>
    </div>
    <div class="row">
        <p class="col-xs-12 text-muted" style="font-size: 12px;"><?php echo $key['introduction'];?></p>
    </div>
    <div class="row list_one_count">
        <div class="col-xs-4">
            <?php echo $key['rate']*100;?>%/年
        </div>
        <div class="col-xs-4" style="text-align: center;border-left: 1px solid #eee;border-right: 1px solid #eee;">
            <?php echo $key['day'];?>个月
        </div>
        <div class="col-xs-4" style="text-align: right">
             <?php echo $key['money'];?>元
        </div>
    </div>
    <div class="row" style="margin-top: 10px;">
        <div class="col-xs-6 text-muted" style="font-size: 12px;">
           <?php echo $key['repay'];?>
        </div>
        <div class="col-xs-6">
            <?php if($key['static'] == 1){?>
                <?php if($key['restmoney'] == 0){?>
                	<a class="btn btn-primary pull-right" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">审核中</a>
                <?php }else{?>
                	<?php if($key['is_open'] == 1 and $key['creattime'] > date('Y-m-d H:i:s')){?>
                		<a class="btn btn-success pull-right" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">即将上线</a>
                    <?php }else{?>
                    	<a class="btn btn-danger pull-right" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">余<?php echo $key['restmoney'];?>元</a>
					<?php }?>
                <?php }?>
                <?php }?>
                <?php if($key['static'] == 2){?>
                	<a class="btn btn-warning pull-right" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">还款中</a>	
                <?php }?>
                <?php if($key['static'] == 3){?>
                	<a class="btn btn-defalut pull-right" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">已结束</a>	
                <?php }?>
        </div>
    </div>
    <?php $buy_load = floor((($key['money'] - $key['restmoney'])/$key['money'])*100);//进度?>
        <div class="progress" style="margin-top: 10px;">
            <div class="progress-bar progress-bar-success progress-bar-striped pull-left" role="progressbar" aria-valuenow="<?php echo $buy_load;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $buy_load;?>%;line-height: 12px;">
               <?php echo $buy_load;?>%
            </div>
        </div>

</div>
<?php }?>