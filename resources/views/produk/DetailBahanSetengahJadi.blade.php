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
                        <h4 class="card-title">Detail Bahan Setengah Jadi</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-bahan-setengah-jadi') }}'" style="margin-right: 10px;">
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
                    @endif
                    <form>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">ID Bahan Setengah Jadi</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="id_bahan_setengah_jadi" value="{{ $bahan_setengah_jadi->id_bahan_setengah_jadi }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="text">Nama Bahan Setengah Jadi</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="nama_bahan_setengah_jadi" value="{{ $bahan_setengah_jadi->nama_bahan_setengah_jadi }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="text">Harga</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="harga" value="Rp {{ number_format($bahan_setengah_jadi->harga, 2) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Penggunaan Bahan</h4>
                            </div>
                        </div>
                        <hr style="height: 10px;">
                        <div class="table-responsive container">
                            <table class="table table-striped table-borderless" id="tabel_bahan">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Jenis Bahan</th>
                                        <th>Ukuran</th>
                                        <th>Quantity</th>
                                        <th>Harga Beli Rata-Rata</th>
                                    </tr>
                                </thead>
                                <tbody id="table_del_bahan">
                                    @foreach($penggunaan_bahan as $bahan)
                                    <tr>
                                        <td>{{ $bahan->produk->jenis_kertas }}</td>
                                        @isset($bahan->produk->ukuran)
                                        <td>{{ $bahan->produk->ukuran }}</td>
                                        @else
                                        <td>{{ $bahan->produk->lebar.' x '.$bahan->produk->panjang.' '.$bahan->produk->satuan }}</td>
                                        @endisset
                                        <td>{{ $bahan->jumlah_pemakaian.' '.$bahan->satuan }}</td>
                                        @php($count_bahan = 0)
                                        @foreach ($stok_bahan as $bahan_stok)
                                            @if ($bahan_stok->produk_id == $bahan->produk_id)
                                            <td>Rp {{ number_format(($bahan_stok->harga_average*$bahan->jumlah_pemakaian), 2) }}</td>
                                            @php($count_bahan = 1)
                                            @endif
                                        @endforeach
                                        @if($count_bahan == 0)
                                        <td>Rp {{ number_format(0, 2) }}</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody> 
                            </table>
                        </div>
                        <br>
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Penggunaan Tinta</h4>
                            </div>
                        </div>
                        <hr style="height: 10px;">
                        <div class="table-responsive container">
                            <table class="table table-striped table-borderless" id="tabel_tinta">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Jenis Tinta</th>
                                        <th>Quantity</th>
                                        <th>Harga Beli Rata-Rata</th>
                                    </tr>
                                </thead>
                                <tbody id="table_del_tinta">
                                    @foreach($penggunaan_tinta as $tintas)
                                    <tr>
                                        <td>{{ $tintas->detail_tinta->tinta->jenis_tinta.' '.$tintas->detail_tinta->warna }}</td>
                                        <td>{{ $tintas->jumlah_pemakaian.' '.$tintas->satuan }}</td>
                                        @php($count_tinta = 0)
                                        @foreach ($stok_tinta as $tinta_stok)
                                            @if ($tinta_stok->detail_tinta_id == $tintas->detail_tinta_id)
                                                @if($tintas->satuan == "liter")
                                                <td>Rp {{ number_format(($tinta_stok->harga_average*$tintas->jumlah_pemakaian*1000), 2) }}</td>
                                                @else
                                                <td>Rp {{ number_format(($tinta_stok->harga_average*$tintas->jumlah_pemakaian), 2) }}</td>
                                                @endif
                                            @php($count_tinta = 1)
                                            @endif
                                        @endforeach
                                        @if($count_tinta == 0)
                                        <td>Rp {{ number_format(0, 2) }}</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody> 
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
</html>
