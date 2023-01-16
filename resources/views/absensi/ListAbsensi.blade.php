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

        label {
            color: black;
        }

    </style>
</head>
<body onload="startTime();">
    <div class="wrapper d-flex align-items-stretch">
        @include('partials.navbar')

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Daftar Absensi</h4>
                    </div>
                </div>
            </div>
            <hr style="height: 10px;">
            <div class="iq-card-body">
                <!--Tabel-->
                <div class="table-responsive container">
                    <table class="table table-striped table-borderless" id="dtBasicExample">
                        <thead class="thead-dark">
                            <tr>
                                {{-- <th>Nama Cabang</th> --}}
                                <th style="min-width: 100px">ID Pegawai</th>
                                <th style="min-width: 150px">Nama Lengkap</th>
                                <th style="min-width: 150px">Tanggal Masuk</th>
                                <th style="min-width: 120px">Jam Masuk</th>
                                <th style="min-width: 150px">Longitude Masuk</th>
                                <th style="min-width: 150px">Latitude Masuk</th>
                                <th style="min-width: 150px">Tanggal Keluar</th>
                                <th style="min-width: 120px">Jam Keluar</th>
                                <th style="min-width: 150px">Longitude Keluar</th>
                                <th style="min-width: 150px">Latitude Keluar</th>
                                <th style="min-width: 120px">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_absensi as $absensi)
                            <tr>
                                {{-- <td>{{ $absensi->pegawai->cabang->nama_cabang }}</td> --}}
                                <td>{{ $absensi->pegawai->id_pegawai }}</td>
                                <td>{{ $absensi->pegawai->nama_lengkap }}</td>
                                <td>{{ date('d-m-Y', strtotime($absensi->tanggal_masuk)) }}</td>
                                <td>{{ $absensi->jam_masuk }}</td>
                                <td>{{ $absensi->longitude_masuk }}</td>
                                <td>{{ $absensi->latitude_masuk }}</td>
                                @isset ($absensi->tanggal_keluar)
                                <td>{{ date('d-m-Y', strtotime($absensi->tanggal_keluar)) }}</td>
                                @else
                                <td>&nbsp;</td>
                                @endisset
                                @isset ($absensi->jam_keluar)
                                <td>{{ $absensi->jam_keluar }}</td>
                                @else
                                <td>&nbsp;</td>
                                @endisset
                                @isset ($absensi->longitude_keluar)
                                <td>{{ $absensi->longitude_keluar }}</td>
                                @else
                                <td>&nbsp;</td>
                                @endisset
                                @isset ($absensi->latitude_keluar)
                                <td>{{ $absensi->latitude_keluar }}</td>
                                @else
                                <td>&nbsp;</td>
                                @endisset
                                <td>{{ $absensi->status }}</td>
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
    <script>
        function startTime() {
            const today = new Date();
            let h = today.getHours();
            let m = today.getMinutes();
            let s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('jam').innerHTML =  h + ":" + m + ":" + s;
            // document.getElementById('jam_keluar').innerHTML =  h + ":" + m + ":" + s;
            setTimeout(startTime, 1000);
        }
        
        function checkTime(i) {
          if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
          return i;
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
