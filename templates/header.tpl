<div id="allcontent">
<div id="header">
	<div id="headertop">
		<img src="images/willzb_logo-sm.png" width="144" height="41" alt="Cio Remote" id="logo">
		<div id="loginform">
			<form action="index.php?p=login" method="post" name="logout">
				<span id="logoutspan"><input type="submit" name="logout" class="button" value="logout"></span>
				<span id="logoutspan_mobile" class="hidden"><input type="hidden" name="logout" value="logout"><a href="#" onclick="$(this).closest('form').submit()">Logout</a></span>
			</form>
			<span id="header_stats">
				Status: <br>
				Speed: 0.00 KB/s<br>
				Queue: 0.00/0.00 MB
				&nbsp;&nbsp;
			</span>
		</div>
	</div>
	&nbsp;
	<div id="mainmenu">
		<span id="nav1">
			<ul id="mainav">
				<li{if $smarty.session.maintab == "add_nzb"} class="active"{/if}><a href="index.php?p=search_nzb&tab=add_nzb">Add NZB's</a></li>
				<li{if $smarty.session.maintab == "monitor"} class="active"{/if}><a href="index.php?p=sabnzbd&tab=monitor">Monitor</a></li>
			{if $smarty.session.user_level > 1}
				<li{if $smarty.session.maintab == "settings"} class="active"{/if}><a href="index.php?p=users&tab=settings">Settings</a></li>
			{/if}
			</ul>
		</span><span id="nav_between">&nbsp;<font size=4><b> > </b></font>&nbsp;</span><span id="nav2">
			<ul id="subnav">
			{if $smarty.session.maintab == "add_nzb"}
				<li><a href="index.php?p=search_nzb">Search</a></li>
				<li><a href="index.php?p=add_nzb_manual">Add Manually</a></li>
			{elseif $smarty.session.maintab == "monitor"}
				<li><a href="index.php?p=sabnzbd">Monitor</a></li>
			{elseif $smarty.session.maintab == "settings"}
				<li><a href="index.php?p=users">Users</a></li>
				<li><a href="index.php?p=cpu">CPU</a></li>
				<li><a href="index.php?p=setup">Setup</a></li>
			{else}
				<li><a href="">Subnav 1: {$smarty.session.maintab}</a></li>
			{/if}
			</ul>
		</span>
	</div>
</div>
&nbsp;