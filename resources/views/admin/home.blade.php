@extends('layouts.layout-admin')

@section('container')
    <div class="container mt-3">
        <div class="row">
            <div class="col d-flex justify-content-end mb-3">
                <a href="#" class="btn btn-success mr-3" id="openModalButton" data-toggle="modal"
                    data-target="#fileInputModal">Import Excel</a>
                <a href="{{ route('export-pdf') }}" class="btn btn-secondary">Review Dashboard</a>
            </div>
            <script></script>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="fileInputModal" tabindex="-1" role="dialog" aria-labelledby="fileInputModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fileInputModalLabel">Upload Excel File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form input file -->
                        <form action="{{ route('admin-import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col d-flex align-items-center">
                                    <input type="file" name="file" class="form-control">
                                    <button type="submit" class="btn btn-primary ml-3">Import</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="dashboard">
            {{-- <div class="row">
                <div class="col-lg-4 margin-tb">
                    <canvas id="total_done" width="200" height="200"></canvas>
                </div>
                <div class="col-lg-4 margin-tb">
                    <canvas id="total_progress" width="200" height="200"></canvas>
                </div>
                <div class="col-lg-4 margin-tb">
                    <canvas id="total_open" width="200" height="200"></canvas>
                </div>
            </div>
            <script>
                var ctx1 = document.getElementById('total_done').getContext('2d');
                var ctx2 = document.getElementById('total_progress').getContext('2d');
                var ctx3 = document.getElementById('total_open').getContext('2d');

                var currentDate = new Date();
                var currentYear = currentDate.getFullYear();
                var currentMonth = currentDate.getMonth();

                var jumlah_selesai = <?php echo json_encode($jumlah_konsultasi_selesai); ?>;
                var jumlah_proses = <?php echo json_encode($jumlah_konsultasi_proses); ?>;
                var jumlah_dibuka = <?php echo json_encode($jumlah_konsultasi_dibuka); ?>;

                var currentValue1 = jumlah_selesai[currentYear][currentMonth];
                var currentValue2 = jumlah_proses[currentYear][currentMonth];
                var currentValue3 = jumlah_dibuka[currentYear][currentMonth];

                var data1 = {
                    datasets: [{
                        data: [currentValue1],
                        backgroundColor: ['rgba(75, 192, 192, 0.2)'],
                        borderColor: ['rgba(75, 192, 192, 1)'],
                        borderWidth: 1
                    }]
                };

                var data2 = {
                    datasets: [{
                        data: [currentValue2],
                        backgroundColor: ['rgba(255, 99, 132, 0.2)'],
                        borderColor: ['rgba(255, 99, 132, 1)'],
                        borderWidth: 1
                    }]
                };

                var data3 = {
                    datasets: [{
                        data: [currentValue3],
                        backgroundColor: ['rgba(54, 162, 235, 0.2)'],
                        borderColor: ['rgba(54, 162, 235, 1)'],
                        borderWidth: 1
                    }]
                };

                var options1 = {
                    responsive: true,
                    rotation: -Math.PI,
                    cutoutPercentage: 80,
                    circumference: Math.PI,
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Konsultasi Selesai Bulan Ini',
                    },
                    scales: {
                        x: {
                            display: false
                        },
                        y: {
                            display: false
                        }
                    }
                };

                var options2 = {
                    responsive: true,
                    rotation: -Math.PI,
                    cutoutPercentage: 80,
                    circumference: Math.PI,
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Konsultasi Progress Bulan Ini'
                    },
                    scales: {
                        x: {
                            display: false
                        },
                        y: {
                            display: false
                        }
                    }
                };

                var options3 = {
                    responsive: true,
                    rotation: -Math.PI,
                    cutoutPercentage: 80,
                    circumference: Math.PI,
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Konsultasi Open Bulan Ini',
                    },
                    scales: {
                        x: {
                            display: false
                        },
                        y: {
                            display: false
                        }
                    }
                };

                var gaugeChart1 = new Chart(ctx1, {
                    type: 'doughnut',
                    data: data1,
                    options: options1
                });

                var gaugeChart2 = new Chart(ctx2, {
                    type: 'doughnut',
                    data: data2,
                    options: options2
                });

                var gaugeChart3 = new Chart(ctx3, {
                    type: 'doughnut',
                    data: data3,
                    options: options3
                });
            </script> --}}

            <div class="row">
                <div class="col-lg-6 margin-tb">
                    <div class="card" style="width: 100%; background-color: #FDE4D0">
                        <div class="card-header">
                            <h5 class="card-title">Presentase Jumlah Konsultasi</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 margin-tb">

                                    <canvas id="pieChart" style="width:100%;max-width:700px;"></canvas>

                                    <script>
                                        var xValues = [
                                            'Done', 'Progress', 'Open',
                                        ];

                                        var jumlah_selesai = <?php echo json_encode($jumlah_konsultasi_selesai); ?>;
                                        var jumlah_proses = <?php echo json_encode($jumlah_konsultasi_proses); ?>;
                                        var jumlah_dibuka = <?php echo json_encode($jumlah_konsultasi_dibuka); ?>;

                                        var totalDone = 0;
                                        var totalProgress = 0;
                                        var totalOpen = 0;

                                        for (var tahun in jumlah_selesai) {
                                            for (var bulan in jumlah_selesai[tahun]) {
                                                totalDone += jumlah_selesai[tahun][bulan];
                                            }
                                        }

                                        for (var tahun in jumlah_proses) {
                                            for (var bulan in jumlah_proses[tahun]) {
                                                totalProgress += jumlah_proses[tahun][bulan];
                                            }
                                        }

                                        for (var tahun in jumlah_dibuka) {
                                            for (var bulan in jumlah_dibuka[tahun]) {
                                                totalOpen += jumlah_dibuka[tahun][bulan];
                                            }
                                        }

                                        var yValuesTotal = totalDone + totalProgress + totalOpen;

                                        var yValues = [
                                            ((totalDone / yValuesTotal) * 100).toFixed(1),
                                            ((totalProgress / yValuesTotal) * 100).toFixed(1),
                                            ((totalOpen / yValuesTotal) * 100).toFixed(1),
                                        ]
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
                </div>


                <div class="col-lg-6 margin-tb">
                    <div class="card" style="width: 100%;background-color: #FDE4D0">
                        <div class="card-header">
                            <h5 class="card-title">Jumlah Konsultasi Selama 1 Tahun</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 margin-tb">

                                    <canvas id="barChart"></canvas>
                                    <script>
                                        var ctxbar = document.getElementById('barChart').getContext('2d');

                                        var labels = <?php echo json_encode($label); ?>;

                                        jumlah_selesai_all = [];
                                        for (var i = 0; i < labels.length; i++) {
                                            var total = 0;
                                            for (var tahun in jumlah_selesai) {
                                                total += jumlah_selesai[tahun][i];
                                            }
                                            jumlah_selesai_all[i] = total;
                                        }
                                        var data1 = jumlah_selesai_all

                                        jumlah_proses_all = [];
                                        for (var i = 0; i < labels.length; i++) {
                                            var total = 0;
                                            for (var tahun in jumlah_proses) {
                                                total += jumlah_proses[tahun][i];
                                            }
                                            jumlah_proses_all[i] = total;
                                        }
                                        var data2 = jumlah_proses_all

                                        jumlah_dibuka_all = [];
                                        for (var i = 0; i < labels.length; i++) {
                                            var total = 0;
                                            for (var tahun in jumlah_dibuka) {
                                                total += jumlah_dibuka[tahun][i];
                                            }
                                            jumlah_dibuka_all[i] = total;
                                        }
                                        var data3 = jumlah_dibuka_all

                                        var myBarChart = new Chart(ctxbar, {
                                            type: 'bar',
                                            data: {
                                                labels: labels,
                                                datasets: [{
                                                        label: 'Data 1',
                                                        data: data1,
                                                        backgroundColor: 'rgba(71, 42, 0, 0.8)',
                                                    },
                                                    {
                                                        label: 'Data 2',
                                                        data: data2,
                                                        backgroundColor: 'rgba(208, 122, 0, 0.8)',
                                                    },
                                                    {
                                                        label: 'Data 3',
                                                        data: data3,
                                                        backgroundColor: 'rgba(248, 145, 0, 0.8)',
                                                    },
                                                ],
                                            },
                                            options: {
                                                scales: {
                                                    x: {
                                                        stacked: true,
                                                    },
                                                    y: {
                                                        stacked: false,
                                                        beginAtZero: true,
                                                    },
                                                },
                                            },
                                        });
                                    </script>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 margin-tb">
                    <div class="card" style="width: 100%;background-color: #FDE4D0">
                        <div class="card-header">
                            <h5 class="card-title">Grafik Perkembangan Jumlah Konsultasi Selesai Tiap Bulan</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="d-flex align-items-center justify-content-end">
                                    <label class="form-label" style="margin-right: 10px" for="year">Filter
                                        Tahun</label>
                                    <select class="form-select w-25" id="year" onchange="updateChart()">
                                        <option value="all">All</option>
                                        @forelse ($jumlah_konsultasi_selesai as $tahun => $data)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-lg-12 margin-tb">

                                    <canvas id="lineChart"></canvas>

                                    <script>
                                        var ctx = document.getElementById("lineChart").getContext("2d");
                                        var chart;

                                        function updateChart() {
                                            var selectedYear = document.getElementById("year").value;

                                            if (chart) {
                                                chart.destroy();
                                            }

                                            var labels = <?php echo json_encode($label); ?>;
                                            var jumlah_selesai = {!! json_encode($jumlah_konsultasi_selesai) !!};

                                            if (selectedYear === 'all') {
                                                var jumlah_selesai_all = [];

                                                for (var i = 0; i < labels.length; i++) {
                                                    var total = 0;
                                                    for (var tahun in jumlah_selesai) {
                                                        total += jumlah_selesai[tahun][i];
                                                    }
                                                    jumlah_selesai_all[i] = total;
                                                }
                                                var datasets = [{
                                                    label: 'Total Jumlah Tamu',
                                                    backgroundColor: 'rgb(255,211,148)',
                                                    borderColor: '#F57009',
                                                    fill: false,
                                                    tension: 0,
                                                    data: jumlah_selesai_all
                                                }];
                                            } else {
                                                var datasets = [{
                                                    label: 'Total Jumlah Tamu',
                                                    backgroundColor: 'rgb(255,211,148)',
                                                    borderColor: '#F57009',
                                                    fill: false,
                                                    tension: 0,
                                                    data: jumlah_selesai[selectedYear]
                                                }];
                                            }

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
                <div class="col-lg-6 margin-tb">
                    <style>
                        .styled-table {
                            width: 100%;
                            border-collapse: collapse;
                            font-size: 14px;
                            text-align: left;
                        }

                        .styled-table th,
                        .styled-table td {
                            padding: 12px 15px;
                            font-size: 16px;
                            text-align: center;
                        }

                        .styled-table th {
                            background-color: #343a40;
                            color: white;
                        }

                        .styled-table tr:nth-child(even) {
                            background-color: #f2f2f2;
                        }

                        .styled-table tr:hover {
                            background-color: #ddd;
                        }
                    </style>
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>Tahun</th>
                                <th>Total Done</th>
                                <th>Total Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jumlah_konsultasi_selesai as $tahun => $bulan_data)
                                <tr>
                                    <td>{{ $tahun }}</td>
                                    <td>{{ array_sum($jumlah_konsultasi_selesai[$tahun]) }}</td>
                                    <td>{{ array_sum($jumlah_konsultasi_proses[$tahun]) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
