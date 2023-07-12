Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: pie_gradient,
        align: 'center',
        style: { color: color },
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
            borderRadius: 5,
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                distance: -50,
                filter: {
                    property: 'percentage',
                    operator: '>',
                    value: 4
                }
            }
        }
    },
    series: [{
        name: 'Ratio',
        data: [
            { name: approved, color: '#2fb36a', y: count_approved },
            { name: rejected, color: '#d83939', y: count_rejected },
            { name: submitted, color: '#f59f4a', y: count_submitted },
        ]
    }],
    credits: {
        enabled: false
    },
    exporting: {
        enabled: false,
    },
});
