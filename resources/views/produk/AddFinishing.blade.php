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
                        <h4 class="card-title">Add Finishing</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-finishing') }}'" style="margin-right: 10px;">
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
                    <form action="/finishing" method="post">
                        @csrf
                        <div class="form-group">
                            <label style="color: black; font-weight: bold;" for="text">ID Finishing</label>
                            <input type="text" readonly="readonly" class="form-control @error('id_finishing') is-invalid @enderror" id="id_finishing" name="id_finishing" required autofocus value="{{ $idproduk }}"/>
                            @error('id_finishing')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="text">Jenis Finishing</label>
                            <input type="text" class="form-control @error('jenis_finishing') is-invalid @enderror" id="jenis_finishing" name="jenis_finishing" required value="{{ old('jenis_finishing') }}"/>
                            @error('jenis_finishing')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="text">Harga</label>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror" id="finishing_harga" name="finishing_harga" required value="{{ old('finishing_harga') }}"/>
                            @error('finishing_harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- <button type="cancel" class="btn btn-danger">
                            Cancel
                        </button> --}}
                        <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-finishing') }}'">
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
