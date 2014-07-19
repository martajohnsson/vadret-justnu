<?php

	# INKLUDERA
	require '../../../properties.php';

	# TEMPERATUR
	$temperature = $_GET['p'];



	# DIAGRAM
	echo '<div id="chart" class="chart"></div>';

?>









<script type="text/javascript">
$(document).ready(function() {


	var date = new Date;
	var date_hours = date.getHours();
	var hours = [];

	/*
	for(i = 0; i <= 24; i++) {
		var h = (date_hours + i) % 24;
		if (h == 0) h = 24;

		if(h < 10) {
			hours.push('0' + h + ':00');
		} else if(h == 24) {
			hours.push('00:00');
		} else {
			hours.push(h + ':00');
		}
	}
	*/



	var chart = new CanvasJS.Chart('chart', {
		theme: 'theme1',
		creditText: '',
		creditLink: '',

		title: {
			text: 'Temperatur, 24 timmar framåt',
			fontFamily: 'Arial',
			fontSize: 18,
			fontColor: '#222222',
			fontWeight: 'normal'
		},

		axisY: {
			margin: 10,
			// prefix: '+',
			// suffix: '° {degrees}',
			lineThickness: 1,
			lineColor: '#eaeaea',
			gridThickness: 1,
			gridColor: '#eaeaea',
			tickThickness: 1,
			tickColor: '#eaeaea',
			tickLength: 10
		},

		axisX: {
			lineThickness: 1,
			lineColor: '#eaeaea',
			gridThickness: 0,
			gridColor: '#eaeaea',
			tickThickness: 1,
			tickColor: '#eaeaea',
			tickLength: 10
		},

		toolTip: {
			enabled: true,
			animationEnabled: false
		},

		data: [{
			type: 'splineArea',
			markerSize: 10,
			toolTipContent: '{label}: {meter}{y}° {degrees}',

			dataPoints: [
				<?php echo str_replace('hours', '' + hours + '', $temperature); ?>
				// temperature
			]
		}]
	});

	chart.render();







	/*
	var data = {
		labels: hours,
		datasets: [{
			fillColor: 'rgba(0, 0, 0, 0)',
			strokeColor: 'rgba(0, 0, 0, 1)',
			pointColor: '#000000',
			pointStrokeColor: '#ffffff',
			data: <?php echo "[".$_GET["p"]."]"; ?>
		}]
	}

	var chart_line = new Chart($('.weather-chart-line').get(0).getContext('2d')).Line(data);
	*/


});
</script>