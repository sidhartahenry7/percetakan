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
                        <h4 class="card-title">Daftar Jadwal Kerja Pegawai</h4>
                    </div>
                    @if(auth()->user()->user_role == "Admin")
                    <button type="button" class="btn btn-primary" onclick="location.href='{{ url('jadwal') }}'" style="margin-right: 10px;">
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
                <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID Pegawai</th>
                                <th>Nama Pegawai</th>
                                <th>Hari</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                @if(auth()->user()->user_role == "Admin")
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($list_jadwal as $jadwal)
                            <tr>
                                <td>{{ $jadwal->pegawai->id_pegawai }}</td>
                                <td>{{ $jadwal->pegawai->nama_lengkap }}</td>
                                <td>{{ $jadwal->hari }}</td>
                                <td>{{ $jadwal->jam_masuk }}</td>
                                <td>{{ $jadwal->jam_keluar }}</td>
                                @if(auth()->user()->user_role == "Admin")
                                <td>
                                    <form action="{{ url('/jadwal/'.$jadwal->id) }}" method="POST" class="d-inline">
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

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
