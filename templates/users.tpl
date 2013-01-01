<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Users</title>
{include file='headtag.tpl'}
</head>
<body onload="general_stats();">
{include file='header.tpl'}
<div id='maincontent'>
	{if $mode == "browse"}
		<h2>Browse User Accounts</h2>
		<table class="browse" border="0">
		<tr class="head" align="left"><th>Name</th><th></th></tr>
		{foreach $users as $row}
			<tr class="{cycle values='odd,'} row" onmouseover="Highlight(this)" onmouseout="Lowlight(this)">
				<td class="cursor" onclick="document.location.href='index.php?p=users&name={$row}'">{$row}</td>
				<td align="center" valign="top" class="redx" title="Delete user {$row}" onmouseover="Highlight(this)" onmouseout="Lowlight(this)" onclick="javascript:if(confirm('Really delete user \'{$row}\'?')) location.href='index.php?p=users&delete={$row}';"></td>
			</tr>
		{/foreach}
		</table>
		<br><br>
		<button onClick="window.location='index.php?p=users&newUser=1'">New User</button>
	{else}
		<h2>{if $mode == "edit"}Edit User: {$user.name}{else}Add User{/if}</h2>
		<span id="servermessage">{$message}</span>
		<div id="general">
		<form action="index.php?p=users" method="post">
		<input type="hidden" name="id" value="{$user_id}">
		<table>
		{if $mode == "add"}
		<tr><td>Username:</td><td><input type="text" name="username" value="{$details.name}" size="20" maxlength="20"></td></tr>
		<tr><td>Password:</td><td><input type="password" name="password" size="20" maxlength="20"></td></tr>
		{else}
		<tr><td>New Password:</td><td><input type="password" name="password" size="20" maxlength="20"> (leave blank to keep existing password)
		<input type="hidden" name="username" value="{$details.name}">
		</td></tr>
		{/if}
		<tr><td>User Level:</td><td>{html_options name="user_level" options=$userLevels selected=$details.user_level}</td></tr>
		</table>
		{if $mode == "edit"}
			<input type="submit" name="action" value="save">
			<input type="submit" name="action" value="delete" onclick="return confirm('Are you sure you want to delete this user?')">
		{else}
			<input type="submit" name="action" value="add">
		{/if}
		<input type="submit" name="action" value="cancel">
		</form>
		</div>
	{/if}
	<br><br>
</div>
{include file='footer.tpl'}
</body>
</html>
