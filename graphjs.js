$(function () {
    $.getJSON('data.php', function (data) {  // on récupère les data du json.

Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Station météorologique connectée'
    },
    xAxis: {
//      max : 15,
        categories: data[0]['data']
    },


    yAxis: {
        title: {
           text: ''
       }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Température (°C)',
        data: data[1]['data']
    }, {
        name: 'Humidite (%)',
        data: data[2]['data']
    }]
});
});
});
