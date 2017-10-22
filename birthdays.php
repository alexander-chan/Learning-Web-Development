#!/usr/local/bin/php

<?php 
	print '<?xml version = "1.0" encoding="utf-8"?>'; 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"> 
	<head> 
		<title>My First PHP Embedded Page</title> 
		<style>
			table {
				border:1px solid black;
				border-spacing:10px;
			}
			td th{
				padding:30px;
			}
		</style>
	</head> 
	<body> 
		<p> 
			<?php 
				date_default_timezone_set('America/Los_Angeles');			
				$year = 1995;
				$month = 5;
				$day = 10;
				$cur_time = $_SERVER['REQUEST_TIME'];
				$birthday  = mktime(0,0,0, $month, $day, $year);
				//echo date("M-d-Y" , $birthday), "<br/>";
				
				$cur_year = $birthday;
				
				echo "<h3> Paragraph Form </h3> ";
				for($i = 0; $i <= date("Y") - date("Y", $birthday); $i++){
					echo date("F jS Y", $cur_year), " was a ", date("l", $cur_year), "<br/>";
					$cur_year = mktime(0,0,0, date("m", $cur_year), date("d", $cur_year), date("Y", $cur_year) + 1);
				}

				$cur_year = $birthday;
				//Initialize Table
				echo "<h3> Table Form </h3> ";
				echo "<table>";
				echo " 
						<tr>
						    <th>Year</th>
						    <th>Day</th>

						</tr>
						
				";
				//Enter Table
				for($i = 0; $i <= date("Y") - date("Y", $birthday); $i++){
					echo "<tr>";
						echo "<td>";
							echo date("F jS Y", $cur_year); 
						echo "</td>";	
						echo "<td>";
							echo date("l", $cur_year);
						echo "</td>";
					echo "</tr>";

					$cur_year = mktime(0,0,0, date("m", $cur_year), date("d", $cur_year), date("Y", $cur_year) + 1);
				}
				echo "</table>";



				$cur_year = $birthday;
				//Initialize Table
				echo "<h3> Just for fun!! </h3> ";
				echo "<table>";
				echo " 
						<tr>
						    <th>Year</th>
						    <th>Day</th>

						</tr>
						
				";
				//Enter Table
				for($i = 0; $i <= 2040 - date("Y", $birthday); $i++){
					echo "<tr>";
						echo "<td>";
							echo date("F jS Y", $cur_year); 
						echo "</td>";	
						echo "<td>";
							echo date("l", $cur_year);
						echo "</td>";
					echo "</tr>";

					$cur_year = mktime(0,0,0, date("m", $cur_year), date("d", $cur_year), date("Y", $cur_year) + 1);
				}
				echo "</table>";
			?> 
			

			<h3> Reason </h3>
			<p> 
			When it hits 2038, it goes back to the Linux Epoch, Dec 31, 1969!
			The Unix Millennium Bug
			</p>


			<h3> Technical cause </h3>
			<p style="font-style:italic;"> 
				<a href="https://en.wikipedia.org/wiki/Year_2038_problem"> From Wikipedia </a> 
			</p>
			<p>
			The latest time that can be represented in Unix's signed 32-bit integer time format is 03:14:07 UTC on Tuesday, 19 January 2038 (2,147,483,647 seconds after 1 January 1970).[2] Times beyond that will wrap around and be stored internally as a negative number, which these systems will interpret as having occurred on 13 December 1901 rather than 19 January 2038. This is caused by integer overflow. The counter runs out of usable digit bits, flips the sign bit instead, and reports a maximally negative number (continuing to count up, toward zero). Resulting erroneous calculations on such systems are likely to cause problems for users and other relying parties.

			Programs that work with future dates will begin to run into problems sooner; for example a program that works with dates 20 years in the future will have to be fixed no later than 2018.

			</p>


		</p> 
	</body>
</html>
