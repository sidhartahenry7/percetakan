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

        label {
            color: black;
        }

        #status_finishing {
            font-size: 12px;
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
                        <h4 class="card-title">Detail Produk</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-detail-produk') }}'" style="margin-right: 10px;">
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
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="id_detail_produk">ID Detail Produk</label>
                                </div>
                                <div class="col-sm-3">
                                    <label id="id_detail_produk">{{ $detail_produk->id_detail_produk }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="nama_kategori">Kategori</label>
                                </div>
                                <div class="col-sm-4">
                                    <label id="nama_kategori">{{ $detail_produk->kategori->nama_kategori }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="jenis_bahan">Jenis Bahan</label>
                                </div>
                                <div class="col-sm-4">
                                    <label id="jenis_bahan">{{ $detail_produk->jenis_bahan }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="ukuran">Ukuran</label>
                                </div>
                                <div class="col-sm-4">
                                    <label id="ukuran">{{ $detail_produk->ukuran }}</label>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="jenis_tinta">Jenis Tinta</label>
                                </div>
                                <div class="col-sm-4">
                                    <label id="jenis_tinta">{{ $detail_produk->tinta->jenis_tinta }}</label>
                                </div>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="jenis_finishing">Finishing</label>
                                </div>
                                <div class="col-sm-4">
                                    <label id="jenis_finishing">{{ $detail_produk->finishing->jenis_finishing }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="harga_finishing">Harga Finishing</label>
                                </div>
                                <div class="col-sm-4">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="p-0" style="text-align:left;">
                                                <label class="m-0" id="harga_finishing">Rp {{ number_format($detail_produk->finishing->finishing_harga, 2) }}</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-0" style="text-align:left;" id="status_finishing">
                                                @if($detail_produk->status_finishing == 0)
                                                <input disabled class="m-0" type="checkbox"> harga per quantity
                                                @else
                                                <input checked disabled class="m-0" type="checkbox"> harga per quantity
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="keterangan">Keterangan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label id="keterangan">{!! $detail_produk->keterangan !!}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="harga">Harga</label>
                                </div>
                                <div class="col-sm-4">
                                    <label id="harga">Rp {{ number_format($detail_produk->harga, 2) }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="diskon">Diskon (%)</label>
                                </div>
                                <div class="col-sm-4">
                                    <label id="diskon">{{ $detail_produk->diskon }}</label>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Bahan Setengah Jadi</h4>
                        </div>
                    </div>
                    <hr style="height: 10px;">
                    <div class="table-responsive container">
                        <table class="table table-striped table-borderless" id="dtBasicExample">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Bahan Setengah Jadi</th>
                                    <th>Quantity</th>
                                    <th>Harga Bahan Setengah Jadi</th>
                                    <th>Harga Beli Rata-Rata</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detail_produk_bahan as $bahan)
                                <tr>
                                    <td>{{ $bahan->bahan_setengah_jadi->nama_bahan_setengah_jadi }}</td>
                                    <td>{{ $bahan->quantity.' buah' }}</td>
                                    <td>Rp {{ number_format(($bahan->quantity*$bahan->bahan_setengah_jadi->harga), 2) }}</td>
                                    @for($i = 0; $i < count($data); $i++)
                                        @if ($data[$i]['id'] == $bahan->id)
                                        <td>Rp {{ number_format($data[$i]['harga_total'], 2) }}</td>
                                        @endif
                                    @endfor
                                </tr>
                                @endforeach
                                @foreach($detail_finishing as $finishing)
                                <tr>
                                    <td>{{ $finishing->bahan_setengah_jadi->nama_bahan_setengah_jadi }}</td>
                                    <td>{{ $finishing->quantity.' buah' }}</td>
                                    <td>Rp {{ number_format(($finishing->bahan_setengah_jadi->harga*$finishing->quantity), 2) }}</td>
                                    @for($i = 0; $i < count($data_finishing); $i++)
                                        @if ($data_finishing[$i]['finishing_id'] == $finishing->id)
                                        <td>Rp {{ number_format($data_finishing[$i]['harga_finishing_total'], 2) }}</td>
                                        @endif
                                    @endfor
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
</body>
</html>
