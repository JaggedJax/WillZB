<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>NZB Search Results</title>
{include file='headtag.tpl'}
<script type="text/javascript">
	var saved_id;
	function add_to_queue(base_url, nzbid){
		saved_id = nzbid;
		document.getElementById('addlink_'+nzbid).innerHTML = 'Please Wait...';
		MakeRequest('ajax.php?p=add_nzb_id&nzbid='+nzbid+'&base_url='+base_url, nzbid, '<b><i>', '</i></b>', null, 'added_to_queue', false);
	}
	
	function perform_search(){
		{for $count=0 to count($sitename)-1}
			MakeRequest('ajax.php?p=nzb_search&query={$query}&searchin={$searchin}&category={$category}'
				+'&sitename={$sitename[$count]}&siteurl={$siteurl[$count]}'
				+'&username={$username[$count]}&apikey={$apikey[$count]}'
				, '{$sitename[$count]}', null, null, 'search_results', null, false);
		{/for}
	}

	function added_to_queue(){
		var id = saved_id;
		var span = document.getElementById('addlink_'+id);
		var result = document.getElementById(id);
		if (result.innerHTML.indexOf("ERROR: ") != -1)
			span.innerHTML = "<a href=\"javascript:add_to_queue('"+id+"');\">Add To Queue</a>";
		else
			span.innerHTML = 'Successfully Added';
	}
</script>
</head>
<body onload="perform_search(); general_stats();">
<div id="dhtmltooltip"></div> <!-- For ddrive -->
<script type="text/javascript" src="js/ddrive.js"></script>
{include file='header.tpl'}
<div id='maincontent'>
	<h2>Search Results</h2>
	<span id="servermessage">{$message}</span>
	{for $count=0 to count($sitename)-1}
		<span id="{$sitename[$count]}"></span>&nbsp;&nbsp;&nbsp;&nbsp;
	{/for}
	<table class="browse" id="results_table" border="0">
	<tr class="head"><th class="image">Image</th><th>Details</th><th class="size">Size</th><th class="hits">Hits/Comm</th><th class="age">Age</th></tr>
	{foreach $results as $row}
	<tr class="row" onmouseover="Highlight(this)" onmouseout="Lowlight(this)">
		<td class="image" onmouseover="{if $row.IMAGE}ddrivetip('<img src=\'{$row.IMAGE}\'>', '#EFEFEF', {$row.IMGWIDTH});{/if}" onmouseout="{if $row.IMAGE}hideddrivetip();{/if}">
			{if $row.IMAGE}<img src="{$row.IMAGE}" width="90" height="130" border="0" alt="Image {$row.NZBID}">{else}<img src="images/no-image.jpg" border="0" alt="No image available">{/if}
		</td>
		<td valign="top">
			<b>{$row.NZBNAME}</b><br>
			> {$row.CATEGORY}<br>
			<b>Uploaded on:</b> {$row.USENET_DATE|date_format:"%m/%d/%Y %l:%M %p"}, {$row.USENET_AGE} (ago)<br>
			<b>Indexed on:</b> {$row.INDEX_DATE|date_format:"%m/%d/%Y %l:%M %p"}, {$row.INDEX_AGE} (ago)<br>
			<b>Size:</b> {$row.SIZE}<br>
			<b>Group:</b> <a href="{$row.SITE_URL}/browse?g={$row.GROUP}" target="_blank">{$row.GROUP}</a><br>
			<br>
			<span id='addlink_{$row.NZBID}'><a href="javascript:enable_div('break_{$row.NZBID}'); add_to_queue('{$row.SITE_URL}','{$row.NZBID}');">Add To Queue</a></span>&nbsp;&nbsp;|&nbsp;
			<a href="index.php?p=search_nzb&nzbid={$row.NZBID}&action=download&base_url={$row.SITE_URL}">Download NZB</a>&nbsp;&nbsp;|&nbsp;
			<a href="{$row.SITE_URL}/details/{$row.NZBID}" target="_blank">View on {$row.SITE_NAME}</a>
			<div id='break_{$row.NZBID}' class='hidden'>
				<span id='{$row.NZBID}'></span>
			</div>
		</td>
		<td class="size" align="center">{$row.SIZE}</td>
		<td class="hits" align="center">{$row.HITS}/
			<a href="{$row.SITE_URL}/details/{$row.NZBID}#comments" target="_blank">{$row.COMMENTS}</a>
		</td>
		<td class="age" align="center">{$row.INDEX_AGE}</td>
	</tr>
	{/foreach}
	</table>
	<br><br>
	<a href="index.php?p=search_nzb">Search again</a><br>
	{for $count=0 to count($sitename)-1}
		<div id="{$sitename[$count]}_error"></div>
	{/for}
</div>
{include file='footer.tpl'}
</body>
</html>
