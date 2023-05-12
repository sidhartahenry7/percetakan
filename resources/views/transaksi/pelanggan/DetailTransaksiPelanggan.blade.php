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
        @include('partials.NavbarPelanggan')
        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Detail Transaksi</h4>
                    </div>
                    @if($transaksi->status_pengerjaan == "Selesai")
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('history-transaksi') }}'" style="margin-right: 10px;">
                        Back
                    </button>
                    @else
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('daftar-transaksi') }}'" style="margin-right: 10px;">
                        Back
                    </button>
                    @endif
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
                                <a class="nav-link" id="detail_transaksi" href="#">Detail Transaksi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="history_status_transaksi" href="#">History Status Transaksi</a>
                            </li>
                        </ul>
                    </nav>
                    <div id="detail">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <p class="card-text" style="color: black; font-size: 16px;"><b>ID Transaksi</b></p>
                                </div>
                                <div class="col-sm-10">
                                    <p class="card-text" style="color: black; font-size: 16px;"><b>{{ $transaksi->id_transaksi }}</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <p class="card-text" style="color: black; font-size: 16px;">Cabang</p>
                                </div>
                                <div class="col-sm-10">
                                    <p class="card-text" style="color: black; font-size: 16px;">{{ $transaksi->antrian->cabang->alamat }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <p class="card-text" style="color: black; font-size: 16px;">Tanggal Antrian</p>
                                </div>
                                <div class="col-sm-10">
                                    <p class="card-text" style="color: black; font-size: 16px;">{{ date('d F Y H:i:s', strtotime($transaksi->antrian->tanggal_antrian)) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <p class="card-text" style="color: black; font-size: 16px;">Nomor Antrian</p>
                                </div>
                                <div class="col-sm-10">
                                    <p class="card-text" style="color: black; font-size: 16px;">{{ $transaksi->antrian->nomor_antrian }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <p class="card-text" style="color: black; font-size: 16px;">Status Transaksi</p>
                                </div>
                                <div class="col-sm-10">
                                    <p class="card-text" style="color: black; font-size: 16px;">{{ $transaksi->status_transaksi }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <p class="card-text" style="color: black; font-size: 16px;">Status Pengerjaan</p>
                                </div>
                                <div class="col-sm-10">
                                    <p class="card-text" style="color: black; font-size: 16px;">{{ $transaksi->status_pengerjaan }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <p class="card-text" style="color: black; font-size: 16px;">Estimasi Selesai</p>
                                </div>
                                <div class="col-sm-10">
                                    <p class="card-text" style="color: black; font-size: 16px;">{{ date('d M Y H:i:s', strtotime($transaksi->estimasi_selesai)) }}</p>
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
                        <div class="row">
                            <div class="col-sm-9">
                                @foreach ($detail_transaksi as $detail)
                                <div class="container row mb-4">
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="row align-middle">
                                                    <div class="col-sm-12">
                                                        @isset($detail->detail_produk->kategori->gambar_kategori)
                                                        <img class="card-img responsive" src="{{ asset('/storage/'.$detail->detail_produk->kategori->gambar_kategori) }}" style="height: 200px;" alt="Card image cap">
                                                        @else
                                                        <img class="card-img responsive" src="{{ asset('/storage/kategori/null.jpg') }}" style="height: 200px; width: 200px;" alt="Card image cap">
                                                        @endisset
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h4 class="card-title">{{ $detail->detail_produk->nama_produk }}</h4>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="card-text">Jenis Bahan</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="card-text">{{ $detail->jenis_bahan_input }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="card-text">Ukuran</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="card-text">{{ $detail->ukuran_input }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="card-text">Finishing</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="card-text">{{ $detail->finishing_input }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="card-text">Status Warna</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="card-text">{{ $detail->warna_input }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="card-text">Jumlah Produk</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="card-text">{{ $detail->jumlah_produk }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="card-text">Custom Notes</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        @isset ($keranjang->custom)
                                                        {!! $detail->custom !!}
                                                        @else
                                                        <p class="card-text">None</p>
                                                        @endisset
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="card-text">File</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        @isset($detail->file_cetak)
                                                        <button type="button" onclick="location.href='{{ url('file-transaksi/'.$detail->id) }}'" class="btn btn-primary btn-sm"><span class="material-icons align-middle">description</span> Download</button>
                                                        @else
                                                        <p class="card-text">None</p>
                                                        @endisset
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="card-text">Sub Total</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="card-text">Rp {{ number_format($detail->harga*$detail->jumlah_produk+$detail->harga_finishing, 2) }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="card-text">Diskon</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="card-text">{{ $detail->diskon }}%</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="card-text">Harga Custom</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="card-text">Rp {{ number_format($detail->harga_custom, 2) }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="card-text" style="color: black"><b>Total</b></p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="card-text" style="color: black"><b>Rp {{ number_format($detail->sub_total, 2) }}</b></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group mb-0">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label for="jumlah_total_item"><b>Jumlah Produk</b></label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label for="jumlah_total_item">{{ $transaksi->jumlah_total_item }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-0">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label for="sub_total_transaksi"><b>Sub Total</b></label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label for="sub_total_transaksi">Rp {{ number_format($transaksi->sub_total_transaksi, 2) }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-0">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label for="sub_total_transaksi"><b>Promo</b></label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                @isset($penawaran->promo_id)
                                                                <label for="promo_id">{{ $transaksi->promo->potongan }}%</label>
                                                                @else
                                                                <label for="promo_id">0%</label>
                                                                @endisset
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-0">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label for="total" style="font-size: 18px;"><b>Total</b></label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label for="total" style="font-size: 18px;"><b>Rp {{ number_format($transaksi->total, 2) }}</b></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @isset($transaksi->bukti_pembayaran)
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label for="bukti_pembayaran"><b>Bukti Pembayaran</b></label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-7">
                                                                Download Bukti Pembayaran
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <button type="button" onclick="location.href='{{ url('bukti-pembayaran-transaksi/'.$transaksi->id) }}'" class="btn btn-primary btn-sm"><span class="material-icons align-middle">description</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endisset
                                @if($transaksi->status_pengerjaan == 'Selesai')
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label for="nota_transaksi"><b>Nota Transaksi</b></label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-7">
                                                                Download Nota Transaksi
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <button type="button" onclick="location.href='{{ url('/transaksi/'.$transaksi->id.'/nota') }}'" class="btn btn-primary btn-sm"><span class="material-icons align-middle">description</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div id="status">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless" id="dtBasicExample">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Tanggal / Waktu</th>
                                        <th>Status Penawaran</th>
                                        <th>PIC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($list_status as $status)
                                    <tr>
                                        <td>{{ date('d F Y H:i:s', strtotime($status->tanggal_status)) }}</td>
                                        <td>{{ $status->status_pengerjaan }}</td>
                                        <td>{{ $status->pegawai->nama_lengkap }}</td>
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
    <script>
        $(document).ready(function() {
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
