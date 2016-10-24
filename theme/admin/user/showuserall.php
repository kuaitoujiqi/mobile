<div class="definewidth m20">
<table class="table table-bordered table-hover m10">
    <tr>
        <td class="tableleft" width="10%">ID</td>
        <td><?php echo $row['id'];?>
        </td>
    </tr>
    <tr>
        <td class="tableleft">昵称</td>
        <td>
        <?php echo $row['nickname'];?></td>
    </tr>
    <tr>
        <td class="tableleft">手机</td>
        <td><?php echo $row['mobile'];?></td>
    </tr>
    <tr>
        <td class="tableleft">身份证</td>
        <td><?php echo $row['idcard'];?> <?php if($row['cardtime'] != ""){echo "认证时间：".date('Y-m-d H:i:s',$row['cardtime']);}?></td>
    </tr>
    <tr>
        <td class="tableleft">姓名</td>
        <td><?php echo $row['name'];?></td>
    </tr>
    <tr>
        <td class="tableleft">邮箱</td>
        <td><?php echo $row['email'];?></td>
    </tr>
    <tr>
        <td class="tableleft">手机验证</td>
        <td><?php echo $row['is_mobile']==0?"未验证":"已验证";?></td>
    </tr>
    <tr>
        <td class="tableleft">身份证验证</td>
        <td>
        <?php echo $row['is_idcard']==0?"未验证":"已验证";?>
       </td>
    </tr>
    <tr>
        <td class="tableleft">邮箱验证</td>
        <td><?php echo $row['is_email']==0?"未验证":"已验证";?></td>
    </tr>
    <tr>
        <td class="tableleft">是否邦卡</td>
        <td><?php 
			if($bind_card['count']<=0)
			{
				echo "未绑定";	
			}
			else
			{
				$bind_type = $bind_card['row']['verify_mode'] == 1?"支付提现卡":"提现";
				echo "已绑定"." 绑卡时间：".date('Y-m-d H:i:s',$bind_card['row']['dateline'])." 邦卡请求号:".$bind_card['row']['id']." 邦卡类型:".$bind_type." 邦卡银行:".$bind_card['row']['bank_code'];
				if($bind_card['count'] > 1){echo '<font style="color:red"> 绑卡异常2卡存在</font>';}
			}
		?></td>
    </tr>
    <tr>
        <td class="tableleft">金额统计</td>
        <td>
        	资产总额:<?php echo $tongji['zcze'];?><br />
            账户余额:<?php echo $tongji['yue'];?><br />
            持有产品:<?php echo $tongji['chiyou'];?><br />
            结束产品:<?php echo $tongji['jsxmze'];?><br />
            提现额度:<?php echo $tongji['quota'];?><br />
            预期收益:<?php echo $tongji['yqsy'];?><br />
            累计收益:<?php echo $tongji['ljsy'];?><br />
            累计充值:<?php echo $tongji['recharge'];?>(成功)<br />
            累计提现:<?php echo $tongji['withdraw'];?>(成功)<br />
            累计投资:<?php echo $tongji['ljtz'];?>(成功)<br />
            累计购债: 成交价格 <?php echo $tongji['ljgz'][0];?>  项目原始价格 <?php echo $tongji['ljgz'][1];?> (成功)<br />
            累计债转: 成交价格 <?php echo $tongji['ljzz'][0];?>  项目原始价格 <?php echo $tongji['ljzz'][1];?> (成功)<br />
            提现手续费:<?php echo $tongji['withdraw_shouxufei'];?>(成功)<br />
        </td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
           <a class="btn btn-success" href="<?php echo $_SERVER['HTTP_REFERER'];?>">返回列表</a>
        </td>
    </tr>
</table>
</div>

