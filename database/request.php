<?php
// Access provided by database configuration file
require_once 'config.php';

// Create connection to MySQL Database
$conn = new mysqli($servername, $username, $password, $dbname);
    
// Check for sucessful connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
        
// Request most recent recorded temperature
$res = $conn->query("SELECT * FROM env_sensors ORDER BY TempID DESC LIMIT 1");

// Request lowest temperature of the past 7 days  
$lowtempreq = $conn->query("SELECT TemperatureF AS low_temp, DATE_FORMAT(Date_Time, '%c/%e') AS Date FROM env_sensors WHERE Date_Time BETWEEN (CURRENT_TIMESTAMP() - INTERVAL 7 DAY) AND CURRENT_TIMESTAMP() ORDER BY TemperatureF, Date_Time LIMIT 1");
$lowtemp = $lowtempreq->fetch_row();    

// Request average temperature of the past 7 days       
$avg = $conn->query("SELECT AVG(TemperatureF) AS avg_temp FROM env_sensors WHERE Date_Time BETWEEN (CURRENT_TIMESTAMP() - INTERVAL 7 DAY) AND CURRENT_TIMESTAMP()");
$avgrow = $avg->fetch_row();

// Request highest temperature of the past 7 days  
$hightempreq = $conn->query("SELECT TemperatureF AS low_temp, DATE_FORMAT(Date_Time, '%c/%e') AS Date FROM env_sensors WHERE Date_Time BETWEEN (CURRENT_TIMESTAMP() - INTERVAL 7 DAY) AND CURRENT_TIMESTAMP() ORDER BY TemperatureF DESC LIMIT 1");
$hightemp = $hightempreq->fetch_row();

// Request date and time of most recent recorded temperature
$currentDateReq = $conn->query("SELECT Date_Time FROM env_sensors ORDER BY TempID DESC LIMIT 1");
$currentDate = $currentDateReq ->fetch_row();
date_default_timezone_set('America/New_York');
        
?>