<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head></head>
        <body onload="loginOutAn('<?php echo $uid;?>');location.href='<?php echo site_url('m');?>'">
        </body>
<script type="text/javascript">
 function connectWebViewJavascriptBridge(callback) {
    if (window.WebViewJavascriptBridge) {
        callback(WebViewJavascriptBridge)
    } else {
        document.addEventListener('WebViewJavascriptBridgeReady', function() {
            callback(WebViewJavascriptBridge)
        }, false)
    }
}
function loginOutAn(uid){
connectWebViewJavascriptBridge(function(bridge) {
    /* Init your app here */
    bridge.init(function(message, responseCallback) {
        alert('Received message: ' + message)   
        if (responseCallback) {
            responseCallback("Right back atcha")
        }
    })
    bridge.send(uid)
	
    /*bridge.send('Please respond to this', function responseCallback(responseData) {
        console.log("Javascript got its response", responseData)
    })*/
})
android.loginOutAn(uid)
}

</script>

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
