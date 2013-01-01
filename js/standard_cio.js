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
	oldClass = obj.className;
	obj.className = "highlight"+" "+obj.className;
	obj.style.cursor = "pointer";
	return true;
}

function Lowlight(obj) {
	obj.className = oldClass;
	return true;
}

function yousure(){
	if(!confirm("Really Refund Labels?\n\nThis will refund all outstanding labels associated with this order"))
		return false;
}

function onConfirm(text){
	if(!confirm(text))
		return false;
}

function mancloseout(){
	var filename = document.closeout.filename.value;
	var filetype = filename.substr(filename.length-3, 3).toLowerCase();
	if (filename == "")
	{
		alert("Please select a file for manual closeout.");
		return false;
	}
	else if (document.closeout.carrier.value == 0)
	{
		alert("Please select the carrier for this file.");
		return false;
	}
	else if (filetype != "csv" && filetype != "xls")
	{
		alert("This file must be in csv or xls format.");
		document.closeout.filename.value = "";
		return false;
	}
	return true;
}

function writeToTextBox(id, newText){
    var box = document.getElementById(id);
    box.value = newText;
}

function closeoutcarrier(){
	csv = document.closeout.filename.value;
	if (csv.toLowerCase().indexOf("fedex") != -1)
	{
		document.closeout.carrier.value = "FedEx";
	}
	else if (csv.toLowerCase().indexOf("ups") != -1)
	{
		document.closeout.carrier.value = "UPS";
	}
	else if (csv.toLowerCase().indexOf("cio") != -1)
	{
		document.closeout.carrier.value = "Any";
	}
}

function checkReportDay(){
	var select = document.getElementById("frequency");
	var day = document.getElementById("day");
	var freq = select.options[select.selectedIndex].value;
	if (freq != "monthly" && freq != "quarterly"){ // Then we don't need the Day selection box
		if (day.options[day.options.length-1].value != 0)
			day.options[day.options.length] = new Option("N/A", 0, true, true);
		else
			day.options[day.options.length-1].selected = true;
		day.disabled = true;
	}
	else{
		if (day.options[day.options.length-1].value == 0)
			day.options[day.options.length-1] = null;
		day.disabled = false;	
	}
	
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

function enable_numItems_change(){
	document.getElementById("multipleText").className = "hidden";
	document.getElementById("multipleText").setAttribute("className", "hidden");
	//document.multipleText.className = "hidden";
	//document.ScanForm.numItems.type = "text";
	//document.numText.className = "visible";
	document.getElementById("numText").className = "visible";
	document.getElementById("numText").setAttribute("className", "visible");
	document.getElementById("numBox").className = "visible";
	document.getElementById("numBox").setAttribute("className", "visible");
	document.ScanForm.numItems.focus();
}

function enable_addOverride(arrayCarriers, arrayValues, arrayNames){
	var el = document.getElementById('addOverrideDiv');
	el.className = "visible";
	el.setAttribute("className", "visible");
	document.getElementById('addOverride').style.visibility="hidden";
	
	change_carrier(arrayCarriers, arrayValues, arrayNames, false, false, true);
	
	var select = document.RatesForm.ShipMethod_0;
	select.focus();
}

function change_carrier(arrayCarriers, arrayValues, arrayNames, translation, lookup, skip2){
	if (translation == null) translation = false;
	if (lookup == null) lookup = false;
	if (skip2 == null) skip2 = false;
	if (translation){
		var select = document.TranslationForm.ship_method_code;
		var carrier = document.TranslationForm.carrier_code.value;
	}
	else if (lookup){
		var select = document.EditForm.ShipMethod;
		var carrier = document.EditForm.carrier.value;
	}
	else{
		var select = document.RatesForm.ShipMethod_0;
		var select2 = document.TestForm.ShipMethod_test;
		var carrier = document.RatesForm.Carrier.value;
	}
	
	// find the position of carrier
	var pos=0;
	for (pos=0; pos<arrayCarriers.length; pos++){
		if (arrayCarriers[pos] == carrier)
			break;
	}
	
	// wipe select options
	if (select.options)
		select.options.length = 0;
	if (select2 && select2.options && !skip2)
		select2.options.length = 0;
		
	// for each element in arrayValues[pos]
	for (var i=0; i<arrayValues[pos].length; i++){
		select.options[i] = new Option(arrayNames[pos][i], arrayValues[pos][i]);
		if (select2 && i > 0 && !skip2) // Skip first one for select2
			select2.options[i-1] = new Option(arrayNames[pos][i], arrayValues[pos][i]);
	}
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

// For admin_rates page
function calculate_rates(numOverrides){
	var baseCost = 0.00;
	var yourCost = 0.00;
	var processingCharge = 0;
	var shippingMarkup = 0;
	var insuranceMarkup = 0;
	var num1 = document.TestForm.TestShipping.value;
	var num2 = document.TestForm.TestInsurance.value;
	var shipMethod = document.TestForm.ShipMethod_test.value;
	var found = false;
	var i=0;
	while (found == false && i <= numOverrides){
		if (document.RatesForm['ShipMethod_'+i].value == shipMethod)
			found = true;
		i++;
	}
	if (found){
		i--;
		processingCharge = parseFloat(document.RatesForm['ProcessingCharge_'+i].value);
		shippingMarkup = parseFloat(document.RatesForm['MarkUp_'+i].value);
		insuranceMarkup = parseFloat(document.RatesForm['InsuranceMarkUp_'+i].value);
	}
	else{
		processingCharge = parseFloat(document.RatesForm['ProcessingCharge'].value);
		shippingMarkup = parseFloat(document.RatesForm['MarkUp'].value);
		insuranceMarkup = parseFloat(document.RatesForm['InsuranceMarkUp'].value);
	}
	if (!isNaN(num1) && !isNaN(num2)){
		var shipping = parseFloat(num1);
		var insurance = parseFloat(num2);
		baseCost = shipping + insurance;
		
		yourCost = shipping + (shipping*shippingMarkup/100) + processingCharge + insurance + (insurance*insuranceMarkup/100);
		document.getElementById('baseCost').innerHTML = roundNumber(baseCost, 2).toFixed(2);
		document.getElementById('yourCost').innerHTML = roundNumber(yourCost, 2).toFixed(2);
	}
}

function check_tblshipconf_add(count){
	var message = new Array();
	for(var i=0; i<count; i++){
		if(!isNumber(document.getElementById("weightLbs_"+i).value)){
			message.push("Package "+(i+1)+": Weight Lbs must be a number");
		}
		if(!isNumber(document.getElementById("weightOz_"+i).value)){
			message.push("Package "+(i+1)+": Weight Oz must be a number");
		}
		if(!isNumber(document.getElementById("package_"+i).value)){
			message.push("Package "+(i+1)+": Package Cost must be a number");
		}
		if(!isNumber(document.getElementById("insurance_"+i).value)){
			message.push("Package "+(i+1)+": Insurance Cost must be a number");
		}
		if(!isNumber(document.getElementById("insured_"+i).value)){
			message.push("Package "+(i+1)+": Insured Value must be a number");
		}
		if(!isNumber(document.getElementById("other_"+i).value)){
			message.push("Package "+(i+1)+": Other Costs must be a number");
		}
	}
	if (message.length > 0){
		alert(message.join("\n"));
		return false;
	}
	else{
		return true;
	}
}

function set_costoverride_id(id){
	document.RatesForm.deleteoverride_id.value = id;
	return true;
}

function change_box(id){
	document.getElementById("box"+id).className = "hidden";
	document.getElementById("box"+id).setAttribute("className", "hidden");
	document.getElementById("changeBox"+id).className = "visible";
	document.getElementById("changeBox"+id).setAttribute("className", "visible");
	//var field = document.getElementsByName("change_box_"+id);
	var field = getElementsByClass("change_box_"+id, 'input');
	field[0].focus();
}
function change_sn(id){
	document.getElementById("sn"+id).className = "hidden";
	document.getElementById("sn"+id).setAttribute("className", "hidden");
	document.getElementById("changeSn_"+id).className = "visible";
	document.getElementById("changeSn_"+id).setAttribute("className", "visible");
	var field = getElementsByClass("change_sn1_"+id, 'input');
	field[0].focus();
}
function change_sn2(id){
	document.getElementById("sn2"+id).className = "hidden";
	document.getElementById("sn2"+id).setAttribute("className", "hidden");
	document.getElementById("changeSn2_"+id).className = "visible";
	document.getElementById("changeSn2_"+id).setAttribute("className", "visible");
	var field = getElementsByClass("change_sn2_"+id, 'input');
	field[0].focus();
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

/* Play alert sound with ForrestGump java applet */
function play_alert(){
	document.getElementById('ForrestGump').playAlert();
}
