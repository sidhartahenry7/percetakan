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
            background-color: #0b2357;
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
                        <h4 class="card-title">Penerimaan Bahan Baku</h4>
                    </div>
                    <button type="button" class="btn" onclick="location.href='{{ url('list-pembelian-bahan-baku') }}'" style="margin-right: 10px; background-color: #29a4da; color:white;">
                        <span class="material-icons align-middle">arrow_back</span>
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
                    <form action="/penerimaan-bahan-baku" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label style="color: black; font-weight: bold;" for="text">ID Pembelian Bahan</label>
                                </div>
                                <div class="col-3">
                                    <input type="text" readonly="readonly" class="form-control" id="id_pembelian_bahan" autofocus value="{{ $pembelian->id_pembelian_bahan }}"/>
                                    <input type="hidden" readonly="readonly" class="form-control @error('pembelian_bahan_id') is-invalid @enderror" id="pembelian_bahan_id" name="pembelian_bahan_id" required value="{{ $pembelian->id }}"/>
                                    @error('pembelian_bahan_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="text">Cabang</label>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="cabang_id" readonly value="{{ $pembelian->cabang->nama_cabang }}"/>
                                </div>                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="date">Tanggal Penerimaan</label>
                                </div>
                                <div class="col-3">
                                    <input type="date" class="form-control @error('tanggal_penerimaan') is-invalid @enderror" id="tanggal_penerimaan" name="tanggal_penerimaan" readonly required value="{{ date('Y-m-d') }}"/>
                                    @error('tanggal_penerimaan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="text">PIC</label>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="nama_lengkap" readonly value="{{ auth()->user()->nama_lengkap }}"/>
                                    <input type="hidden" class="form-control @error('pegawai_id') is-invalid @enderror" id="pegawai_id" name="pegawai_id" required readonly value="{{ auth()->user()->id }}"/>
                                    @error('pegawai_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="text">Total</label>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="total" readonly value="Rp {{ number_format($pembelian->total) }}"/>
                                </div>                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="text">Status</label>
                                </div>
                                <div class="col-3">
                                    <select class="form-control" id="status" name="status">                    
                                        <option value="Terima">Terima</option>
                                        <option value="Tolak">Tolak</option>
                                    </select>
                                </div>                
                            </div>
                        </div>
                        <div class="table-responsive container">
                            <table class="table table-striped table-borderless" id="tabel">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID Bahan Baku</th>
                                        <th>Ukuran</th>
                                        <th>Jenis Kertas</th>
                                        <th>Quantity (lbr)</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($detail as $d)
                                    <tr>
                                        <td>{{ $d->produk->id_produk }}</td>
                                        <td>{{ $d->produk->ukuran }}</td>
                                        <td>{{ $d->produk->jenis_kertas }}</td>
                                        <td>{{ $d->quantity }}</td>
                                        <td>Rp {{ number_format($d->harga) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody> 
                            </table>
                        </div>
                        <button type="button" class="btn" style="background-color: #29a4da; color:white;" onclick="location.href='{{ url('list-pembelian-bahan-baku') }}'">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
</html>
