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
                        <h4 class="card-title">Edit Cabang</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-cabang') }}'" style="margin-right: 10px;">
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
                    <form action="{{ url('/cabang/'.$cabang->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label style="color: black; font-weight: bold;" for="id_cabang">ID Cabang</label>
                                    <input type="text" class="form-control"  id="id_cabang" name="id_cabang" value="{{ $cabang->id_cabang }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label style="color: black; font-weight: bold;" for="nama_cabang">Nama Cabang</label>
                                    <input type="text" class="form-control"  id="nama_cabang" name="nama_cabang" value="{{ $cabang->nama_cabang }}" required autofocus />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label style="color: black; font-weight: bold;" for="alamat">Alamat</label>
                                    <input type="text" class="form-control"  id="alamat" name="alamat" value="{{ $cabang->alamat }}" required autofocus />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label style="color: black; font-weight: bold;" for="longitude">Longitude</label>
                                    <input type="text" class="form-control"  id="longitude" name="longitude" value="{{ $cabang->longitude }}" required autofocus />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label style="color: black; font-weight: bold;" for="latitude">Latitude</label>
                                    <input type="text" class="form-control"  id="latitude" name="latitude" value="{{ $cabang->latitude }}" required autofocus />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label style="color: black; font-weight: bold;" for="nomor_telepon">Nomor Telepon</label>
                                    <input type="text" class="form-control"  id="nomor_telepon" name="nomor_telepon" value="{{ $cabang->nomor_telepon }}" required autofocus />
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-cabang') }}'">
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
