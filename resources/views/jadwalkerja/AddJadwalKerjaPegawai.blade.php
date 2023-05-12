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
                        <h4 class="card-title">Add Jadwal Kerja Pegawai</h4>
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
                    <form action="{{url('/jadwal')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label style="color: black; font-weight: bold;" for="text">Pegawai</label>
                            <select class="form-control @error('pegawai_id') is-invalid @enderror" id="pegawai_id" name="pegawai_id" required>
                                <option selected="" disabled="">
                                    -- Pilih Pegawai --
                                </option>
                                @foreach ($list_pegawai as $pegawai)
                                    @if(old('pegawai_id') == $pegawai->id)
                                        <option value="{{ $pegawai->id }}" selected>{{ $pegawai->nama_lengkap }}</option>
                                    @else
                                        <option value="{{ $pegawai->id }}">{{ $pegawai->nama_lengkap }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="text">Hari</label>
                                    {{-- <br> --}}
                                    <select class="form-control @error('hari') is-invalid @enderror" id="hari" name="hari" required>
                                        <option selected="" disabled="">
                                            -- Pilih Hari --
                                        </option>
                                        @foreach ($list_hari as $hari)
                                            @if(old('hari') == $hari)
                                                <option value="{{ $hari }}" selected>{{ $hari }}</option>
                                            @else
                                                <option value="{{ $hari }}">{{ $hari }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    {{-- <input type="text" class="form-control @error('hari') is-invalid @enderror" id="hari" name="hari" required value="{{ old('hari') }}"/>
                                    @error('hari')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror --}}
                                </div>
                                <div class="col-sm-4">
                                    <label for="text">Jam Masuk</label>
                                    <br>
                                    <input type="time" class="form-control @error('hari') is-invalid @enderror" id="jam_masuk" name="jam_masuk" required value="{{ old('jam_masuk') }}"/>
                                    @error('jam_masuk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label for="text">Jam Keluar</label>
                                    <br>
                                    <input type="time" class="form-control @error('jam_keluar') is-invalid @enderror" id="jam_keluar" name="jam_keluar" required value="{{ old('jam_keluar') }}"/>
                                    @error('jam_keluar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        {{-- <button type="cancel" class="btn btn-danger">
                            Cancel
                        </button> --}}
                        <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-jadwal') }}'">
                            Cancel
                        </button>
                        <button type="submit" class="btn" style="background-color: #29a4da; color: white;">
                            Submit
                        </button>
                    </form>
                    @endif                    
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#pegawai_id').select2();
            $('#hari').select2();
        });
    </script>
</body>
</html>
