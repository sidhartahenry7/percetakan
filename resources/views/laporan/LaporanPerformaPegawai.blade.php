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
                        <h4 class="card-title">Laporan Performa Pegawai</h4>
                    </div>
                </div>
                <hr style="height: 10px;">
            </div>
            <!--Content-->
            <div id="laporan_performa_pegawai">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-2">
                            <label id="date-label-from" class="date-label">From: </label>
                            <input type="date" id="min" name="min" class="form-control"/>
                        </div>
                        <div class="col-sm-2">
                            <label id="date-label-to" class="date-label">To: </label>
                            <input type="date" id="max" name="max" class="form-control"/>
                        </div>
                        <div class="col-sm-2 d-flex justify-content-center align-items-center">
                            <div class="d-inline">
                                <button type="button" class="btn" style="background-color: #EC268F; color: white;" id="create">Create</button>
                                <button onclick="CreatePDFPerformaPegawai()" id="downloadPerformaPegawai" type="button" class="btn" style="background-color: #29a4da; color: white;"><span class="material-icons align-middle">download</span></button>
                            </div>
                        </div>
                    </div>
                </div>
                <canvas id="myChart" style="width:100%;"></canvas>
                <div id="keterangan"></div>
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
        var xValues = [];
        var yValues = [];
        var yValuesTransaksi = [];
        var barColors = '#9BD0F5';

        $(document).ready(function() {
            var performa = JSON.parse({!! json_encode($data) !!});
            $.each(performa, function (key, value) { 
                xValues.push(value.nama_pegawai);
                yValues.push(value.jumlah_komplain);
                yValuesTransaksi.push(value.jumlah_transaksi);
            });
            const myBarChart = new Chart("myChart", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        label: 'Jumlah komplain',
                        backgroundColor: barColors,
                        data: yValues
                    }, {
                        label: 'Jumlah transaksi',
                        backgroundColor: "#2e5468",
                        data: yValuesTransaksi
                    }]
                },
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Data Jumlah Komplain dan Jumlah Transaksi per Pegawai"
                    },
                    scales: {
                        xAxes: [{
                            stacked: true
                        }],
                        yAxes: [{
                            stacked: true,
                            display: true,
                            ticks: {
                                suggestedMin: 0
                            }
                        }]
                    },
                    plugins: {}
                }
            });
            
            $('#create').on('click', function () {
                xValues = [];
                yValues = [];
                yValuesTransaksi = [];
                var min = $('#min').val();
                var max = $('#max').val();
                $.ajax({
                    url: "{{url('/api/laporan-performa')}}",
                    type: 'POST',
                    data: {
                        min:min,
                        max:max,
                        _token:'{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $.each(result.performa_pegawai, function (key, value) { 
                            xValues.push(value.nama_pegawai);
                            yValues.push(value.jumlah_komplain);
                            yValuesTransaksi.push(value.jumlah_transaksi);
                        });
                        myBarChart.data = {
                            labels: xValues,
                            datasets: [{
                                label: 'Jumlah komplain',
                                backgroundColor: barColors,
                                data: yValues
                            }, {
                                label: 'Jumlah transaksi',
                                backgroundColor: "#2e5468",
                                data: yValuesTransaksi
                            }]
                        };
                        myBarChart.update();
                    }
                });
            });
        });

        //Create PDf from HTML...
        function CreatePDFPerformaPegawai() {
            var HTML_Width = $("#laporan_performa_pegawai").width();
            var HTML_Height = $("#laporan_performa_pegawai").height();
            var top_left_margin = 100;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            $("#create").hide();
            $("#downloadPerformaPegawai").hide();

            html2canvas($("#content")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                // var pdf = new jsPDF('p', 'mm', [210, 270]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save("Laporan_Performa_Pegawai.pdf");
                // $(".html-content").hide();
                $("#create").show();
                $("#downloadPerformaPegawai").show();
            });
        }
    </script>
</body>
</html>