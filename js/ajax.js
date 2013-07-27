/**
 * Functions to make ajax calls
 */

var api_results = { };

function getXMLHttp(){
	var xmlHttp;
	if('Microsoft Internet Explorer' == window.navigator.appName) {
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else{
		// Other browsers
		xmlHttp = new XMLHttpRequest();
	}
	return xmlHttp;
}

function MakeRequest(page, div, before, after, funcName, callNext, skipLoad){
	var xmlHttp = getXMLHttp();
	var result = '';
	console.log("API Call: "+ page);
	if (div != null && div != '' && skipLoad != true)
		document.getElementById(div).innerHTML = "<b>"+div+":</b> <img src='images/animationProcessing.gif' border='0'>";
	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4){
			if (funcName != null && funcName != ''){
				window[funcName](xmlHttp.responseText);
			}
			else
				HandleResponse(xmlHttp.responseText, div, before, after, callNext);
		}
	}
	xmlHttp.open("GET", page, true); 
	xmlHttp.send(null);
}

function HandleResponse(response, div, before, after, callNext){
	document.getElementById(div).innerHTML = before+response+after;
	if (callNext != null && callNext != ''){
		window[callNext]();
	}
}

function general_stats(){
	MakeRequest('ajax.php?p=general_stats', 'header_stats', '', '&nbsp;&nbsp;', null, null, true);
	window.setInterval(function(){
		MakeRequest('ajax.php?p=general_stats', 'header_stats', '', '&nbsp;&nbsp;', null, null, true);
	}, 10000); // Call every 10 seconds
}

function search_results(response){
	try{
		var result = JSON.parse(response);
	}catch(e){
		console.log("Error getting search results: "+e.message+"\n"+response);
    }
	if (result){
		var table=document.getElementById("results_table");
		for (var c in result) {
			if (api_results[result[c].NZBNAME+'__'+result[c].USENET_DATE_NOHOUR+'__'+result[c].GROUP+'__'+result[c].CATEGORY]){
				// Item already found
				console.log('Already found: '+result[c].NZBNAME+'__'+result[c].USENET_DATE_NOHOUR+'__'+result[c].GROUP+'__'+result[c].CATEGORY);
				multiple_span = document.getElementById(api_results[result[c].NZBNAME+'__'+result[c].USENET_DATE_NOHOUR+'__'+result[c].GROUP+'__'+result[c].CATEGORY]);
				multiple_span.innerHTML = '- Duplicate results hidden -';
			}
			
			else if (result.hasOwnProperty(c) && c != 'sitename' && c != 'message') {
				// Mark as found
				var multiples_id = 'found_'+result[c].NZBID;
				api_results[result[c].NZBNAME+'__'+result[c].USENET_DATE_NOHOUR+'__'+result[c].GROUP+'__'+result[c].CATEGORY] = multiples_id;
				
				var col1 = "";
				if (result[c].IMAGE){
					col1 = '<img src="'+ result[c].IMAGE +'" width="90" height="130" border="0" alt="Image '+ result[c].NZBID +'">';
				}
				else{
					col1 = '<img src="images/no-image.jpg" border="0" alt="No image available">';
				}
				
				var col2 = "<b>"+result[c].NZBNAME+"</b><br>"
					+"> "+result[c].CATEGORY+"<br>"
					+"<b>Uploaded on:</b> "+result[c].USENET_DATE_FORMATTED+", "+result[c].USENET_AGE+" (ago)<br>"
					+"<b>Indexed on:</b> "+result[c].INDEX_DATE_FORMATTED+", "+result[c].INDEX_AGE+" (ago)<br>"
					+"<b>Size:</b> "+result[c].SIZE+"<br>"
					+"<b>Group:</b> <a href='"+result[c].SITE_URL+"/browse?g="+result[c].GROUP+"' target='_blank'>"+result[c].GROUP+"</a><br>"
					+"<div class='indent clearboth' id='"+multiples_id+"'>&nbsp;</div>"
					+"<span id='addlink_"+result[c].NZBID+"'><a href=\"javascript:enable_div('break_"+result[c].NZBID+"'); add_to_queue('"+result[c].SITE_URL+"','"+result[c].NZBID+"');\">Add To Queue</a></span>&nbsp;&nbsp;|&nbsp;"
					+"<a href='index.php?p=search_nzb&nzbid="+result[c].NZBID+"&action=download&base_url="+result[c].SITE_URL+"'>Download NZB</a>&nbsp;&nbsp;|&nbsp;"
					+"<a href='"+result[c].SITE_URL+"/details/"+result[c].NZBID+"' target='_blank'>View on "+result[c].SITE_NAME+"</a>"
					+"<div id='break_"+result[c].NZBID+"' class='hidden'>"
						+"<span id='"+result[c].NZBID+"'></span>"
					+"</div>";
				
				var col3 = result[c].SIZE;
				
				var col4 = result[c].HITS+'/<a href="'+ result[c].SITE_URL +'/details/'+ result[c].NZBID +'#comments" target="_blank">'+ result[c].COMMENTS +'</a>';
				
				var col5 = result[c].INDEX_AGE;
				
				var row=table.insertRow(-1);
				row.setAttribute("onmouseover","Highlight(this)");
				row.setAttribute("onmouseout","Lowlight(this)");
				
				var cell1=row.insertCell(0);
				var cell2=row.insertCell(1);
				var cell3=row.insertCell(2);
				var cell4=row.insertCell(3);
				var cell5=row.insertCell(4);
				cell1.innerHTML=col1;
				//cell1.setAttribute();
				cell1.setAttribute("class","image");
				cell2.innerHTML=col2;
				cell2.setAttribute("valign","top");
				cell3.innerHTML=col3;
				cell3.setAttribute("align","center");
				cell3.setAttribute("class","size");
				cell4.innerHTML=col4;
				cell4.setAttribute("align","center");
				cell4.setAttribute("class","hits");
				cell5.innerHTML=col5;
				cell5.setAttribute("align","center");
				cell5.setAttribute("class","age");
			}
			
		}
		if (result.message){
			console.log("error message: "+result.message);
			document.getElementById(result.sitename+'_error').innerHTML = '<b>'+result.sitename+' Error:</b> '+result.message;
			document.getElementById(result.sitename).innerHTML = '<b>'+result.sitename+':</b> Error';
		}
		else if(result.sitename){
			document.getElementById(result.sitename).innerHTML = '<b>'+result.sitename+':</b> Complete';
		}
	}
}
