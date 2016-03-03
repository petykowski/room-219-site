<html>
    <head>
        <title>Temperature in 219</title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <script src="https://use.typekit.net/hqb0pcr.js"></script>
        <script>try{Typekit.load({ async: false });}catch(e){}</script>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="viewport" content="user-scalable=0, initial-scale=1.0" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="js/script.js"></script>
        <script src="Chart.js-2.0.0-beta2/Chart.js"></script>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="js/chart.js"></script>       
    </head>
    <body>
        
<?php
// Access provided by database configuration file
require_once 'database/config.php';

// Create connection to MySQL Database
$conn = new mysqli($servername, $username, $password, $dbname);
    
// Check for sucessful connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
        
// Request most recent recorded temperature
$res = $conn->query("SELECT * FROM env_sensors ORDER BY TempID DESC LIMIT 1");

// Request lowest temperature of the past 7 days  
$lowtempreq = $conn->query("SELECT TemperatureF AS low_temp FROM env_sensors WHERE Date_Time BETWEEN (CURRENT_TIMESTAMP() - INTERVAL 7 DAY) AND CURRENT_TIMESTAMP() ORDER BY TemperatureF LIMIT 1");
$lowtemp = $lowtempreq->fetch_row();

// Request average temperature of the past 7 days       
$avg = $conn->query("SELECT AVG(TemperatureF) AS avg_temp FROM env_sensors WHERE Date_Time BETWEEN (CURRENT_TIMESTAMP() - INTERVAL 7 DAY) AND CURRENT_TIMESTAMP()");
$avgrow = $avg->fetch_row();

// Request highest temperature of the past 7 days  
$hightempreq = $conn->query("SELECT TemperatureF AS high_temp FROM env_sensors WHERE Date_Time BETWEEN (CURRENT_TIMESTAMP() - INTERVAL 7 DAY) AND CURRENT_TIMESTAMP() ORDER BY TemperatureF DESC LIMIT 1");
$hightemp = $hightempreq->fetch_row();

// Request date and time of most recent recorded temperature
$currentDateReq = $conn->query("SELECT Date_Time FROM env_sensors ORDER BY TempID DESC LIMIT 1");
$currentDate = $currentDateReq ->fetch_row();
date_default_timezone_set('America/New_York');
        
?>
  
        <div class="currenttemp">
            <?php
            for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
                $res->data_seek($row_no);
                $row = $res->fetch_assoc();
                echo "<h1>" . $row['TemperatureF'] . "\n&deg;F</h1>";
            }
            ?>
            <p>Last reading on <?php echo date('F j, Y \a\t h:i A \(T\)',strtotime($currentDate[0]));?></p>
        </div>
        
        <div class="lowtemp">
            <p><?php echo round($lowtemp[0], 1) . "\n&deg;F";?></p>
        </div>
        
        <div class="avgtemp">
            <p><?php echo round($avgrow[0], 1) . "\n&deg;F";?></p>
        </div>
        
        <div class="hightemp">
            <p><?php echo round($hightemp[0], 1) . "\n&deg;F";?></p>
        </div>
        
        <div class="subtext-low">
            <p class="text-low">Lowest temperature in 7 Days.</p>
        </div>
        
        <div class="subtext-avg">
            <p class="text-avg">Average temperature of 7 Days.</p>
        </div>
        
        <div class="subtext-high">
            <p class="text-high">Highest temperature in 7 Days.</p>
        </div>
        
        <div id="outer">
            <div id="chart"></div>
        </div>
        
        <div id="footer">
            <a href="https://github.com/spetykowski/room-219">Code</a>
        </div>
        
    </body>
</html>