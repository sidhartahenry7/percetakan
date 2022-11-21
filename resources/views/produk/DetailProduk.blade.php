<!DOCTYPE html>
<html lang="en">
<head>
    <title>Detail Produk</title>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/trix.css') }}">
    <script type="text/javascript" src="{{ asset('/js/trix.js') }}"></script>
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
                        <h4 class="card-title">Detail Produk</h4>
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
                    <form action="/detail-produk" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">ID Detail Produk</label>
                                    <input type="text" readonly="readonly" class="form-control @error('id_detail_produk') is-invalid @enderror" id="id_detail_produk" name="id_detail_produk" required autofocus value="{{ $idproduk }}"/>
                                    @error('id_detail_produk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-9">
                                    <label for="text">Nama Produk</label>
                                    <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" id="nama_produk" name="nama_produk" required value="{{ old('nama_produk') }}"/>
                                    @error('ukuran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="row">
                                <div class="col-sm-8">
                                    <label for="text">Nama Produk</label>
                                    <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" id="nama_produk" name="nama_produk" required value="{{ old('nama_produk') }}"/>
                                    @error('ukuran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="text">Jenis Kertas</label>
                            <input type="text" class="form-control @error('jenis_kertas') is-invalid @enderror" id="jenis_kertas" name="jenis_kertas" required value="{{ old('jenis_kertas') }}"/>
                            @error('jenis_kertas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}
                        {{-- <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="produk">Kategori</label>
                                        <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                                            <option selected="" disabled="">
                                                -- Pilih Kategori --
                                            </option>
                                            @foreach ($list_kategori as $kategori)
                                                @if(old('kategori_id') == $kategori->id)
                                                    <option value="{{ $kategori->id }}" selected>{{ $kategori->nama_kategori }}</option>
                                                @else
                                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="produk">Kategori</label>
                                        <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                                            <option selected="" disabled="">
                                                -- Pilih Kategori --
                                            </option>
                                            @foreach ($list_kategori as $kategori)
                                                @if(old('kategori_id') == $kategori->id)
                                                    <option value="{{ $kategori->id }}" selected>{{ $kategori->nama_kategori }}</option>
                                                @else
                                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="produk">Ukuran & Jenis Bahan</label>
                                        <select class="form-control @error('produk_id') is-invalid @enderror" id="produk_id" name="produk_id" required>
                                            <option selected="" disabled="">
                                                -- Pilih Ukuran & Jenis Kertas --
                                            </option>
                                            @foreach ($list_main_produk as $main_produk)
                                                @if(old('produk_id') == $main_produk->id)
                                                    <option value="{{ $main_produk->id }}" selected>{{ $main_produk->ukuran . " " . $main_produk->jenis_kertas }}</option>
                                                @else
                                                    <option value="{{ $main_produk->id }}">{{ $main_produk->ukuran . " " . $main_produk->jenis_kertas }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="produk">Jenis Tinta</label>
                                        <select class="form-control @error('tinta_id') is-invalid @enderror" id="tinta_id" name="tinta_id" required>
                                            <option selected="" disabled="">
                                                -- Pilih Jenis Tinta --
                                            </option>
                                            @foreach ($list_tinta as $tinta)
                                                @if(old('tinta_id') == $tinta->id)
                                                    <option value="{{ $tinta->id }}" selected>{{ $tinta->jenis_tinta }}</option>
                                                @else
                                                    <option value="{{ $tinta->id }}">{{ $tinta->jenis_tinta }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="text">Finishing</label>
                                        <input type="text" class="form-control @error('finishing') is-invalid @enderror" id="finishing" name="finishing" required value="{{ old('finishing') }}"/>
                                        @error('keterangan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="text">Keterangan</label>
                                {{-- <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" required value="{{ old('keterangan') }}"/>
                                @error('keterangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror --}}
                                <input id="keterangan" name="keterangan" type="hidden" value="{{ old('keterangan') }}">
                                <trix-editor input="keterangan"></trix-editor>
                            </div>
                            {{-- <div class="row"> --}}
                                {{-- <div class="col-sm-3">
                                </div> --}}
                            {{-- </div> --}}
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="text">Harga</label>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" required value="{{ old('harga') }}"/>
                                        @error('harga')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="text">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" required value="{{ old('keterangan') }}"/>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}
                        {{-- <button type="cancel" class="btn btn-danger">
                            Cancel
                        </button> --}}
                        <button type="submit" class="btn" style="background-color: #29a4da; color: white;">
                            Submit
                        </button>
                    </form>
                    @endif
                </div>
            </div>
            <br>
            <!--Tabel-->
            <div class="table-responsive">
                <table class="table table-striped table-borderless">
                    <thead class="thead-dark">
                    <tr>
                        <th>ID Detail Produk</th>
                        <th>Kategori</th>
                        <th>Nama Produk</th>
                        <th>Ukuran</th>
                        <th>Jenis Bahan</th>
                        <th>Jenis Tinta</th>
                        <th>Finishing</th>
                        <th>Keterangan</th>
                        <th>Harga</th>
                        <th>Diskon (%)</th>
                        @if(auth()->user()->user_role == "Admin")
                        <th>Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($list_produk as $detail_produk)
                        <tr>
                            <td>{{ $detail_produk->id_detail_produk }}</td>
                            <td>{{ $detail_produk->kategori->nama_kategori }}</td>
                            <td>{{ $detail_produk->nama_produk }}</td>
                            <td>{{ $detail_produk->produk->ukuran }}</td>
                            <td>{{ $detail_produk->produk->jenis_kertas }}</td>
                            <td>{{ $detail_produk->tinta->jenis_tinta }}</td>
                            <td>{{ $detail_produk->finishing }}</td>
                            <td>{!! $detail_produk->keterangan !!}</td>
                            <td>Rp {{ number_format($detail_produk->harga, 2) }}</td>
                            <td>{{ $detail_produk->diskon }}</td>
                            @if(auth()->user()->user_role == "Admin")
                            <td>
                                <form action="{{ url('/detail-produk/'.$detail_produk->id) }}" method="POST" class="d-inline">
                                    @method('put')
                                    @csrf
                                    <button class="btn btn-success">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </button>
                                </form>
                                <form action="{{ url('/detail-produk/'.$detail_produk->id) }}" method="POST" class="d-inline">
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

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#kategori_id').select2();
            $('#produk_id').select2();
            $('#tinta_id').select2();
        });
    </script>
</body>
</html>
