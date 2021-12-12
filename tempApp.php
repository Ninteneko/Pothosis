<meta http-equiv="refresh" content="5">

<?php

$value = file_get_contents("data.txt");
$temp = file_get_contents("humidity.txt");

$temperature = substr($temp, 15, 5);
$humid = substr($temp, 35, 5);
$faren = $temperature * 9/5 + 32;

date_default_timezone_set('America/Los_Angeles');
$time = date("h:i:sa");

if ($humid < 50 || $humid > 60){
	$color="#B8390E";
	} else {
		$color="green";
	}

if ($value <= 40 || $value > 50){
	$valColor="#E1C340";
	} elseif($value < 20 || $value > 60){
		$valColor='#B8390E';

	} else{
		$valColor="green";
	}

if ($faren < 50 || $faren > 80){
	$farenColor = "#B8390E";
	}else{
		$farenColor="green";
	}

print "<body style='background-color:#B2D2A4;' 'text-align:center>'";

print "<h2 style='text-align:center;'> $time </h2>";
print "<h1 style='text-align:center;'>Current Moisture Percentage</h1>";
print "<div style='text-align:center; font-size:15px'> the majority of plants thrive in soil with a moisture level that ranges between 20% and 60%. </div>";
print "<p style='text-align:center; font-size:170px; margin-top:5px; margin-bottom:5px; color:".$valColor.";'>".$value."</p>";

print "<h1 style='text-align:center;'> Current Temperature (F)</h1>";
print "<div style='text-align:center; font-size:15px;'> The best temperature range for indoor plants is 70 degrees F – 80 degrees F day and 65 degrees F – 70 degrees F night. </div>";
print "<p style='text-align:center; font-size:170px; margin-top:5px; margin-bottom:5px; color:".$farenColor.";'>".$faren."</p>";

print "<h1 style='text-align:center;'> Current Humidity </h1>";
print "<div style='text-align:center; font-size:15px'> keep the humidity for most tropical indoor plants at 50-60% humidity </div>";
print "<p style='text-align:center; font-size:170px; margin-top:5px; margin-bottom:5px; color:".$color.";'>".$humid."</p>";
print "</body>"
?>
