Highcharts.chart('pie_gradient', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Tỷ lệ dự án theo tình trạng',
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
            { name: 'Hoàn thành', y: count_approved },
            { name: 'Chưa hoàn thành', y: count_rejected },
            { name: 'Mới cập nhật', y: count_submitted },
        ]
    }],
    credits: {
        enabled: false
    },
});
