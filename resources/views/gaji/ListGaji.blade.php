<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daftar Gaji</title>
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
                </div>
            </div>
            <hr style="height: 10px;">
            <div class="iq-card-body">
                <!--Tabel-->
                <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                        <thead class="thead-dark">
                            <tr>
                                <th>Tanggal Penggajian</th>
                                <th>Nama Pegawai</th>
                                <th>Gaji Pokok</th>
                                <th>Jumlah Hari Masuk</th>
                                <th>Bonus</th>
                                <th>Total Gaji</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($list_gaji as $gaji)
                            <tr>
                                <td>{{ $gaji->tanggal_cetak }}</td>
                                <td>{{ $gaji->pegawai->nama_lengkap }}</td>
                                <td>{{ $gaji->gaji_pokok }}</td>
                                <td>{{ $gaji->jumlah_hari_masuk }}</td>
                                <td>{{ $gaji->bonus }}</td>
                                <td>{{ $gaji->total_gaji }}</td>
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
