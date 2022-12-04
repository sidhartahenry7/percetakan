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
                        <h4 class="card-title">Daftar Gaji</h4>
                    </div>
                    @if(auth()->user()->user_role == "Admin")
                    <button type="button" class="btn btn-primary" onclick="location.href='{{ url('gaji') }}'" style="margin-right: 10px;">
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
                    <table class="table table-striped table-borderless">
                        <thead class="thead-dark">
                            <tr>
                                <th style="min-width: 120px">Tanggal Penggajian</th>
                                <th style="min-width: 150px">Nama Pegawai</th>
                                <th style="min-width: 150px">Gaji Pokok</th>
                                <th style="min-width: 120px">Jumlah Hari Masuk</th>
                                <th style="min-width: 150px">Bonus</th>
                                <th style="min-width: 150px">Total Gaji</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($list_gaji as $gaji)
                            <tr>
                                <td>{{ date('d-m-Y', strtotime($gaji->tanggal_cetak)) }}</td>
                                <td>{{ $gaji->pegawai->nama_lengkap }}</td>
                                <td>Rp {{ number_format($gaji->gaji_pokok) }}</td>
                                <td>{{ $gaji->jumlah_hari_masuk }}</td>
                                <td>Rp {{ number_format($gaji->bonus) }}</td>
                                <td>Rp {{ number_format($gaji->total_gaji) }}</td>
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
