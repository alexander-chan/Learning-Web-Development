#!/usr/local/bin/php -d display_errors=STDOUT
<?php 
	print '<?xml version = "1.0" encoding="utf-8"?>'; 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<title>Calendar</title> 

<link rel="stylesheet" type="text/css" href="calendar.css" />

</head>
<body>

<div class="container">
<img class="bro" src="http://pre05.deviantart.net/6c26/th/pre/f/2013/244/4/a/ucla_brony_logo_by_nsaiuvqart-d6k5q4j.png" alt = "UCLA FTW"  />
<h1>Bruin Family Schedule for 
<?php 
date_default_timezone_set('America/Los_Angeles');
echo date("D, M j, Y, g:i a");
?> </h1>
<table id="event_table">


	<tr> 
		<th class='hr_td_'> &nbsp; </th> 
		<th class='table_header'>Snoop Dogg's Son</th>
		<th class='table_header'>Jim Mora</th>
		<th class='table_header'>The Alford Clan</th> 
	</tr> 

<?php
	date_default_timezone_set('America/Los_Angeles');	
	$hours_to_show = 12;
	$even = true; 
	$cur_hour = date("H");
	function get_hour_string($date_object){
		//$date is a date() object
		return(date("g:i a",$date_object));
	}

	for($i = 0; $i <= $hours_to_show; $i++){
		//if($even){
		if($i % 2 == 0){
			echo "<tr class='even_row'> ";
		} else {
			echo "<tr class='odd_row'> ";
		}
		$hour = mktime(date("H") + $i, 0, 0, date("n"), date("j"), date("Y"));
		//echo "date("H", $hour)";
		echo "<td class='hr_td'> ".date("g:i a", $hour)." </td> <td> </td> <td> </td> <td></td> </tr>";
		//echo "<td class='hr_td'> ".get_hour_string($hour)." </td> <td> </td> <td> </td> <td></td> </tr>";
		$even = !$even;
	}

?>
	
</table>


</div>

<p>
    <a href="http://validator.w3.org/check?uri=referer"><img
      src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
  </p>
</body>
</html>

