<?php

// Access provided by database configuration file
require_once 'config.php';

// Create connection to MySQL Database
$con = new mysqli($servername, $username, $password, $dbname);

// Check for sucessful connection
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

// Create request for average daily temperature for the past 30 days 
$dailyaveragerequest = ("SELECT
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),30)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),29)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),28)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),27)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),26)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),25)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),24)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),23)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),22)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),21)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),20)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),19)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),18)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),17)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),16)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),15)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),14)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),13)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),12)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),11)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),10)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),9)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),8)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),7)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),6)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),5)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),4)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),4)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),2)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),1)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average',
ROUND(AVG(CASE DAYOFYEAR(`Date_Time`) WHEN DAYOFYEAR(SUBDATE(NOW(),0)) THEN `TemperatureF` ELSE NULL END),2) AS 'days_average'
FROM env_sensors");

// Query the request
$result = mysqli_query($con,$dailyaveragerequest);

// Fetch results row
$avgtemps = $result->fetch_row();

// Close MySQL connection
mysqli_close($con);

// Establish JSON heading
$table = array();
$table['cols'] = array(
    
    //Labels for the chart, these represent the column titles
    array('id' => '', 'label' => 'Date', 'type' => 'string'),
    array('id' => '', 'label' => 'Temperature (F)', 'type' => 'number')
);

// Prepare for ForEach loop
$rows = array();
$count = 30;
$daysago = 30;


// Parse through results
foreach($avgtemps as $row){
    $temp = array();
    
    // Get date of reading
    $date = new DateTime();
    $date->sub(new DateInterval('P'.$daysago.'D'));
    $readingdate = $date->format('n\/d');
    
    // Add date and temperature to temp arrays then to rows array
    $temp[] = array('v' => (string) $readingdate);
    $temp[] = array('v' => (float) $row); 
    $rows[] = array('c' => $temp);
    
    // Prepare for next loop
    $count--;
    $daysago--;
}

// Free up memory
$result->free();

// Build table and encode
$table['rows'] = $rows;
$jsonTable = json_encode($table, true);

// Provide JSON
echo $jsonTable;

?>