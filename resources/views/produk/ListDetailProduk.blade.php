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
                        <h4 class="card-title">Daftar Detail Produk</h4>
                    </div>
                    @if(auth()->user()->user_role == "Admin")
                    <button type="button" class="btn btn-primary" onclick="location.href='{{ url('detail-produk') }}'" style="margin-right: 10px;">
                        <span class="material-icons align-middle">
                            add
                        </span>
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
                </div>
            </div>
            <br>
            <!--Tabel-->
            <div class="table-responsive container">
                <table class="table table-striped table-borderless">
                    <thead class="thead-dark">
                    <tr>
                        <th>ID Detail Produk</th>
                        <th>Kategori</th>
                        <th>Nama Produk</th>
                        <th>Ukuran</th>
                        <th>Jenis Bahan</th>
                        <th>Jenis Tinta</th>
                        <th>Finishing</th>
                        <th>Keterangan</th>
                        <th>Harga</th>
                        <th>Diskon (%)</th>
                        @if(auth()->user()->user_role == "Admin")
                        <th>Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($list_produk as $detail_produk)
                        <tr>
                            <td style="min-width: 150px">{{ $detail_produk->id_detail_produk }}</td>
                            <td style="min-width: 120px">{{ $detail_produk->kategori->nama_kategori }}</td>
                            <td style="min-width: 200px">{{ $detail_produk->nama_produk }}</td>
                            <td>{{ $detail_produk->produk->ukuran }}</td>
                            <td style="min-width: 120px">{{ $detail_produk->produk->jenis_kertas }}</td>
                            <td style="min-width: 120px">{{ $detail_produk->tinta->jenis_tinta }}</td>
                            <td style="min-width: 120px">{{ $detail_produk->finishing->jenis_finishing }}</td>
                            <td style="min-width: 300px; text-align: left;">{!! $detail_produk->keterangan !!}</td>
                            <td style="min-width: 130px">Rp {{ number_format($detail_produk->harga, 2) }}</td>
                            <td style="min-width: 100px">{{ $detail_produk->diskon }}</td>
                            @if(auth()->user()->user_role == "Admin")
                            <td style="min-width: 120px">
                                <div class="d-inline">
                                    <form action="{{ url('/detail-produk/'.$detail_produk->id) }}" method="POST" class="d-inline">
                                        @method('put')
                                        @csrf
                                        <button class="btn btn-success">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="d-inline">
                                    <form action="{{ url('/detail-produk/'.$detail_produk->id) }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

      
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
