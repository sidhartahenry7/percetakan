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
                        <h4 class="card-title">Laporan Pembelian</h4>
                    </div>
                </div>
                <hr style="height: 10px;">
            </div>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-0">
                <ul class="navbar-nav nav-fill w-100">
                    <li class="nav-item">
                        <a class="nav-link" id="laporan_bahan_baku_show" href="#">Laporan Pembelian Bahan Baku</a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link" id="laporan_tinta_show" href="#">Laporan Pembelian Tinta</a>
                    </li>
                </ul>
            </nav>
            <div id="laporan_pembelian_bahan_baku">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Laporan Pembelian Bahan Baku</h4>
                        </div>
                    </div>
                    <hr style="height: 10px;">
                </div>
                <!--Content-->
                <div id="bahan-harga">
                    <p id="date_filter">
                        <span id="date-label-from" class="date-label">From: </span><input type="date" id="min_bahan_baku" name="min_bahan_baku" value="{{ date('Y-m-d') }}"/>
                        <span id="date-label-to" class="date-label">To: </span><input type="date" id="max_bahan_baku" name="max_bahan_baku" value="{{ date('Y-m-d') }}"/>
                        <span id="bahan_dropdown-label">Bahan Baku: </span>
                            <select id="bahan_dropdown">
                                <option selected="" value="All">All</option>
                                @foreach ($list_bahan_baku as $bahan)
                                    @isset($bahan->ukuran)
                                    <option value="{{ $bahan->id }}">{{ $bahan->jenis_kertas. ' ' .$bahan->ukuran }}</option>
                                    @else
                                    <option value="{{ $bahan->id }}">{{ $bahan->jenis_kertas. ' ' .$bahan->lebar." x ".$bahan->panjang." ".$bahan->satuan }}</option>
                                    @endisset
                                @endforeach
                            </select>
                        </span>
                        <button type="button" class="btn" style="background-color: #EC268F; color: white;" id="create_bahan_baku">Create</button>
                    </p>
                    <canvas id="myChartBahanBaku" style="width:100%;"></canvas>
                </div>
                <br>
                <div id="bahan-jumlah">
                    <p id="date_filter">
                        <span id="date-label-from" class="date-label">From: </span><input type="date" id="min_bahan_baku_jumlah" name="min_bahan_baku_jumlah" value="{{ date('Y-m-d') }}"/>
                        <span id="date-label-to" class="date-label">To: </span><input type="date" id="max_bahan_baku_jumlah" name="max_bahan_baku_jumlah" value="{{ date('Y-m-d') }}"/>
                        <span id="bahan_dropdown-label">Bahan Baku: </span>
                            <select id="bahan_dropdown_jumlah">
                                {{-- <option selected="" value="All">All</option> --}}
                                @foreach ($list_bahan_baku as $bahan)
                                    @isset($bahan->ukuran)
                                    <option value="{{ $bahan->id }}">{{ $bahan->jenis_kertas. ' ' .$bahan->ukuran }}</option>
                                    @else
                                    <option value="{{ $bahan->id }}">{{ $bahan->jenis_kertas. ' ' .$bahan->lebar." x ".$bahan->panjang." ".$bahan->satuan }}</option>
                                    @endisset
                                @endforeach
                            </select>
                        </span>
                        <button type="button" class="btn" style="background-color: #EC268F; color: white;" id="create_bahan_baku_jumlah">Create</button>
                    </p>
                    <canvas id="myChartBahanBakuJumlah" style="width:100%;"></canvas>
                </div>
            </div>
            <div id="laporan_pembelian_tinta">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Laporan Pembelian Tinta</h4>
                        </div>
                    </div>
                    <hr style="height: 10px;">
                </div>
                <!--Content-->
                <div id="tinta-harga">
                    <p id="date_filter">
                        <span id="date-label-from" class="date-label">From: </span><input type="date" id="min_tinta" name="min_tinta" value="{{ date('Y-m-d') }}"/>
                        <span id="date-label-to" class="date-label">To: </span><input type="date" id="max_tinta" name="max_tinta" value="{{ date('Y-m-d') }}"/>
                        <span id="tinta_dropdown-label">Jenis Tinta: </span>
                            <select id="tinta_dropdown">
                                <option selected="" value="All">All</option>
                                @foreach ($list_tinta as $tintas)
                                    <option value="{{ $tintas->id }}">{{ $tintas->tinta->jenis_tinta. ' ' .$tintas->warna }}</option>
                                @endforeach
                            </select>
                        </span>
                        <button type="button" class="btn" style="background-color: #EC268F; color: white;" id="create_tinta">Create</button>
                    </p>
                    <canvas id="myChartTinta" style="width:100%;"></canvas>
                </div>
                <br>
                <div id="tinta-jumlah">
                    <p id="date_filter">
                        <span id="date-label-from" class="date-label">From: </span><input type="date" id="min_tinta_jumlah" name="min_tinta_jumlah"/>
                        <span id="date-label-to" class="date-label">To: </span><input type="date" id="max_tinta_jumlah" name="max_tinta_jumlah"/>
                        <span id="tinta_dropdown-label">Jenis Tinta: </span>
                            <select id="tinta_dropdown_jumlah">
                                <option selected="" value="All">All</option>
                                @foreach ($list_tinta as $tintas)
                                    <option value="{{ $tintas->id }}">{{ $tintas->tinta->jenis_tinta. ' ' .$tintas->warna }}</option>
                                @endforeach
                            </select>
                        </span>
                        <button type="button" class="btn" style="background-color: #EC268F; color: white;" id="create_tinta_jumlah">Create</button>
                    </p>
                    <canvas id="myChartTintaJumlah" style="width:100%;"></canvas>
                </div>
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
        var xValuesBahanBaku = [];
        var yValuesBahanBaku = [];
        var xValuesBahanBakuJumlah = [];
        var yValuesBahanBakuJumlah = [];
        var xValuesTinta = [];
        var yValuesTinta = [];
        var barColors = '#9BD0F5';

        $(document).ready(function() {
            $("#laporan_pembelian_bahan_baku").show();
            $("#laporan_pembelian_tinta").hide();
            $('#bahan_dropdown').select2();
            $('#bahan_dropdown_jumlah').select2();
            $('#tinta_dropdown').select2({
                width:'15%'
            });
            $('#tinta_dropdown_jumlah').select2({
                width:'15%'
            });

            const myBarChartBahanBaku = new Chart("myChartBahanBaku", {
                type: "bar",
                data: {},
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Data Pembelian Bahan Baku Berdasarkan Harga"
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
                        // tooltip: {
                        //     callbacks: {
                        //         label: function(context) {
                        //             let label = '';
                        //             console.log(context);
                        //             if (context.parsed.yValuesBahanBaku !== null) {
                        //                 label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'IDR' }).format(context.parsed.yValuesBahanBaku);
                        //             }
                        //             return label;
                        //         }
                        //     }
                        // }
                    }
                }
            });
            $('#create_bahan_baku').on('click', function () {
                xValuesBahanBaku = [];
                yValuesBahanBaku = [];
                var min_bahan_baku = $('#min_bahan_baku').val();
                var max_bahan_baku = $('#max_bahan_baku').val();
                var produk_id = $('#bahan_dropdown').val();
                $.ajax({
                    url: "{{url('/api/laporan-pembelian-bahan-baku')}}",
                    type: 'POST',
                    data: {
                        min_bahan_baku:min_bahan_baku,
                        max_bahan_baku:max_bahan_baku,
                        produk_id:produk_id,
                        _token:'{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $.each(result, function (key, value) { 
                            xValuesBahanBaku.push(value.tanggal);
                            yValuesBahanBaku.push(value.harga);
                        });
                        myBarChartBahanBaku.data = {
                            labels: xValuesBahanBaku,
                            datasets: [{
                                backgroundColor: barColors,
                                data: yValuesBahanBaku
                            }]
                        };
                        myBarChartBahanBaku.plugins = {
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            console.log(context);
                                            let label = context.dataset.label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            if (context.parsed.yValuesBahanBaku !== null) {
                                                label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(context.parsed.yValuesBahanBaku);
                                            }
                                            return label;
                                        }
                                    }
                                }
                            }
                        }
                        myBarChartBahanBaku.update();
                    }
                });
            });

            const myBarChartBahanBakuJumlah = new Chart("myChartBahanBakuJumlah", {
                type: "bar",
                data: {},
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Data Pembelian Bahan Baku Berdasarkan Jumlah"
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
            $('#create_bahan_baku_jumlah').on('click', function () {
                xValuesBahanBakuJumlah = [];
                yValuesBahanBakuJumlah = [];
                var min_bahan_baku_jumlah = $('#min_bahan_baku_jumlah').val();
                var max_bahan_baku_jumlah = $('#max_bahan_baku_jumlah').val();
                var produk_id_jumlah = $('#bahan_dropdown_jumlah').val();
                $.ajax({
                    url: "{{url('/api/laporan-pembelian-bahan-baku-jumlah')}}",
                    type: 'POST',
                    data: {
                        min_bahan_baku_jumlah:min_bahan_baku_jumlah,
                        max_bahan_baku_jumlah:max_bahan_baku_jumlah,
                        produk_id_jumlah:produk_id_jumlah,
                        _token:'{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $.each(result, function (key, value) { 
                            xValuesBahanBakuJumlah.push(value.tanggal);
                            yValuesBahanBakuJumlah.push(value.jumlah);
                        });
                        myBarChartBahanBakuJumlah.data = {
                            labels: xValuesBahanBakuJumlah,
                            datasets: [{
                                backgroundColor: barColors,
                                data: yValuesBahanBakuJumlah
                            }]
                        };
                        myBarChartBahanBakuJumlah.update();
                    }
                });
            });

            const myBarChartTinta = new Chart("myChartTinta", {
                type: "bar",
                data: {},
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Data Pembelian Tinta Berdasarkan Harga"
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
            $('#create_tinta').on('click', function () {
                xValuesTinta = [];
                yValuesTinta = [];
                var min_tinta = $('#min_tinta').val();
                var max_tinta = $('#max_tinta').val();
                var tinta_id = $('#tinta_dropdown').val();
                $.ajax({
                    url: "{{url('/api/laporan-pembelian-tinta')}}",
                    type: 'POST',
                    data: {
                        min_tinta:min_tinta,
                        max_tinta:max_tinta,
                        tinta_id:tinta_id,
                        _token:'{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $.each(result, function (key, value) { 
                            xValuesTinta.push(value.tanggal);
                            yValuesTinta.push(value.harga);
                        });
                        myBarChartTinta.data = {
                            labels: xValuesTinta,
                            datasets: [{
                                backgroundColor: barColors,
                                data: yValuesTinta
                            }]
                        };
                        myBarChartTinta.update();
                    }
                });
            });

            const myBarChartTintaJumlah = new Chart("myChartTintaJumlah", {
                type: "bar",
                data: {},
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Data Pembelian Tinta Berdasarkan Jumlah"
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
            $('#create_tinta_jumlah').on('click', function () {
                xValuesTintaJumlah = [];
                yValuesTintaJumlah = [];
                var min_tinta_jumlah = $('#min_tinta_jumlah').val();
                var max_tinta_jumlah = $('#max_tinta_jumlah').val();
                var tinta_id_jumlah = $('#tinta_dropdown_jumlah').val();
                $.ajax({
                    url: "{{url('/api/laporan-pembelian-tinta-jumlah')}}",
                    type: 'POST',
                    data: {
                        min_tinta_jumlah:min_tinta_jumlah,
                        max_tinta_jumlah:max_tinta_jumlah,
                        tinta_id_jumlah:tinta_id_jumlah,
                        _token:'{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $.each(result, function (key, value) { 
                            xValuesTintaJumlah.push(value.tanggal);
                            yValuesTintaJumlah.push(value.jumlah);
                        });
                        myBarChartTintaJumlah.data = {
                            labels: xValuesTintaJumlah,
                            datasets: [{
                                backgroundColor: barColors,
                                data: yValuesTintaJumlah
                            }]
                        };
                        myBarChartTintaJumlah.update();
                    }
                });
            });

            $('#laporan_bahan_baku_show').on('click', function () {
                $("#laporan_pembelian_bahan_baku").show();
                $("#laporan_pembelian_tinta").hide();
            });
            $('#laporan_tinta_show').on('click', function () {
                $("#laporan_pembelian_bahan_baku").hide();
                $("#laporan_pembelian_tinta").show();
            });
        });
    </script>
</body>
</html>