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
                        <h4 class="card-title">Add Detail Produk</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-detail-produk') }}'" style="margin-right: 10px;">
                        Back
                    </button>
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
                                        <label for="produk">Finishing</label>
                                        <select class="form-control @error('finishing_id') is-invalid @enderror" id="finishing_id" name="finishing_id" required>
                                            <option selected="" disabled="">
                                                -- Pilih Finishing --
                                            </option>
                                            @foreach ($list_finishing as $finishing)
                                                @if(old('finishing_id') == $finishing->id)
                                                    <option value="{{ $finishing->id }}" selected>{{ $finishing->jenis_finishing }}</option>
                                                @else
                                                    <option value="{{ $finishing->id }}">{{ $finishing->jenis_finishing }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <input type="checkbox" id="status_finishing" name="status_finishing"> harga per quantity
                                    </div>
                                </div>
                                {{-- <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="text">Finishing</label>
                                        <input type="text" class="form-control @error('finishing') is-invalid @enderror" id="finishing" name="finishing" required value="{{ old('finishing') }}"/>
                                        @error('keterangan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div> --}}
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
                        <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-detail-produk') }}'">
                            Cancel
                        </button>
                        <button type="submit" class="btn" style="background-color: #29a4da; color: white;">
                            Submit
                        </button>
                    </form>
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
            $('#kategori_id').select2();
            $('#produk_id').select2();
            $('#tinta_id').select2();
            $('#finishing_id').select2();
        });
    </script>
</body>
</html>
