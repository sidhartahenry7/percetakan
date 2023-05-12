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
                        <h4 class="card-title">Detail Kategori</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-kategori') }}'" style="margin-right: 10px;">
                        Back
                    </button>
                </div>
                <hr style="height: 10px;">
                <div class="iq-card-body">
                    <form>
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
                                @endempty
                            </div>
                            @isset($kategori->gambar_kategori)
                            <div class="row">
                                <div class="col-sm-9">
                                    <img src="{{ asset('/storage/'.$kategori->gambar_kategori) }}" style="height: 350px"/>
                                </div>
                            </div>
                            @endisset
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="text">Estimasi Durasi Pengerjaan</label>
                                </div>
                                <div class="col-sm-3">
                                    <label for="text" id="estimasi_durasi">{{ $durasi.' '.$satuan }}</label>
                                </div>
                            </div>
                        </div>
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
