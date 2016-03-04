$(window).load(function() {
    
    $( "div.lowtemp" ).click(function() {
        $( "div.subtext-low" ).delay(100).fadeIn(100);
        $( "div.subtext-avg" ).hide();
        $( "div.subtext-high" ).hide();
    });

    $( "div.avgtemp" ).click(function() {
        $( "div.subtext-low" ).hide();
        $( "div.subtext-avg" ).delay(100).fadeIn(100);
        $( "div.subtext-high" ).hide();
    });

    $( "div.hightemp" ).click(function() {
        $( "div.subtext-low" ).hide();
        $( "div.subtext-avg" ).hide();
        $( "div.subtext-high" ).delay(100).fadeIn(100);
    });

    $( "div.currenttemp" ).click(function() {
        $( "div.subtext-low" ).hide();
        $( "div.subtext-avg" ).hide();
        $( "div.subtext-high" ).hide();
    });
    
});

$(window).resize(function(){
  drawChart();
});