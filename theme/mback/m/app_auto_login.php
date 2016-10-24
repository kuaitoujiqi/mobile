<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head></head>


        
        <body onload="<?php /*?>loginAuto('<?php echo $uid;?>');<?php */?>location.href='<?php if($code == "001"){echo site_url('m/usercenter');}else{echo site_url('m/welcome/login')."?from=app";}?>'">
        </body>


<?php /*?><script language='javascript'>
function loginOutAn(uid){ 
	 	
	android.loginOutAn(uid);
} 
</script><?php */?>



<?php /*?><input type="button" name="aaa" value="test" id="aaa"  onclick=""/>
<script language="javascript">
document.getElementById('aaa').click();
</script><?php */?>

</html>
