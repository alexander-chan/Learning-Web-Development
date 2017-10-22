#!/usr/local/bin/php -d display_errors=STDOUT
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
$table = "votes";
$field1 = "yes";
$field2 = "no";


$sql= "CREATE TABLE IF NOT EXISTS $table (
$field1 int,
$field2 int
)";
$result = $db->query($sql);

/* Get the current value of the button that is checked */
$currentvote = $_GET["vote"];

/* Update the vote amount in the correct column depending on which button is checked */
if ($currentvote == "yes") {
$sql = "UPDATE $table SET $field1 = $field1 + 1";
}
else if ($currentvote == "no") {
$sql = "UPDATE $table SET $field2 = $field2 + 1";
}
    
$result = $db->query($sql);


$sql = "SELECT * FROM $table";
$result = $db->query($sql);

/* Print out the number of yes and no votes */
while($record = $result->fetchArray())
{  
 
    print $record[$field1];
    print ",";
    print $record[$field2];
 
}

?>