<html>
<head>
<title>WillZB</title>
{include file='headtag.tpl'}
<script type="text/javascript">
var ua = navigator.userAgent.toLowerCase();
var url = document.location.href;
var isAndroid = ua.indexOf("android") > -1;
var isApple = ua.indexOf("iphone") > -1;
var isMobile = ua.indexOf("mobile") > -1;
var tabletView = url.indexOf("tablet") > -1;
if((isAndroid || isApple || isMobile) && !tabletView) {
	// Redirect to Tablet version
	window.location = "index.php?{$server_query}&osType=tablet";
}
</script>
</head>
<body onload="document.loginform.username.focus()">
<div id="centered">
	<form action="index.php?p=login" method="post" name="loginform">
	<table id="getlogin">
		<tr><td colspan="2"><img src="images/willzb_logo-sm.png" width="144" height="41" alt="WillZB"></td></tr>
		<tr><td class="fn">Username</td><td><input type="text" name="username"></td></tr>
		<tr><td class="fn">Password</td><td><input type="password" name="password"></td></tr>
		<tr><td></td><td><input type="submit" name="login" onclick="return true;" value="login"></td></tr>
	</table>
	<span id="servermessage">{$message}</span>
	</form>
</div>
</body>
</html>
