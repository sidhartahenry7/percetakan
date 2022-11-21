<!DOCTYPE html>
<html lang="en">
<head>
    <title>Detail Transaksi</title>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900"
        rel="stylesheet"
    />

    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="/css/style.css" />
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
            background-color: #0b2357;
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
                    @endif
                    @if($transaksi->status_pengerjaan == "Selesai")
                    <button onclick="window.location.href='/history-transaksi'" type="button" class="btn btn-success">
                        Back
                    </button>
                    @else
                    <button onclick="window.location.href='/transaksi'" type="button" class="btn btn-success">
                        Back
                    </button>
                    @endif
                    <br><br>
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
            </div>
            <br>
            <!--Tabel-->
            <div class="table-responsive">
                <table class="table table-striped table-borderless" id="tabel">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Produk</th>
                            <th>Nama Poduk</th>
                            <th>Ukuran</th>
                            <th>Jenis Bahan</th>
                            <th>Jenis Tinta</th>
                            <th>Finishing</th>
                            <th>Harga</th>
                            <th>Jumlah Produk</th>
                            <th>Diskon (%)</th>
                            <th>Sub Total</th>
                            <th>Harga Custom</th>
                            <th>Total</th>
                            <th>Custom Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_beli as $beli)
                        <tr>
                            <td>{{ $beli->detail_produk->id_detail_produk }}</td>
                            <td>{{ $beli->detail_produk->nama_produk }}</td>
                            <td>{{ $beli->detail_produk->produk->ukuran }}</td>
                            <td>{{ $beli->detail_produk->produk->jenis_kertas }}</td>
                            <td>{{ $beli->detail_produk->tinta->jenis_tinta }}</td>
                            <td>{{ $beli->detail_produk->finishing }}</td>
                            <td>Rp {{ number_format($beli->harga, 2) }}</td>
                            <td>{{ $beli->jumlah_produk }}</td>
                            <td>{{ $beli->diskon }}</td>
                            <td>Rp {{ number_format(($beli->harga*$beli->jumlah_produk*(1-$beli->diskon/100)), 2) }}</td>
                            <td>Rp {{ number_format($beli->harga_custom, 2) }}</td>
                            <td>Rp {{ number_format($beli->sub_total, 2) }}</td>
                            <td>{!! $beli->custom !!}</td>
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
    </div>

    {{-- <script src="/js/jquery.min.js"></script> --}}
    <script src="/js/popper.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>

</body>
</html>
