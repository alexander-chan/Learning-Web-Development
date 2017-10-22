#!/usr/local/bin/php -d display_errors=STDOUT
<?php
  // begin this XHTML page
  print('<?xml version="1.0" encoding="utf-8"?>');
  print("\n");
?>
<?php header('Access-Control-Allow-Origin: *'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
<title>Update Database for Memory Map</title> 
</head>
<body>
<p>
<?php 

date_default_timezone_set('America/Los_Angeles'); 
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


// define tablename and field names for a SQLite3 query to create a table in a database
$table = "map_table";
$field1 = "name";
$field2 = "date";
$field3 = "event";
$field4 = "latlng";


// Create the table if not exists
$sql= "CREATE TABLE IF NOT EXISTS $table (
$field1 varchar(100),
$field2 varchar(100),
$field3 varchar(300),
$field4 varchar(300)
)";
$result = $db->query($sql);


// Code to extract fields from the $_POST data.

$name = "\"".(string)$_GET['name']."\"";
$date = "\"".(string)$_GET['date']."\"";
$event = "\"".(string)$_GET['event']."\"";
$latlng  = "\"".(string)$_GET['latlng']."\"";

//Turn date and time to UNIX timestamp
//$date_arr = explode("-", $date);
//$timestamp = mktime(0, 0, 0, $date_arr[0], $date_arr[1], $date_arr[2] );


//Create the $sql string that will accomplish this.
 // $sql = your string

$sql = "INSERT INTO $table ($field1, $field2, $field3, $field4) VALUES ($name, $date, $event, $latlng)";

print "Inserting a new record to the $table table the command I am using is:</br>";
print "$sql";
$result = $db->query($sql);

print "</table>\n";
?>
</body>
</html>
