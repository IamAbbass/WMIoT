<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover">
  
</head>
<body>

  <div id="myDiv"></div>
<script type="text/javascript" src="js/plotly-latest.min.js"></script>
<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript">
	var DO 	 	  = [];
	var ph 	 	  = [];
	var temp 	  = [];
	var DO_std    = [];
	var time      = [];
	var myPlot = document.getElementById('myDiv');
	$.get("../app_services/pond_data_json.php?id=6&filter=24h" , function(data){
		$dat = JSON.parse(data);
		$data = $dat.data;

		$.each($data, function( key, value ) {
		  DO.push(value.d_o);
		  DO_std.push(value.d_o_st);
		  ph.push(value.ph);
		  temp.push(value.temp);
		  time.push(value.date_time);
		  console.log(value);
		});




		var trace1 = {
  			y: DO,
			name: 'DO',
			text: 'DO',
  			textposition:"bottom left",
  			type: 'scatter',
  			hoverlabel:{
  				font :{ size:15}
  			}
		};
		var trace2 = {
		  y: ph,
		  type: 'scatter',
		  name: 'pH',
		  text: 'pH',
		  hoverlabel:{
  				font :{ size:15}
  			}
		};
		var trace3 = {
		  y: temp,
		  type: 'scatter',
		  text: 'temp',
		  name: 'Temperature',
		  hoverlabel:{
  				font :{ size:15}
  			}
		};
		var trace4 = {
		  y: DO_std,
		  type: 'scatter',
		  text: 'DO_std',
		  name: 'DO Standard',
		  hoverlabel:{
  				font :{ size:15}
  		  }
  		  // margin:{
  		  // 	pad:100
  		  // }
		};

		var color1 = '#fff';
		var trace5 = {
			x: time,
			name: 'Date_time',
			opacity:0,
			// legend:false,
			showlegend:false,
			hoverlabel:{
				font :{ size:1,color:color1},
				bgcolor:color1,
				bordercolor:color1
			},
			marker:{
				color: 'rgb(255, 255, 255)',
			}

		};


		var data = [trace1,trace2,trace3,trace4,trace5];

		var layout = {showlegend: true,
			legend: {"orientation": "h"},
			margin: {
				t:1,
			    b: 200,
			},

			xaxis: {
			   title: 'Time/Date',zeroline:false,showticklabels: false
			},
			legend:{
				traceorder:'grouped'
			},
			// yaxis: {
			//     showgrid: false,
			//     showline: false
			// }
		};


		Plotly.newPlot('myDiv', data,layout, {}, {showSendToCloud: true});


	});

</script>
</body>
</html>
