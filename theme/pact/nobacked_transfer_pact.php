<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="favicon.ico" type="image/x-icon"/>
    <title>快投机器借款及服务协议</title>
    <meta name="keywords" content="投资理财,网络理财,固定收益,本息保障,网络融资,互联网理财,互联网金融,P2P,P2C,P2P投资,P2P理财,网贷" />
    <meta name="description" content="提供安全、方便、快捷的投资理财服务，预期收益率10%-18%，第三方资金托管，科学风控，安全保障。" />
    <link href="" rel="apple-touch-icon-precomposed">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>style/css/member.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url();?>style/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>style/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>style/js/base.js"></script>
</head>
<body>
<div class="container" style="width: 800px; margin:0 auto">
	<?php $ex = explode("|",$info[2]['pact']);?>	
    <small>合同编号：<?php echo $info[2]['number'];?>-<?php echo $info[0]['id'];?></small>
    <h2 style="text-align: center;font-weight: bold;">快投机器借款及服务协议</h2>

    <div style="margin-top: 30px;">
        <p>甲方（出借人）:<?php echo $info[4]['name'];?></p>
        <p>身份证号：<?php echo $info[4]['idcard'];?></p>
        <p>乙方（借款人）:<?php echo $info[3]['company_name'];?></p>
        <p>注册号：<?php echo $info[3]['license_no'];?></p>
        <p>丙方(平台方): 北京泰恒长隆网络科技有限公司</p>
        <p>注册号:310141000128354</p>
    </div>
    <br>
    <p>支付机构：是指本协议各方之间作为中介机构提供资金转移服务的银行或者第三方支付结算机构。</p>
    <p>银行监管或第三方支付机构信息帐户信息：新浪支付（200010459399）</p>
    <p>根据《中华人民共和国合同法》及相关法律法规的规定，四方遵循平等自愿的原则，经友好协商，就各方在平台方运营管理的快投机器（域名为www.kuaitoujiqi.com,“快投机器”，以下简称平台）上进行资金借贷、担保等事宜达成一致，以兹信守。</p>
    <br>

    <h3>第一条 借款基本信息</h3>
    <table>
        <tr>
            <td>项目名称</td>
            <td><?php echo $info[2]['title'];?></td>
        </tr>
        <tr>
            <td>借款本金</td>
            <td><?php echo $info[1]['monkey'];?>元(<?php echo cny($info[1]['monkey']);?>)</td>
        </tr>
        <tr>
            <td>年化利率</td>
            <td><?php echo $info[2]['rate']*100;?>%</td>
        </tr>
        <?php 
		function interest($rate=false,$day = false,$monkey = false)
		{
			$year_rate = $rate * $monkey;
			$day_rate = number_format($year_rate/12,2,'.','');
			$day_rate = $day_rate * $day;
			return number_format($day_rate,2,'.','');
		}
		?>
        
        <tr>
            <td>本息合计</td>
            <td><?php echo $info[1]['monkey']-(-interest($info[2]['rate'],$info[2]['day'],$info[1]['monkey']));?>元(<?php echo cny($info[1]['monkey']-(-interest($info[2]['rate'],$info[2]['day'],$info[1]['monkey'])));?>)</td>
        </tr>
        <tr>
            <td>还款方式</td>	
            <td>按月付息，到期还本</td>
        </tr>
        <tr>
            <td>借款用途</td>	
            <td>补充车辆质押项目资金</td>
        </tr>
        <tr>
            <td>借贷期限</td>
            <td>自 <?php echo date('Y-m-d',$info[2]['starttime']);?> 至 <?php echo date('Y-m-d',$info[2]['endtitme']);?></td>
        </tr>
    </table>
    <br>

    <h3>第二条 借款和还款的支付</h3>
    <p>1、本协议各方均委托快投机器通过新浪支付平台进行借款和还款的支付。甲方同意向乙方出借相关款项时，已委托快投机器通过新浪支付平台将借款直接划转到乙方账户；乙方向甲方还款时，已委托快投机器通过新浪支付平台将还款直接划转到甲方帐户；丙方同意在承担担保责任时，已委托快投机器通过新浪支付平台将还款直接划转到甲方帐户。</p>
    <p>2、本协议中的每个出借人与借款人之间的借贷法律关系均是相互独立的，任何一个出借人均可以自己的名义要求借款人和担保人承担还本付息的责任。</p>

    <h3>第三条 各方权利和义务</h3>
    <h4>甲方的权利和义务 </h4>
    <p>1、甲方保证其具备完全民事行为能力，自愿将款项借给乙方，并保证其借出资金来源合法。</p>
    <p>2、甲方应按合同约定的借款日将足额的借款金支付到丁方指定第三方资金监管平台。甲方因本协议获取的收益，如需纳税由甲方自行依法缴纳。甲方享有其所出借款项所带来的利息收益。</p>
    <p>3、在本协议约定的借款期限届满之前，甲方不得要求乙方提前还款。甲方可以根据自己的意愿进行本协议下其对乙方债权的转让，但应经过担保方的同意，并通知乙方。在甲方的债权转让后，乙方需对债权受让人继续履行本协议下其对甲方的还款义务。</p>
    <h4>乙方权利和义务 </h4>
    <p>1、乙方保证不改变本协议第一条约定的借款用途，不得将借款用于任何违法活动，否则，愿承担相应法律责任。</p>
    <p>2、乙方以资产包所含车辆质押权为担保，若资产包所含个人车辆质押借款无法偿还借款时，则乙方将首先按照本协议约定偿还借款人本息，而后进行车辆质押处置预案。</p>
    <p>3、乙方保证按时还款付息，如果逾期还款，按本协议约定承担违约责任。 </p>
    <p>4、在本协议约定的借款期限届满之前，乙方可提前还款，但提前还款应当向甲方提出申请，提前还款的利息按本合同第六条提前还款条例所示。乙方不得将本协议项下的任何权利义务转让给任何其他方。</p>
    <p>5、借款方需提供相应证明文件含且不仅局限以下文件：<br>
        资产包相关资料：个人车辆抵押借款合同，协议书，二手车买卖合同等</p>

    <h4>丙方权利和义务 </h4>
    <p>1、丙方应当遵循本协议，充分协助甲乙双方的借款事宜。</p>
    <p>2、丙方有义务对甲乙双方的信息、信誉进行审核，并对借款双方相关信息，按照国家相关法律向两方信息披露。</p>
    <p>3、丙方应依据其与支付机构北京新浪支付科技有限公司签订的《互联网金融资金管理服务协议》，协助和保证甲方提供的借款按时支付到本合同项下的第三方平台新浪支付监管帐户，并保证该款项由第三方平台支付给乙方。</p>
    <p>4、丙方有义务对甲乙双方相关固有资产，担保情况，运营状况等相关信息进行审核评估，对借款方担保财产进行评估。</p>
    <p>快投机器资产评估报告</p>

    <h3>第四条 违约责任</h3>
    <p>1、合同各方均应严格履行合同义务，非经各方协商一致或依照本协议约定，任何一方不得解除本协议。</p>
    <p>2、任何一方违约，违约方应承担因违约使得其他各方产生的费用和损失，包括但不限于调查、诉讼费、律师费等，应由违约方承担。如违约方为乙方的，甲方有权立即解除本协议，并要求乙方立即偿还未偿还的本金、利息、罚息、违约金。</p>
    <p>3、乙方应严格履行还款义务，如乙方逾期还款，则应按照下述条款向甲方支付逾期罚息，自逾期开始之后，逾期本金的正常利息停止计算。</p>
    <p>罚息总额 = 逾期本息总额×对应罚息利率×逾期天数；</p>
    <table>
        <tr>
            <td>逾期天数</td>
            <td>1—30天</td>
            <td>31天及以上</td>
        </tr>
        <tr>
            <td>罚息利率</td>
            <td> 0.05%日息</td>
            <td>0.07%日息</td>
        </tr>
    </table>
    <p>4、本借款协议中甲方与乙方之间的借款均是相互独立的，一旦乙方逾期未归还借款本息，甲方有权单独向乙方追索或者提起诉讼。丙方有责任提供相关信息协助甲方追索。</p>

    <h3>第五条 违约责任</h3>
    <p>1、乙方可在借款期间任何时候提前偿还剩余借款。</p>
    <p>2、提前偿还全部剩余借款 </p>
    <p>1）乙方提前清偿全部剩余借款时，应向甲方支付当期应还本息，剩余本金及提前还款补偿（补偿金额为剩余本金的1%）。 </p>

    <h3>第六条 法律及争议解决</h3>
    <p>本协议的签订、履行、终止、解释均适用中华人民共和国法律，并由平台所在地上海市浦东新区人民法院管辖。</p>

    <h3>第七条 附则 </h3>
    <p>1、任何一方在快投机器对本协议进行操纵成功确认时，即视为该方接受本协议条款内容并受之约束。各方均对本协议进行操作成功确认时，本协议成立。</p>
    <p>2、通过快投机器提供的服务，出借人向借款人成功出借资金时，本协议生效。</p>
    <p>3、如果本协议中的任何一条或多条违反适用的法律法规，则该条将被视为无效，但该无效条款并不影响本协议其他条款的效力。 </p>


    <br><br><br><br><br>
	<div style="background:url(<?php echo base_url();?>style/img/gongzhang.gif) no-repeat; overflow:hidden; background-position:20% 100%">
    <p>甲方（出借人）:<?php echo $info[4]['name'];?></p>
    <p>身份证号：<?php echo $info[4]['idcard'];?></p>
    <p>乙方（借款人）:<?php echo $info[3]['company_name'];?></p>
    <p>注册号：<?php echo $info[3]['license_no'];?></p>
    <p>丙方(平台方): 北京泰恒长隆网络科技有限公司</p>
    <p>注册号:        310141000128354</p>
	</div>
    <br><br><br>

    <p style="text-align: right;font-weight: bold">签订日期：<?php echo date('Y年m月d日',$info[2]['starttime']);?></p>
    
    <h3>附件:还款计划</h3>
    <table width="400" border="0" class="table table-striped">
      <tr>
        <td>还款日期</td>
        <td>付息金额</td>
        <td>还本金额</td>
      </tr>
      <?php for($i=1;$i<=$info[2]['day'];$i++){?>
      <tr>
        <td><?php echo date('Y年m月d日',next_time($info[2]['starttime'],$i-1));?></td>
        <td>
		<?php 
			$year_rate = $info[2]['rate'] * $info[1]['monkey'];
			$day_rate = number_format($year_rate/12,2,'.','');
			echo $day_rate;
		?></td>
        <td>
        	<?php 
				if($i == $info[2]['day'])
				{
					echo $info[1]['monkey'];
				}
				else
				{
					echo 0;	
				}
			?>
        </td>
      </tr>
      <?php }?>
</table>
<h3>附件：债权转让</h3>
快投机器会员：<?php echo mb_substr($info[4]['nickname'],0,3,'utf-8');?>**** 于<?php echo date('Y年m月d日',strtotime($sendeetime))?>购买原债权人快投机器会员：<?php echo mb_substr($transfer_user['nickname'],0,3,'utf-8');?>**** 所持有债权《<?php echo $info[2]['title'];?>》<?php echo $info[1]['monkey'];?>元。
<br><br><br>
</div>
	
    	
    
</body>
</html>