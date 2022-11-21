<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daftar Absensi</title>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900"
        rel="stylesheet"
    />

    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="css/style.css" />
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
                <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                        <thead class="thead-dark">
                            <tr>
                                {{-- <th>Nama Cabang</th> --}}
                                <th>ID Pegawai</th>
                                <th>Nama Pegawai</th>
                                <th>Tanggal Masuk</th>
                                <th>Jam Masuk</th>
                                <th>Longitude Masuk</th>
                                <th>Latitude Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>Jam Keluar</th>
                                <th>Longitude Keluar</th>
                                <th>Latitude Keluar</th>
                                <th>Status</th>
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
                                <td>{{ $absensi->jam_keluar }}</td>
                                <td>{{ $absensi->longitude_keluar }}</td>
                                <td>{{ $absensi->latitude_keluar }}</td>
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
</body>
</html>
