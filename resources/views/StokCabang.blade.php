<!DOCTYPE html>
<html lang="en">
<head>
    <title>Stok</title>
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
                        <h4 class="card-title">Stok</h4>
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
                    @if(auth()->user()->user_role == "Admin" || auth()->user()->user_role == "Kepala Toko" || auth()->user()->user_role == "Wakil Kepala Toko")
                    <form action="/stok" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">Cabang</label>
                                    <select class="form-control @error('cabang_id') is-invalid @enderror" id="cabang_id" name="cabang_id" required>
                                        <option selected="" disabled="">
                                            -- Pilih Cabang --
                                        </option>
                                        @foreach ($list_cabang as $cabang)
                                            @if(old('pegawai_id') == $cabang->id)
                                                <option value="{{ $cabang->id }}" selected>{{ $cabang->nama_cabang }}</option>
                                            @else
                                                <option value="{{ $cabang->id }}">{{ $cabang->nama_cabang }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">Produk</label>
                                    {{-- <br> --}}
                                    <select class="form-control @error('produk_id') is-invalid @enderror" id="produk_id" name="produk_id" required>
                                        <option selected="" disabled="">
                                            -- Pilih Produk --
                                        </option>
                                        @foreach ($list_produk as $produk)
                                            @if(old('produk_id') == $produk->id)
                                                <option value="{{ $produk->id }}" selected>{{ $produk->ukuran . " " . $produk->jenis_kertas }}</option>
                                            @else
                                                <option value="{{ $produk->id }}">{{ $produk->ukuran . " " . $produk->jenis_kertas }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="text">Jumlah Stok</label>
                                    <br>
                                    <input type="number" class="form-control @error('jumlah_stok') is-invalid @enderror" id="jumlah_stok" name="jumlah_stok" required value="{{ old('jumlah_stok') }}"/>
                                    @error('jumlah_stok')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <button type="cancel" class="btn btn-danger">
                            Cancel
                        </button>
                        <button type="submit" class="btn" style="background-color: #29a4da; color: white;">
                            Submit
                        </button>
                    </form>
                    @endif

                    @if(auth()->user()->user_role != "Admin")
                    <br>
                    <div class="form-group">
                        <label style="color: black; font-weight: bold;" for="text">Nama Cabang :</label>
                        <label for="text">{{ auth()->user()->cabang->nama_cabang }}</label>
                    </div>
                    <div class="form-group">
                        <label style="color: black; font-weight: bold;" for="text">Alamat :</label>
                        <label for="text">{{ auth()->user()->cabang->alamat }}</label>
                    </div>
                    <div class="form-group">
                        <label style="color: black; font-weight: bold;" for="text">Nomor Telepon :</label>
                        <label for="text">{{ auth()->user()->cabang->nomor_telepon }}</label>
                    </div>
                    @endif
                    
                </div>
            </div>
            <br>
            <!--Tabel-->
            <table>
                <tr>
                    <th>ID Cabang</th>
                    <th>Nama Cabang</th>
                    <th>ID Produk</th>
                    <th>Ukuran</th>
                    <th>Jenis Kertas</th>
                    <th>Jumlah Stok</th>
                    @if(auth()->user()->user_role == 'Admin' || auth()->user()->user_role == 'Kepala Toko' || auth()->user()->user_role == 'Wakil Kepala Toko')
                    <th>Action</th>
                    @endif
                </tr>
                @foreach ($list_stok as $stok)
                    <tr>
                        <td>{{ $stok->cabang->id_cabang }}</td>
                        <td>{{ $stok->cabang->nama_cabang }}</td>
                        <td>{{ $stok->produk->id_produk }}</td>
                        <td>{{ $stok->produk->ukuran }}</td>
                        <td>{{ $stok->produk->jenis_kertas }}</td>
                        <td>{{ $stok->jumlah_stok }}</td>
                        @if(auth()->user()->user_role == 'Admin' || auth()->user()->user_role == 'Kepala Toko' || auth()->user()->user_role == 'Wakil Kepala Toko')
                        <td>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" style="height: 35px; font-size: small; padding: 5px; margin-left: 5px;">Edit</button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Jumlah Stok</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form>
                                        {{-- <form method="post" action="/stok">
                                            @csrf --}}
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="edit_stok">Edit Jumlah Stok
                                                        <input type="number" class="form-control @error('jumlah_stok') is-invalid @enderror" id="jumlah_stok" name="jumlah_stok" required>
                                                    </label>
                                                    @error('jumlah_stok')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Confirm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>

  
      
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
