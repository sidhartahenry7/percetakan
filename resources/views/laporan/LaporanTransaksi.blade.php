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
                        <h4 class="card-title">Laporan Transaksi</h4>
                    </div>
                </div>
                <hr style="height: 10px;">
            </div>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-0">
                <ul class="navbar-nav nav-fill w-100">
                    <li class="nav-item">
                        <a class="nav-link" id="laporan_penjualan_produk_show" href="#">Laporan Penjualan Produk</a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link" id="laporan_transaksi_show" href="#">Laporan Jumlah Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="laporan_pendapatan_show" href="#">Laporan Pendapatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="laporan_produk_laris_show" href="#">Laporan Produk Terlaris</a>
                    </li>
                </ul>
            </nav>
            <div id='penjualan_produk'>
                <div id="laporan_penjualan_produk">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Laporan Penjualan Produk</h4>
                            </div>
                        </div>
                        <hr style="height: 10px;">
                    </div>
                    <!--Content-->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label id="date-label-from" class="date-label">From: </label>
                                <input type="date" id="min" name="min" class="form-control" value="{{ date('Y-m-d') }}"/>
                            </div>
                            <div class="col-sm-3">
                                <label id="date-label-to" class="date-label">To: </label>
                                <input type="date" id="max" name="max" class="form-control" value="{{ date('Y-m-d') }}"/>
                            </div>
                            <div class="col-sm-4">
                                <label id="produk_dropdown-label">Produk: </label>
                                <select id="produk_dropdown" class="form-control">
                                    <option selected="" value="All">All</option>
                                    @foreach ($list_produk as $detail)
                                        <option value="{{ $detail->id }}">{{ $detail->nama_produk." ".$detail->ukuran." ".$detail->finishing->jenis_finishing }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 d-flex justify-content-center align-items-center">
                                <div class="d-inline">
                                    <button type="button" class="btn" style="background-color: #EC268F; color: white;" id="create">Create</button>
                                    <button onclick="CreatePDFPenjualanProduk()" id="downloadPenjualanProduk" type="button" class="btn" style="background-color: #29a4da; color: white;"><span class="material-icons align-middle">download</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <canvas id="myChart" style="width:100%;"></canvas>
                    <br>
                    <div id="keterangan">

                    </div>
                </div>
            </div>
            <div id="laporan_transaksi">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Laporan Jumlah Transaksi</h4>
                        </div>
                    </div>
                    <hr style="height: 10px;">
                </div>
                <!--Content-->
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label id="date-label-from" class="date-label">From: </label>
                            <input type="date" id="min_transaksi" name="min_transaksi" class="form-control" value="{{ date('Y-m-d') }}"/>
                        </div>
                        <div class="col-sm-3">
                            <label id="date-label-to" class="date-label">To: </label>
                            <input type="date" id="max_transaksi" name="max_transaksi" class="form-control" value="{{ date('Y-m-d') }}"/>
                        </div>
                        <div class="col-sm-2 d-flex justify-content-center align-items-center">
                            <div class="d-inline">
                                <button type="button" class="btn" style="background-color: #EC268F; color: white;" id="create_transaksi">Create</button>
                                <button onclick="CreatePDFJumlahTransaksi()" id="downloadJumlahTransaksi" type="button" class="btn" style="background-color: #29a4da; color: white;"><span class="material-icons align-middle">download</span></button>
                            </div>
                        </div>
                    </div>
                </div>
                <canvas id="myChartTransaksi" style="width:100%;"></canvas>
                <br>
                <div id="keterangan_jumlah_transaksi">

                </div>
            </div>
            <div id="laporan_pendapatan">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Laporan Pendapatan</h4>
                        </div>
                    </div>
                    <hr style="height: 10px;">
                </div>
                <!--Content-->
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label id="date-label-from" class="date-label">From: </label>
                            <input type="date" id="min_pendapatan" name="min_pendapatan" class="form-control" value="{{ date('Y-m-d') }}"/>
                        </div>
                        <div class="col-sm-3">
                            <label id="date-label-to" class="date-label">To: </label>
                            <input type="date" id="max_pendapatan" name="max_pendapatan" class="form-control" value="{{ date('Y-m-d') }}"/>
                        </div>
                        <div class="col-sm-2 d-flex justify-content-center align-items-center">
                            <div class="d-inline">
                                <button type="button" class="btn" style="background-color: #EC268F; color: white;" id="create_pendapatan">Create</button>
                                <button onclick="CreatePDFPendapatan()" id="downloadPendapatan" type="button" class="btn" style="background-color: #29a4da; color: white;"><span class="material-icons align-middle">download</span></button>
                            </div>
                        </div>
                    </div>
                </div>
                <canvas id="myChartPendapatan" style="width:100%;"></canvas>
                <br>
                <div id="keterangan_pendapatan">

                </div>
            </div>
            <div id="laporan_produk_laris">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <button onclick="CreatePDFLaris()" id="downloadLaris" type="button" class="btn" style="background-color: #29a4da; color: white;"><span class="material-icons align-middle">download</span> Download</button>
                        </div>
                    </div>
                </div>
                <div id="laporan_laris_jumlah">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Laporan Produk Terlaris Berdasarkan Jumlah</h4>
                            </div>
                        </div>
                        <hr style="height: 10px;">
                    </div>
                    <!--Content-->
                    <canvas id="myChartLarisJumlah" style="width:100%;"></canvas>
                </div>
                <br>
                <div id="laporan_laris_harga">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Laporan Produk Terlaris Berdasarkan Harga</h4>
                            </div>
                        </div>
                        <hr style="height: 10px;">
                    </div>
                    <!--Content-->
                    <canvas id="myChartLarisHarga" style="width:100%;"></canvas>
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
        var minDate, maxDate;
        var xValues = [];
        var yValues = [];
        var xValuesTransaksi = [];
        var yValuesTransaksi = [];
        var xValuesLarisJumlah = [];
        var yValuesLarisJumlah = [];
        var xValuesLarisHarga = [];
        var yValuesLarisHarga = [];
        var barColors = '#9BD0F5';

        $(document).ready(function() {
            $("#laporan_penjualan_produk").show();
            $("#laporan_transaksi").hide();
            $("#laporan_pendapatan").hide();
            $("#laporan_produk_laris").hide();
            $('#produk_dropdown').select2();
            const autocolors = window['chartjs-plugin-autocolors'];

            const lighten = (color, value) => Chart.helpers.color(color).lighten(value).rgbString();

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
                        if(result.jumlah_per_produk.length === 0) {
                            $('#myChart').hide();
                            $('#keterangan').html('<center><h4>Data Tidak Ditemukan</h4></<center>');
                        }
                        else {
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
                            $('#myChart').show();
                            $('#keterangan').html('');
                        }
                    }
                });
            });

            const myBarChartTransaksi = new Chart("myChartTransaksi", {
                type: "bar",
                data: {},
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Data Jumlah Transaksi Harian"
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
            $('#create_transaksi').on('click', function () {
                xValuesTransaksi = [];
                yValuesTransaksi = [];
                var min_transaksi = $('#min_transaksi').val();
                var max_transaksi = $('#max_transaksi').val();
                $.ajax({
                    url: "{{url('/api/laporan-transaksi-harian')}}",
                    type: 'POST',
                    data: {
                        min_transaksi:min_transaksi,
                        max_transaksi:max_transaksi,
                        _token:'{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        if(result.transaksi.length === 0) {
                            $('#myChartTransaksi').hide();
                            $('#keterangan_jumlah_transaksi').html('<center><h4>Data Tidak Ditemukan</h4></<center>');
                        }
                        else {
                            $.each(result.transaksi, function (key, transaksi) { 
                                xValuesTransaksi.push(transaksi.tanggal);
                                yValuesTransaksi.push(transaksi.jumlah);
                            });
                            myBarChartTransaksi.data = {
                                labels: xValuesTransaksi,
                                datasets: [{
                                    backgroundColor: barColors,
                                    data: yValuesTransaksi
                                }]
                            };
                            myBarChartTransaksi.update();
                            $('#myChartTransaksi').show();
                            $('#keterangan_jumlah_transaksi').html('');
                        }
                    }
                });
            });

            const myBarChartPendapatan = new Chart("myChartPendapatan", {
                type: "bar",
                data: {},
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Data Pendapatan Harian"
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
            $('#create_pendapatan').on('click', function () {
                xValuesPendapatan = [];
                yValuesPendapatan = [];
                var min_pendapatan = $('#min_pendapatan').val();
                var max_pendapatan = $('#max_pendapatan').val();
                $.ajax({
                    url: "{{url('/api/laporan-pendapatan-harian')}}",
                    type: 'POST',
                    data: {
                        min_pendapatan:min_pendapatan,
                        max_pendapatan:max_pendapatan,
                        _token:'{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        if(result.pendapatan.length === 0) {
                            $('#myChartPendapatan').hide();
                            $('#keterangan_pendapatan').html('<center><h4>Data Tidak Ditemukan</h4></<center>');
                        }
                        else {
                            $.each(result.pendapatan, function (key, pendapatan) { 
                                xValuesPendapatan.push(pendapatan.tanggal);
                                yValuesPendapatan.push(pendapatan.jumlah);
                            });
                            myBarChartPendapatan.data = {
                                labels: xValuesPendapatan,
                                datasets: [{
                                    backgroundColor: barColors,
                                    data: yValuesPendapatan
                                }]
                            };
                            myBarChartPendapatan.update();
                            $('#myChartPendapatan').show();
                            $('#keterangan_pendapatan').html('');
                        }
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
                        }],
                        // xAxes: [{
                        //     ticks: {
                        //         callback: function(value) {
                        //             const val = `${value}`
                        //             return val.length > 40 ? `${val.substring(0, 40)}...` : val;
                        //         }
                        //     }
                        // }]
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

            $('#laporan_penjualan_produk_show').on('click', function () {
                $("#laporan_penjualan_produk").show();
                $("#laporan_transaksi").hide();
                $("#laporan_pendapatan").hide();
                $("#laporan_produk_laris").hide();
            });
            $('#laporan_transaksi_show').on('click', function () {
                $("#laporan_penjualan_produk").hide();
                $("#laporan_transaksi").show();
                $("#laporan_pendapatan").hide();
                $("#laporan_produk_laris").hide();
            });
            $('#laporan_pendapatan_show').on('click', function () {
                $("#laporan_penjualan_produk").hide();
                $("#laporan_transaksi").hide();
                $("#laporan_pendapatan").show();
                $("#laporan_produk_laris").hide();
            });
            $('#laporan_produk_laris_show').on('click', function () {
                $("#laporan_penjualan_produk").hide();
                $("#laporan_transaksi").hide();
                $("#laporan_pendapatan").hide();
                $("#laporan_produk_laris").show();
            });
        });

        //Create PDf from HTML...
        function CreatePDFPenjualanProduk() {
            var HTML_Width = $("#penjualan_produk").width();
            var HTML_Height = $("#penjualan_produk").height();
            var top_left_margin = 100;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            $("#downloadPenjualanProduk").hide();
            $("#create").hide();

            html2canvas($("#penjualan_produk")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                // var pdf = new jsPDF('p', 'mm', [210, 270]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save("Laporan_Jumlah_Transaksi.pdf");
                // $(".html-content").hide();
                $("#downloadPenjualanProduk").show();
                $("#create").show();
            });
        }

        function CreatePDFJumlahTransaksi() {
            var HTML_Width = $("#laporan_transaksi").width();
            var HTML_Height = $("#laporan_transaksi").height();
            var top_left_margin = 100;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            $("#downloadJumlahTransaksi").hide();
            $("#create_transaksi").hide();

            html2canvas($("#laporan_transaksi")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                // var pdf = new jsPDF('p', 'mm', [210, 270]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save("Laporan_Jumlah_Transaksi.pdf");
                // $(".html-content").hide();
                $("#downloadJumlahTransaksi").show();
                $("#create_transaksi").show();
            });
        }

        function CreatePDFPendapatan() {
            var HTML_Width = $("#laporan_pendapatan").width();
            var HTML_Height = $("#laporan_pendapatan").height();
            var top_left_margin = 100;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            $("#downloadPendapatan").hide();
            $("#create_pendapatan").hide();

            html2canvas($("#laporan_pendapatan")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                // var pdf = new jsPDF('p', 'mm', [210, 270]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save("Laporan_Pendapatan.pdf");
                // $(".html-content").hide();
                $("#downloadPendapatan").show();
                $("#create_pendapatan").show();
            });
        }

        function CreatePDFLaris() {
            var HTML_Width = $("#laporan_produk_laris").width();
            var HTML_Height = $("#laporan_produk_laris").height();
            var top_left_margin = 100;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            $("#downloadLaris").hide();

            html2canvas($("#laporan_produk_laris")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                // var pdf = new jsPDF('p', 'mm', [210, 270]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save("Laporan_Penjualan_Terlaris.pdf");
                // $(".html-content").hide();
                $("#downloadLaris").show();
            });
        }
    </script>
</body>
</html>
