Highcharts.chart('pie_gradient', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: pie_gradient,
        align: 'center'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'Tỷ lệ',
        data: [
            { name: approved, color: '#2fb36a',  y: count_approved },
            { name: rejected, color: '#d83939', y: count_rejected },
            { name: submitted, color: 'yellow',  y: count_submitted },
        ]
    }],
    credits: {
        enabled: false
    },
});
