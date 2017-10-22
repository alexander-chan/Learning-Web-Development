function init(){
	loadName();
}

function saveName(){
	var name = document.getElementById("name");
	document.cookie = name.value;
	return false;
}

function loadName(){
	var name = document.getElementById("name");
	var cookie_arr = document.cookie.split(";");
	var cookie_text = cookie_arr[0];
	name.value = cookie_text;
}

function process_form(){
	saveName(); //Saves name into cookie

	var query_string = "";
	var name_field = document.getElementById("name");
	var date_field = document.getElementById("date");
	var event_field = document.getElementById("event");
	var latlng_field = document.getElementById("latlng");
	query_string = "name=" + name_field.value + 
					"&date=" + date_field.value + 
					"&event=" + event_field.value + 
					"&latlng=" + latlng_field.value;
	do_ajax_stuff(query_string);
}

function display_result(result){
	//adds *new* points to map

	//parse result string
	var result_arr = result.split('=').join(',').split('&').join(',').split('(').join(',').split(')').join(',').split(",");
	/*
	alert("name is = " + result_arr[1] + " date is " + result_arr[3] 
		+ " event is " + result_arr[5] + " lat is " + result_arr[8] 
		+ " long is " + result_arr[9]);
	*/
	//create new DOM element with javascript
	var element = document.createElement("script");
	element.setAttribute("type", "text\javascript");

	//Set new dom Element based on result string
	element.innerHTML = L.marker([result_arr[8], result_arr[9]]).addTo(mymap)
		.bindPopup("<b>" + result_arr[5] +"</b><br/>User: " + 
			result_arr[1] + "     " + "Date: " + result_arr[3]).openPopup();

	//get body element, the append element to it.
	var body = document.getElementById("body");
	body.appendChild(element);
}	

function do_ajax_stuff(query_string) {
	window.xhr = new XMLHttpRequest();

	xhr.onreadystatechange = function () 
	{
		if (xhr.readyState == 4 && xhr.status == 200) 
		{
			var result = xhr.responseText;
			//alert("result string is: " + result);
			//result string is the html document, not sure if expected
			display_result(query_string);
		}
	}	

	//alert("query sting is: " + query_string);
	//display_result(query_string);
	xhr.open("GET", "www.pic.ucla.edu/~alexander255110/final_project/Leaflet/updateMapDatabase.php?" + query_string, true); 
	xhr.send(null);
}
