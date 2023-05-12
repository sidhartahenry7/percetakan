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
                        <a class="nav-link" id="laporan_produk_laris_jumlah" href="#">Penjualan Terlaris Berdasarkan Jumlah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="laporan_produk_laris_harga" href="#">Penjualan Terlaris Berdasarkan Harga</a>
                    </li>
                </ul>
            </nav>
            <div id="laporan_laris_jumlah">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Penjualan Terlaris Berdasarkan Jumlah</h4>
                        </div>
                    </div>
                    <hr style="height: 10px;">
                </div>
                <!--Content-->
                <canvas id="myChartLarisJumlah" style="width:100%;"></canvas>
            </div>
            <div id="laporan_laris_harga">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Penjualan Terlaris Berdasarkan Harga</h4>
                        </div>
                    </div>
                    <hr style="height: 10px;">
                </div>
                <!--Content-->
                <canvas id="myChartLarisHarga" style="width:100%;"></canvas>
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
        var xValuesLarisJumlah = [];
        var yValuesLarisJumlah = [];
        var xValuesLarisHarga = [];
        var yValuesLarisHarga = [];
        var barColors = '#9BD0F5';

        $(document).ready(function() {
            $("#laporan_laris_jumlah").show();
            $("#laporan_laris_harga").hide();

            const myBarChart = new Chart("myChart", {
                type: "bar",
                data: {},
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Data Penjualan Produk"
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            ticks: {
                                suggestedMin: 0
                            }
                        }]
                    },
                    plugins: {
                        autocolors: {
                            customize(context) {
                                const colors = context.colors;
                                return {
                                    background: lighten(colors.background, 0.5),
                                    border: lighten(colors.border, 0.5)
                                };
                            }
                        }
                    }
                }
            });
            $('#create').on('click', function () {
                xValues = [];
                yValues = [];
                var min = $('#min').val();
                var max = $('#max').val();
                var produk_id = $('#produk_dropdown').val();
                $.ajax({
                    url: "{{url('/api/laporan-penjualan-produk')}}",
                    type: 'POST',
                    data: {
                        min:min,
                        max:max,
                        produk_id:produk_id,
                        _token:'{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $.each(result.jumlah_per_produk, function (key, jumlah_per_produk) { 
                            xValues.push(jumlah_per_produk.nama_produk);
                            yValues.push(jumlah_per_produk.jumlah);
                        });
                        myBarChart.data = {
                            labels: xValues,
                            datasets: [{
                                backgroundColor: barColors,
                                data: yValues
                            }]
                        };
                        myBarChart.update();
                    }
                });
            });

            var laris_jumlah = JSON.parse({!! json_encode($laris_jumlah) !!});
            $.each(laris_jumlah, function (key, value) { 
                xValuesLarisJumlah.push(value.nama);
                yValuesLarisJumlah.push(value.jumlah);
            });
            const myBarChartLarisJumlah = new Chart("myChartLarisJumlah", {
                type: "bar",
                data: {
                    labels: xValuesLarisJumlah,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValuesLarisJumlah
                    }]
                },
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Data Produk Terlaris Berdasarkan Jumlah"
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

            var laris_harga = JSON.parse({!! json_encode($laris_harga) !!});
            $.each(laris_harga, function (key, value) { 
                xValuesLarisHarga.push(value.nama);
                yValuesLarisHarga.push(value.harga);
            });
            const myBarChartLarisHarga = new Chart("myChartLarisHarga", {
                type: "bar",
                data: {
                    labels: xValuesLarisHarga,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValuesLarisHarga
                    }]
                },
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Data Produk Terlaris Berdasarkan Harga"
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

            $('#laporan_produk_laris_jumlah').on('click', function () {
                $("#laporan_laris_jumlah").show();
                $("#laporan_laris_harga").hide();
            });
            $('#laporan_produk_laris_harga').on('click', function () {
                $("#laporan_laris_jumlah").hide();
                $("#laporan_laris_harga").show();
            });
        });
    </script>
</body>
</html>