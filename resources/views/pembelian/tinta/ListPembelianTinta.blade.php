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
                        <h4 class="card-title">Daftar Pembelian Tinta</h4>
                    </div>
                    <div class="d-inline">
                        <button type="button" class="btn" onclick="location.href='{{ url('history-pembelian-tinta') }}'" style="margin-right: 10px; background-color: #29a4da; color:white;">
                            <span class="material-icons align-middle">
                                history
                            </span>
                        </button>
                        @if(auth()->user()->user_role == "Admin")
                        <button type="button" class="btn btn-primary" onclick="location.href='{{ url('pembelian-tinta') }}'" style="margin-right: 10px;">
                            <span class="material-icons align-middle">
                                add
                            </span>
                        </button>
                        @endif
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
                </div>
            </div>
            <!--Tabel-->
            <div class="table-responsive container">
                <table class="table table-striped table-borderless" id="dtBasicExample">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Pembelian</th>
                            <th>Tanggal Pembelian</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($list_pembelian as $tinta)
                        <tr>
                            <td>{{ $tinta->id_pembelian_tinta }}</td>
                            <td>{{ $tinta->tanggal_pembelian_tinta }}</td>
                            <td>Rp {{ number_format($tinta->total) }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" onclick="location.href='{{ url('pembelian-tinta/'.$tinta->id) }}'"><span class="material-icons align-middle">visibility</span></button>
                                @if($tinta->status == 'Pending')
                                @if(auth()->user()->user_role == "Admin")
                                <form action="{{ url('pembelian-tinta/'.$tinta->id) }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><span class="material-icons align-middle">delete</span></button>
                                </form>
                                @endif
                                <button type="button" class="btn btn-sm" style="background-color: #29a4da; color:white;" onclick="location.href='{{ url('penerimaan-tinta/'.$tinta->id) }}'">Penerimaan</button>
                                @endif
                            </td>
                            {{-- <td>
                                <form action="{{ url('/penerimaan-bahan-baku/'.$bahan->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td> --}}
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
