<script language="javascript" type="text/javascript" src="<?php echo static_url();?>js/data/WdatePicker.js"></script>

<form class="form-inline definewidth m20" action="" method="get">  
<a class="btn btn-<?php if($type == 0){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/repayment_list/');?>?type=0">全部</a>
<a class="btn btn-<?php if($type == 1){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/repayment_list/');?>?type=1">3天内</a>
<a class="btn btn-<?php if($type == 2){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/repayment_list/');?>?type=2">5天内</a>
<a class="btn btn-<?php if($type == 3){echo "danger";}else{echo "success";}?>" href="<?php echo admin_url('order/repayment_list/');?>?type=3">10天内</a>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>项目名称</th>
        <th>企业名称</th>
        <th>企业手机号</th>
        <th>下次付息时间</th>
        <th>还款金额</th>
    </tr>
    <?php 
  	function interest($rate= false,$monkey = false,$services = false)
	{
		//rate 年华利率 day 购买时间 monkey 购买钱数
		//计算一年总利息
		$rate = $rate-(-$services);
		$year_rate = $rate * $monkey;
		//计算每月的利息
		$day_rate = number_format(($year_rate/12),2,'.','');
		//计算总共的利息
		//$count_rate = $day_rate * $day;	
		return sprintf("%.2f", $day_rate);
	}
  ?>
    </thead>
    	<?php foreach($result as $key){?>
	     <tr>
            <td><?php echo $key['title'];?></td>
            <td>
			<?php echo $key['company_name'];?>
            </td>
            <td><?php echo $key['telephone'];?></td>
            <td><?php echo date('Y-m-d H:i:s',$key['next_interest']);?></td>
            <td>
            	<?php if($key['repayment_num'] == ($key['day']-1)){
        			echo interest($key['rate'],$key['money'],$key['services']) -(-$key['money']);
        		}else{ //利息
        			echo interest($key['rate'],$key['money'],$key['services']);
				}?>
            </td>
        </tr>
        <?php }?>
        </table>
<div class="inline pull-right page">
	<?php echo $links;?>
</div>
