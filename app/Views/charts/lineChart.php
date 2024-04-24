<?= $this->extend('Layout/template_sbadmin'); ?>
<?= $this->section('content'); ?>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Grafik Batang Kepemilikan Saham</title>

		<style type="text/css">
#container {
    height: 400px;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

		</style>
	</head>
	<body>
<div>	
	<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/ub/index">Dashboard</a></li>
							<li class="breadcrumb-item active"><?= $title; ?></li>
                        </ol>
</div>

<script src="/highcharts/highcharts.js"></script>
<script src="/highcharts/highcharts-3d.js"></script>
<script src="/highcharts/exporting.js"></script>
<script src="/highcharts/export-data.js"></script>
<script src="/highcharts/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        <i><?= $deskripsi ?></i><br><br>
    </p>
</figure>


		<script type="text/javascript">
Highcharts.chart('container', {

    title: {
        text: '<?= $title ?>',
        align: 'left'
    },

    subtitle: {
        text: 'UB Bina Syirkah Mandiri">IREC</a>.',
        align: 'left'
    },

    yAxis: {
        title: {
            text: 'Penjualan UB'
        }
    },

    xAxis: {
        accessibility: {
            rangeDescription: 'Range: Jan sd Des'
        }
    },

    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 1       }
    },

    series: <?= json_encode($chart_data); ?>,

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});

		</script>
	</body>
	<?= $this->endSection(); ?>

