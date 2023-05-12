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
                        <h4 class="card-title">Detail Produk Penawaran</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('penawaran/'.$penawaran->id) }}'" style="margin-right: 10px;">
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
                    <div id="detail">
                        <form action="{{ url('penawaran/'.$penawaran->id.'/'.$detail_penawaran->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="id_penawaran">ID Penawaran</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="id_penawaran">{{ $detail_penawaran->penawaran->id_penawaran }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="cabang_id">Cabang</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="cabang_id">{{ $detail_penawaran->penawaran->cabang->alamat }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="tanggal_penawaran">Tanggal Penawaran</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="tanggal_penawaran">{{ date('d F Y H:i:s', strtotime($detail_penawaran->penawaran->tanggal_penawaran)) }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="status_penawaran">Status Penawaran</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <label id="status_penawaran">{{ $detail_penawaran->penawaran->status_penawaran }}</label>
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
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="kategori_id">Kategori</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="kategori_id">{{ $detail_penawaran->kategori->nama_kategori }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="jenis_bahan_input">Jenis Bahan</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="jenis_bahan_input">{{ $detail_penawaran->jenis_bahan_input }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="ukuran_input">Ukuran</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="ukuran_input">{{ $detail_penawaran->ukuran_input }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="finishing_input">Finishing</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="finishing_input">{{ $detail_penawaran->finishing_input }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="warna_input">Status Warna</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="warna_input">{{ $detail_penawaran->warna_input }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="harga">Harga</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="harga">Rp {{ number_format($detail_penawaran->harga, 2) }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="jumlah_produk_label">Jumlah Produk</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="jumlah_produk_label">{{ $detail_penawaran->jumlah_produk }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="harga_finishing">Harga Finishing</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="harga_finishing">Rp {{ number_format($detail_penawaran->harga_finishing, 2) }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="diskon">Diskon</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="diskon">{{ $detail_penawaran->diskon }}%</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="harga_custom"><b>Harga Custom</b></label>
                                    </div>
                                    <div class="col-sm-10">
                                        <label id="harga_custom">Rp {{ number_format($detail_penawaran->harga_custom, 2) }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="sub_total"><b>Sub Total</b></label>
                                    </div>
                                    <div class="col-sm-10">
                                        <label id="sub_total">Rp {{ number_format($detail_penawaran->sub_total, 2) }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="custom">Custom Notes</label>
                                    </div>
                                    <div class="col-sm-3">
                                        @isset ($detail_penawaran->custom)
                                        <label id="custom">{{ $detail_penawaran->custom }}</label>
                                        @else
                                        <label id="custom">None</label>
                                        @endisset
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="file_cetak">File Cetak</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" onclick="location.href='{{ url('file-penawaran/'.$detail_penawaran->id) }}'" class="btn btn-primary btn-sm"><span class="material-icons align-middle">description</span> Download</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="persen_cmyk"><b>CMYK (%)</b></label>
                                    </div>
                                    <div class="col-sm-10">
                                        <label for="persen_cyan">Cyan: {{ $detail_penawaran->persen_cyan }}%, </label>
                                        <label for="persen_magenta">Magenta: {{ $detail_penawaran->persen_magenta }}%, </label>
                                        <label for="persen_yellow">Yellow: {{ $detail_penawaran->persen_yellow }}%, </label>
                                        <label for="persen_black">Black: {{ $detail_penawaran->persen_black }}%</label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Data Master Produk</h4>
                                </div>
                            </div>
                            <hr style="height: 10px;">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="nama_produk"><b>Nama Produk</b></label>
                                    </div>
                                    <div class="col-sm-10">
                                        <label id="nama_produk">{{ $detail_penawaran->detail_produk->nama_produk }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="jenis_bahan"><b>Jenis Bahan</b></label>
                                    </div>
                                    <div class="col-sm-10">
                                        <label id="jenis_bahan">{{ $detail_penawaran->detail_produk->jenis_bahan }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="ukuran"><b>Ukuran</b></label>
                                    </div>
                                    <div class="col-sm-10">
                                        <label id="ukuran">{{ $detail_penawaran->detail_produk->ukuran }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="finishing"><b>Finishing</b></label>
                                    </div>
                                    <div class="col-sm-10">
                                        <label id="finishing">{{ $detail_penawaran->detail_produk->finishing->jenis_finishing }}</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/jquery.min.js')}}"></script>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
</html>
