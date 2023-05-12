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
                        <h4 class="card-title">Detail Pembelian Bahan Baku</h4>
                    </div>
                    @if($pembelian->status == "Pending")
                    <button type="button" class="btn" onclick="location.href='{{ url('list-pembelian-bahan-baku') }}'" style="margin-right: 10px; background-color: #29a4da; color:white;">
                        <span class="material-icons align-middle">arrow_back</span>
                    </button>
                    @else
                    <button type="button" class="btn" onclick="location.href='{{ url('history-pembelian-bahan-baku') }}'" style="margin-right: 10px; background-color: #29a4da; color:white;">
                        <span class="material-icons align-middle">arrow_back</span>
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
                    @endif
                    <form>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label style="color: black; font-weight: bold;" for="text">ID Pembelian Bahan</label>
                                </div>
                                <div class="col-3">
                                    <input type="text" readonly="readonly" class="form-control" id="id_pembelian_bahan" value="{{ $pembelian->id_pembelian_bahan }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="date">Tanggal Pembelian</label>
                                </div>
                                <div class="col-3">
                                    <input type="date" class="form-control" id="tanggal_pembelian_bahan" readonly value="{{ $pembelian->tanggal_pembelian_bahan }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="text">PIC</label>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" value="{{ $pembelian->pegawai->nama_lengkap }}" readonly/>
                                </div>
                            </div>
                        </div>
                        @if($pembelian->status != "Pending")
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="date">Tanggal Penerimaan</label>
                                </div>
                                <div class="col-3">
                                    <input type="date" class="form-control" id="tanggal_penerimaan" readonly value="{{ $penerimaan->tanggal_penerimaan }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="pegawai_id">Penerima</label>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="pegawai_id" readonly value="{{ $penerimaan->pegawai->nama_lengkap }} ({{ $penerimaan->pegawai->user_role }})"/>
                                </div>                
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="cabang_id">Cabang</label>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="cabang_id" readonly value="{{ $pembelian->cabang->nama_cabang }}"/>
                                </div>                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="total">Total</label>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="total" readonly value="Rp {{ number_format($pembelian->total) }}"/>
                                </div>                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="status">Status</label>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="status" readonly value="{{ $pembelian->status }}"/>
                                </div>                
                            </div>
                        </div>
                        <div class="table-responsive container">
                            <table class="table table-striped table-borderless" id="tabel">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID Bahan Baku</th>
                                        <th>Jenis Bahan</th>
                                        <th>Ukuran</th>
                                        <th>Quantity</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody id="table_del_bahan">
                                    @foreach($detail as $d)
                                    <tr>
                                        <td>{{ $d->produk->id_produk }}</td>
                                        <td>{{ $d->produk->jenis_kertas }}</td>
                                        @isset($d->produk->ukuran)
                                        <td>{{ $d->produk->ukuran }}</td>
                                        @else
                                        <td>{{ $d->produk->lebar." x ".$d->produk->panjang." ".$d->produk->satuan }}</td>
                                        @endisset
                                        <td>{{ $d->quantity." ".$d->satuan }}</td>
                                        <td>Rp {{ number_format($d->harga) }}</td>
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
