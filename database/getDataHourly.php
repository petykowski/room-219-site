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
$dailyaveragerequest = ("SELECT TemperatureF, DATE_FORMAT(Date_Time, '%l:%i') AS TimeOfReading
FROM env_sensors 
WHERE DATE(Date_Time) = CURDATE()");

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
    array('id' => '', 'label' => 'Time', 'type' => 'string'),
    array('id' => '', 'label' => 'Temperature (F)', 'type' => 'number')
);

// Prepare for ForEach loop
$rows = array();


// Parse through results
foreach($result as $row){
    $temp = array();
//    $str = date("h\:i", ;
//    $str = $row['TimeOfReading']->format('h\:i');
    // Add date and temperature to temp arrays then to rows array
    $temp[] = array('v' => (string) $row['TimeOfReading']);
    $temp[] = array('v' => (float) $row['TemperatureF']); 
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