<!DOCTYPE html>
<html lang="en">
<head>
    <title>Nota Transaksi</title>
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
                        <h4 class="card-title">Nota Transaksi</h4>
                    </div>
                    <button onclick="window.location.href='/history-transaksi'" type="button" class="btn btn-danger">
                        Back
                    </button>
                </div>
                <hr style="height: 10px;">
                <div class="iq-card-body">
                    <form action="{{ url('/po-botol/add') }}" method="POST">
                        <div class="text-center" style="margin: 20px;">
                            <button type="button" class="btn btn-success" onclick="pdfNotaBahanBaku()"><i class="mdi mdi-printer"></i> Cetak Nota</button>
                        </div>
                        <div class="nota-transaksi-main">
                            <div class="card border-dark mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="nota-logo text-center">
                                                <img src="{{ asset('/images/Logo-Cassa.png') }}" alt="..." width="60%" height="60%">
                                            </div>
                                        </div>
                                        <div class="col text-center">
                                            <p class="nota-namaperusahaan">
                                                CASSA DE VERDE
                                            </p>
                                            <p class="nota-alamatperusahaan">
                                                {{ $transaksi->alamat }}
                                                {{-- Ds. Siwalanpanji Kec. Buduran Kab. Sidoarjo- Jawa Timur<br>
                                                Email : andaracamtikaindonesia@gmail.com --}}
                                            </p>
                                        </div>
                                    </div>
                                    <hr style="width:100%; border: 0.2px solid black">
                                    <div class="text-center">
                                        <p><strong><h5>Nota Transaksi</h5></strong></p>
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="col-5">
                                            <div class="form-group row">
                                                <label for="noPO" class="col-5 col-form-label">ID Transaksi</label>
                                                <div class="col">
                                                    <input type="text" class="form-control-plaintext" id="id_antrian" value="{{ $transaksi->id_antrian }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="noSupplier" class="col-5 col-form-label">Nama Pelanggan</label>
                                                <div class="col">
                                                    <input type="text" class="form-control-plaintext" id="nama_lengkap" value="{{ $transaksi->nama_pelanggan }}" readonly>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group row">
                                                <label for="email" class="col-4 col-form-label">Email</label>
                                                <div class="col">
                                                    <input type="text" class="form-control-plaintext" id="email" value="{{ $po_bahan_baku->email }}" readonly>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group row">
                                                <label for="created_at" class="col-5 col-form-label">Tanggal Transaksi</label>
                                                <div class="col">
                                                    <input type="text" class="form-control-plaintext" id="tanggal_antrian" value="{{ date('d F Y',strtotime($transaksi->tanggal_antrian)) }}" readonly>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group row">
                                                <label for="alamat" class="col-4 col-form-label">Alamat</label>
                                                <div class="col">
                                                    <input type="text" class="form-control-plaintext" id="alamat" value="{{ $po_bahan_baku->alamat }}" readonly>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="form-group row">
                                                <label for="expired_at" class="col-4 col-form-label">Expired at</label>
                                                <div class="col">
                                                    <input type="text" class="form-control-plaintext" id="expired_at" value="31 Agustus 2022" readonly>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No. Urut</th>
                                                            <th>Nama Poduk</th>
                                                            <th>Jumlah Produk</th>
                                                            <th>Harga</th>
                                                            <th>Diskon (%)</th>
                                                            <th>Sub Total</th>
                                                            <th>Harga Custom</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $count = 1   
                                                        @endphp
                                                        @foreach($detail_transaksi as $detail)
                                                        <tr>
                                                            <td>{{ $count }}</td>
                                                            <td>{{ $detail->nama_produk }}</td>
                                                            <td>{{ $detail->jumlah_produk }}</td>
                                                            <td>Rp {{ number_format($detail->harga) }}</td>
                                                            <td>{{ $detail->diskon }}</td>
                                                            <td>Rp {{ number_format($detail->harga*$detail->jumlah_produk*(1-$detail->diskon/100)) }}</td>
                                                            <td>Rp {{ number_format($detail->harga_custom) }}</td>
                                                            <td>Rp {{ number_format($detail->sub_total) }}</td>
                                                        </tr>
                                                        @php
                                                        $count += 1
                                                        @endphp
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="container row justify-content-end" style="padding:10px;">
                                        <div class="col-1">
                                            <strong><h4>Total</h4></strong>
                                        </div>
                                        <div class="col-2">
                                            <strong><h4>Rp {{ number_format($po_bahan_baku->total_nominal) }}</h4></strong>
                                        </div>
                                    </div> --}}
                                    {{-- <div id="editor"></div> --}}
                                </div>
                            </div>
                        </div>
                    </form> 
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
