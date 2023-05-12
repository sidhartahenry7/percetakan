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
            min-width: 150px;
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
                        <h4 class="card-title">Detail Transaksi</h4>
                    </div>
                    @if($transaksi->status_pengerjaan == "Pesanan telah diambil")
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('history-transaksi') }}'" style="margin-right: 10px;">
                        Back
                    </button>
                    @else
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('transaksi') }}'" style="margin-right: 10px;">
                        Back
                    </button>
                    @endif
                </div>
                <hr style="height: 10px;">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-0">
                    <ul class="navbar-nav nav-fill w-100">
                        <li class="nav-item">
                            <a class="nav-link" id="detail_transaksi" href="#">Detail Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="history_status_transaksi" href="#">History Status Transaksi</a>
                        </li>
                    </ul>
                </nav>
                <div id="detail">
                    <div class="iq-card-body">
                        @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">ID Transaksi</label>
                                    <br>
                                    <label type="text" id="id_transaksi" style="color: black;">{{ $transaksi->id_transaksi }}</label>
                                    <input type="hidden" class="form-control" id="transaksi_id" name="transaksi_id" value="{{ $transaksi->id }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">ID Antrian</label>
                                    <br>
                                    <label type="text" id="IDantrian" style="color: black;">{{ $transaksi->antrian->id_antrian }}</label>
                                </div>
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">Cabang</label>
                                    <br>
                                    <label type="text" id="IDantrian" style="color: black;">{{ $transaksi->antrian->cabang->alamat }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">Tanggal Antrian</label>
                                    <br>
                                    <label type="text" id="tanggal_antrian" style="color: black;">{{ date('d M Y H:i:s', strtotime($transaksi->antrian->tanggal_antrian)) }}</label>
                                </div>
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">Estimasi Selesai</label>
                                    <br>
                                    <label type="text" id="estimasi_selesai" style="color: black;">{{ date('d M Y H:i:s', strtotime($transaksi->estimasi_selesai)) }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">Nama Pelanggan</label>
                                    <br>
                                    <label type="text" id="namaPelanggan" style="color: black;">{{ $transaksi->antrian->pelanggan->nama_pelanggan }}</label>
                                </div>
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">Nomor Handphone</label>
                                    <br>
                                    <label type="text" id="noHandphone" style="color: black;">{{ $transaksi->antrian->pelanggan->nomor_handphone }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label style="color: black; font-weight: bold;" for="text">Kasir</label>
                                        <br>
                                        @isset($history_kasir)
                                        <label type="text" id="kasir" style="color: black;">{{ $history_kasir->nama_lengkap }}</label>
                                        @else
                                        <label type="text" id="kasir" style="color: black;">-</label>
                                        @endisset
                                    </div>    
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label style="color: black; font-weight: bold;" for="text">Operator Printer</label>
                                        <br>
                                        @isset($history_operator_printer)
                                        <label type="text" id="operator_printer" style="color: black;">{{ $history_operator_printer->nama_lengkap }}</label>
                                        @else
                                        <label type="text" id="kasir" style="color: black;">-</label>
                                        @endisset
                                    </div>    
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label style="color: black; font-weight: bold;" for="text">Desainer</label>
                                        <br>
                                        @isset($history_desainer)
                                        <label type="text" id="desainer" style="color: black;">{{ $history_desainer->nama_lengkap }}</label>
                                        @else
                                        <label type="text" id="kasir" style="color: black;">-</label>
                                        @endisset
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <!--Tabel-->
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
                                    <th>Harga</th>
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
                                @foreach ($list_beli as $beli)
                                <tr>
                                    <td>{{ $beli->detail_produk->id_detail_produk }}</td>
                                    <td>{{ $beli->detail_produk->nama_produk }}</td>
                                    <td>{{ $beli->jenis_bahan_input }}</td>
                                    <td>{{ $beli->ukuran_input }}</td>
                                    <td>{{ $beli->finishing_input }}</td>
                                    <td>{{ $beli->warna_input }}</td>
                                    <td>
                                        <div class="row">
                                            Cyan: {{ $beli->persen_cyan }}%
                                        </div>
                                        <div class="row">
                                            Magenta: {{ $beli->persen_magenta }}%
                                        </div>
                                        <div class="row">
                                            Yellow: {{ $beli->persen_yellow }}%
                                        </div>
                                        <div class="row">
                                            Black: {{ $beli->persen_black }}%
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($beli->harga, 2) }}</td>
                                    <td>{{ $beli->jumlah_produk }}</td>
                                    <td>Rp {{ number_format($beli->harga_finishing, 2) }}</td>
                                    <td>{{ $beli->diskon }}</td>
                                    <td>Rp {{ number_format(($beli->harga*$beli->jumlah_produk*(1-$beli->diskon/100)), 2) }}</td>
                                    <td>Rp {{ number_format($beli->harga_custom, 2) }}</td>
                                    <td>Rp {{ number_format($beli->sub_total, 2) }}</td>
                                    <td>
                                        @isset($beli->custom)
                                        {!! $beli->custom !!}
                                        @else
                                        None
                                        @endisset
                                    </td>
                                    <td>
                                        @isset($beli->file_cetak)
                                        <button type="button" onclick="location.href='{{ url('file-transaksi/'.$beli->id) }}'" class="btn btn-primary btn-sm"><span class="material-icons align-middle">description</span></button>
                                        @else
                                        None
                                        @endisset
                                    </td>
                                    <td><button type="button" onclick="location.href='{{ url('transaksi/'.$beli->transaksi_id.'/'.$beli->id.'/view') }}'" style="background-color: #29a4da; color:white;" class="btn btn-sm"><span class="material-icons align-middle">visibility</span></button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <!--Text Bawah-->
                    <div class="row">
                        <div class="col-sm-9" style="text-align: right;">
                            <label style="color: black; font-weight: bold; font-size: 20px;" for="text">Sub Total : </label>
                        </div>
                        <div class="col-sm-3" style="text-align: start;" id="subTotal">
                            <label type="text" style="color: black; font-size: 16px; padding-top: 3px;">Rp {{ number_format($transaksi->sub_total_transaksi, 2) }}</label>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-sm-9" style="text-align: right;">
                            <label style="color: black; font-weight: bold; font-size: 20px;" for="text">Diskon (%) : </label>
                        </div>
                        <div class="col-sm-3">
                            <label type="text" style="color: black; font-size: 16px; padding-top: 3px;">{{ $transaksi->diskon }}</label>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-sm-9" style="text-align: right;">
                            <label style="color: black; font-weight: bold; font-size: 20px;" for="text">Promo : </label>
                        </div>
                        <div class="col-sm-3">
                            @isset($transaksi->promo_id)
                            <label type="text" style="color: black; font-size: 16px; padding-top: 3px;">{{ $transaksi->promo->potongan }}%</label>
                            @else   
                            <label type="text" style="color: black; font-size: 16px; padding-top: 3px;">0%</label>
                            @endisset
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9" style="text-align: right;">
                            <label style="color: black; font-weight: bold; font-size: 20px;" for="text">Total : </label>
                        </div>
                        <div class="col-sm-3" style="text-align: start;" id="total-form">
                            <label type="text" id="total" name="total" style="color: black; font-weight: bold; font-size: 20px;">Rp {{ number_format($transaksi->total, 2) }}</label>
                        </div>
                    </div>
                </div>
                <div id="status">
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless" id="dtBasicExample">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Tanggal / Waktu</th>
                                    <th>Status Pengerjaan</th>
                                    <th>Notes</th>
                                    <th>PIC</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($list_status as $status)
                                <tr>
                                    <td>{{ date('d F Y H:i:s', strtotime($status->tanggal_status)) }}</td>
                                    <td>{{ $status->status_pengerjaan }}</td>
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

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>

    <script>
        $(document).ready(function () {
            $("#detail").show();
            $("#status").hide();
    
            $('#detail_transaksi').on('click', function () {
                $("#detail").show();
                $("#status").hide();
            });
            $('#history_status_transaksi').on('click', function () {
                $("#detail").hide();
                $("#status").show();
            });
        });
    </script>
</body>
</html>
