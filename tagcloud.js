function frequencyTable(array){
	// Input: one sorted character array
	// Output: An array of 2, containing arrays
	// 		- 1 Array with unique character strings
	//      - 1 Array with the frequency of the unique strings in respective position.
	n = array.length;
	var unique = new Array;
	var freq = new Array;
	for(var i = 0; i < n; i++){
		if(unique.includes(array[i])){
			// if word is already in unique,
			// find index array[i] is in unique
			// increment frequency index by 1
			var ind = unique.findIndex(function(el){return el == array[i]});
			freq[ind]++;
		}
		else{
			// if word is not in unique
			// add to unique array
			// initialize freq in unique by 1
			unique.push(array[i]);
			freq[unique.length - 1] = 1;
		}
	}
	var output = [unique, freq];
	return(output);
}

function maxFreq(array){
	// finds max of numerical array
	return(array.reduce(function(a, b) {return Math.max(a, b)}));
}

function makeCloud(){
	var tags = document.getElementById("tags");
	var content = tags.value;
	var content_split = content.split(" ");
	var content_split_sort = content_split.sort();
	var freqOutput = frequencyTable(content_split_sort);
	var unique = freqOutput[0];
	var freq = freqOutput[1];
	var max = maxFreq(freq);

	// Make Div
	var Div = document.createElement('div');
	Div.id = "cloud";
	Div.style.borderWidth = "1em solid";
	Div.style.borderColor = "silver";
	Div.style.backgroundColor = "blue";
	Div.style.color = "silver";
	Div.style.fontFamily = "serif";
	Div.style.fontSize = "x-large";
	Div.style.zIndex = "1";
	
	//Make spans for each word
	for(var i = 0; i < unique.length; i++){
		var span = document.createElement('span');
		var size = Math.round((freq[i]/max)*20) + 15 + "pt";
		var textNode = document.createTextNode(unique[i]);
		var spaceNode = document.createTextNode(" ");
		span.style.fontSize = size;
		span.appendChild(textNode);
		
		span.onclick = function(num){
				return function(){alert(unique[num] + ": " + freq[num] + " occurences");
							};  }(i);
		
		Div.appendChild(span);
		Div.appendChild(spaceNode);

	}

	//document.body.appendChild(Div);
	var oldDiv = document.getElementsByTagName("div")[0];
	oldDiv.parentNode.replaceChild(Div, oldDiv);

}


function saveCloud(){
	var tags = document.getElementById("tags");
	document.cookie = tags.value;
}

function loadCloud(){
	// Load cloud from cookie
	var tags = document.getElementById("tags");
	var cookie_arr = document.cookie.split(";");
	var cookie_text = cookie_arr[0];
	tags.value = cookie_text;
}

function clearArea(){
	// erase contents from textarea
	var tags = document.getElementById("tags");
	tags.value = "";
}