google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart1);

function drawChart1() {
  var jsonData = $.ajax({
      url: "database/getDataHourly.php",
      dataType:"json",
      async: false
}).responseText;

// Create our data table out of JSON data loaded from server.
var data = new google.visualization.DataTable(jsonData);

//var showEvery = parseInt(data.getNumberOfRows() / 5);
    
var options = {
    chartArea: { 
        width: "100%",
        height: "80%",
        top: "5%",
        left: "10%",
    },
    curveType: 'function',
    legend: {
        position: 'top',
        alignment: 'end',
    },
    backgroundColor: 'black',
    hAxis: {
        baseline: '100',
        showTextEvery: 5,
        maxTextLines: 1,
        textStyle: {
            color: 'white',
            fontName: "brandon-grotesque",
            bold: "true",
            fontSize: 13,
        },
        
    },
    vAxis: {
        textStyle: {
            color: 'white',
            fontName: "brandon-grotesque",
            bold: "true",
            fontSize: 13,
        },
        viewWindowMode: "maximized",
    },
    lineWidth: 1.5,
    legend: {
        position: 'bottom',
        textStyle: {
            color: 'white',
            fontName: "brandon-grotesque",
            bold: "true",
            fontSize: 14,
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