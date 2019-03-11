window.onload = function () {

if($('#analysis-graph').length){
	
	//var data = {
//    labels: ["2005", "2006", "2007", "2008", "2009", "2010", "2011", "2012", "2013", "2014", "2015"],
//    datasets: [{
//        backgroundColor: "rgba(3,199,217,0.8)",
//        borderColor: "rgba(75,192,192,1)",
//        data: [2000, 2500, 1500, 3500, 2200, 2800, 3000, 4000, 3500, 5500, 6800],
//    }]
//};
//
//var ctx = document.getElementById("analysis-graph");
//Chart.defaults.global.legend.display = false;
//var myChart = new Chart(ctx, {
//    type: 'line',
//    data: data,
//    options: {
//        scales: {
//            yAxes: [{
//                ticks: {
//                    beginAtZero: true
//                }
//            }],
//            xAxes: [{
//                // Change here
//            	barPercentage: 1
//            }]
//        },
//		legend: {
//		  position: 'right'
//		}
//    }
//});

window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};

window.randomScalingFactor = function() {
	return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
};

var lineChartData = {
        labels: ["January", "February", "March", "April","May"],
        datasets: [{
            label: "Financial Growth",
            borderColor: window.chartColors.red,
            backgroundColor: window.chartColors.red,
            fill: false,
            data: [
                0,
                25,
                45,
                25,
				62
            ],
            yAxisID: "y-axis-1",
        }, {
            label: "Economy Growth",
            borderColor: window.chartColors.blue,
            backgroundColor: window.chartColors.blue,
            fill: false,
            data: [
                0,
                40,
                21,
                55,
				22
            ],
            yAxisID: "y-axis-2"
        }]
    };

        var ctx = document.getElementById("analysis-graph").getContext("2d");
        window.myLine = Chart.Line(ctx, {
            data: lineChartData,
            options: {
                responsive: true,
                hoverMode: 'index',
                stacked: false,
                title:{
                    display: true,
                    text:'January 2017 - May 2017'
                },
                scales: {
                    yAxes: [{
                        type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                        display: true,
                        position: "left",
                        id: "y-axis-1",
                    }, {
                        type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                        display: true,
                        position: "right",
                        id: "y-axis-2",

                        // grid line settings
                        gridLines: {
                            drawOnChartArea: false, // only want the grid lines for one axis to show up
                        },
                    }],
                },
				legend: {
				  position: 'bottom'
				}
            }
        });

}

if($('#service-analysis-graph').length){
	
	var ctx = document.getElementById("service-analysis-graph").getContext('2d');
	var myChart = new Chart(ctx, {
	  type: 'doughnut',
	  data: {
		labels: ["Total Projects - 35% ", "Loan Prograns - 65% ", "Debt Prograns -  15%"],
		datasets: [{
		  backgroundColor: [
			"#b855f1",
			"#1a9bff",
			"#f8bc3c"
		  ],
		  data: [35, 65, 15]
		}]
	  },
	   options: {
		legend: {
		  position: 'bottom'
		}
	  }
	});

}	


};