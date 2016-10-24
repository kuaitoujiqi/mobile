<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit" />
    <link href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
    <title>用户中心 - 债权转让</title>
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
    <script language="javascript">
    $(document).ready(function(){
		$('[data-target="#transferModal111"]').click(function(){
			$('#xmje').text($(this).attr('total'));
			$('#buy').text($(this).attr('buy'));
			$('#endtime').text($(this).attr('endtime'));
			$('#projectid').val($(this).attr('projectid'));
		});
		
		$('#transferModal111 #zhuanrang').click(function(){
			var arg = {};
			arg['projectid'] = parseInt($('#projectid').val());
			arg['monkey'] = $('#monkey').val();
			
			$('#zhuanrang').attr('disabled',true);
			$.post('/usercenter/ajax_transfer',arg,function(data,status){
				if(data == "success")
				{
					alert('提交成功');
					location.href="/usercenter/transfer";
				}
				else
				{
					alert(data);	
					$('#zhuanrang').attr('disabled',false);
				}
			});
		});
	});
    </script>
</head>
<body>
<?php $this->load->view('usercenter/header');?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
           <?php $this->load->view('usercenter/left');?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h3 class="page-header">债权转让</h3>
			<div style="margin-top: 20px; margin-bottom:20px">
            	<div class="btn-group" role="group">
                	<button type="button" class="btn btn-defalut" onclick="javascript:location='<?php echo site_url('usercenter/transfer/');?>';">债权转让</button> 
                    <button type="button" class="btn btn-danger" onclick="javascript:location='<?php echo site_url('usercenter/user_transfer');?>';">转让列表</button>
                </div>
            </div>
            

            <h4 class="sub-header">债权转让记录</h4>

           <?php /*?> <form class="form-inline" style="margin-top: 20px;">
                <div class="form-group">
                    <label for="exampleInputAmount">起止时间：&nbsp;</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></div>
                        <input type="text" class="form-control" id="exampleInputAmount" placeholder="">
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></div>
                        <input type="text" class="form-control" id="exampleInputAmount" placeholder="">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">查询</button>
            </form><?php */?>
            <div class="table-responsive">
                <table class="table transfer_table" style="margin-top: 10px">
                    <thead>
                    <tr>
                        <th>项目ID</th>
                        <th>持有金额</th>
                        <th>收益率</th>
                        <th>转让价格</th>
                        <th>发布日期</th>
                        <th>状态</th>
                        <th>备注</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($result as $key){ ?>
                    <tr>
                    	<td><a href="<?php echo site_url('product/bulk_standard/'.$key['pro_id']);?>" target="_blank"><?php echo $key['pro_id'];?></a></td>
                        <td><?php echo $key['holding'];?></td>
                        <td><?php echo $key['rate']*100;?>%</td>
                        <td><?php echo $key['monkey'];?></td>
                        <td><?php echo date('Y年m月d日',$key['cretattime']);?></td>
                        <td><?php switch($key['static']){
								case 1:echo "待审核";break;
								case 2:echo "已审核";break;
								case 3:echo "<font style='color:#006600'>已转让</font>";break;
								case 4:echo "<font style='color:red'>已撤销</font>";break;
							}?>
                        </td> 
                        <td><?php echo $key['reasons'];?></td>           
                        <td>
                        <?php if($key['static'] == 1 || $key['static'] == 2){?>
                        <a href="<?php echo site_url('usercenter/del_transfer/'.$key['id']);?>" class="btn btn-danger" onClick="return confirm('确定撤销?')">撤销</a>
                        <?php }?>
                        </td>					
                    </tr>
                    <?php }?>
                    

                    </tbody>
                </table>
            </div>
			<div class="page"><?php echo $links;?></div>
        </div>
    </div>
</div>


</body>
</html>