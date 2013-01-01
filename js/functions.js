var oldClass;
var loadCount = 0;

// Convert menu to dropdown if window too small
$(function() {
	// Begin dropdown
	$("<select id=\"pagenav_main\" class=\"dropnav hidden\"/>").appendTo("#nav1");
	$("<select id=\"pagenav_sub\" class=\"dropnav hidden\"/>").appendTo("#nav2");
	
	// Populate dropdowns
	// select nav1 and nav2 from list as defaults
	$("#nav1 a").each(function() {
		var el = $(this);
		if (nav1 == el.text().toLowerCase()){
			$("<option />", {
				"selected": "selected",
				"value"   : el.attr("href"),
				"text"    : el.text()
			}).appendTo("#nav1 select");
		}
		else{
			$("<option />", {
				"value"   : el.attr("href"),
				"text"    : el.text()
			}).appendTo("#nav1 select");
		}
	});
	$("#nav2 a").each(function() {
		var el = $(this);
		if (el.attr("href").indexOf(nav2) != -1){
			$("<option />", {
				"selected": "selected",
				"value"   : el.attr("href"),
				"text"    : el.text()
			}).appendTo("#nav2 select");
		}
		else{
			$("<option />", {
				"value"   : el.attr("href"),
				"text"    : el.text()
			}).appendTo("#nav2 select");
		}
	});
	
	// Make dropdown actually work
	$("#nav1 select").change(function() {
		window.location = $(this).find("option:selected").val();
	});
	$("#nav2 select").change(function() {
		window.location = $(this).find("option:selected").val();
	});
});

// Is given input a number (int or float)? Boolean result. True if yes.
function isNumber(n) {
	return !isNaN(parseFloat(n)) && isFinite(n);
}

// Round number to d decimal places
function roundNumber(num, d) {
	if (d == 0)
		return Math.round(num);
	return Math.round(num*Math.pow(10,d))/Math.pow(10,d);
}

function rand_string(length) {
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var randomstring = '';
	for (var i=0; i<length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	return randomstring;
}

function Highlight(obj, class2) { //class2 only kept because some template files still pass it. Not needed though.
	AddClassName(obj, "highlight", true);
	obj.style.cursor = "pointer";
	return true;
}

function Lowlight(obj) {
	RemoveClassName(obj, "highlight");
	return true;
}

function onConfirm(text){
	if(!confirm(text))
		return false;
}

function writeToTextBox(id, newText){
    var box = document.getElementById(id);
    box.value = newText;
}

function getElementsByClass(searchClass, tagName) {
	if (tagName == null)
		tagName = '*';
	var el = new Array();
	var tags = document.getElementsByTagName(tagName);
	var tcl = " "+searchClass+" ";
	for(i=0; i<tags.length; i++) {
		var test = " " + tags[i].getAttribute("name") + " ";
		if (test.indexOf(tcl) != -1)
			el.push(tags[i]);
	}
	return el;
}

function change_div(name, changeTo){
	div = document.getElementById(name);
	if (changeTo == null)
		changeTo = "visible";
	div.className = changeTo;
	div.setAttribute("className", changeTo);
}

function change_divs(divs, changeTo){
	var i=0;
	if (changeTo == null)
		changeTo = "visible";
	for (i=0; i<divs.length; i++){
		divs[i].className = changeTo;
		divs[i].setAttribute("className", changeTo);
	}
}

function enable_divs(divs){
	var i=0;
	for (i=0; i<divs.length; i++){
		RemoveClassName(divs[i], "hidden");
		AddClassName(divs[i], "visible", true);
	}
}

function disable_divs(divs){
	var i=0;
	for (i=0; i<divs.length; i++){
		RemoveClassName(divs[i], "visible");
		AddClassName(divs[i], "hidden", true);
	}
}

function change_divs_by_id(names, changeTo){
	var i=0;
	if (changeTo == null)
		changeTo = "visible";
	for (i=0; i<names.length; i++){
		div = document.getElementById(names[i]);
		div.className = changeTo;
		div.setAttribute("className", changeTo);
	}
}

function enable_div(id){
	var div_node = document.getElementById(id);
	RemoveClassName(div_node, "hidden");
	AddClassName(div_node, "visible", true);
}

function disable_div(id){
	var div_node = document.getElementById(id);
	RemoveClassName(div_node, "visible");
	AddClassName(div_node, "hidden", true);
}

function enable_disable_div(id){
	swap_classes(id, "hidden", "visible");
}

function swap_classes(id, class1, class2){
	var div_node = document.getElementById(id);
	
	if (HasClassName(div_node, class1)){
		RemoveClassName(div_node, class1);
		AddClassName(div_node, class2, false);
	}
	else{
		RemoveClassName(div_node, class2);
		AddClassName(div_node, class1, false);
	}
}

function HasClassName(objElement, strClass){
	if ( objElement && objElement.className ){
		var arrList = objElement.className.split(' ');
		var strClassUpper = strClass.toUpperCase();
		for ( var i = 0; i < arrList.length; i++ ){
			if ( arrList[i].toUpperCase() == strClassUpper ){
				return true;
			}
		}
	}
	return false;
}

function AddClassName(objElement, strClass, blnMayAlreadyExist){
	if (objElement && objElement.className ){
		var arrList = objElement.className.split(' ');
		if ( blnMayAlreadyExist ){
			var strClassUpper = strClass.toUpperCase();
			for ( var i = 0; i < arrList.length; i++ ){
				if ( arrList[i].toUpperCase() == strClassUpper ){
					arrList.splice(i, 1);
					i--;
				}
			}
		}
		arrList[arrList.length] = strClass;
		objElement.className = arrList.join(' ');
	}
	else if(objElement){
		objElement.className = strClass;
	}
}

function RemoveClassName(objElement, strClass){
	if (objElement && objElement.className ){
		var arrList = objElement.className.split(' ');
		var strClassUpper = strClass.toUpperCase();
		for ( var i = 0; i < arrList.length; i++ ){
			if ( arrList[i].toUpperCase() == strClassUpper ){
				arrList.splice(i, 1);
				i--;
			}
		}
		objElement.className = arrList.join(' ');
	}
}

/**
 * return if a checkbox given by id is checked or not as a boolean.
*/
function is_checked(id){
	return document.getElementById(id).checked;
	if (checkbox){
		return checkbox.checked;
	}
	return false;
}

// Select and highlight input field text
function SelectForm(id, num)
{
	if (!num)
		num = 0;
	var field = document.getElementsByName(id);
    field[num].focus();
    field[num].select();
}

// Select value v of dropdown menu s
function setSelectedIndex(s, v) {
    for ( var i = 0; i < s.options.length; i++ ) {
        if ( s.options[i].value == v ) {
            s.options[i].selected = true;
            return;
        }
    }
}

// focus an element by name (first one by default)
function focus_element_by_name(element_name){
	document.getElementsByName(element_name)[0].focus();
}

function add_option(selectbox, text, value, select) {
	var option = document.createElement("OPTION");
	option.text = text;
	option.value = value;
	option.selected = select;
	selectbox.options.add(option);
}

function resizeFrame(name, name2, name3) {
	var f = document.getElementById('childframe');
	loadCount++;
	if (loadCount == 2){
		//disable_div(name);
		f.style.height = "200px";
		disable_div(name2);
		enable_div(name3);
		document.Express1.submit();
		loadCount = 0;
	}
}

function loadinparent(url, closeSelf){
	self.opener.location = url;
	if(closeSelf) self.close();
}
function loadinparentIE(url, closeSelf){
	parent.location.href = url;
	if(closeSelf) self.close();
}

function popupPage(page, key, value, name, width, height){
	var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
	wi = window.open('index.php?p=' + page + '&' + key + '=' + value, name, 'width=' + width + ',height=' + height + ',menubar=0,status=0,toolbar=0,resizable');
	if (is_chrome)
		wi.parent.blur();
	wi.focus();
	return false;
}

function addInput(divName, type, inputName, value){
	if (value == null)
		value = "";
	var newdiv = document.createElement('div');
	newdiv.innerHTML = "<input type='"+type+"' name='"+inputName+"' value='"+value+"'>";
	document.getElementById(divName).appendChild(newdiv);
}

function get_url_parameter(param){
	param = param.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	var r1 = "[\\?&]"+param+"=([^&#]*)";
	var r2 = new RegExp( r1 );
	var r3 = r2.exec( window.location.href );
	if( r3 == null )
		return "";
	else
		return r3[1];
}

function setCookie(c_name, value, exdays){
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}

function change_tab(pagenav, tabs, tab){
	change_divs_by_id(tabs['tab_pagenav'][tab-1], 'inactive');
	change_div(tab, 'active');
	change_divs_by_id(tabs['div_pagenav'][tab-1], 'hidden');
	enable_div('pagenav_'+tab);
	setCookie(pagenav, tab);
}