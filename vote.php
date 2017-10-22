#!/usr/local/bin/php -d display_errors=STDOUT
<?php
  print('<?xml version="1.0" encoding="utf-8"?>');
  print("\n");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
<title>Vote PHP</title> 
</head>
<body>
<p>
<?php 


$database = "ajax.db";          


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
$table = "vote";
$field1 = "yes";
$field2 = "no";


// Create the table
$sql= "CREATE TABLE IF NOT EXISTS $table (
$field1 int,
$field2 int,
)";
$result = $db->query($sql);

print "<h3>Creating the table</h3>";
print "<p>$sql</p>";


// Be sure you understand this code:
// print an XHTML table to display the current table
$sql = "SELECT * FROM $table";
$result = $db->query($sql);
$record = $result->fetchArray();
$numYes = $record[$field1];
$numNo = $record[$field2];


// Write code here to extract the name, SID and GPA from the $_GET data.

$yes = $_GET['yes_check'];
$no = $_GET['no_check'];

//  Insert a new record to your database with name = $name, sid = $SID and gpa = $GPA 
//  Create the $sql string that will accomplish this.
//  $sql = your string
if($yes = true){
  $numYes = $numYes + 1;
  $sql = "UPDATE vote SET = $numYes";
} else if ($no = true);{
  $numNo = $numNo + 1;
  $sql = "UPDATE vote SET no = $numNo";
}


print "The command I am using to update the db is:</br>";
print "$sql";
$result = $db->query($sql);

?>
</body>
</html>