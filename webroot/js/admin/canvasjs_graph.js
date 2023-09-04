window.onload = function () {
	  CanvasJS.addColorSet("blue",
                [//colorSet Array
                "#2d95e3"              
                ]);
//monthlysales
	var chart = new CanvasJS.Chart("monthlysales",
	{
		animationEnabled: true,
		zoomEnabled:false,
		colorSet: "blue",
		title:{
			text: "Order Sales: Last 12 months",
			fontColor: "#000",
        	fontSize: 14,
        	padding: 10,
        	fontWeight: "600",
			horizontalAlign: "left",
			fontFamily: "'Open Sans', sans-serif"
		},
		axisY: {title:"Sales",
			labelFontSize: 12,
			labelFontColor: "#000",
			valueFormatString:  "#,##,##0.##",
			labelFontFamily:"'Open Sans', sans-serif",
			maximum: 160000,
			gridThickness: 1,
			lineThickness: 1,
			tickThickness: 1,
			interval: 40000
		},
		axisX: {title:"Duration",
			//valueFormatString: "MMM-YYYY",
			labelFontSize: 12,
			labelFontFamily:"'Open Sans', sans-serif",
			lineThickness: 1,
			labelFontColor: "#000"
		},
		data: [
		{
			type: "column",
			dataPoints: [
				{ label: "Jan-2016",  y: 58900  },
				{ label: "Feb-2016",  y: 48000  },
				{ label: "Mar-2016", y: null },
				{ label: "Apr-2016", y: 60000  },
				{ label: "May-2016",  y: 85000  },
				{ label: "Jun-2016",  y: 180000 },
				{ label: "Jul-2016",  y: null  },
				{ label: "Aug-2016",  y: 100000},
				{ label: "Sep-2016",  y: 120000},
				{ label: "Oct-2016",  y: null  },
				{ label: "Nov-2016",  y: 30000}
			]
		}
		]
	});

	chart.render();
	
//monthlyearnings
var chart1 = new CanvasJS.Chart("monthlyearnings",
	{
		animationEnabled: true,
		height:270,
		width:673,
		zoomEnabled:!1,
		zoomType:"x",
		colorSet: "blue",
		title:{
			text: "Sales Earnings: Last 12 months",
			fontColor: "#000",
			fontSize: 14,
			padding: 10,
			fontWeight: "600",
			horizontalAlign: "left",
			fontFamily: "'Open Sans', sans-serif"
		},
		axisY: {title:"Sales",
			labelFontSize: 12,
			labelFontColor: "#000",
			valueFormatString:  "#,##,##0.##",
			labelFontFamily:"'Open Sans', sans-serif",
			maximum: 160000,
			gridThickness: 1,
			lineThickness: 1,
			tickThickness: 1,
			interval: 40000
		},
		axisX: {title:"Duration",
			//valueFormatString: "MMM-YYYY",
			labelFontSize: 12,
			labelFontFamily:"'Open Sans', sans-serif",
			lineThickness: 1,
			labelFontColor: "#000"
		},
		data: [
		{
			type: "column",
			dataPoints: [
				{ label: "Jan-2016",  y: 58900  },
				{ label: "Feb-2016",  y: 48000  },
				{ label: "Mar-2016", y: null },
				{ label: "Apr-2016", y: 60000  },
				{ label: "May-2016",  y: 85000  },
				{ label: "Jun-2016",  y: 180000 },
				{ label: "Jul-2016",  y: null  },
				{ label: "Aug-2016",  y: 100000},
				{ label: "Sep-2016",  y: 120000},
				{ label: "Oct-2016",  y: null  },
				{ label: "Nov-2016",  y: 30000}
			]
		}
		]
	});

	chart1.render();	

//signups
var chart2 = new CanvasJS.Chart("signups",
	{
		animationEnabled: true,
		height:270,
		width:673,
		zoomEnabled:!1,
		zoomType:"x",
		colorSet: "blue",
		title:{
			text: "Signups: Last 12 months",
			fontColor: "#000",
			fontSize: 14,
			padding: 10,
			fontWeight: "600",
			horizontalAlign: "left",
			fontFamily: "'Open Sans', sans-serif"
		},
		axisY: {title:"Signups",
			labelFontSize: 12,
			labelFontColor: "#000",
			valueFormatString:  "#,##,##0.##",
			labelFontFamily:"'Open Sans', sans-serif",
			maximum: 60,
			gridThickness: 1,
			lineThickness: 1,
			tickThickness: 1,
			interval: 15
		},
		axisX: {title:"Duration",
			//valueFormatString: "MMM-YYYY",
			labelFontSize: 12,
			labelFontFamily:"'Open Sans', sans-serif",
			lineThickness: 1,
			labelFontColor: "#000"
		},
		data: [
		{
			type: "column",
			dataPoints: [
				{ label: "Jan-2016", y: null },
				{ label: "Feb-2016", y: null },
				{ label: "Mar-2016", y: null },
				{ label: "Apr-2016", y: 58 },
				{ label: "May-2016", y: 25 },
				{ label: "Jun-2016", y: 18 },
				{ label: "Jul-2016", y: null },
				{ label: "Aug-2016", y: null },
				{ label: "Sep-2016", y: null },
				{ label: "Oct-2016", y: null },
				{ label: "Nov-2016", y: 30 }
			]
		}
		]
	});

	chart2.render();	

//products
var chart3 = new CanvasJS.Chart("products_graph",
	{
		animationEnabled: true,
		height:270,
		width:673,
		zoomEnabled:!1,
		zoomType:"x",
		colorSet: "blue",
		title:{
			text: "Products: Last 12 months",
			fontColor: "#000",
			fontSize: 14,
			padding: 10,
			fontWeight: "600",
			horizontalAlign: "left",
			fontFamily: "'Open Sans', sans-serif"
		},
		axisY: {title:"Products",
			labelFontSize: 12,
			labelFontColor: "#000",
			valueFormatString:  "#,##,##0.##",
			labelFontFamily:"'Open Sans', sans-serif",
			maximum: 100,
			gridThickness: 1,
			lineThickness: 1,
			tickThickness: 1,
			interval: 25
		},
		axisX: {title:"Duration",
			//valueFormatString: "MMM-YYYY",
			labelFontSize: 12,
			labelFontFamily:"'Open Sans', sans-serif",
			lineThickness: 1,
			labelFontColor: "#000"
		},
		data: [
		{
			type: "column",
			dataPoints: [
				{ label: "Jan-2016", y: 15 },
				{ label: "Feb-2016", y: null },
				{ label: "Mar-2016", y: null },
				{ label: "Apr-2016", y: null },
				{ label: "May-2016", y: 25 },
				{ label: "Jun-2016", y: 18 },
				{ label: "Jul-2016", y: 58 },
				{ label: "Aug-2016", y: null },
				{ label: "Sep-2016", y: 83 },
				{ label: "Oct-2016", y: null },
				{ label: "Nov-2016", y: 30 }
			]
		}
		]
	});

	chart3.render();	

//products
var chart4 = new CanvasJS.Chart("affiliate_graph",
	{
		animationEnabled: true,
		height:270,
		width:673,
		zoomEnabled:!1,
		zoomType:"x",
		colorSet: "blue",
		title:{
			text: "Products: Last 12 months",
			fontColor: "#000",
			fontSize: 14,
			padding: 10,
			fontWeight: "600",
			horizontalAlign: "left",
			fontFamily: "'Open Sans', sans-serif"
		},
		axisY: {title:"Products",
			labelFontSize: 12,
			labelFontColor: "#000",
			valueFormatString:  "#,##,##0.##",
			labelFontFamily:"'Open Sans', sans-serif",
			maximum: 1.00,
			gridThickness: 1,
			lineThickness: 1,
			tickThickness: 1,
			interval:0.25
		},
		axisX: {title:"Duration",
			//valueFormatString: "MMM-YYYY",
			labelFontSize: 12,
			labelFontFamily:"'Open Sans', sans-serif",
			lineThickness: 1,
			labelFontColor: "#000"
		},
		data: [
		{
			type: "column",
			dataPoints: [
				{ label: "Jan-2016", y: null },
				{ label: "Feb-2016", y: null },
				{ label: "Mar-2016", y: null },
				{ label: "Apr-2016", y: null },
				{ label: "May-2016", y: null },
				{ label: "Jun-2016", y: null },
				{ label: "Jul-2016", y: 0.85 },
				{ label: "Aug-2016", y: null },
				{ label: "Sep-2016", y: null },
				{ label: "Oct-2016", y: null },
				{ label: "Nov-2016", y: null }
			]
		}
		]
	});

	chart4.render();	
}
