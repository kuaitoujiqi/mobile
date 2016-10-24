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
    <script src="<?php echo base_url();?>style/js/jquery-migrate-1.1.0.js"></script>
    <script src="<?php echo base_url();?>style/js/jquery.jqprint-0.3.js"></script>
    
    <script language="javascript">
	$(document).ready(function(){
		$('#print_btn').click(function(){
			$('#print').jqprint();
		});
		
	});
	</script>
<?php /*?>    <style type="text/css">
    @media print {
		#gongzhang{background:url(http://www.kuaitoujiqi.com/style/img/gongzhang.gif) no-repeat; overflow:hidden; background-position:20% 100%; z-index:999; position:relative; width:300px; height:100px}	
	}
    </style><?php */?>
</head>
<body style="-webkit-print-color-adjust: exact;">
<div class="container" style="width: 800px; margin:0 auto" id="print">
	<?php $ex = explode("|",$info[2]['pact']);?>	
    <small>合同编号：<?php echo $info[2]['number'];?>-<?php echo $info[0]['id'];?></small>
    <h2 style="text-align: center;font-weight: bold;">网络借款协议	</h2>

    <div style="margin-top: 30px;">
        <p>甲方（出借人）:<?php echo $info[4]['name'];?></p>
        <p>身份证号：<?php echo $info[4]['idcard'];?></p>
		
        <p>乙方（借款人）:<?php echo $info[3]['company_name'];?></p>
        <p>注册号：<?php echo $info[3]['license_no'];?></p>
		
        <p>丙方（保证方）:<?php echo $ex[0];?></p>
        <p>注册号：<?php echo $ex[1];?></p>
		
        <p>丁方(平台方): 北京泰恒长隆网络科技有限公司</p>
		<p>法定代表人：葛继华</p>
		<p>住所地：北京市海淀区紫竹院路广源闸5号4层4138</p>
        <p>统一社会信用代码：91110108MA00113GA </p>
    </div>
    <br>
	
	<p>快投机器平台是指：北京泰恒长隆网络科技有限公司经营的为其注册用户提供专业网络借贷交易居间服务的互联网平台，网站域名为：www.kuaitoujiqi.com</p>
	
    <p>支付机构：是指本协议各方之间作为中介机构提供资金托管与转移服务的银行或者具有第三方托管资质的第三方支付结算机构。本协议下的支付机构是指：新浪第三方支付</p>
    <p>根据《中华人民共和国合同法》及相关法律法规的规定，四方遵循平等自愿的原则，经友好协商，就甲乙丙在丁方运营管理的快投机器平台（域名为www.kuaitoujiqi.com,“快投机器”，以下简称平台）上进行资金借贷、担保等事宜达成一致，以兹信守。</p>
    <br>

    <h3>第一条 借款信息</h3>
    <table border="1" cellspacing="0" cellpadding="0" width="100%" >
        <tr>
            <td>项目名称</td>
            <td><?php echo $info[2]['title'];?></td>
        </tr>
        <tr>
            <td>借款本金</td>
            <td><?php echo $info[1]['monkey'];?>元(<?php echo ParseNumber(100);?>)</td>
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
            <td><?php echo $info[1]['monkey']-(-interest($info[2]['rate'],$info[2]['day'],$info[1]['monkey']));?>元(<?php echo ParseNumber($info[1]['monkey']-(-interest($info[2]['rate'],$info[2]['day'],$info[1]['monkey'])));?>)</td>
        </tr>
        <tr>
            <td>还款方式</td>	
            <td>按月付息，到期还本</td>
        </tr>	
        <tr>
            <td>借贷期限</td>
            <td>自 <?php echo date('Y-m-d',$info[2]['starttime']);?> 至 <?php echo date('Y-m-d',$info[2]['endtitme']);?></td>
        </tr>
    </table>
    <br>

    <h3>第二条 借款流程</h3>
    <p>1、本协议成立：甲方按照丁方快投机器平台的规则，通过在平台上对乙方通过平台发布的借款需求点击“立即购买”确认时，本协议立即成立。</p>
    <p>2、出借资金冻结：甲方点击“立即购买”即视为其已经向丁方发出不可撤销的授权指令，授权丁方委托第三方支付机构或资金监管银行等合作机构，在监管账户中冻结甲方出借金额的资金。上述冻结在本协议生效时或本协议确定失效时解除。</p>
    <p>3、本协议生效：本协议在乙方发布的借款需求全部得到满足，即乙方借款需求所对应的资金已经全部冻结时立即生效。 </p>
    <p>4、出借资金划转：本协议生效时，乙方即不可撤销地授权丁方委托相应的第三方支付机构或资金监管银行，将每期借款本金数额的资金划转至乙方的互联网金融资金管理账户，划转完毕即视为借款发放成功，借款利息及相关费用开始计算。</p>
    <p>5、本协议各方均通过快投机器的合作方新浪支付平台进行借款和还款的支付。甲方同意向乙方出借相关款项时，委托快投机器通过新浪支付平台将借款直接划转到乙方账户；乙方向甲方还款时，委托快投机器通过新浪支付平台将还款直接划转到甲方帐户；丙方同意在承担担保责任时，委托快投机器通过新浪支付平台将还款直接划转到甲方帐户。</p>
    <p>6、本协议中的每个出借人与借款人之间的借贷法律关系均是相互独立的，任何一个出借人均可以自己的名义要求借款人和担保人承担还本付息的责任。</p>
    <p>7、丁方作为平台方仅为甲乙丙三方的借款和还款提供居间服务及相关中介服务，不是借贷关系的主体。</p>
	
	<h3>第三条 借款资金来源保证</h3>
	<p>甲方保证其所用于出借的资金来源合法，甲方是该资金的合法所有人，如果第三方对资金归属、合法性问题提出异议，由甲方自行解决。如甲方未能解决导致甲方不能获得本协议下借款利息的，甲方无权向乙丙追偿。</p>
	
	<h3>第四条 收费及税费</h3>
	<p>1、丁方有权就为本协议借款所提供的服务向乙方收取手续费和服务费、催收费等费用，上述费用的收取方式由乙、丙双方另行约定。</p>
	<p>2、甲方应自行负担并主动缴纳因利息收益带来的可能的税费。</p>
	
	<h3>第五条 借款资金来源保证</h3>
	<p>1、乙方必须按照本协议的约定按时、足额偿还对甲方的借款本金和利息。甲方、乙方同意并授权丁方按如下方式代为收取上述费用：丁方在每月付息日当日（不得迟于24:00）或之前根据甲方的授权代为向乙方收取乙方当期应支付的本息，金额等同于本协议第一条所列的“月偿还本息数额”的资金。具体代收方式由乙方与丁方另行约定。</p>
	<p>2、乙方指定其在新浪支付平台的互联网金融资金管理账户为本协议的还款收款账户，各方同意丁方代为收取的本息一经划转至乙方在新浪支付平台的互联网金融资金管理账户后，即视为乙方已经履行本协议项下对甲方的相应还款义务。收到上述本息后，丁方根据与甲方之间的约定通过第三方支付平台向甲方支付该等资金。</p>
	<p>3、如果还款日遇到法定假日或公休日，还款日期不顺延。</p>
	<p>4、乙方每期还款按照如下顺序清偿：（1）根据本协议产生的其他全部费用（2）逾期罚息（3）拖欠利息（5）当期利息（6）当期本金。</p>
	
	<h3>第六条 债权转让</h3>
	<p>1、各方同意并确认，甲方可将本协议项下全部借款的债权转让予第三方，但该第三方必须为快投机器平台的注册用户。</p>
	<p>2、甲方根据本协议转让借款债权时，乙方不可撤销地授权丁方代为接收该等转让通知；债权受让人依法承接甲方在本协议项下的权利和义务。债权转让后，乙方需对债权受让人在剩余借款期限继续履行本协议下其对甲方的还款义务，丙方在原保证担保的范围内继续承担本协议项下的代偿责任。</p>
	
	<h3>第七条 债务转让</h3>
	<p>未经甲方及丙方事先书面（包括但不限于电子邮件等方式）同意，乙方不得将本协议项下的任何权利义务转让给任何第三方。</p>
	
	<h3>第八条 各方权利和义务</h3>
	<h4>甲方的权利和义务</h4>
	<p>1、甲方保证其具备完全民事行为能力，自愿将款项借给乙方，并保证其借出资金来源合法。</p>
	<p>2、甲方应按合同约定的借款日将足额的借款金支付到丁方指定第三方资金支付机构/监管平台。甲方享有其所出借款项所带来的利息收益。</p>
	<p>3、在本协议约定的借款期限届满之前，甲方不得要求乙方提前还款。甲方可以根据自己的意愿进行本协议下其对乙方债权的转让，并书面通知乙方、丙方和丁方，并在平台系统做变更登记。在甲方的债权转让后，乙方需对债权受让人继续履行本协议下其对甲方的还款义务。</p>

	<h4>乙方权利和义务</h4>
	<p>1、乙方保证不改变本协议第一条约定的借款用途，不得将借款用于任何违法活动。</p>
	<p>2、乙方保证按时还款付息，如果逾期还款，按本协议约定承担违约责任。</p>
	<p>3、在本协议约定的借款期限届满之前，乙方可提前还款，但提前还款应当通过平台发布并，提前还款的利息和补偿按本合同第六条提前还款条例所示。乙方不得将本协议项下的任何权利义务转让给任何其他方。</p>
	<p>4、借款方需提供相应证明文件含且不仅局限以下文件：</p>
	<p>
		<ul>
			<li> 营业执照</li>
			<li> 税务登记证</li>
			<li> 组织机构代码证</li>
			<li> 借款用途相关证明文件</li>
		</ul>
	</p>
	
	<h4>丙方权利和义务</h4>
	<p>1、丙方提供保证担保并向甲方出具保证函。如乙方到期不能偿还本合同约定的本金和利息，甲方可向丙方追偿。</p>
	<p>2、甲乙双方如变更借款事项，包括但不限于借款金额、利息、借款期限和用途，债权转移，应及时通知丙方争得丙方书面同意，否则丙方不再承担本合同下的担保义务。</p>
	<p>3、保证方需提供相关证明文件含且不仅局限于以下文件：</p>
	<p>
		<ul>
			<li> 营业执照</li>
			<li> 税务登记证</li>
			<li> 组织机构代码证</li>
			<li> 资产证明</li>
			<li> 保证函</li>
		</ul>
	</p>
	
	<h4>丁方的权利和义务</h4>
	<p>1、丁方应当遵循本协议，为甲乙双方的借款事宜提供网络平台服务。</p>
	<p>2、丁方有义务对甲乙双方的信息、信誉进行审核，并对借款双方相关信息，按照国家相关法律向两方信息披露。</p>
	<p>3、丁方应充分保守甲乙丙三方的个人和企业信息，不得随意使用或对外披露相关信息。</p>
	<p>4、丁方应依据其与支付机构北京新浪支付科技有限公司签订的《互联网金融资金账户管理服务协议》，协助和保证甲方提供的借款按时支付到本合同项下的第三方平台新浪支付监管帐户，并保证该款项由第三方平台支付给乙方。</p>
	<p>5、丁方有义务对甲乙双方相关身份、资质信息、固有资产、担保情况，运营状况等相关信息进行审核评估，对借款方担保财产进行评估。</p>
	
	<h3>第九条 违约责任</h3>
	<p>1、合同各方均应严格履行合同义务，非经各方协商一致或依照本协议约定，任何一方不得解除本协议。</p>
	<p>2、任何一方违约，违约方应承担因违约使得其他各方产生的费用和损失，包括但不限于调查、诉讼费、律师费等，应由违约方承担。</p>
	<p>3、乙方应严格履行还款义务，如乙方逾期还款，则应按照下述条款向甲方支付逾期罚息，自逾期开始之后，逾期本金的正常利息停止计算。</p>
	<p>罚息总额 = 逾期本息总额×对应罚息利率×逾期天数；</p>
	<p>
		<table border="1" cellspacing="0" cellpadding="0" width="50%"  >
			<tr>
				<td>逾期天数</td>
				<td>1-30天</td>
				<td>31天及以上</td>
			</tr>
			<tr>
				<td>罚息利率</td>
				<td>0.05%罚息</td>
				<td>0.07%日息</td>
			</tr>
		</table>
	</p>
	<p>4、本借款协议中甲方与乙方之间的借款均是相互独立的，一旦乙方逾期未归还借款本息，甲方有权单独向乙方追索或者提起诉讼。</p>
	
	<h3>第十条 提前还款</h3>
	<p>1、乙方可在借款期间任何时候提前偿还剩余借款。</p>
	<p>2、提前偿还全部剩余借款</p>
	<p>3、乙方提前清偿全部剩余借款时，应向甲方支付当期应还本息，剩余本金及提前还款补偿（补偿金额为剩余本金的1%）。</p>
	
	<h3>第十一条 法律及争议解决</h3>
	<p>本协议的签订、履行、终止、解释均适用中华人民共和国法律，并由平台所在地北京市海淀区人民法院管辖。</p>
	
	<h3>第十二条 附则</h3>
	<p>如果本协议中的任何一条或多条违反适用的法律法规，则该条将被视为无效，但该无效条款并不影响本协议其他条款的效力。</p>
	
    <br><br><br><br><br>
	<div style="background:url(http://www.kuaitoujiqi.com/style/img/gongzhang.gif) no-repeat; overflow:hidden; background-position:20% 100%;height:151px;" >
    <p>甲方（出借人）:<?php echo $info[4]['name'];?></p>
    
    <p>乙方（借款人）:<?php echo $info[3]['company_name'];?></p>
    
    <p>丙方（保证方）:<?php echo $ex[0];?></p>
   
    <p>丁方(平台方): 北京泰恒长隆网络科技有限公司</p>
	<!----
    <div id="gongzhang" style="height:151px;background:url(http://www.kuaitoujiqi.com/style/img/zizhi/danbao.png) no-repeat; overflow:hidden;"></div>
	--->
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
<br><br><br>
</div>
	
<?php /*?><div class="container" style="width: 800px; margin:0 auto; display:none">
	<button type="button" class="btn btn-primary" id="print_btn">打印</button>
</div>  <?php */?>	
    
</body>
</html>