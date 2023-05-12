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

    </style>
</head>
<body>
    <div class="wrapper d-flex align-items-stretch">
        @include('partials.navbar')
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Daftar Pegawai</h4>
                    </div>
                    @if(auth()->user()->user_role == "Admin")
                    <button type="button" class="btn btn-primary" onclick="location.href='{{ url('pegawai') }}'" style="margin-right: 10px;">
                        <span class="material-icons align-middle">
                            add
                        </span>
                    </button>
                    @endif
                </div>
            </div>
            <hr style="height: 10px;">
            <div class="iq-card-body">
                <!--Tabel-->
                <div class="table-responsive container">
                    <table class="table table-striped table-borderless" id="dtBasicExample">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID Pegawai</th>
                                <th>Nama Lengkap</th>
                                <th>Alamat</th>
                                <th>Nomor Telepon</th>
                                <th>Email</th>
                                <th>Bank</th>
                                <th>Nomor Rekening</th>
                                <th>Gaji Pokok</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>Role</th>
                                <th>Cabang</th>
                                @if(auth()->user()->user_role == "Admin")
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($list_pegawai as $pegawai)
                            <tr>
                                <td style="min-width: 100px">{{ $pegawai->id_pegawai }}</td>
                                <td style="min-width: 150px">{{ $pegawai->nama_lengkap }}</td>
                                <td style="min-width: 150px">{{ $pegawai->alamat }}</td>
                                <td style="min-width: 130px">{{ $pegawai->nomor_handphone }}</td>
                                <td style="min-width: 150px">{{ $pegawai->email }}</td>
                                <td style="min-width: 120px">{{ $pegawai->rekening_bank }}</td>
                                <td style="min-width: 140px">{{ $pegawai->nomor_rekening }}</td>
                                <td style="min-width: 120px">Rp {{ number_format($pegawai->gaji_pokok) }}</td>
                                <td style="min-width: 150px">{{ date('d F Y', strtotime($pegawai->tanggal_masuk)) }}</td>
                                @isset($pegawai->tanggal_keluar)
                                <td style="min-width: 150px">{{ date('d F Y', strtotime($pegawai->tanggal_keluar)) }}</td>
                                @else
                                <td style="min-width: 150px">{{ $pegawai->tanggal_keluar }}</td>
                                @endisset
                                <td style="min-width: 140px">{{ $pegawai->user_role }}</td>
                                <td style="min-width: 140px">{{ $pegawai->cabang->nama_cabang }}</td>
                                @if(auth()->user()->user_role == "Admin")
                                <td style="min-width: 120px">
                                    <form action="{{ url('/pegawai/'.$pegawai->id) }}" method="POST" class="d-inline">
                                        @method('put')
                                        @csrf
                                        <button class="btn btn-success">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </button>
                                    </form>
                                    <form action="{{ url('/pegawai/'.$pegawai->id) }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>

    <script>
        function myFunction() {
        var x = document.getElementById("passPegawai");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }
    </script>
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
