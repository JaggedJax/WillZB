<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>SABnzbd Download Queue</title>
{include file='headtag.tpl'}
<script type="text/javascript">
	function move_queue(id, dropdown){
		document.getElementById('id').value = id;
		document.getElementById('pos').value = dropdown.options[dropdown.selectedIndex].value;
		document.getElementById('sabnzbd').submit();
	}
</script>
</head>
<body onload="general_stats();">
{include file='header.tpl'}
<div id='maincontent'>
	<h2>Download Queue</h2>
	<span id="servermessage">{$message}</span>
	<h3>Queue</h3>
	<div class="floatright">
		<a href="index.php?p=sabnzbd&{if $general.status == 'Paused'}resumeall{else}pauseall{/if}=1">{if $general.status == 'Paused'}Resume All{else}Pause All{/if}</a>
		<a href="#" onclick="swap_classes('pauseTime','hidden','visible'); return false;"><img src="images/bullet_arrow_down_{$osType}.png" border="0"></a>
		<div class="hidden indent" id="pauseTime">
			<a href="index.php?p=sabnzbd&pauseall=5">5 mins</a><br>
			<a href="index.php?p=sabnzbd&pauseall=15">15 mins</a><br>
			<a href="index.php?p=sabnzbd&pauseall=30">30 mins</a><br>
			<a href="index.php?p=sabnzbd&pauseall=60">1 hour</a><br>
			<a href="index.php?p=sabnzbd&pauseall=120">2 hours</a><br>
			<a href="index.php?p=sabnzbd&pauseall=180">3 hours</a><br>
			<a href="index.php?p=sabnzbd&pauseall=300">5 hours</a><br>
			<a href="#" onclick="var time=prompt('Please enter time to pause in minutes'); location.href='index.php?p=sabnzbd&pauseall='+time">Custom</a>
		</div>
	</div>
	<table class="browse pointer" border="0">
		<tr class="head" align="left"><th class="pos"></th><th class="filename">Name</th><th class="progress">Progress</th><th class="timeleft">Time Left</th><th class="size">Size</th><th class="pause"></th><th class="redx"></th></tr>
	<form action="index.php?p=sabnzbd&move=1" name="sabnzbd" id="sabnzbd" method="post">
	{foreach $queue as $row}
		<tr class="{cycle values='odd,'} row">
			<td onmouseover="Highlight(this)" onmouseout="Lowlight(this)" class="pos">{html_options name=newPos options=$posList selected=$row.index onchange="move_queue('{$row.nzo_id}', this);"}</td>
			<td class="filename">{$row.filename}</td>
			<td class="progress"><progress value="{$row.percent}" max="100" title="{$row.mbleft}/{$row.mb} MB"></progress></td>
			<td class="timeleft">{$row.timeleft}</td>
			<td class="size">{$row.size}</td>
			<td class="pause">
				<a href="index.php?p=sabnzbd&{if $row.status == 'Paused'}resume{else}pause{/if}={$row.nzo_id}"><img src="images/control_{if $row.status == 'Paused'}play{else}pause{/if}.png" border="0"></a>
			</td>
			<td align="center" valign="top" class="redx" title="Delete NZB File" onmouseover="Highlight(this)" onmouseout="Lowlight(this)" onclick="javascript:if(confirm('Really delete file \'{$row.filename}\'?')) location.href='index.php?p=sabnzbd&delete={$row.nzo_id}&mode=queue';"></td>
		</tr>
	{/foreach}
	</table>
	<input type="hidden" name="id" id="id">
	<input type="hidden" name="pos" id="pos" value="0">
	</form>
	<br><br>
	<h3>History</h3>
	<table class="browse"><tr><td>
	<table class="browse pointer" border="0">
	<tr class="head" align="left"><th class="plus"></th><th class="filename">Name</th><th class="size">Size</th><th class="status">Status</th><th class="redx"></th></tr>
	{foreach $history as $row}
		<tr valign="top" class="{cycle values='odd,'} row">
			<td class="plus"><a href="javascript:void(0)" onclick="enable_disable_div('{$row.nzo_id}')" onmouseover="Highlight(this)" onmouseout="Lowlight(this)"><b>+</b></a></td>
			<td>
				{$row.name}
				{if $row.fail_message}<br><font color="#ff0000">{$row.fail_message}</font> - <a href="index.php?p=sabnzbd&retry={$row.nzo_id}">Retry?</a>{/if}
				<div id='{$row.nzo_id}' class="hidden">
				<br> <!-- Download status messages -->
				{if $row.completed}
					Completed on: {$row.completed}<br>
				{/if}
				{foreach $row.log as $key=>$stage}
					<b>{$key}</b>
					<ul>
					{foreach $stage as $action}
						<li>{$action}</li>
					{/foreach}
					</ul>
				{/foreach}
				</div>
			</td>
			<td class="size">{$row.size}</td>
			<td class="status">{$row.status}</td>
			<td align="center" valign="top" class="redx" title="Delete NZB File" onmouseover="Highlight(this)" onmouseout="Lowlight(this)" onclick="javascript:if(confirm('Really delete file \'{$row.nzb_name}\'?')) location.href='index.php?p=sabnzbd&delete={$row.nzo_id}&mode=history';"></td>
		</tr>
	{/foreach}
	</table>
	</td></tr><tr><td align="center">
	Size: <b>{$general.total_size}</b> | This month: <b>{$general.month_size}</b> | This week: <b>{$general.week_size}</b>
	</td></tr></table>
	<br><br>
</div>
{include file='footer.tpl'}
</body>
</html>
