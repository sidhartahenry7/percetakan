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
                        <h4 class="card-title">Add Pembayaran</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-pembayaran') }}'" style="margin-right: 10px;">
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
                    <form action="{{ url('/pembayaran') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="text">PIC</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" readonly value="{{ auth()->user()->nama_lengkap }}"/>
                                    <input type="hidden" class="form-control @error('pegawai_id') is-invalid @enderror" id="pegawai_id" name="pegawai_id" required readonly value="{{ auth()->user()->id }}"/>
                                    @error('pegawai_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="text">Cabang</label>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control @error('cabang_id') is-invalid @enderror" id="cabang_id" name="cabang_id" required>
                                        @if(auth()->user()->user_role == "Admin")
                                        <option selected="" disabled="">
                                            -- Pilih Cabang --
                                        </option>
                                        @foreach ($list_cabang as $cabang)
                                            @if(old('cabang_id') == $cabang->id)
                                                <option value="{{ $cabang->id }}" selected>{{ $cabang->id_cabang }}  {{ $cabang->nama_cabang }}</option>
                                            @else
                                                <option value="{{ $cabang->id }}">{{ $cabang->id_cabang }}  {{ $cabang->nama_cabang }}</option>
                                            @endif
                                        @endforeach
                                        @else
                                        <option value="{{ auth()->user()->cabang_id }}" selected>{{ auth()->user()->cabang->id_cabang }}  {{ auth()->user()->cabang->nama_cabang }}</option>
                                        @endif
                                    </select>
                                    @error('cabang_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="text">Tanggal Pembayaran</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control @error('tanggal_pembayaran') is-invalid @enderror" id="tanggal_pembayaran" name="tanggal_pembayaran" required value="{{ date('Y-m-d') }}"/>
                                    @error('tanggal_pembayaran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="text">Jenis Biaya</label>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control @error('biaya_id') is-invalid @enderror" id="biaya_id" name="biaya_id" required>
                                        <option selected="" disabled="">
                                            -- Pilih Jenis Biaya --
                                        </option>
                                        @foreach ($list_biaya as $biaya)
                                            @if(old('biaya_id') == $biaya->id)
                                                <option value="{{ $biaya->id }}" selected>{{ $biaya->jenis_biaya }}</option>
                                            @else
                                                <option value="{{ $biaya->id }}">{{ $biaya->jenis_biaya }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="text">Nominal</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control @error('nominal') is-invalid @enderror" id="nominal" name="nominal" required/>
                                    @error('nominal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-pembayaran') }}'">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#cabang_id').select2();
            $('#biaya_id').select2();
        });
    </script>
</body>
</html>
