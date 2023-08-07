<!DOCTYPE html>
<html lang="en" style="height: auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css">
    <title>Layanan Konsultasi | Admin</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Favicons -->
    <link href="assets/img/kominfo.png" rel="icon">
    <link href="assets/img/kominfo.png" rel="kominfo">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
    {{-- ChartJS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    @livewireStyles

</head>

<body class="hold-transition sidebar-mini">

    <div class="container-fluid">
        <div class="container mt-3">
            <div class="row">
                <div class="col d-flex justify-content-end mb-3">
                    <button class="btn btn-primary" id="exportPdfButton">Export to PDF</button>
                </div>
            </div>
            {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.9.179/pdf.min.js"
                integrity="sha512-9jr6up7aOKJkN7JmtsxSdU+QibDjV6m6gL+I76JdpX1qQy8Y5nxAWVjvKMaBkETDC3TP3V2zvIk+zG7734WqPA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
            {{-- <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script> --}}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
            <script>
                document.getElementById('exportPdfButton').addEventListener('click', function() {
                    const pdfElement = document.getElementById('dashboard');

                    html2pdf().from(pdfElement).set({
                        margin: 10,
                        filename: 'dashboard.pdf',
                        image: {
                            type: 'jpeg',
                            quality: 0.98
                        },
                        html2canvas: {
                            scale: 2,
                        }, // Atur skala sesuai kebutuhan
                        jsPDF: {
                            unit: 'mm',
                            format: 'a4',
                            orientation: 'portrait',
                            floatPrecision: 'smart'
                        }
                    }).save();
                });
            </script>

            <div id="dashboard">
                <div class="row">
                    <div class="col-lg-6 margin-tb">
                        <div class="card" style="width: 100%; background-color: #FDE4D0">
                            <div class="card-header">
                                <h5 class="card-title">Presentase Jumlah Pelayanan</h5>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <canvas id="pieChart"></canvas>
                                    <script>
                                        var xValues = [
                                            @foreach ($queues as $data)
                                                '{{ $data->consultants->nama_konsultan }}',
                                            @endforeach
                                        ];
                                        var yValuesTotal = {{ $queues_total }};
                                        var yValues = [
                                            @foreach ($queues as $data)
                                                (({{ $data->total }} / yValuesTotal) * 100)
                                                .toFixed(1),
                                            @endforeach
                                        ];
                                        var barColors = [
                                            "#472a00",
                                            "#d07a00",
                                            "#f89100"
                                        ];

                                        var bdrColors = [
                                            "rgb(32,19,0)",
                                            "rgb(169,99,0)",
                                            "rgb(228,134,0)"
                                        ];
                                        var format = '%';
                                        new Chart("pieChart", {
                                            type: "doughnut",
                                            data: {
                                                labels: xValues,
                                                datasets: [{
                                                    backgroundColor: barColors,
                                                    borderColor: bdrColors,
                                                    data: yValues
                                                }]
                                            },
                                            options: {
                                                tooltips: {
                                                    callbacks: {
                                                        label: function(tooltipItem, data) {
                                                            var dataset = data.datasets[tooltipItem.datasetIndex];
                                                            var labels = data.labels[tooltipItem.index];
                                                            var currentValue = dataset.data[tooltipItem.index];
                                                            return labels + ": " + currentValue + " %";
                                                        }
                                                    }
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="col-lg-6 margin-tb">
                        <div class="card" style="width: 100%;background-color: #FDE4D0">
                            <div class="card-header">
                                <h5 class="card-title">Jumlah Konsultasi Setiap Konsultan</h5>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <canvas id="myChart"></canvas>
                                    <script>
                                        Chart.defaults.global.legend.display = false;

                                        var xValues = [
                                            @foreach ($queues as $data)
                                                '{{ $data->consultants->nama_konsultan }}',
                                            @endforeach
                                        ];
                                        var yValues = [
                                            @foreach ($queues as $data)
                                                {{ $data->total }},
                                            @endforeach
                                        ];
                                        var barColors = [
                                            "#6e4100",
                                            "#bd6f00",
                                            "#f89100"
                                        ];

                                        new Chart("myChart", {
                                            type: "bar",
                                            data: {
                                                labels: xValues,
                                                datasets: [{
                                                    label: [],
                                                    backgroundColor: barColors,
                                                    data: yValues,
                                                }]
                                            },
                                            options: {
                                                title: {
                                                    display: true,
                                                    text: 'Statistik Consultant'
                                                },
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            min: 0
                                                        }
                                                    }]
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="card" style="width: 100%;background-color: #FDE4D0">
                            <div class="card-header">
                                <h5 class="card-title">Grafik Perkembangan Jumlah Konsultasi Tiap Bulan
                                </h5>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <label class="form-label" style="margin-right: 10px" for="year">Filter
                                            Tahun</label>
                                        <select class="form-select w-25" id="year" onchange="updateChart()">
                                            <option value="all">All</option>
                                            @forelse ($jumlah_tamu as $tahun => $data)
                                                <option value="{{ $tahun }}">{{ $tahun }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <canvas id="lineChart"></canvas>
                                    <script>
                                        var ctx = document.getElementById("lineChart").getContext("2d");
                                        var chart;

                                        function getColor(nip) {
                                            if (nip == '1111111111') {
                                                var color = "#ea5545";
                                            } else if (nip == '2222222222') {
                                                var color = "#f46a9b";
                                            } else if (nip == '123456789') {
                                                var color = "#ef9b20";
                                            }
                                            return color;
                                        }

                                        function updateChart() {
                                            var selectedYear = document.getElementById("year").value;

                                            if (chart) {
                                                chart.destroy();
                                            }

                                            var labels = <?php echo json_encode($label); ?>;
                                            var jumlah_tamu = {!! json_encode($jumlah_tamu) !!};
                                            var data_konsultan = {!! json_encode($consultants) !!};

                                            var datasets = [];
                                            if (selectedYear === 'all') {
                                                var nipData = {};

                                                for (var tahun in jumlah_tamu) {
                                                    for (var nip in jumlah_tamu[tahun]) {
                                                        if (!nipData[nip]) {
                                                            nipData[nip] = {
                                                                label: 'NIP ' + nip,
                                                                backgroundColor: 'rgb(255,211,148)',
                                                                borderColor: getColor(nip),
                                                                fill: false,
                                                                tension: 0,
                                                                data: Array.from({
                                                                    length: 12
                                                                }, () => 0)
                                                            };
                                                        }
                                                        for (var bulan in jumlah_tamu[tahun][nip]) {
                                                            nipData[nip].data[bulan - 1] += jumlah_tamu[tahun][nip][bulan];
                                                        }
                                                        console.log(data_konsultan);
                                                    }
                                                }

                                                // Prepare datasets array
                                                var datasets = Object.values(nipData);
                                            } else {
                                                for (var nip in jumlah_tamu[selectedYear]) {
                                                    datasets.push({
                                                        label: 'NIP ' + nip,
                                                        backgroundColor: 'rgb(255,211,148)',
                                                        borderColor: getColor(nip),
                                                        fill: false,
                                                        tension: 0,
                                                        data: jumlah_tamu[selectedYear][nip]
                                                    });
                                                }
                                            }

                                            // if (selectedYear === 'all') {
                                            //     var jumlah_tamu_all = [];

                                            //     for (var i = 0; i < labels.length; i++) {
                                            //         var total = 0;
                                            //         for (var tahun in jumlah_tamu) {
                                            //             total += jumlah_tamu[tahun][i];
                                            //         }
                                            //         jumlah_tamu_all[i] = total;
                                            //     }
                                            //     var datasets = [{
                                            //         label: 'Total Jumlah Tamu',
                                            //         backgroundColor: 'rgb(255,211,148)',
                                            //         borderColor: '#F57009',
                                            //         fill: false,
                                            //         tension: 0,
                                            //         data: jumlah_tamu_all
                                            //     }];
                                            // } else {
                                            //     var datasets = [{
                                            //         label: 'Total Jumlah Tamu',
                                            //         backgroundColor: 'rgb(255,211,148)',
                                            //         borderColor: '#F57009',
                                            //         fill: false,
                                            //         tension: 0,
                                            //         data: jumlah_tamu[selectedYear]
                                            //     }];
                                            // }

                                            chart = new Chart(ctx, {
                                                type: "line",
                                                data: {
                                                    labels: labels,
                                                    datasets: datasets,
                                                },
                                                options: {
                                                    title: {
                                                        display: true,
                                                        text: 'Statistik Konsultasi'
                                                    },
                                                    scales: {
                                                        yAxes: [{
                                                            ticks: {
                                                                min: 0,
                                                                max: 10
                                                            }
                                                        }]
                                                    }
                                                }
                                            });
                                        }

                                        updateChart();
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="/assets/plugins/jquery/jquery.min.js"></script>
        <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/dist/js/adminlte.min.js"></script>
        <script src="/assets/dist/js/demo.js"></script>
        <script src="/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="/assets/plugins/chart.js/Chart.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
        <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://momentjs.com/downloads/moment.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
        @livewireScripts
</body>

</html>
