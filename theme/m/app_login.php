<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head></head>
<?php /*?><script language='javascript'>
function loginSuccAn( uid,username,password)
{  
	android.loginSuccAn(uid,username,password);
}
</script><?php */?>


<body onload="loginSuccAn('<?php echo $userinfo['id'];?>','<?php echo $userinfo['mobile'];?>','<?php echo $userinfo['password'];?>');location.href='<?php echo site_url('m/usercenter');?>'">


<?php /*?>location.href='<?php echo site_url('m/usercenter');<input type="button" name="aaa" value="test" id="aaa"  onclick=""/>?>'
<script language="javascript">
document.getElementById('aaa').click();
</script><?php */?>
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

function loginSuccAn(uid,username,password){

connectWebViewJavascriptBridge(function(bridge) {

    /* Init your app here */

    bridge.init(function(message, responseCallback) {
        alert('Received message: ' + message)   
        if (responseCallback) {
            responseCallback("Right back atcha")
        }
    })
    bridge.send('{"uid":"'+uid+'","username":"'+username+'","password":"'+password+'"}')
    /*bridge.send('Please respond to this', function responseCallback(responseData) {
        console.log("Javascript got its response", responseData)
    })*/
})
android.loginSuccAn(uid,username,password)
}

</script>
</html>
