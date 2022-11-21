<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daftar Komplain</title>
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
                        <h4 class="card-title">Daftar Komplain</h4>
                    </div>
                </div>
                <hr style="height: 10px;">
            </div>
            <!--Tabel-->
            <div class="table-responsive">
                <table class="table table-striped table-borderless">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Nama Produk</th>
                            <th>Isi Komplain</th>
                            <th>Bukti Komplain</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_komplain as $komplain)
                            <tr>
                                <td>{{ $komplain->detail_transaksi->transaksi->id_transaksi }}</td>
                                <td>{{ $komplain->detail_transaksi->detail_produk->nama_produk }}</td>
                                <td>{{ $komplain->isi_komplain }}</td>
                                <td><img src="images/bukti_komplain/{{ $komplain->bukti_komplain }}" style="height: 200px;"/></td>
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
