#!/usr/local/bin/php -d display_errors=STDOUT
<?php

$password = "PW1234";
$username = "yourlogin";
$database = "dbyourlogin";
$hostname = "laguna.pic.ucla.edu";
$table = "vote_table";

$yes_no = $_GET['vote'];

$field1 = "yes";
$field2 = "no";
$field3 = "question";

$db = mysql_connect($hostname, $username, $password); 
mysql_select_db($database,$db);

$sql = "select * from $table";
$result = mysql_query($sql);

$record = mysql_fetch_array($result);

$yes = $record[$field1];
$no = $record[$field2];
$question = $record[$field3];

if ($yes_no == "yes")
  $yes++;
else
  $no++;

$sql = "update $table set $field1=$yes, $field2=$no";

$result = mysql_query($sql);

print "$yes,$no";
