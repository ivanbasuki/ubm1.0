<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>
	<div class="container mt-3">
  <div>	
	<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/ub/index">Dashboard</a></li>
							<li class="breadcrumb-item active"><?= $title; ?></li>
                        </ol>
</div>

		<div class="container">
			<div class="mb-5 mt-5">
				<div id="GoogleLineChart" style="height: 400px; width: 100%"></div>
			</div>
			<div class="mb-5">
				<div id="GoogleBarChart" style="height: 400px; width: 100%"></div>
			</div>
		</div>

		<script type="text/javascript" src="/js/loader.js"></script>
		<script>
			google.charts.load('current', {'packages':['corechart', 'bar']});
			google.charts.setOnLoadCallback(drawLineChart);
			google.charts.setOnLoadCallback(drawBarChart);
            // Line Chart
			function drawLineChart() {
				var data = google.visualization.arrayToDataTable([
					['Day', 'Products Count'],
						<?php 
							foreach ($pembayaran as $row){
							   echo "['".$row['day']."',".$row['sell']."],";
						} ?>
				]);
				var options = {
					title: 'Line chart product sell wise',
					curveType: 'function',
					legend: {
						position: 'top'
					}
				};
				var chart = new google.visualization.LineChart(document.getElementById('GoogleLineChart'));
				chart.draw(data, options);
			}
			
			
			// Bar Chart
			google.charts.setOnLoadCallback(showBarChart);
			function drawBarChart() {
				var data = google.visualization.arrayToDataTable([
					['Day', 'Products Count'], 
						<?php 
							foreach ($pembayaran as $row){
							   echo "['".$row['day']."',".$row['sell']."],";
							}
						?>
				]);
				var options = {
					title: ' Bar chart products sell wise',
					is3D: true,
				};
				var chart = new google.visualization.BarChart(document.getElementById('GoogleBarChart'));
				chart.draw(data, options);
			}
			
		</script>
<?= $this->endSection() ?>