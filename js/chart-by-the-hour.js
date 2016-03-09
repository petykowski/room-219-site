google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);

function drawChart() {
  var jsonData = $.ajax({
      url: "database/getDataHourly.php",
      dataType:"json",
      async: false
}).responseText;

// Create our data table out of JSON data loaded from server.
var data = new google.visualization.DataTable(jsonData);

var showEvery = parseInt(data.getNumberOfRows() / 4);
    
var options = {
    chartArea: { left: '10%', width: "88%" },
    curveType: 'function',
    legend: {
        position: 'top',
        alignment: 'end',
    },
    backgroundColor: 'black',
    hAxis: {
        baseline: '100',
        showTextEvery: showEvery,
        maxTextLines: 1,
        textStyle: {
            color: 'white',
        },
    },
    vAxis: {
        textStyle: {
            color: 'white',
        },
    },
    lineWidth: 1.5,
    legend: {
        position: 'bottom',
        textStyle: {
            color: 'white',
        },
    },
    titleTextStyle: {
        color: 'white',
        fontSize: 12,
    },
};

var chart = new google.visualization.LineChart(document.getElementById('chart-hourly'));

chart.draw(data, options);
    
}