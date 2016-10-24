	<?php if($type == 2){?>
		<?php if($result == null || empty($result)){ ?>
			 <div class="record_one" style="border-bottom:5px solid #eee;margin-top:30px;"> 
				<div class="row">
					<div class="col-xs-4"></div>
					<div class="col-xs-4 text-center">
						<div>
						<img src="<?php echo base_url();?>style/img/m/norecord.png" width="100%" />
						</div>
						<div class="text-center text-primary"><b>暂无记录</b></div>	
					</div>
					<div class="col-xs-4"></div>
				</div>
			 </div>
		<?php }else{ ?>
			<?php foreach($result as $key){?>
				 <div class="record_one" style="border-bottom:5px solid #eee;height:89px;">
					<div class="row" style="height:30px;border-bottom:1px solid #ddd;margin-top:0;border-top:1px solid #eee;">
						
						<div class="col-xs-12 text-left"><a href="<?php echo base_url();?><?php echo 'm/product/bulk_standard/'.$key['productid']; ?>"><?php echo $key['title'];?></a></div>
					</div>	 
					<div class="row">
						<div class="col-xs-4 text-center" style="border-right:1px solid #ddd;">
							<div class="text-center text-primary"><b><?php echo $key['monkey'];?>元</b></div>
							<div class="text-center">投资金额</div>
						</div>
						<div class="col-xs-4 text-center" style="border-right:1px solid #ddd;">
							<div class="text-center text-primary"><b>
								<?php 
									if($key['static'] == 1){
										echo "处理中";
									}else{
										if($key['static'] == 5){
											echo "已结束";	
										}else{
											if($type == 1 && $key['static'] == 4){
												echo "已转让";	
											}else{
												switch($key['pstatic']){
													case 1:echo "等待开始";break;
													case 2:echo date('Y-m-d',$key['next_interest']-(-86400));break;
													case 3:echo "已结束";
												}
											}
										}
									}
								?>
							</b></div>
							<div class="text-center">下期还款</div>	
						</div>		
						<div class="col-xs-4">
							<div class="text-center text-primary"><b><?php echo date('m-d H:i',$key['dateline']);?></b></div>
							<div class="text-center">日期</div>
						</div>
					</div>	 
				 </div>
			<?php }?>	
		<?php }?>		
	<?php }?>

	<?php if($type == 5){?>
		<?php if($result == null || empty($result)){ ?>
			 <div class="record_one" style="border-bottom:5px solid #eee;margin-top:30px;"> 
				<div class="row">
					<div class="col-xs-4"></div>
					<div class="col-xs-4 text-center">
						<div>
						<img src="<?php echo base_url();?>style/img/m/norecord.png" width="100%" />
						</div>
						<div class="text-center text-primary"><b>暂无记录</b></div>						
					</div>
					<div class="col-xs-4"></div>
				</div>
			 </div>
		<?php }else{ ?>
			<?php foreach($result as $key){?>
				 <div class="record_one" style="border-bottom:5px solid #eee;height:89px;">
					<div class="row" style="height:30px;border-bottom:1px solid #ddd;">
						
						<div class="col-xs-12 text-left"><a href="<?php echo base_url();?><?php echo 'm/product/bulk_standard/'.$key['productid']; ?>"><?php echo $key['title'];?></a></div>
					</div>	 
					<div class="row">
						<div class="col-xs-6 text-center" style="border-right:1px solid #ddd;">
							<div class="text-center text-primary"><b><?php echo $key['monkey'];?>元</b></div>
							<div class="text-center">还款金额</div>
						</div>		
						<div class="col-xs-6">
							<div class="text-center text-primary"><b><?php echo date('m-d H:i',$key['dateline']);?></b></div>
							<div class="text-center">日期</div>
						</div>

					</div>	 
				 </div>
			<?php }?>	
		<?php }?>		
	<?php }?>
	
	<?php if($type == 7){?>
		<?php if($result == null || empty($result)){ ?>
			 <div class="record_one" style="border-bottom:5px solid #eee;margin-top:30px;"> 
				<div class="row">
					<div class="col-xs-4"></div>
					<div class="col-xs-4 text-center">
						<div>
						<img src="<?php echo base_url();?>style/img/m/norecord.png" width="100%" />
						</div>
						<div class="text-center text-primary"><b>暂无记录</b></div>							
					</div>
					<div class="col-xs-4"></div>
				</div>
			 </div>
		<?php }else{ ?>
			<?php foreach($result as $key){?>
				 <div class="record_one" style="border-bottom:5px solid #eee;height:59px;margin-top:0;border-top:1px solid #eee;"> 
					<div class="row">
						<div class="col-xs-4 text-center" style="border-right:1px solid #ddd;">
							<div class="text-center text-primary"><b><?php echo $key['monkey'];?>元</b></div>
							<div class="text-center">提现金额</div>
						</div>
						<div class="col-xs-4 text-center" style="border-right:1px solid #ddd;">
							<div class="text-center text-primary"><b><?php if($key['static'] == 1){echo "处理中";}if($key['static'] == 2){echo "成功";}if($key['static'] == 3){echo "失败";}?></b></div>
							<div class="text-center">状态</div>	
						</div>		
						<div class="col-xs-4">
							<div class="text-center text-primary"><b><?php echo date('m-d H:i',$key['dateline']);?></b></div>
							<div class="text-center">日期</div>
						</div>

					</div>	 
				 </div>
			<?php }?>	
		<?php }?>	
	<?php }?>
	
	<?php if($type == 1){?>
		<?php if($result == null || empty($result)){ ?>
			 <div class="record_one" style="border-bottom:5px solid #eee;margin-top:30px;"> 
				<div class="row">
					<div class="col-xs-4"></div>
					<div class="col-xs-4 text-center">
						<div>
						<img src="<?php echo base_url();?>style/img/m/norecord.png" width="100%" />
						</div>
						<div class="text-center text-primary"><b>暂无记录</b></div>		
					</div>
					<div class="col-xs-4"></div>
				</div>
			 </div>
		<?php }else{ ?>
			<?php foreach($result as $key){?>
			 <div class="record_one" style="border-bottom:5px solid #eee;height:59px;margin-top:0;border-top:1px solid #eee;"> 
				<div class="row">
					<div class="col-xs-4 text-center" style="border-right:1px solid #ddd;">
						<div class="text-center text-primary"><b><?php echo $key['monkey'];?>元</b></div>
						<div class="text-center">充值金额</div>
					</div>
					<div class="col-xs-4 text-center" style="border-right:1px solid #ddd;">
						<div class="text-center text-primary"><b><?php if($key['static'] == 1){echo "处理中";}if($key['static'] == 2){echo "成功";}if($key['static'] == 3){echo "失败";}?></b></div>
						<div class="text-center">状态</div>	
					</div>		
					<div class="col-xs-4">
						<div class="text-center text-primary"><b><?php echo date('m-d H:i',$key['dateline']);?></b></div>
						<div class="text-center">日期</div>
					</div>
				</div>	 
			 </div>
			<?php }?>	
		<?php }?>
	<?php }?>	
