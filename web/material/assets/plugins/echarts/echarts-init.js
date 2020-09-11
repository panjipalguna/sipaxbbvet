// ============================================================== 
// Bar chart option
// ============================================================== 
var myChart = echarts.init(document.getElementById('bar-chart'));

// specify chart configuration item and data
option = {
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['Hasil Konsultasi']
    },
    toolbox: {
        show : true,
        feature : {
            
            magicType : {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    color: ["#009efb"],
    calculable : true,
    xAxis : [
        {
            type : 'category',
            data : ['Per Akut','Akut','Sub Akut','Kronis']
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:'Tingkat Keparahan',
            type:'bar',
            data:[3, 2, 7, 12],
            markPoint : {
                data : [
                    {type : 'max', name: 'Max'},
                    {type : 'min', name: 'Min'}
                ]
            },
            markLine : {
                data : [
                    {type : 'average', name: 'Average'}
                ]
            }
        }
    ]
};
                    

// use configuration item and data specified to show chart
myChart.setOption(option, true), $(function() {
	function resize() {
		setTimeout(function() {
			myChart.resize()
		}, 100)
	}
	$(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
});
