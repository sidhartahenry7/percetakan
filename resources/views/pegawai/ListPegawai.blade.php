<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daftar Pegawai</title>
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
<body>
    <div class="wrapper d-flex align-items-stretch">
        @include('partials.navbar')
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Daftar Pegawai</h4>
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
                                <th>ID</th>
                                <th>Nama</th>
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
                                <td>{{ $pegawai->id_pegawai }}</td>
                                <td>{{ $pegawai->nama_lengkap }}</td>
                                <td>{{ $pegawai->alamat }}</td>
                                <td>{{ $pegawai->nomor_handphone }}</td>
                                <td>{{ $pegawai->email }}</td>
                                <td>{{ $pegawai->rekening_bank }}</td>
                                <td>{{ $pegawai->nomor_rekening }}</td>
                                <td>{{ $pegawai->gaji_pokok }}</td>
                                <td>{{ $pegawai->tanggal_masuk }}</td>
                                <td>{{ $pegawai->tanggal_keluar }}</td>
                                <td>{{ $pegawai->user_role }}</td>
                                <td>{{ $pegawai->cabang->nama_cabang }}</td>
                                @if(auth()->user()->user_role == "Admin")
                                <td>
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

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

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

</body>
</html>
