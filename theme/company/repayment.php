<div class="sysinfo">
<p class="sinfotit">本期待还款列表<span style="color:red">（温馨提示:节假日请提前还款）</span></p>
<div class="exec">
	<table width="700" border="0">
  <tr>
    <td>项目名称</td>
    <td>项目总额</td>
    <td>项目周期</td>
    <td>本次还款金额</td>
    <td>本次还款期限</td>
    <td>操作</td>
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
  <?php foreach($result as $key){?>
  
  <tr>
    <td><?php echo $key['title'];?></td>
    <td><?php echo $key['money'];?></td>
    <td><?php echo $key['day'];?></td>
    <td>
    	<?php if($key['repayment_num'] == ($key['day']-1)){
        	echo interest($key['rate'],$key['money'],$key['services']) -(-$key['money']);
        }else{ //利息
        	echo interest($key['rate'],$key['money'],$key['services']);
		}?>
    </td>
    <td>
    	<?php echo date('Y-m-d',$key['next_interest']);?>
    </td>
    <td><a href="<?php echo site_url('company/main/form_repayment/'.$key['id']);?>" onClick="return confirm('确定还款？');">还款</a></td>
  </tr>
  <?php }?>
<tr>
    <td colspan="6" align="center"><?php echo $links;?></td>
    </tr>
  
</table>

</div>
</div>