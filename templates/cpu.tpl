<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>CPU Settings</title>
{include file='headtag.tpl'}
</head>
<body onload="general_stats()">
{include file='header.tpl'}
<div id='maincontent'>
	{if $message}
		Output:<br>
		<span id="serverresponse">{$message}</span>
	{/if}
	<form action="index.php?p=cpu" name="cpu" method="post">
	<input type="hidden" name="delay" value="0">
	<h2>Shutdown</h2>
	<input type="submit" name="action" value="Shutdown" onclick="var num=prompt('How many minutes before shutting down? 0 For shutdown now.','0'); if (num>=0) setDelay(num);">
	&nbsp;&nbsp;
	<input type="submit" name="action" value="Restart" onclick="var num=prompt('How many minutes before restarting? 0 For restart now.','0'); if (num>=0) setDelay(num);">
	&nbsp;&nbsp;
	<input type="submit" name="action" value="Cancel">
	</form>
	<br><br>
</div>
{include file='footer.tpl'}
</body>
</html>
