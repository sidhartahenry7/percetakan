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
            background-color: #FFC300;
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
                        <h4 class="card-title">Edit Kategori</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-kategori') }}'" style="margin-right: 10px;">
                        Back
                    </button>
                </div>
                <hr style="height: 10px;">
                <div class="iq-card-body">
                    <form action="{{ url('/kategori/'.$kategori->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">ID Kategori</label>
                                </div>
                                <div class="col-sm-9">
                                    <label style="color: black; font-weight: bold;" for="text" id="id_kategori">{{ $kategori->id_kategori }}</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="text">Nama Kategori</label>
                                </div>
                                <div class="col-sm-9">
                                    <label for="text" id="nama_kategori">{{ $kategori->nama_kategori }}</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="text">Gambar Kategori</label>
                                </div>
                                @empty($kategori->gambar_kategori)
                                <div class="col-sm-9">
                                    <label for="text" id="gambar_kategori">None</label>
                                </div>
                                @else
                            </div>
                            <div class="row">
                                <div class="col-sm-9">
                                    <img src="{{ asset('/storage/'.$kategori->gambar_kategori) }}" style="height: 350px"/>
                                </div>
                                @endempty
                            </div>
                            <div class="row">
                                <div class="col-sm-9">
                                    <input type="file" class="@error('gambar_kategori') is-invalid @enderror" id="gambar_kategori" name="gambar_kategori"/>
                                    @error('gambar_kategori')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="text">Estimasi Durasi Pengerjaan</label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control @error('estimasi_durasi') is-invalid @enderror" id="estimasi_durasi" name="estimasi_durasi" required value="{{ $durasi }}"/>
                                    @error('estimasi_durasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" id="satuan_durasi" name="satuan_durasi">
                                        @foreach ($list_satuan as $list)
                                            @if($satuan == $list)
                                                <option value="{{ $list }}" selected>{{ $list }}</option>
                                            @else
                                                <option value="{{ $list }}">{{ $list }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-kategori') }}'">
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

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>
