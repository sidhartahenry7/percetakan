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
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label id="date-label-from" class="date-label">From: </label>
                                <input type="date" id="min_bahan_baku" name="min_bahan_baku" class="form-control" value="{{ date('Y-m-d') }}"/>
                            </div>
                            <div class="col-sm-2">
                                <label id="date-label-to" class="date-label">To: </label>
                                <input type="date" id="max_bahan_baku" name="max_bahan_baku" class="form-control" value="{{ date('Y-m-d') }}"/>
                            </div>
                            <div class="col-sm-3">
                                <label id="bahan_dropdown-label">Bahan Baku: </label>
                                <select id="bahan_dropdown" class="form-control">
                                    <option selected="" value="All">All</option>
                                    @foreach ($list_bahan_baku as $bahan)
                                        @isset($bahan->ukuran)
                                        <option value="{{ $bahan->id }}">{{ $bahan->jenis_kertas. ' ' .$bahan->ukuran }}</option>
                                        @else
                                        <option value="{{ $bahan->id }}">{{ $bahan->jenis_kertas. ' ' .$bahan->lebar." x ".$bahan->panjang." ".$bahan->satuan }}</option>
                                        @endisset
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label id="cabang_dropdown_bahan_harga-label">Cabang: </label>
                                <select id="cabang_dropdown_bahan_harga" class="form-control">
                                    <option selected="" value="All">All</option>
                                    @foreach ($list_cabang as $cabang)
                                    <option value="{{ $cabang->id }}">{{ $cabang->nama_cabang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 d-flex justify-content-center align-items-center">
                                <div class="d-inline">
                                    <button type="button" class="btn" style="background-color: #EC268F; color: white;" id="create_bahan_baku">Create</button>
                                    <button onclick="CreatePDFPembelianBahanHarga()" id="downloadPembelianBahanHarga" type="button" class="btn" style="background-color: #29a4da; color: white;"><span class="material-icons align-middle">download</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <canvas id="myChartBahanBaku" style="width:100%;"></canvas>
                    <div id="keterangan_bahan"></div>
                </div>
                <br>
                <div id="bahan-jumlah">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label id="date-label-from" class="date-label">From: </label>
                                <input type="date" id="min_bahan_baku_jumlah" name="min_bahan_baku_jumlah" class="form-control" value="{{ date('Y-m-d') }}"/>
                            </div>
                            <div class="col-sm-2">
                                <label id="date-label-to" class="date-label">To: </label>
                                <input type="date" id="max_bahan_baku_jumlah" name="max_bahan_baku_jumlah" class="form-control" value="{{ date('Y-m-d') }}"/>
                            </div>
                            <div class="col-sm-3">
                                <label id="bahan_dropdown-label">Bahan Baku: </label>
                                <select id="bahan_dropdown_jumlah" class="form-control">
                                    {{-- <option selected="" value="All">All</option> --}}
                                    @foreach ($list_bahan_baku as $bahan)
                                        @isset($bahan->ukuran)
                                        <option value="{{ $bahan->id }}">{{ $bahan->jenis_kertas. ' ' .$bahan->ukuran }}</option>
                                        @else
                                        <option value="{{ $bahan->id }}">{{ $bahan->jenis_kertas. ' ' .$bahan->lebar." x ".$bahan->panjang." ".$bahan->satuan }}</option>
                                        @endisset
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label id="cabang_dropdown_bahan_jumlah-label">Cabang: </label>
                                <select id="cabang_dropdown_bahan_jumlah" class="form-control">
                                    <option selected="" value="All">All</option>
                                    @foreach ($list_cabang as $cabang)
                                    <option value="{{ $cabang->id }}">{{ $cabang->nama_cabang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 d-flex justify-content-center align-items-center">
                                <div class="d-inline">
                                    <button type="button" class="btn" style="background-color: #EC268F; color: white;" id="create_bahan_baku_jumlah">Create</button>
                                    <button onclick="CreatePDFPembelianBahanJumlah()" id="downloadPembelianBahanJumlah" type="button" class="btn" style="background-color: #29a4da; color: white;"><span class="material-icons align-middle">download</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <canvas id="myChartBahanBakuJumlah" style="width:100%;"></canvas>
                    <div id="keterangan_bahan_jumlah"></div>
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
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label id="date-label-from" class="date-label">From: </label>
                                <input type="date" id="min_tinta" name="min_tinta" class="form-control" value="{{ date('Y-m-d') }}"/>
                            </div>
                            <div class="col-sm-2">
                                <label id="date-label-to" class="date-label">To: </label>
                                <input type="date" id="max_tinta" name="max_tinta" class="form-control" value="{{ date('Y-m-d') }}"/>
                            </div>
                            <div class="col-sm-3">
                                <label id="tinta_dropdown-label">Jenis Tinta: </label>
                                <select id="tinta_dropdown" class="form-control">
                                    <option selected="" value="All">All</option>
                                    @foreach ($list_tinta as $tintas)
                                        <option value="{{ $tintas->id }}">{{ $tintas->tinta->jenis_tinta. ' ' .$tintas->warna }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label id="cabang_dropdown_tinta_harga-label">Cabang: </label>
                                <select id="cabang_dropdown_tinta_harga" class="form-control">
                                    <option selected="" value="All">All</option>
                                    @foreach ($list_cabang as $cabang)
                                    <option value="{{ $cabang->id }}">{{ $cabang->nama_cabang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 d-flex justify-content-center align-items-center">
                                <div class="d-inline">
                                    <button type="button" class="btn" style="background-color: #EC268F; color: white;" id="create_tinta">Create</button>
                                    <button onclick="CreatePDFPembelianTintaHarga()" id="downloadPembelianTintaHarga" type="button" class="btn" style="background-color: #29a4da; color: white;"><span class="material-icons align-middle">download</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <canvas id="myChartTinta" style="width:100%;"></canvas>
                    <div id="keterangan_tinta"></div>
                </div>
                <br>
                <div id="tinta-jumlah">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label id="date-label-from" class="date-label">From: </label>
                                <input type="date" id="min_tinta_jumlah" name="min_tinta_jumlah" class="form-control" value="{{ date('Y-m-d') }}"/>
                            </div>
                            <div class="col-sm-2">
                                <label id="date-label-to" class="date-label">To: </label>
                                <input type="date" id="max_tinta_jumlah" name="max_tinta_jumlah" class="form-control" value="{{ date('Y-m-d') }}"/>
                            </div>
                            <div class="col-sm-3">
                                <label id="tinta_dropdown-label">Jenis Tinta: </label>
                                <select id="tinta_dropdown_jumlah" class="form-control">
                                    <option selected="" value="All">All</option>
                                    @foreach ($list_tinta as $tintas)
                                        <option value="{{ $tintas->id }}">{{ $tintas->tinta->jenis_tinta. ' ' .$tintas->warna }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label id="cabang_dropdown_tinta_jumlah-label">Cabang: </label>
                                <select id="cabang_dropdown_tinta_jumlah" class="form-control">
                                    <option selected="" value="All">All</option>
                                    @foreach ($list_cabang as $cabang)
                                    <option value="{{ $cabang->id }}">{{ $cabang->nama_cabang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 d-flex justify-content-center align-items-center">
                                <div class="d-inline">
                                    <button type="button" class="btn" style="background-color: #EC268F; color: white;" id="create_tinta_jumlah">Create</button>
                                    <button onclick="CreatePDFPembelianTintaJumlah()" id="downloadPembelianTintaJumlah" type="button" class="btn" style="background-color: #29a4da; color: white;"><span class="material-icons align-middle">download</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <canvas id="myChartTintaJumlah" style="width:100%;"></canvas>
                    <div id="keterangan_tinta_jumlah"></div>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

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
            $('#cabang_dropdown_bahan_harga').select2();
            $('#cabang_dropdown_bahan_jumlah').select2();
            $('#bahan_dropdown_jumlah').select2();
            // $('#tinta_dropdown').select2();
            // $('#cabang_dropdown_tinta_harga').select2();
            // $('#tinta_dropdown_jumlah').select2();
            // $('#cabang_dropdown_tinta_jumlah').select2();

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
                var cabang_id = $('#cabang_dropdown_bahan_harga').val();
                $.ajax({
                    url: "{{url('/api/laporan-pembelian-bahan-baku')}}",
                    type: 'POST',
                    data: {
                        min_bahan_baku:min_bahan_baku,
                        max_bahan_baku:max_bahan_baku,
                        produk_id:produk_id,
                        cabang_id:cabang_id,
                        _token:'{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        if(result.length === 0) {
                            $('#myChartBahanBaku').hide();
                            $('#keterangan_bahan').html('<center><h4>Data Tidak Ditemukan</h4></<center>');
                        }
                        else {
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
                            $('#myChartBahanBaku').show();
                            $('#keterangan_bahan').html('');
                        }
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
                var cabang_id = $('#cabang_dropdown_bahan_jumlah').val();
                $.ajax({
                    url: "{{url('/api/laporan-pembelian-bahan-baku-jumlah')}}",
                    type: 'POST',
                    data: {
                        min_bahan_baku_jumlah:min_bahan_baku_jumlah,
                        max_bahan_baku_jumlah:max_bahan_baku_jumlah,
                        produk_id_jumlah:produk_id_jumlah,
                        cabang_id:cabang_id,
                        _token:'{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        if(result.length === 0) {
                            $('#myChartBahanBakuJumlah').hide();
                            $('#keterangan_bahan_jumlah').html('<center><h4>Data Tidak Ditemukan</h4></<center>');
                        }
                        else {
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
                            $('#myChartBahanBakuJumlah').show();
                            $('#keterangan_bahan_jumlah').html('');
                        }
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
                var cabang_id = $('#cabang_dropdown_tinta_harga').val();
                $.ajax({
                    url: "{{url('/api/laporan-pembelian-tinta')}}",
                    type: 'POST',
                    data: {
                        min_tinta:min_tinta,
                        max_tinta:max_tinta,
                        tinta_id:tinta_id,
                        cabang_id:cabang_id,
                        _token:'{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        if(result.length === 0) {
                            $('#myChartTinta').hide();
                            $('#keterangan_tinta').html('<center><h4>Data Tidak Ditemukan</h4></<center>');
                        }
                        else {
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
                            $('#myChartTinta').show();
                            $('#keterangan_tinta').html('');
                        }
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
                var cabang_id = $('#cabang_dropdown_tinta_jumlah').val();
                $.ajax({
                    url: "{{url('/api/laporan-pembelian-tinta-jumlah')}}",
                    type: 'POST',
                    data: {
                        min_tinta_jumlah:min_tinta_jumlah,
                        max_tinta_jumlah:max_tinta_jumlah,
                        tinta_id_jumlah:tinta_id_jumlah,
                        cabang_id:cabang_id,
                        _token:'{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        if(result.length === 0) {
                            $('#myChartTintaJumlah').hide();
                            $('#keterangan_tinta_jumlah').html('<center><h4>Data Tidak Ditemukan</h4></<center>');
                        }
                        else {
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
                            $('#myChartTintaJumlah').show();
                            $('#keterangan_tinta_jumlah').html('');
                        }
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

        //Create PDf from HTML...
        function CreatePDFPembelianBahanHarga() {
            var HTML_Width = $("#bahan-harga").width();
            var HTML_Height = $("#bahan-harga").height();
            var top_left_margin = 100;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            $("#bahan-jumlah").hide();
            $("#create_bahan_baku").hide();
            $("#downloadPembelianBahanHarga").hide();

            html2canvas($("#laporan_pembelian_bahan_baku")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                // var pdf = new jsPDF('p', 'mm', [210, 270]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save("Laporan_Pembelian_Bahan_Baku_Harga.pdf");
                // $(".html-content").hide();
                $("#bahan-jumlah").show();
                $("#create_bahan_baku").show();
                $("#downloadPembelianBahanHarga").show();
            });
        }

        function CreatePDFPembelianBahanJumlah() {
            var HTML_Width = $("#bahan-jumlah").width();
            var HTML_Height = $("#bahan-jumlah").height();
            var top_left_margin = 100;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            $("#bahan-harga").hide();
            $("#create_bahan_baku_jumlah").hide();
            $("#downloadPembelianBahanJumlah").hide();

            html2canvas($("#laporan_pembelian_bahan_baku")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                // var pdf = new jsPDF('p', 'mm', [210, 270]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save("Laporan_Pembelian_Bahan_Baku_Jumlah.pdf");
                // $(".html-content").hide();
                $("#bahan-harga").show();
                $("#create_bahan_baku_jumlah").show();
                $("#downloadPembelianBahanJumlah").show();
            });
        }

        function CreatePDFPembelianTintaHarga() {
            var HTML_Width = $("#tinta-harga").width();
            var HTML_Height = $("#tinta-harga").height();
            var top_left_margin = 100;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            $("#tinta-jumlah").hide();
            $("#create_tinta").hide();
            $("#downloadPembelianTintaHarga").hide();

            html2canvas($("#laporan_pembelian_tinta")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                // var pdf = new jsPDF('p', 'mm', [210, 270]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save("Laporan_Pembelian_Tinta_Harga.pdf");
                // $(".html-content").hide();
                $("#tinta-jumlah").show();
                $("#create_tinta").show();
                $("#downloadPembelianTintaHarga").show();
            });
        }

        function CreatePDFPembelianTintaJumlah() {
            var HTML_Width = $("#tinta-jumlah").width();
            var HTML_Height = $("#tinta-jumlah").height();
            var top_left_margin = 100;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            $("#tinta-harga").hide();
            $("#create_tinta_jumlah").hide();
            $("#downloadPembelianTintaJumlah").hide();

            html2canvas($("#laporan_pembelian_tinta")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                // var pdf = new jsPDF('p', 'mm', [210, 270]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save("Laporan_Pembelian_Tinta_Jumlah.pdf");
                // $(".html-content").hide();
                $("#tinta-harga").show();
                $("#create_tinta_jumlah").show();
                $("#downloadPembelianTintaJumlah").show();
            });
        }
    </script>
</body>
</html>