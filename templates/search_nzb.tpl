<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Search for NZB Files to download</title>
{include file='headtag.tpl'}
</head>
<body onload="general_stats();">
{include file='header.tpl'}
<div id='maincontent'>
	<h2>Search Files to Download</h2>
	<span id="servermessage">{$message}</span>
	<form action="index.php?p=search_nzb" name="search" method="post">
	Search for NZBs to download by category.
	<br><br>
	<table>
		<tr>
			<td>Search: </td>
			<td><input type="text" name="query" size="30"> </td>
			<td>
				<span name="mobile_show"><!-- Extra break for mobile --></span>
				In:
			</td>
			<td>
				{html_options name=category options=$categories selected=$category}
			</td>
		</tr>
	</table>
	Optional:
	<table>
		<tr>
			<td>Min Filesize:</td>
			<td><input type="text" name="minSize" size="10" >MB</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>Max Filesize:</td>
			<td><input type="text" name="maxSize" size="10">MB</td>
		</td>
	</table>
	<table>
		<tr>
			<td>Match:</td>
			<td>{html_options name=searchin options=$searchin selected='name'}</td>
		</td>
	</table>
	<br>
	
	<input type="submit" name="action" value="Search">
	</form>
	<br><br>
</div>
{include file='footer.tpl'}
</body>
</html>
