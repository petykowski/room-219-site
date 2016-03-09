<?php

// Access provided by database configuration file
require_once 'config.php';

// Create connection to MySQL Database
$con = new mysqli($servername, $username, $password, $dbname);

// Check for sucessful connection
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

// Create request for temperature reading at the top of each hour
$dailyrequest = ("SELECT TemperatureF AS Temperature, DATE_FORMAT(Date_Time, '%c/%e') AS Date
FROM env_sensors
WHERE Date_Time IN (
	SELECT MIN(Date_Time)
	FROM env_sensors
	WHERE DATE(Date_Time) BETWEEN (CURRENT_TIMESTAMP() - INTERVAL 7 DAY) AND CURRENT_TIMESTAMP()
	GROUP BY DAY(Date_Time)
)");

// Query the request
$result = mysqli_query($con,$dailyrequest);

// Close MySQL connection
mysqli_close($con);

// Establish JSON heading
$table = array();
$table['cols'] = array(
    
    //Labels for the chart, these represent the column titles
    array('id' => '', 'label' => 'Time', 'type' => 'string'),
    array('id' => '', 'label' => 'Temperature (F)', 'type' => 'number')
);

// Prepare for ForEach loop
$rows = array();

// Parse through results
foreach($result as $row){
    $temp = array();
    
    // Add date and temperature to temp arrays then to rows array
    $temp[] = array('v' => (string) $row['Date']);
    $temp[] = array('v' => (float) $row['Temperature']); 
    $rows[] = array('c' => $temp);
    
}

// Free up memory
$result->free();

// Build table and encode
$table['rows'] = $rows;
$jsonTable = json_encode($table, true);

// Provide JSON
echo $jsonTable;

//echo '<pre>';
//echo json_encode($table, JSON_PRETTY_PRINT);
//echo '</pre>';

?>