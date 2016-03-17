google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart2);

function drawChart2() {
  var jsonData = $.ajax({
      url: "database/getDataDaily.php",
      dataType:"json",
      async: false
}).responseText;

// Create our data table out of JSON data loaded from server.
var data = new google.visualization.DataTable(jsonData);

var showEvery = parseInt(data.getNumberOfRows() / 4);
    
var options = {
    chartArea: { 
        width: "100%",
        height: "78%",
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
        showTextEvery: showEvery,
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

var chart = new google.visualization.LineChart(document.getElementById('chart-daily'));

chart.draw(data, options);
    
}