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
// Request data from MySQL Server via request.php
require_once 'database/request.php';
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