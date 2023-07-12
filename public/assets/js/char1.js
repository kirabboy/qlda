Highcharts.chart('column_basic', {
    chart: {
        type: 'column',
    },
    title: {
        text: column_basic,
        style: {
            color: color,
        }
    },
    xAxis: {
        categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
        crosshair: true,
        labels: { style: { color: color } },
    },
    yAxis: {
        min: 0,
        allowDecimals: false,
        title: {
            text: 'Number of projects',
            style: {
                color: color,
            }
        },
        labels: { style: { color: color } },
    },
    tooltip: {
        headerFormat: '<span style="font-size:15px"; >Month: {point.key}</span><table width=150px;>',
        pointFormat: '<tr><td style="color:{series.color};padding:0;">{series.name}: </td>' +
            '<td style="padding:0;color:{series.color}"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true,
    },
    plotOptions: {
        column: {
            pointPadding: 0,
            borderWidth: 0,
            pointWidth: 10
        },
    },
    series: [{
        name: approved,
        data: count_month_approved,
        color: '#2fb36a',
        fill: 'red'
    }, {
        name: rejected,
        data: count_month_rejected,
        color: '#d83939'
    }, {
        name: submitted,
        data: count_month_submitted,
        color: '#f59f4a'
    }],
    legend: {
        backgroundColor: color,
        borderRadius: 8
    },
    exporting: {
        enabled: false,
    },
    credits: {
        enabled: false
    },
});
