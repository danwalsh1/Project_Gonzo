<?php
	function makeGoogleChart($title, $width, $height, $divID, $dataString){
		# Uses Google Charts
		echo "
			<!--Uses Google Charts-->
			<script type=\"text/javascript\" src=\"https://www.gstatic.com/charts/loader.js\"></script>
			<script type=\"text/javascript\">
				google.charts.load('current', {'packages':['corechart']});
				
				google.charts.setOnLoadCallback(drawChart);
				
				function drawChart(){
					var data = google.visualization.arrayToDataTable(" . $dataString . ");
					
					var options = {'title':'" . $title ."',
						'width':" . $width . ",
						'height':" . $height . "};
					
					var chart = new google.visualization.LineChart(document.getElementById('" . $divID ."'));
					chart.draw(data, options);
				}
		</script>
	";
	}
?>