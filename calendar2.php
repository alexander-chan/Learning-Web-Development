#!/usr/local/bin/php -d display_errors=STDOUT
<?php 
	print '<?xml version = "1.0" encoding="utf-8"?>'; 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
<title>Calendar</title>
    <link rel="stylesheet" type="text/css" href="calendar2.css" />

</head>
<body>
<div class="container">

<img class="bro" src="http://pre05.deviantart.net/6c26/th/pre/f/2013/244/4/a/ucla_brony_logo_by_nsaiuvqart-d6k5q4j.png" alt = "UCLA FTW"  />
<?php 
	date_default_timezone_set('America/Los_Angeles'); 
    
    function get_hour_string($date_object){
        //$date is a date() object
        return(date("g:i a",$date_object));
    }
    
    function getPersonEvents($person, $timestamp){
            
        $database = "dbalexander255110.db";          

        try {     
             $db = new SQLite3($database);
        }
        catch (Exception $exception){
            echo '<p>There was an error connecting to the database!</p>';

            if ($db)
            {
                echo $exception->getMessage();
            }
        }
        
        $table = "event_table";
        $field1 = "time";
        $field2 = "person";
        $field3 = "event_title";
        $field4 = "event_message";

        $sql = "SELECT * FROM $table";
        $result = $db->query($sql);
        
        $event_string = "";
            while($record = $result->fetchArray()){  
                if ($record[$field2] == $person && $record[$field1] == $timestamp){
                       $event_string = "$event_string  $record[$field3]: $record[$field4] <br/>"; 
                }
            }
        return $event_string; 
        }
    
     $today = true; 
     $_12hours = 3600 * 12;
     $form_timestamp = $_POST["time_stamp"]; 
     
     if ($form_timestamp > 0){
        $today = false;
        echo "<h1>Bruin Family Schedule for " . date('D, M j, Y, g:i a', $form_timestamp) . "</h1>";
        $next = $form_timestamp + $_12hours;
        $prev = $form_timestamp - $_12hours; 
     } else { 
        $next = time() + $_12hours;
        $prev = time() - $_12hours;
     }
    
	echo "<table id='event_table'>
	      <tr><th>&nbsp;</th>
          <th class='table_header'>Snoop Dogg's Son</th>
          <th class='table_header'>Jim Mora</th>
          <th class='table_header'>Alford Clan</th></tr>";

    $hours_to_show = 12; 
    
    for ($i = 0; $i <= $hours_to_show; $i++){     
        if ($today){
            $timestamp = mktime(date("H") + $i, 0, 0, date("n"), date("j"), date("Y"));
        }
        else{
            $timestamp = mktime(date("H", $form_timestamp) + $i, 0, 0, date("n", $form_timestamp), date("j", $form_timestamp), date("Y", $form_timestamp));
        }
        
        if ($i % 2 == 0){
            echo "<tr class='even_row'>";
        }
        else{
            echo "<tr class='odd_row'>";
        }
        $date = get_hour_string($timestamp);
        echo "<td>" . $date . "</td>";
        
        echo "<td>" . getPersonEvents("Snoop Doggs Son", $timestamp)."</td>";
        echo "<td>" . getPersonEvents("Jim Mora", $timestamp) ."</td>";
        echo "<td>" . getPersonEvents("Alford Clan", $timestamp)."</td></tr>";
        
    }
   
    echo 
        "</table>
        <div>
    	<form id='prev' method='post' action='calendar2.php'>
        <p><input type='hidden' name='time_stamp' value='$prev' />
        <input type='submit' value='Previous twelve hours'/></p>
        </form> 
    
        <form id='today' method='post' action='calendar2.php'>
        <p><input type='submit' value='Today'/></p>
        </form>
     
        <form id='next' method='post' action='calendar2.php'>
        <p><input type='hidden' name='time_stamp' value='$next' />
        <input type='submit' value='Next twelve hours'/></p>
        </form>
        </div>";
    
?> 

</div>
    <p>
    <a href="http://validator.w3.org/check?uri=referer"><img
      src="http://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a>
  </p>
</body>
</html>