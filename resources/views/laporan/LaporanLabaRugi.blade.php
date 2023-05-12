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
            color: black;
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
                        <h4 class="card-title">Laporan Laba Rugi</h4>
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
                        <label id="cabang_dropdown-label">Cabang: </label>
                        <select id="cabang_dropdown" class="form-control">
                            {{-- <option selected="" value="All">All</option> --}}
                            @foreach ($list_cabang as $cabang)
                            <option value="{{ $cabang->id }}">{{ $cabang->nama_cabang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2 d-flex justify-content-center align-items-center">
                        <div class="d-inline">
                            <button type="button" class="btn" style="background-color: #EC268F; color: white;" id="create">Create</button>
                            <button onclick="CreatePDFLabaRugi()" id="downloadLabaRugi" type="button" class="btn" style="background-color: #29a4da; color: white;"><span class="material-icons align-middle">download</span></button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div id="laporan_laba_rugi">
                <div class="container" style="background-color: white;">
                    <div id=header_laporan>
                        {{-- <center>
                            <h6><b>Soerabaja45</b></h6>
                            <h6><b>Laporan Laba Rugi</b></h6>
                            <h6><b>Periode XXX</b></h6>
                        </center> --}}
                    </div>
                    <br>
                    <div class="container ml-5" id=body_laporan>
                        {{-- <div class="row">
                            <div class="col-sm-5"><b>Pendapatan</b></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">Penjualan Bersih</div>
                            <div class="col-sm-3">Rp 50.000.000,00</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-4">Pendapatan Sewa</div>
                            <div class="col-sm-3"><u>Rp 4.000.000,00</u></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-4">Total Pendapatan</div>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-3">Rp 46.000.000,00</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5"><b>Beban</b></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">Harga Pokok Penjualan</div>
                            <div class="col-sm-3">Rp 20.000.000,00</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-4">Beban Penjualan</div>
                            <div class="col-sm-3">Rp 3.000.000,00</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-4">Beban Administrasi</div>
                            <div class="col-sm-3">Rp 1.000.000,00</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-4">Beban Bunga</div>
                            <div class="col-sm-3">Rp 500.000,00</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-4">Beban Lain-lain</div>
                            <div class="col-sm-3">Rp 500.000,00</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-4">Total Beban</div>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-3">Rp 25.000.000,00</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5"><b>Laba Sebelum Pajak</b></div>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-2">Rp 21.000.000,00</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-4"><b>Pajak</b></div>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-3">Rp 0,00</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5"><b>Laba Bersih</b></div>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-2">Rp 21.000.000,00</div>
                        </div> --}}
                    </div>
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
        $(document).ready(function() {
            $('#create').on('click', function () {
                var min = $('#min').val();
                var max = $('#max').val();
                var cabang_id = $('#cabang_dropdown').val();
                var periode = new Date(min);
                var total_pendapatan = 0;
                var total_beban = 0;
                var laba_sebelum_pajak = 0;
                var pajak = 0;
                var laba_bersih = 0;
                $("#header_laporan").html('');
                $("#body_laporan").html('');
                $("#periode").html('');
                $.ajax({
                    url: "{{url('/api/laporan-laba-rugi')}}",
                    type: 'POST',
                    data: {
                        min:min,
                        max:max,
                        cabang_id:cabang_id,
                        _token:'{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#header_laporan').append('<center>\
                                                        <h6><b>Soerabaja45</b></h6>\
                                                        <h6><b>Laporan Laba Rugi</b></h6>\
                                                        <h6><b>Periode '+moment(periode).format("MMMM")+' '+periode.getFullYear()+'</b></h6>\
                                                     </center>');
                        $('#body_laporan').append('<div class="row">\
                                                       <div class="col-sm-5">\<b>Pendapatan</b>\</div>\
                                                   </div>\
                                                   <div class="row">\
                                                        <div class="col-sm-5">Penjualan Bersih</div>\
                                                        <div class="col-sm-3">'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(result.pendapatan_bersih)+'</div>\
                                                        <input type="hidden" id="pendapatan_bersih" value="'+result.pendapatan_bersih+'"/>\
                                                   </div>\
                                                   <div class="row">\
                                                        <div class="col-sm-1"></div>\
                                                        <div class="col-sm-4">Pendapatan Sewa</div>\
                                                        <div class="col-sm-3"><u>'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(result.pendapatan_sewa)+'</u></div>\
                                                        <input type="hidden" id="pendapatan_sewa" value="'+result.pendapatan_sewa+'"/>\
                                                   </div>\
                                                   <div class="row">\
                                                        <div class="col-sm-1"></div>\
                                                        <div class="col-sm-4">Total Pendapatan</div>\
                                                        <div class="col-sm-2"></div>\
                                                        <div class="col-sm-3">'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(result.total_pendapatan)+'</div>\
                                                        <input type="hidden" id="total_pendapatan" value="'+result.total_pendapatan+'"/>\
                                                   </div>\
                                                   <div class="row">\
                                                        <div class="col-sm-5"><b>Beban</b></div>\
                                                   </div>\
                                                   <div class="row">\
                                                        <div class="col-sm-5">Harga Pokok Penjualan</div>\
                                                        <div class="col-sm-3">'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(result.harga_pokok_penjualan)+'</div>\
                                                        <input type="hidden" id="harga_pokok_penjualan" value="'+result.harga_pokok_penjualan+'"/>\
                                                   </div>');
                        total_pendapatan = result.total_pendapatan;
                        total_beban += parseFloat(result.harga_pokok_penjualan);
                        $.each(result.biaya, function (key, value) { 
                            $('#body_laporan').append('<div class="row">\
                                                            <div class="col-sm-1"></div>\
                                                            <div class="col-sm-4">'+value.jenis_biaya+'</div>\
                                                            <div class="col-sm-3">'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(value.nominal)+'</div>\
                                                       </div>');
                            if(value.nominal == null) {
                                value.nominal = 0;
                            }
                            total_beban += parseFloat(value.nominal);
                            console.log(value.nominal);
                        });
                        laba_sebelum_pajak = parseFloat(total_pendapatan)-parseFloat(total_beban);
                        pajak = parseFloat(laba_sebelum_pajak)*0.25;
                        laba_bersih = parseFloat(laba_sebelum_pajak)-parseFloat(pajak);
                        $('#body_laporan').append('<div class="row">\
                                                        <div class="col-sm-1"></div>\
                                                        <div class="col-sm-4">Total Beban</div>\
                                                        <div class="col-sm-2"></div>\
                                                        <div class="col-sm-3"><u>'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(total_beban)+'</u></div>\
                                                        <input type="hidden" id="total_beban" value="'+total_beban+'"/>\
                                                   </div>\
                                                   <div class="row">\
                                                        <div class="col-sm-5"><b>Laba Sebelum Pajak</b></div>\
                                                        <div class="col-sm-2"></div>\
                                                        <div class="col-sm-2">'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(laba_sebelum_pajak)+'</div>\
                                                        <input type="hidden" id="laba_sebelum_pajak" value="'+laba_sebelum_pajak+'"/>\
                                                   </div>\
                                                   <div class="row">\
                                                        <div class="col-sm-1"></div>\
                                                        <div class="col-sm-4"><b>Pajak</b></div>\
                                                        <div class="col-sm-2"></div>\
                                                        <div class="col-sm-3"><u>'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(pajak)+'</u></div>\
                                                        <input type="hidden" id="pajak" value="'+pajak+'"/>\
                                                   </div>\
                                                   <div class="row">\
                                                        <div class="col-sm-5"><b>Laba Bersih</b></div>\
                                                        <div class="col-sm-2"></div>\
                                                        <div class="col-sm-2">'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(laba_bersih)+'</div>\
                                                        <input type="hidden" id="laba_bersih" value="'+laba_bersih+'"/>\
                                                   </div>');
                    }
                });
            });
        });

        function CreatePDFLabaRugi() {
            var HTML_Width = $("#laporan_laba_rugi").width();
            var HTML_Height = $("#laporan_laba_rugi").height();
            var top_left_margin = 100;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            // $("#create").hide();
            // $("#downloadLabaRugi").hide();

            html2canvas($("#laporan_laba_rugi")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                // var pdf = new jsPDF('p', 'mm', [210, 270]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                // $(".html-content").hide();
                // $("#downloadLaris").show();
                pdf.save("Laporan_Laba_Rugi.pdf");
            });
        }
    </script>
</body>
</html>