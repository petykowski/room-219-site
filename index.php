<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Temperature in 219</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="/css/style.css" type="text/css">
        <script src="https://use.typekit.net/hqb0pcr.js"></script>
        <script>try{Typekit.load({ async: true });}catch(e){}</script>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="js/script.js"></script>
        <script src="Chart.js-2.0.0-beta2/Chart.js"></script>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="js/chart-by-the-hour.js"></script>
        <script src="js/chart-by-the-day.js"></script>
<!--        <script src="js/chart.js"></script>       -->
    </head>
    
    <?php
        // Request data from MySQL Server via request.php
        require_once 'database/request.php';
    ?>
    
    <body>
        <div class="row no-margin">
            <div class="col-xs-12 header">
                <b>Temperature in Room 219</b>
            </div>
        </div>
        
        <div class="row no-margin">
            <div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 no-padding border-bottom">
                <div class="col-xs-12 col-sm-5 col-md-4 no-padding temp-main border-bottom">
                <?php
                for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
                    $res->data_seek($row_no);
                    $row = $res->fetch_assoc();
                echo "<h1>" . round($row['TemperatureF'], 1) . "\n&deg;F</h1>";
                }
                ?>
                    <p class="timestamp-long"><em>Last updated: </em><?php echo date('F j, Y \a\t h:i A \(T\)',strtotime($currentDate[0]));?></p>
                    <p class="timestamp"><em>Last updated: </em><?php echo date('n\/j\/y \a\t h:i A \(T\)',strtotime($currentDate[0]));?></p>
                </div>
                <div class="col-xs-12 col-sm-7 col-md-8 padding-left no-padding last">
                    <h2 class="section-title">Temperature By The Hour</h2>
                    <div id="chart-hourly" class="chart-hourly"></div>
                </div>
            </div>
        </div>
        
        <div class="row no-margin">
            <div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 no-padding border-bottom">
                <div class="col-xs-12 no-padding">
                    <h2 class="section-title">Week in Review</h2>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-4 no-padding padding-right">
                    <table class="table table-condensed highlight">
                        <thead>
                            <tr>
                                <th>EVENT</th>
                                <th>TEMPERATURE</th>
                                <th>DATE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><em>Low</em></td>
                                <td><?php echo round($lowtemp[0], 1) . "\n&deg;F";?></td>		
                                <td><?php echo $lowtemp[1]; ?></td>
                            </tr>
                            <tr>
                                <td><em>High</em></td>
                                <td><?php echo round($hightemp[0], 1) . "\n&deg;F";?></td>		
                                <td><?php echo $hightemp[1]; ?></td>
                            </tr>
                            <tr>
                                <td><em>Average</em></td>
                                <td><?php echo round($avgrow[0], 1) . "\n&deg;F";?></td>		
                                <td><?php echo "Week " . date("W"); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row last no-margin">
                    <div class="col-xs-12 col-sm-7 col-md-8 no-padding padding-left">
                        <div id="chart-daily" class="chart-daily"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row no-margin">
            <div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 no-padding border-bottom">
                <div class="col-xs-12 no-padding">
                    <h2 class="section-title">Historical Records</h2>
                </div>
                <div class="col-xs-12 no-padding">
                    <table class="table table-condensed highlight">
                        <thead>
                            <tr>
                                <th>EVENT</th>
                                <th>TEMPERATURE</th>
                                <th>DATE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><em>Lowest</em></td>
                                <td><?php echo round($recordlow[0], 1) . "\n&deg;F";?></td>		
                                <td><?php echo $recordlow[1]; ?></td>
                            </tr>
                            <tr>
                                <td><em>Highest</em></td>
                                <td><?php echo round($recordhigh[0], 1) . "\n&deg;F";?></td>		
                                <td><?php echo $recordhigh[1]; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div id="footer">
            <u><a href="https://github.com/spetykowski/room-219">Code</a></u>
        </div>
        
    </body>
</html>