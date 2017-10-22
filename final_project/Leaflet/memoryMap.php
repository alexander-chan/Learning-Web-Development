#!/usr/local/bin/php -d display_errors=STDOUT
<?php
  // begin this XHTML page
  print('<?xml version="1.0" encoding="utf-8"?>');
  print("\n");
?>

<!DOCTYPE html>
<html>
<head>
	<title>My UCLA Memories</title>
	<!-- Leaflet Template Code -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" integrity="sha512-07I2e+7D8p6he1SIM+1twR5TIrhUQn9+I6yjqD53JQjFiMf8EtC93ty0/5vJTZGF8aAocvHYNEDJajGdNx1IsQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js" integrity="sha512-A7vV8IFfih/D732iSSKi20u/ooOfj/AGehOKq0f4vLT1Zr2Y+RX7C+w8A1gaSasGtRUZpF/NZgzSAu4/Gc41Lg==" crossorigin=""></script>
	<!-- Leaflet Template Code End -->

    <link rel="stylesheet" href="my_leaflet.css" />
</head>


<body id="body" onload = "init()">

<!-- Cookie Functions --> 
<script type="text/javascript" src="memories.js"> </script>


<!-- //////////// SIDEBAR //////////// -->
<div id="sidebar">
	<h1> My UCLA Memories </h1>
	<div class="stylized">	
<form class="stylized" id="form1" action='updateMapDatabase.php' method="post">
<fieldset>
	<legend>Add a Memory</legend>	
<table>
	<tr>
		<td><label for="name">Your Name</label></td>
		<td> <input type="name" name="name" id="name" value=""/></td>
	</tr>
	<tr> <td > Enter Date in MM-DD-YYYY  </td></tr>
	<tr>
		<td><label for="date">Date</label></td>
		<td><input type="text" name="date" id="date" value=""/></td>
	</tr>
	<tr>
		<td><label for="event">Event</label></td>
		<td><input class="stylized" type="text" id="event" name="event" value=""/></td>
	</tr>
	<tr>
		<td><label for="latlng">Lat, Long</label></td><td><input type="text" name="latlng" id="latlng"/></td>
	</tr>
</table>
	
	<input type="button" value="Create Memory" onclick="process_form()"/>
</fieldset>
</form>

</div>
</div>


<!-- //////////// Map //////////// -->

<div id="mapid" ></div>
<script type="text/javascript" src="map.js">
</script>
<script type="text/javascript">
L.marker([34.07061, -118.44661]).addTo(mymap)
		.bindPopup("<b>UCLA!</b><br />").openPopup();
</script>
</body>


<!-- Load Database -->
<?php
	function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
	}

	
	function createLeafletPopup($name, $date, $event, $lat, $lon){
    echo ("<script type='text/javascript'>".'
	//get body element
    var body = document.getElementById("body");

    //create new DOM element with javascript
	var element = document.createElement("script");
	element.setAttribute("type", "text\javascript");

	//Set new dom Element based on result string
	element.innerHTML = L.marker(['.$lat.','. $lon.']).addTo(mymap).bindPopup("<b>  '.$event.' </b><br/>User:   '.$name.'        Date:   '.$date.'");

	 // append element to body element.
	body.appendChild(element);</script>');
	}
	
	


	$database = "memoryMap.db";
	try  
	{     
	     $db = new SQLite3($database);
	}
	catch (Exception $exception)
	{
	    echo '<p>There was an error connecting to the database!</p>';

	    if ($db)
	    {
	        echo $exception->getMessage();
	    }
	        
	}
	$table = "map_table";
	$field1 = "name";
	$field2 = "date";
	$field3 = "event";
	$field4 = "latlng";

	$sql = "SELECT * FROM $table";
	$result  = $db->query($sql);
	while($record = $result->fetchArray())
	{  
	  //alert( "$record[$field1]. $record[$field2]. $record[$field3].$record[$field4]");
		$string = "$record[$field4]";
		$pattern = "/[(,)]/";
		$result_array = preg_split($pattern, $string);

		$name = $record[$field1];
		$date = $record[$field2];
		$event = $record[$field3];
		$lat = $result_array[1];
		$lon = $result_array[2];
		createLeafletPopup($name, $date, $event, $lat, $lon);
	}
?>

</html>
