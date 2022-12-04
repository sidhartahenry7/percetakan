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
                        <h4 class="card-title">Add Pelanggan</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-pelanggan') }}'" style="margin-right: 10px;">
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
                    <form action="/pelanggan" method="post">
                        @csrf
                        <div class="form-group">
                            <label style="color: black; font-weight: bold;" for="text">ID Pelanggan</label>
                            <input type="text" readonly="readonly" class="form-control @error('id_pelanggan') is-invalid @enderror" id="id_pelanggan" name="id_pelanggan" required value="{{ $idpelanggan }}"/>
                            @error('id_pelanggan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="text">Nama</label>
                            <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror" id="nama_pelanggan" name="nama_pelanggan" required autofocus value="{{ old('nama_pelanggan') }}"/>
                            @error('nama_pelanggan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="text">Nomor Handphone</label>
                            <input type="number" class="form-control @error('nomor_handphone') is-invalid @enderror" id="nomor_handphone" name="nomor_handphone" required autofocus value="{{ old('nomor_handphone') }}"/>
                            @error('nomor_handphone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        {{-- <button type="cancel" class="btn btn-danger">
                            Cancel
                        </button> --}}
                        <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-pelanggan') }}'">
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
</body>
</html>
