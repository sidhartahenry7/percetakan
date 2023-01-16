@include('layouts.main')
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid black;
            text-align: left;
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
                        <h4 class="card-title">Kartu Stok Bahan Baku</h4>
                    </div>
                    {{-- <div class="d-inline">
                        <button type="button" class="btn btn-success" onclick="location.href='{{ url('history-pembelian-bahan-baku') }}'" style="margin-right: 10px;">
                            <span class="material-icons align-middle">
                                history
                            </span>
                        </button>
                        @if(auth()->user()->user_role == "Admin")
                        <button type="button" class="btn btn-primary" onclick="location.href='{{ url('pembelian-bahan-baku') }}'" style="margin-right: 10px;">
                            <span class="material-icons align-middle">
                                add
                            </span>
                        </button>
                        @endif
                    </div> --}}
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
            <!--Tabel-->
            <div class="table-responsive container">
                <table class="table table-striped table-borderless" id="dtBasicExample">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>Cabang</th>
                            <th>Bahan Baku</th>
                            <th>Quantity Masuk</th>
                            <th>Quantity Keluar</th>
                            <th>Quantity Sekarang</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($kartu_stok as $stok)
                        <tr>
                            <td>{{ $stok->tanggal }}</td>
                            <td>{{ $stok->cabang->nama_cabang }}</td>
                            <td>{{ $stok->produk->ukuran. ' ' .$stok->produk->jenis_kertas }}</td>
                            <td>{{ $stok->quantity_masuk }}</td>
                            <td>{{ $stok->quantity_keluar }}</td>
                            <td>{{ $stok->quantity_sekarang }}</td>
                            <td>{{ $stok->status }}</td>
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
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
</body>
</html>
