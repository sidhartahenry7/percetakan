<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cabang</title>
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Cabang</h4>
                    </div>
                </div>
                <hr style="height: 10px;">
                @if(auth()->user()->user_role == "Admin")
                <div class="iq-card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(auth()->user()->user_role == "Admin")
                    <form action="/cabang" method="post">
                        @csrf
                        <div class="form-group">
                            <label style="color: black; font-weight: bold;" for="text">ID Cabang</label><br>
                            {{-- <label for="text" id="nama_cabang" name="nama_cabang">{{ $jumlah_cabang }}</label> --}}
                            <input type="text" readonly="readonly" class="form-control @error('id_cabang') is-invalid @enderror" id="id_cabang" name="id_cabang" required value="{{ $idcabang }}"/>
                            @error('id_cabang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="text">Nama Cabang</label><br>
                            <input type="text" class="form-control @error('nama_cabang') is-invalid @enderror" id="nama_cabang" name="nama_cabang" required autofocus value="{{ old('nama_cabang') }}"/>
                            @error('nama_cabang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="text">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required value="{{ old('alamat') }}"/>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="text">Longitude</label>
                                    <br>
                                    <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" required value="{{ old('longitude') }}"/>
                                    @error('longitude')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label for="text">Latitude</label>
                                    <br>
                                    <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" required value="{{ old('latitude') }}"/>
                                    @error('latitude')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="text">Nomor Telepon</label>
                            <input type="number" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" name="nomor_telepon"/>
                            @error('nomor_telepon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- <button type="cancel" class="btn btn-danger">
                            Cancel
                        </button> --}}
                        <button type="submit" class="btn" style="background-color: #29a4da; color: white;">
                            Submit
                        </button>
                    </form>
                    @endif
                </div>
                @endif
            </div>
            <br>
            @if(auth()->user()->user_role == "Admin")
            <!--Tabel-->
            <div class="table-responsive">
                <table class="table table-striped table-borderless">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Cabang</th>
                            <th>Nama Cabang</th>
                            <th>Alamat</th>
                            <th>Longitude</th>
                            <th>Latitude</th>
                            <th>No Telepon</th>
                            @if(auth()->user()->user_role == "Admin")
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($list_cabang as $cabang)
                        <tr>
                            <td>{{ $cabang->id_cabang }}</td>
                            <td>{{ $cabang->nama_cabang }}</td>
                            <td>{{ $cabang->alamat }}</td>
                            <td>{{ $cabang->longitude }}</td>
                            <td>{{ $cabang->latitude }}</td>
                            <td>{{ $cabang->nomor_telepon }}</td>
                            {{-- <td>
                                <div class="d-inline">
                                    <a href="{{ url('/cabang/'.$cabang->id.'/edit') }}" class="btn btn-warning btn-sm">
                                        <span class="material-icons align-middle">
                                            edit
                                        </span>
                                    </a>
                                    <a href="{{ url('/cabang/'.$cabang->id.'/delete') }}" class="btn btn-danger btn-sm">
                                        <span class="material-icons align-middle">
                                            delete
                                        </span>
                                    </a>
                                </div>
                            </td> --}}
                            @if(auth()->user()->user_role == "Admin")
                            <td>
                                <form action="{{ url('/cabang/'.$cabang->id) }}" method="POST" class="d-inline">
                                    @method('put')
                                    @csrf
                                    <button class="btn btn-success">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </button>
                                </form>
                                <form action="{{ url('/cabang/'.$cabang->id) }}" method="POST" class="d-inline">
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
            @else
            <div class="table-responsive">
                <table class="table table-borderless">
                    <tr>
                        <td class="text-left" style="width: 12%"><label style="color: black; font-weight: bold;" for="text">ID Cabang</label></td>
                        <td class="text-left" style="width: 2%"><label style="color: black; font-weight: bold;" for="text">:</label></td>
                        <td class="text-left"><label for="text">{{ auth()->user()->cabang->id_cabang }}</label></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 12%"><label style="color: black; font-weight: bold;" for="text">Nama Cabang</label></td>
                        <td class="text-left" style="width: 2%"><label style="color: black; font-weight: bold;" for="text">:</label></td>
                        <td class="text-left"><label for="text">{{ auth()->user()->cabang->nama_cabang }}</label></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 12%"><label style="color: black; font-weight: bold;" for="text">Alamat</label></td>
                        <td class="text-left" style="width: 2%"><label style="color: black; font-weight: bold;" for="text">:</label></td>
                        <td class="text-left"><label for="text">{{ auth()->user()->cabang->alamat }}</label></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 12%"><label style="color: black; font-weight: bold;" for="text">Longitude</label></td>
                        <td class="text-left" style="width: 2%"><label style="color: black; font-weight: bold;" for="text">:</label></td>
                        <td class="text-left"><label for="text">{{ auth()->user()->cabang->longitude }}</label></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 12%"><label style="color: black; font-weight: bold;" for="text">Latitude</label></td>
                        <td class="text-left" style="width: 2%"><label style="color: black; font-weight: bold;" for="text">:</label></td>
                        <td class="text-left"><label for="text">{{ auth()->user()->cabang->latitude }}</label></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 12%"><label style="color: black; font-weight: bold;" for="text">Nomor Telepon</label></td>
                        <td class="text-left" style="width: 2%"><label style="color: black; font-weight: bold;" for="text">:</label></td>
                        <td class="text-left"><label for="text">{{ auth()->user()->cabang->nomor_telepon }}</label></td>
                    </tr>
                </table>
            </div>
            @endif
        </div>

  
      
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
