<div class="sysinfo">
<p class="sinfotit">账户操作记录</p>
<div class="exec">
<table width="700" border="0">
  <tr>
    <td>日期</td>
    <td>类型</td>
    <td>金额</td>
    <td>手续费</td>
    <td>状态</td>
    <td>详情</td>
  </tr>
  <?php foreach($result as $key){?>
  <tr>
    <td><?php echo date('Y-m-d',$key['dateline']);?></td>
    <td><?php 
							switch($key['type'])
							{
								case 1:echo "充值";break;
								case 3:echo "借款";break;
								case 4:echo "还款";break;
								case 7:echo "提现";break;
							}
						?></td>
    <td><?php echo $key['monkey'];?></td>
    <td><?php echo $key['poundage'];?></td>
    <td><?php if($key['static'] == 1){echo "处理中";}if($key['static'] == 2){echo "成功";}if($key['static'] == 3){echo "失败";}?></td>
    <td><?php switch($key['type'])
		{
			case 3:case 4:echo anchor('product/bulk_standard/'.$key['productid'],'项目详情',array('target'=>'_blank'));break;
			default:echo $key['remark'];break;	
		}?>
        </td>
  </tr>
  <?php }?>
  <tr>
    <td colspan="6" align="center"><?php echo $links;?></td>
    </tr>
</table>
	
</div>
</div>
</div>