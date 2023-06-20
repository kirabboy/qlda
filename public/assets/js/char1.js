Highcharts.chart('column_basic', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Số lượng dự án qua các tháng'
    },
    subtitle: {
        text: 'Theo tình trạng'
    },
    xAxis: {
        categories: months,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Số lượng dự án'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table width:100px>',
        pointFormat: '<tr><td style="color:{series.color};padding:0;">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Dự án',
        data: count_month

    }],
    credits: {
        enabled: false
    },
});
