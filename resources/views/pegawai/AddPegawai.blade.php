<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Pegawai</title>
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
                        <h4 class="card-title">Add Pegawai</h4>
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
                    @if(auth()->user()->user_role == "Admin")
                    <form action="/pegawai" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label style="color: black; font-weight: bold;" for="text">ID Pegawai</label>
                                    <input type="text" readonly="readonly" class="form-control @error('id_pegawai') is-invalid @enderror" id="idPegawai" name="id_pegawai" required value="{{ $idpegawai }}"/>
                                    @error('id_pegawai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-8">
                                    <label for="text">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="namaLengkap" name="nama_lengkap" required value="{{ old('nama_lengkap') }}"/>
                                    @error('nama_lengkap')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-8">
                                    <label for="text">Alamat</label>
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required value="{{ old('alamat') }}"/>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="text">Nomor Handphone</label>
                                    <input type="number" class="form-control @error('nomor_handphone') is-invalid @enderror" id="nomor_handphone" name="nomor_handphone" required value="{{ old('nomor_handphone') }}"/>
                                    @error('nomor_handphone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label for="text">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailPegawai" name="email" required value="{{ old('email') }}"/>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="namaBank">Nama Bank</label>
                                    <select class="form-control @error('rekening_bank') is-invalid @enderror" data-live-search="true" id="namaBank" name="rekening_bank" required>
                                        <option selected="" disabled="">
                                            -- Pilih Bank --
                                        </option>
                                        <option>BCA</option>
                                        <option>BRI</option>
                                        <option>BNI</option>
                                        <option>Bank Mandiri</option>
                                    </select>
                                    @error('rekening_bank')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label for="text">Nomor Rekening</label>
                                    <input type="number" class="form-control @error('nomor_rekening') is-invalid @enderror" id="noRekening" name="nomor_rekening" required value="{{ old('nomor_rekening') }}"/>
                                    @error('nomor_rekening')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-8">
                                    <label for="text">Gaji Pokok</label>
                                    <input type="number" class="form-control @error('gaji_pokok') is-invalid @enderror" id="gaji_pokok" name="gaji_pokok" required value="{{ old('gaji_pokok') }}"/>
                                    @error('gaji_pokok')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="text">Tanggal Masuk</label>
                                    <br>
                                    <input for="tanggalMasuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" type="date" id="tanggalMasuk" name="tanggal_masuk" required value="{{ old('tanggal_masuk') }}"/>
                                    @error('tanggal_masuk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label for="text">Tanggal Keluar</label>
                                    <br>
                                    <input for="tanggalKeluar" class="form-control" type="date" id="tanggalKeluar"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="role">Role</label>
                                    <select class="form-control @error('user_role') is-invalid @enderror" id="role" name="user_role" required>
                                        <option selected="" disabled="">
                                            -- Pilih Role --
                                        </option>
                                        <option>Kepala Toko</option>
                                        <option>Wakil Kepala Toko</option>
                                        <option>Kasir</option>
                                        <option>Desainer</option>
                                        <option>Operator Printer</option>
                                        <option>Admin</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="cabang">Cabang</label>
                                    <select class="form-control @error('cabang_id') is-invalid @enderror" id="cabang" name="cabang_id" required>
                                        <option selected="" disabled="">
                                            -- Pilih Cabang --
                                        </option>
                                        @foreach ($list_cabang as $cabang)
                                            @if(old('cabang_id') == $cabang->id)
                                                <option value="{{ $cabang->id }}" selected>{{ $cabang->nama_cabang }}</option>
                                            @else
                                                <option value="{{ $cabang->id }}">{{ $cabang->nama_cabang }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- <button type="cancel" class="btn btn-danger">
                            Cancel
                        </button> --}}
                        <button type="submit" class="btn" style="background-color: #29a4da; color: white;">
                            Submit
                        </button>
                    </form>
                    @endif
                    
                    {{-- @if(auth()->user()->user_role != "Admin")
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
                    @endif --}}

                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#namaBank').select2();
            $('#role').select2();
            $('#cabang').select2();
        });
    </script>

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
