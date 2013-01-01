<!-- Header details for all pages -->
<link href="css/base.css" rel="Stylesheet" id="base" type="text/css">
<link href="css/{$osType}.css" rel="Stylesheet" id="Stylesheet" type="text/css" title="OSSheet">
{if $osType != "handheld" && $osType != "desktop"}<meta name="viewport" content="width=device-width; initial-scale=1.0;"/>{/if}
<script type="text/javascript" src="js/jquery-min.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/json2.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
{if $osType != "desktop"}
{/if}
<script type="text/javascript">
	var nav1 = "{$smarty.session.maintab}";
	var nav2 = "{$p}";
	
	{if $osType != "desktop"}
	// Listen for orientation Change
	function changeMenuLayout(){
		//if (!isNumber(window.width)) setTimeout(changeMenuLayout, 200);
		var ratio = window.devicePixelRatio;
		var width = window.innerWidth / ratio; //screen.width
		var height = window.innerHeight / ratio; //screen.height
		//alert(width+' x '+height);
		if (width >= 600){
			// Large screen detected
			document.getElementById('Stylesheet').href = 'css/tablet.css';
			disable_div('pagenav_main');
			disable_div('pagenav_sub');
			disable_div('logoutspan_mobile');
			enable_divs(getElementsByClass('mobile_hide', 'div'));
			enable_divs(getElementsByClass('mobile_hide', 'span'));
			enable_div('mainav');
			enable_div('subnav');
			enable_div('logoutspan');
			disable_divs(getElementsByClass('mobile_show', 'div'));
			disable_divs(getElementsByClass('mobile_show', 'span'));
			return 'tablet';
		}
		else{
			// Small screen detected
			document.getElementById('Stylesheet').href = 'css/handheld.css';
			disable_div('mainav');
			disable_div('subnav');
			disable_div('logoutspan');
			enable_divs(getElementsByClass('mobile_show', 'div'));
			enable_divs(getElementsByClass('mobile_show', 'span'));
			enable_div('pagenav_main');
			enable_div('pagenav_sub');
			enable_div('logoutspan_mobile');
			disable_divs(getElementsByClass('mobile_hide', 'div'));
			disable_divs(getElementsByClass('mobile_hide', 'span'));
			return 'handheld';
		}
	}
	
	function screen_change(){
		logo_size(changeMenuLayout());
	}
	
	function logo_size(type){
		var img = document.getElementById('logo');
		if (type == 'tablet'){
			img.style.width = '144px';
			img.style.height = '41px';
		}
		else if (type == 'handheld'){
			img.style.width = '72px';
			img.style.height = '20px';
		}
	}
	
	var supportsOrientationChange = "onorientationchange" in window,
		orientationEvent = supportsOrientationChange ? "orientationchange" : "resize";
		
	window.addEventListener(orientationEvent, screen_change, false);

	$(document).ready(function(){
		screen_change();
	});
	
	screen_change();
	{else}
	$(document).ready(function(){
		enable_divs(getElementsByClass('mobile_hide', 'div'));
		enable_divs(getElementsByClass('mobile_hide', 'span'));
		disable_divs(getElementsByClass('mobile_show', 'div'));
		disable_divs(getElementsByClass('mobile_show', 'span'));
	});
	{/if}
</script>