<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <style>
        .highcharts-legend-item span {
            width: 100px !important;
            text-align: left !important;
        }
    </style>
</head>

<body>

    <div class="container-fluid mt-4">
        <div class="row">
            <?php foreach ($pensiunan as $pen) : ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="chart_container<?= $pen['keterangan'] ?>"></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <div id="chart_container_count_status"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <div id="chart_container_count_keterangan"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        Highcharts.setOptions({
            colors: [
                '#DCE775',
                '#BA68C8',
                '#64B5F6',
                '#FFB74D',
            ],
        });
        <?php foreach ($pensiunan as $pen) : ?>
            Highcharts.chart('chart_container<?= $pen['keterangan'] ?>', {
                chart: {
                    type: 'column'
                },
                credits: false,
                title: {
                    text: '<?= $pen['keterangan'] ?>',
                    align: 'center'
                },
                xAxis: {
                    categories: ['Bulanan', 'Sekaligus']
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total'
                    },
                    stackLabels: {
                        enabled: true
                    }
                },
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom',
                    // itemWidth: 150,
                    // width: 350,
                    useHTML: true,
                    borderWidth: 0,
                },
                tooltip: {
                    headerFormat: '<b><?= $pen['keterangan'] ?> ({point.x})</b><br/>',
                    pointFormat: '{series.name}: {point.y}'
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true
                        }
                    },
                },
                series: [
                    <?php foreach ($pen['status'] as $sts) : ?> {
                            name: '<?= $sts['nama_status'] ?>',
                            data: [<?= $sts['data_total']['bulanan'] ?>, <?= $sts['data_total']['sekaligus'] ?>]
                        },
                    <?php endforeach; ?>
                ]
            });
        <?php endforeach; ?>

        Highcharts.setOptions({
            colors: [
                '#DCE775',
                '#BA68C8',
                '#64B5F6',
                '#FFB74D',
            ],
        });
        Highcharts.chart('chart_container_count_status', {
            chart: {
                type: 'pie'
            },
            credits: false,
            title: {
                text: 'Total Status'
            },
            tooltip: {
                valueSuffix: '%'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: [{
                        enabled: true,
                        distance: 20
                    }, {
                        enabled: true,
                        distance: -40,
                        format: '{point.percentage:.1f}%',
                        style: {
                            fontSize: '1.2em',
                            textOutline: 'none',
                            opacity: 0.7
                        },
                        filter: {
                            operator: '>',
                            property: 'percentage',
                            value: 10
                        }
                    }]
                }
            },
            series: [{
                name: 'Persentase',
                colorByPoint: true,
                data: [
                    <?php foreach ($pie_status as $pp) : ?> {
                            name: '<?= $pp['nama_status'] . '<br>(' . number_format($pp['data_total']['semua'], 0, ',', '.') . ')' ?>',
                            y: <?= round(($pp['data_total']['semua'] / $countAll) * 100, 2) ?>
                        },
                    <?php endforeach; ?>
                ]
            }]
        });

        Highcharts.setOptions({
            colors: [
                '#BDBDBD',
                '#81C784',
                '#E57373',
            ],
        });
        Highcharts.chart('chart_container_count_keterangan', {
            chart: {
                type: 'pie'
            },
            credits: false,
            title: {
                text: 'Total Keterangan'
            },
            tooltip: {
                valueSuffix: '%'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: [{
                        enabled: true,
                        distance: 20
                    }, {
                        enabled: true,
                        distance: -40,
                        format: '{point.percentage:.1f}%',
                        style: {
                            fontSize: '1.2em',
                            textOutline: 'none',
                            opacity: 0.7
                        },
                        filter: {
                            operator: '>',
                            property: 'percentage',
                            value: 10
                        }
                    }]
                }
            },
            series: [{
                name: 'Persentase',
                colorByPoint: true,
                data: [
                    <?php foreach ($pie_keterangan as $key => $pk) : ?> {
                            name: '<?= $pk['nama_keterangan'] . '<br>(' . number_format($pk['data_total']['semua'], 0, ',', '.') . ')' ?>',
                            y: <?= round(($pk['data_total']['semua'] / $countAll) * 100, 2) ?>
                        },
                    <?php endforeach; ?>
                ]
            }]
        });
    </script>


</body>

</html>