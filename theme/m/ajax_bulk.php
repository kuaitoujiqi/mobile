<?php foreach($result as $key){?>
 <!-- <div class="index_list_one">
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
                	<a class="btn  btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">还款中</a>	
                <?php }?>
                <?php if($key['static'] == 3){?>
                	<a class="btn btn-defalut pull-right">已结束</a>	
                <?php }?>
        </div>
    </div> -->
  <!--   <?php $buy_load = floor((($key['money'] - $key['restmoney'])/$key['money'])*100);//进度?>
        <div class="progress" style="margin-top: 10px;">
            <div class="progress-bar progress-bar-success progress-bar-striped pull-left" role="progressbar" aria-valuenow="<?php echo $buy_load;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $buy_load;?>%;line-height: 12px;">
               <?php echo $buy_load;?>%
            </div>
        </div> -->

<!-- </div>
 -->
<div class="index_list_one">
        <div class="row">
            <div class="col-xs-7">
                <h3 style="font-size: 14px;margin-bottom:2px;margin-top:10px;color:#666;"> <?php echo $key['title'];?></h3>
            </div>
            <div class="col-xs-5">
                <h3 style="font-size:10px;color:#999;margin-bottom:2px;margin-top:12px;"><?php echo $key['creattime']; ?></h3>
            </div>
        </div>  
        <div>
            <hr style="margin-top:2px;" />
        </div>
        <div class="row list_one_count">
            <div class="col-xs-4 text-center">
                <span style="font-size:14px;color:#666;"><?php echo $key['rate']*100;?></span>%
                <br />
                <span style="font-size:10px;color:#999;">年化收益率</span>
            </div>
            <div class="col-xs-4" style="text-align: center;border-left: 1px solid #eee;border-right: 1px solid #eee;">
                <span style="font-size:14px;color:#666;"><?php echo $key['restmoney'];?></span>元
                <br />
                <span style="font-size:10px;color:#999;">可购余额</span>
            </div>
            <div class="col-xs-4 text-center">
                <span style="font-size:14px;color:#666;"><?php echo $key['day'];?></span>个月
                <br />
                <span style="font-size:10px;color:#999;">还款期限</span>
            </div>      
        </div>
    <!--    <div class="row" style="margin-top:10px;">
            <div class="col-xs-12 text-center">
                <p style="font-size:10px;">
                <?php if($key['static'] == 1){?>
                <?php if($key['restmoney'] == 0){?>
                    <a class="btn btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="border:1px solid #337ab7;color:#337ab7;">审核中</a>
                <?php }else{?>
                    <?php if($key['is_open'] == 1 and $key['creattime'] > date('Y-m-d H:i:s')){?>
                        <a class="btn btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="background-color:#337ab7;color:#fff;">即将上线</a>
                    <?php }else{?>
                        <a class="btn  btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="background-color:#f68121;border:0px;color:#fff;">立即购买</a>
                    <?php }?>
                <?php }?>
                <?php }?>
                <?php if($key['static'] == 2){?>
                    <a class="btn btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="background-color:#cbd3de;border:0px;color:#fff;">还款中</a>   
                <?php }?>
                <?php if($key['static'] == 3){?>
                    <a class="btn btn-defalut btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">已结束</a>   
                <?php }?>           
                </p>
                
            </div>              
        </div> -->      
        <div class="row" style="margin-top:10px;">
            <div class="col-xs-12 text-center">
                <p style="font-size:10px;">
                <?php if($key['static'] == 1){?>
                <?php if($key['restmoney'] == 0){?>
                    <a class="btn  btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="border:1px solid #337ab7;color:#337ab7;">审核中</a>
                <?php }else{?>
                    <?php if($key['is_open'] == 1 and $key['creattime'] > date('Y-m-d H:i:s')){?>
                        <a class="btn btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="background-color:#337ab7;color:#fff;">即将上线</a>
                    <?php }else{?>
                        <a class="btn  btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="background-color:#f68121;border:0px;color:#fff;">立即购买</a>
                    <?php }?>
                <?php }?>
                <?php }?>
                <?php if($key['static'] == 2){?>
                    <a class="btn  btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>" style="background-color:#cbd3de;border:0px;color:#fff;">还款中</a>  
                <?php }?>
                <?php if($key['static'] == 3){?>
                    <a class="btn btn-defalut btn-block" href="<?php echo site_url('m/product/bulk_standard/'.$key['id']);?>">已结束</a>   
                <?php }?>           
                </p>
                
            </div>              
        </div>  
        <div class="row">
            <div class="col-xs-6 text-left">
                <span style="font-size:10px;color:#999;"><?php echo $key['introduction'];?></span>
            </div>
            <div class="col-xs-6 text-right"><span style="font-size:10px;color:#999;"><?php echo $key['repay'];?></span></div>
        </div>
    </div>
    <?php }?>
   