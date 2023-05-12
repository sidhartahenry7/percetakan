@include('layouts.main')
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid black;
            /* text-align: center; */
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
                        <h4 class="card-title">Detail Penawaran</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-penawaran') }}'" style="margin-right: 10px;">
                        Back
                    </button>
                </div>
                <hr style="height: 10px;">
                <div class="iq-card-body">
                    @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @elseif(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <!--Card-->
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-0">
                        <ul class="navbar-nav nav-fill w-100">
                            <li class="nav-item">
                                <a class="nav-link" id="detail_penawaran" href="#">Detail Penawaran</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="history_status_penawaran" href="#">History Status Penawaran</a>
                            </li>
                        </ul>
                    </nav>
                    <div id="detail">
                        <form>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <p class="card-text" style="color: black; font-size: 16px;"><b>ID Penawaran</b></p>
                                    </div>
                                    <div class="col-sm-10">
                                        <p class="card-text" style="color: black; font-size: 16px;"><b>{{ $penawaran->id_penawaran }}</b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <p class="card-text" style="color: black; font-size: 16px;">Cabang</p>
                                    </div>
                                    <div class="col-sm-10">
                                        <p class="card-text" style="color: black; font-size: 16px;">{{ $penawaran->cabang->alamat }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <p class="card-text" style="color: black; font-size: 16px;">Tanggal Penawaran</p>
                                    </div>
                                    <div class="col-sm-10">
                                        <p class="card-text" style="color: black; font-size: 16px;">{{ date('d F Y H:i:s', strtotime($penawaran->tanggal_penawaran)) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <p class="card-text" style="color: black; font-size: 16px;">Status Penawaran</p>
                                    </div>
                                    <div class="col-sm-10">
                                        <p class="card-text" style="color: black; font-size: 16px;">{{ $penawaran->status_penawaran }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" hidden>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <p class="card-text" style="color: black; font-size: 16px;">Pegawai</p>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-input" id="pegawai_id" value="{{ auth()->user()->id }}"/>
                                        <input type="text" class="form-input" id="nama_lengkap" value="{{ auth()->user()->nama_lengkap }}"/>
                                        <input type="text" class="form-input" id="user_role" value="{{ auth()->user()->user_role }}"/>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Detail Produk</h4>
                                </div>
                            </div>
                            <hr style="height: 10px;">
                            <div class="table-responsive container">
                                <table class="table table-striped table-borderless" id="tabel">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID Produk</th>
                                            <th>Nama Poduk</th>
                                            <th>Jenis Bahan</th>
                                            <th>Ukuran</th>
                                            <th>Finishing</th>
                                            <th>Warna</th>
                                            <th>CMYK (%)</th>
                                            <th>Harga Produk</th>
                                            <th>Jumlah Produk</th>
                                            <th>Harga Finishing</th>
                                            <th>Diskon (%)</th>
                                            <th>Sub Total</th>
                                            <th>Harga Custom</th>
                                            <th>Total</th>
                                            <th>Custom Notes</th>
                                            <th>File Cetak</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detail_penawaran as $detail)
                                        <tr>
                                            <td>{{ $detail->detail_produk->id_detail_produk }}</td>
                                            <td>{{ $detail->detail_produk->nama_produk }}</td>
                                            <td>{{ $detail->jenis_bahan_input }}</td>
                                            <td>{{ $detail->ukuran_input }}</td>
                                            <td>{{ $detail->finishing_input }}</td>
                                            <td>{{ $detail->warna_input }}</td>
                                            <td>
                                                <div class="row">
                                                    Cyan: {{ $detail->persen_cyan }}%
                                                </div>
                                                <div class="row">
                                                    Magenta: {{ $detail->persen_magenta }}%
                                                </div>
                                                <div class="row">
                                                    Yellow: {{ $detail->persen_yellow }}%
                                                </div>
                                                <div class="row">
                                                    Black: {{ $detail->persen_black }}%
                                                </div>
                                            </td>
                                            <td>Rp {{ number_format($detail->harga, 2) }}</td>
                                            <td>{{ $detail->jumlah_produk }}</td>
                                            <td>Rp {{ number_format($detail->harga_finishing, 2) }}</td>
                                            <td>{{ $detail->diskon }}</td>
                                            <td>Rp {{ number_format((($detail->harga*$detail->jumlah_produk+$detail->harga_finishing)*(1-$detail->diskon/100)), 2) }}</td>
                                            <td>Rp {{ number_format($detail->harga_custom, 2) }}</td>
                                            <td>Rp {{ number_format($detail->sub_total, 2) }}</td>
                                            <td>
                                                @isset ($detail->custom)
                                                {!! $detail->custom !!}
                                                @else
                                                None
                                                @endisset
                                            </td>
                                            <td><button type="button" onclick="location.href='{{ url('file-penawaran/'.$detail->id) }}'" class="btn btn-primary btn-sm"><span class="material-icons align-middle">description</span></button></td>
                                            <td><button type="button" onclick="location.href='{{ url('penawaran/'.$penawaran->id.'/'.$detail->id) }}'" style="background-color: #29a4da; color:white;" class="btn btn-sm"><span class="material-icons align-middle">visibility</span></button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        <br><br>
                        @if($penawaran->bukti_pembayaran)
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Pembayaran</h4>
                            </div>
                        </div>
                        <hr style="height: 10px;">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="card-text" style="color: black; font-size: 16px;"><b>Bukti Pembayaran</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="d-inline">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalViewBukti">
                                            <span class="material-icons align-middle">visibility</span> View
                                        </button>
                                        <button type="button" onclick="location.href='{{ url('bukti-pembayaran/'.$penawaran->id) }}'" class="btn" style="background-color: #29a4da; color:white;"><span class="material-icons align-middle">description</span> Download</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal View Bukti Pembayaran -->
                        <div class="modal fade" id="modalViewBukti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <center>
                                                <img class="responsive" src="{{ asset('/storage/'.$penawaran->bukti_pembayaran) }}" style="max-width: 400px; max-height: 550px;">
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($penawaran->status_penawaran == 'Menunggu konfirmasi pembayaran')
                        <form action="{{ url('penawaran/'.$penawaran->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="form-check">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <input class="form-check-input" type="radio" name="status_terima" id="terima" value="Terima">
                                            <label class="form-check-label" for="terima">Terima</label>
                                        </div>
                                        <div class="col-sm-1">
                                            <input class="form-check-input" type="radio" name="status_terima" id="tolak" value="Tolak">
                                            <label class="form-check-label" for="tolak">Tolak</label>
                                        </div>
                                        <div class="col-sm-1" hidden>
                                            <input type="hidden" id="penawaran_id" value="{{ $penawaran->id }}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="notes_tolak"></div>
                            <div id="pegawai">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group" id="kasir"></div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group" id="operator_printer"></div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group" id="desainer"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="tombol"></div>
                        </form>
                        @endif
                    </div>
                    <div id="status">
                        {{-- <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">History Status</h4>
                            </div>
                        </div>
                        <hr style="height: 10px;"> --}}
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless" id="dtBasicExample">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Tanggal / Waktu</th>
                                        <th>Status Penawaran</th>
                                        <th>Notes</th>
                                        <th>PIC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($list_status as $status)
                                    <tr>
                                        <td>{{ date('d F Y H:i:s', strtotime($status->tanggal_status)) }}</td>
                                        <td>{{ $status->status_penawaran }}</td>
                                        @isset($status->notes)
                                        <td>{{ $status->notes }}</td>
                                        @else
                                        <td>&nbsp;</td>
                                        @endisset
                                        @isset($status->pegawai_id)
                                        <td>{{ $status->pegawai->nama_lengkap }} ({{ $status->pegawai->user_role }})</td>
                                        @else
                                        <td>{{ $status->pelanggan->nama_pelanggan }} (Pelanggan)</td>
                                        @endisset
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tabel').DataTable(
                {
                    'autowidth' : false,
                    'columnDefs' : [
                        { 'width': '100%', 'targets': [1] }
                    ]
                }
            );
            $('.dataTables_length').addClass('bs-select');

            $("#detail").show();
            $("#status").hide();

            $('#detail_penawaran').on('click', function () {
                $("#detail").show();
                $("#status").hide();
            });
            $('#history_status_penawaran').on('click', function () {
                $("#detail").hide();
                $("#status").show();
            });

            $("input:radio[name^='status_terima']").click(function () {
                if($('#tolak').is(':checked')==true){
                    $('#notes_tolak').html('');
                    $('#notes_tolak').append('<div class="row"><div class="col-sm-12"><label for="notes">Alasan penolakan</label></div></div>\
                                              <div class="row"><div class="col-sm-12"><textarea id="notes" name="notes" rows="3" style="width: 100%;" required></textarea></div></div>');
                    $('#kasir').html('');
                    $('#operator_printer').html('');
                    $('#desainer').html('');
                }   
                else if($('#terima').is(':checked')==true){
                    $('#notes_tolak').html('');
                    $('#kasir').html('');
                    $('#operator_printer').html('');
                    $('#desainer').html('');
                    var penawaran_id = $('#penawaran_id').val();
                    var pegawai_id = $('#pegawai_id').val();
                    var nama_lengkap = $('#nama_lengkap').val();
                    var user_role = $('#user_role').val();
                    $.ajax({
                        url: "{{url('/fetch-pegawai')}}",
                        type: 'POST',
                        data: {
                            penawaran_id:penawaran_id,
                            _token:'{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function (result) {
                            if (user_role == 'Admin' || user_role == 'Kepala Toko' || user_role == 'Wakil Kepala Toko') {
                                $('#kasir').html('');
                                $('#kasir').append('<select class="form-control" id="kasir_id" name="kasir_id" required><option selected="" value="" disabled="">-- Pilih Kasir --</option></select>');
                                $.each(result.list_kasir, function (key, kasir) {
                                    $("#kasir_id").append('<option value="' + kasir.id + '">' + kasir.nama_lengkap + '</option>');
                                });
                                
                                $('#operator_printer').html('');
                                $('#operator_printer').append('<select class="form-control" id="operator_id" name="operator_id" required><option selected="" value="" disabled="">-- Pilih Operator Printer --</option></select>');
                                $.each(result.list_operator_printer, function (key, operator) {
                                    $("#operator_id").append('<option value="' + operator.id + '">' + operator.nama_lengkap + '</option>');
                                });
    
                                $('#desainer').html('');
                                $('#desainer').append('<select class="form-control" id="desainer_id" name="desainer_id"><option selected="" value="">-- Pilih Desainer --</option></select>');
                                $.each(result.list_desainer, function (key, desainer) {
                                    $("#desainer_id").append('<option value="' + desainer.id + '">' + desainer.nama_lengkap + '</option>');
                                });
                            }
                            else if (user_role == 'Kasir') {
                                $('#kasir').html('');
                                $('#kasir').append('<select class="form-control" id="kasir_id" name="kasir_id" required></select>');
                                $("#kasir_id").append('<option selected value="' + pegawai_id + '">' + nama_lengkap + '</option>');
                                
                                $('#operator_printer').html('');
                                $('#operator_printer').append('<select class="form-control" id="operator_id" name="operator_id" required><option selected="" value="" disabled="">-- Pilih Operator Printer --</option></select>');
                                $.each(result.list_operator_printer, function (key, operator) {
                                    $("#operator_id").append('<option value="' + operator.id + '">' + operator.nama_lengkap + '</option>');
                                });
    
                                $('#desainer').html('');
                                $('#desainer').append('<select class="form-control" id="desainer_id" name="desainer_id"><option selected="" value="">-- Pilih Desainer --</option></select>');
                                $.each(result.list_desainer, function (key, desainer) {
                                    $("#desainer_id").append('<option value="' + desainer.id + '">' + desainer.nama_lengkap + '</option>');
                                });
                            }
                            else if (user_role == 'Desainer') {
                                $('#kasir').html('');
                                $('#kasir').append('<select class="form-control" id="kasir_id" name="kasir_id" required><option selected="" value="" disabled="">-- Pilih Kasir --</option></select>');
                                $.each(result.list_kasir, function (key, kasir) {
                                    $("#kasir_id").append('<option value="' + kasir.id + '">' + kasir.nama_lengkap + '</option>');
                                });
                                
                                $('#operator_printer').html('');
                                $('#operator_printer').append('<select class="form-control" id="operator_id" name="operator_id" required><option selected="" value="" disabled="">-- Pilih Operator Printer --</option></select>');
                                $.each(result.list_operator_printer, function (key, operator) {
                                    $("#operator_id").append('<option value="' + operator.id + '">' + operator.nama_lengkap + '</option>');
                                });
    
                                $('#desainer').html('');
                                $('#desainer').append('<select class="form-control" id="desainer_id" name="desainer_id"></select>');
                                $("#desainer_id").append('<option selected value="' + pegawai_id + '">' + nama_lengkap + '</option>');
                            }
                            else if (user_role == 'Operator Printer') {
                                $('#kasir').html('');
                                $('#kasir').append('<select class="form-control" id="kasir_id" name="kasir_id" required><option selected="" value="" disabled="">-- Pilih Kasir --</option></select>');
                                $.each(result.list_kasir, function (key, kasir) {
                                    $("#kasir_id").append('<option value="' + kasir.id + '">' + kasir.nama_lengkap + '</option>');
                                });
                                
                                $('#operator_printer').html('');
                                $('#operator_printer').append('<select class="form-control" id="operator_id" name="operator_id" required></select>');
                                $("#operator_id").append('<option selected value="' + pegawai_id + '">' + nama_lengkap + '</option>');
                                
                                $('#desainer').html('');
                                $('#desainer').append('<select class="form-control" id="desainer_id" name="desainer_id"><option selected="" value="">-- Pilih Desainer --</option></select>');
                                $.each(result.list_desainer, function (key, desainer) {
                                    $("#desainer_id").append('<option value="' + desainer.id + '">' + desainer.nama_lengkap + '</option>');
                                });
                            }
                        }
                    });
                }
                $('#tombol').html('<button type="submit" class="btn btn-primary">Submit</button>');

            });
            
            $('#kasir_id').select2();
            $('#operator_id').select2();
            $('#desainer_id').select2();
        });
    </script>
</body>
</html>
