<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Manually Add NZB Files to download</title>
{include file='headtag.tpl'}
</head>
<body onload="general_stats();">
{include file='header.tpl'}
<div id='maincontent'>
	<h2>Add Files to Download</h2>
	<span id="servermessage">{$message}</span>
	<form enctype="multipart/form-data" action="index.php?p=add_nzb_manual" name="nzbfile" method="post">
	<br>
	<table>
		<tr>
			<td>Upload an NZB's or provide the url of one to be downloaded.</td>
		</tr>
		<tr>
			<td> <br>
				Select NZB File:<br>
				<input type="file" name="nzbFile" size="40">
			</td>
		</tr>
		{if isset($result.file)}
			<tr><td>{$result.file}</td></tr>
		{/if}
	</table>
	<br>
	<table>
		<tr>
			<td>NZB URL:</td>
		</tr>
		<tr>
			<td><input type="text" name="nzbURL" size="70"></td>
		</tr>
		{if isset($result.url)}
			<tr><td>{$result.url}</td></tr>
		{/if}
	</table>
	<br>
	<input type="submit" name="action" value="Submit File">
	</form>
	<br><br>
</div>
{include file='footer.tpl'}
</body>
</html>
