@include('layouts.main')
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid black;
            text-align: center;
            padding: 8px;
            color: black;
        }

        body {
            background-color: #f7f8f8;
        }

        #sidebar {
            background-color: #FFC300;
        }

        .form-control {
            border: 1px solid black;
        }
        .spek {
            text-align: left;
        }
        label {
            color: black;
        }

    </style>
</head>
<body>
    <div class="wrapper d-flex align-items-stretch">
        @include('partials.navbar')
        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Dashboard</h4>
                    </div>
                </div>
                <hr style="height: 10px;">
            </div>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-0">
                <ul class="navbar-nav nav-fill w-100">
                    <li class="nav-item">
                        <a class="nav-link" id="bahan_baku" href="#">Stok Bahan Baku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tinta" href="#">Stok Tinta</a>
                    </li>
                </ul>
            </nav>
            <div id="stok_bahan_baku">
                <div id="stok_bahan_baku_lembar">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Stok Bahan Baku Lembaran</h4>
                            </div>
                        </div>
                        <hr style="height: 10px;">
                    </div>
                    <!--Content-->
                    <canvas id="myChartBahanBakuLembar" style="width:100%;"></canvas>
                </div>
                <br>
                <div id="stok_bahan_baku_meter">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Stok Bahan Baku Meteran</h4>
                            </div>
                        </div>
                        <hr style="height: 10px;">
                    </div>
                    <!--Content-->
                    <canvas id="myChartBahanBakuMeter" style="width:100%;"></canvas>
                </div>
            </div>
            <div id="stok_tinta">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Stok Tinta</h4>
                        </div>
                    </div>
                    <hr style="height: 10px;">
                </div>
                <!--Content-->
                <canvas id="myChartTinta" style="width:100%;"></canvas>
            </div>
        </div>
    </div>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-autocolors"></script>

    <script>
        var xValuesBahanBakuLembar = [];
        var yValuesBahanBakuLembar = [];
        var xValuesBahanBakuMeter = [];
        var yValuesBahanBakuMeter = [];
        var xValuesTinta = [];
        var yValuesTinta = [];
        var barColors = '#9BD0F5';

        $(document).ready(function() {
            $("#stok_bahan_baku").show();
            $("#stok_tinta").hide();

            var data_bahan_lembar = JSON.parse({!! json_encode($data_bahan_lembar) !!});
            $.each(data_bahan_lembar, function (key, value) { 
                xValuesBahanBakuLembar.push(value.nama_bahan_lembar);
                yValuesBahanBakuLembar.push(value.quantity_bahan_lembar);
            });
            const myBarChartBahanBakuLembar = new Chart("myChartBahanBakuLembar", {
                type: "bar",
                data: {
                    labels: xValuesBahanBakuLembar,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValuesBahanBakuLembar
                    }]
                },
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Jumlah Stok Bahan Baku Lembaran Tersisa"
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            ticks: {
                                suggestedMin: 0
                            }
                        }]
                    },
                    plugins: {}
                }
            });
            
            var data_bahan_meter = JSON.parse({!! json_encode($data_bahan_meter) !!});
            $.each(data_bahan_meter, function (key, value) { 
                xValuesBahanBakuMeter.push(value.nama_bahan_meter);
                yValuesBahanBakuMeter.push(value.quantity_bahan_meter);
            });
            const myBarChartBahanBakuMeter = new Chart("myChartBahanBakuMeter", {
                type: "bar",
                data: {
                    labels: xValuesBahanBakuMeter,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValuesBahanBakuMeter
                    }]
                },
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Jumlah Stok Bahan Baku Meteran Tersisa"
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            ticks: {
                                suggestedMin: 0
                            }
                        }]
                    },
                    plugins: {}
                }
            });
            
            var data_tinta = JSON.parse({!! json_encode($data_tinta) !!});
            $.each(data_tinta, function (key, value) { 
                xValuesTinta.push(value.nama_tinta);
                yValuesTinta.push(value.quantity);
            });
            const myBarChartTinta = new Chart("myChartTinta", {
                type: "bar",
                data: {
                    labels: xValuesTinta,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValuesTinta
                    }]
                },
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Jumlah Stok Tinta Tersisa"
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            ticks: {
                                suggestedMin: 0
                            }
                        }]
                    },
                    plugins: {}
                }
            });

            $('#bahan_baku').on('click', function () {
                $("#stok_bahan_baku").show();
                $("#stok_tinta").hide();
            });
            $('#tinta').on('click', function () {
                $("#stok_bahan_baku").hide();
                $("#stok_tinta").show();
            });
        });
    </script>
</body>
</html>