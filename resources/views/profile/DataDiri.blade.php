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
                        <h4 class="card-title">Data Diri</h4>
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
                    <form action="{{ url('data-diri/'.$data_diri->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row justify-content-start">
                                <div class="col-2">
                                    <label style="color: black; font-weight: bold;" for="text">ID Pegawai</label>
                                </div>
                                <div class="col-2">
                                    <label style="color: black; font-weight: bold;" for="text">{{ $data_diri->id_pegawai }}</label>
                                </div>
                            </div>
                            <input type="hidden" readonly="readonly" class="form-control @error('id_pegawai') is-invalid @enderror" style="width: 270px;" id="idPegawai" name="id" required value="{{ $data_diri->id }}"/>
                            @error('id_pegawai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row justify-content-start align-self-center">
                                <div class="col-2">
                                    <label style="color: black; font-weight: bold;" for="text">Nama Lengkap</label>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" style="width: 270px;" id="namaLengkap" name="nama_lengkap" required value="{{ $data_diri->nama_lengkap }}"/>
                                    @error('nama_lengkap')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row justify-content-start align-self-center">
                                <div class="col-2">
                                    <label style="color: black; font-weight: bold;" for="text">Alamat</label>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" style="width: 270px;" id="alamat" name="alamat" required value="{{ $data_diri->alamat }}"/>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row justify-content-start align-self-center">
                                <div class="col-2">
                                    <label style="color: black; font-weight: bold;" for="text">Nomor Handphone</label>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control @error('nomor_handphone') is-invalid @enderror" style="width: 270px;" id="nomor_handphone" name="nomor_handphone" required value="{{ $data_diri->nomor_handphone }}"/>
                                    @error('nomor_handphone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row justify-content-start align-self-center">
                                <div class="col-2">
                                    <label style="color: black; font-weight: bold;" for="text">Email</label>
                                </div>
                                <div class="col-2">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" style="width: 270px;" id="emailPegawai" name="email" required value="{{ $data_diri->email }}"/>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row justify-content-start align-self-center">
                                <div class="col-2">
                                    <label style="color: black; font-weight: bold;" for="text">Nama Bank</label>
                                </div>
                                <div class="col-2">
                                    <select class="form-control @error('rekening_bank') is-invalid @enderror" style="width: 270px;" id="namaBank" name="rekening_bank" required>
                                        @foreach ($list_bank as $bank)
                                            @if(old('rekening_bank') == $bank)
                                                <option value="{{ $bank }}" selected>{{ $bank }}</option>
                                            @else
                                                <option value="{{ $bank }}">{{ $bank }}</option>
                                            @endif
                                        @endforeach
                                        {{-- <option selected="" disabled="">
                                            -- Pilih Bank --
                                        </option>
                                        <option>Bank BCA</option>
                                        <option>Bank BRI</option>
                                        <option>Bank BNI</option>
                                        <option>Bank Mandiri</option> --}}
                                    </select>
                                    @error('rekening_bank')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row justify-content-start align-self-center">
                                <div class="col-2">
                                    <label style="color: black; font-weight: bold;" for="text">Nomor Rekening</label>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control @error('nomor_rekening') is-invalid @enderror" style="width: 270px;" id="noRekening" name="nomor_rekening" required value="{{ $data_diri->nomor_rekening }}"/>
                                    @error('nomor_rekening')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row justify-content-start align-self-center">
                                <div class="col-2">
                                    <label style="color: black; font-weight: bold;" for="text">Tanggal Masuk</label>
                                </div>
                                <div class="col-2">
                                    <label for="text">{{ date('d M Y', strtotime($data_diri->tanggal_masuk)) }}</label>
                                    <input for="tanggalMasuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" type="hidden" style="width: 270px;" id="tanggalMasuk" name="tanggal_masuk" required value="{{ date('Y-m-d', strtotime($data_diri->tanggal_masuk)) }}"/>
                                    @error('tanggal_masuk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-sm-3">
                                    <label for="text">Tanggal Masuk</label>
                                    <br>
                                    <input for="tanggalMasuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" type="date" id="tanggalMasuk" name="tanggal_masuk" required value="{{ $data_diri->tanggal_masuk }}"/>
                                    @error('tanggal_masuk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label for="text">Tanggal Keluar</label>
                                    <br>
                                    <input for="tanggalKeluar" class="form-control" type="date" id="tanggalKeluar"/>
                                </div>
                            </div> --}}
                        </div>

                        <div class="form-group">
                            <div class="row justify-content-start align-self-center">
                                <div class="col-2">
                                    <label style="color: black; font-weight: bold;" for="text">Role</label>
                                </div>
                                <div class="col-2">
                                    <label for="text">{{ $data_diri->user_role }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row justify-content-start align-self-center">
                                <div class="col-2">
                                    <label style="color: black; font-weight: bold;" for="text">Gaji Pokok</label>
                                </div>
                                <div class="col-2">
                                    <label for="text">Rp {{ number_format($data_diri->gaji_pokok) }}</label>
                                </div>
                            </div>
                        </div>
                        {{-- @isset ($data_diri->cabang->nama_cabang)
                        <div class="form-group">
                            <div class="row justify-content-start align-self-center">
                                <div class="col-2">
                                    <label style="color: black; font-weight: bold;" for="text">Cabang</label>
                                </div>
                                <div class="col-2">
                                    <label for="text">{{ $data_diri->cabang->nama_cabang }}</label>
                                </div>
                            </div>
                        </div>
                        @endisset --}}
                        
                        {{-- <button type="cancel" class="btn btn-danger">
                            Cancel
                        </button> --}}
                        <button type="submit" class="btn" style="background-color: #29a4da; color: white;">
                            Submit
                        </button>
                    </form>
                    
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
            {{-- <br>
            <!--Tabel-->
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Email</th>
                    <th>Bank</th>
                    <th>No Rekening</th>
                    <th>Gaji Pokok</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Keluar</th>
                    <th>Role</th>
                    <th>Cabang</th>
                </tr>
                @foreach ($list_pegawai as $pegawai)
                    <tr>
                        <td>{{ $pegawai->id_pegawai }}</td>
                        <td>{{ $pegawai->nama_lengkap }}</td>
                        <td>{{ $pegawai->alamat }}</td>
                        <td>{{ $pegawai->nomor_handphone }}</td>
                        <td>{{ $pegawai->email }}</td>
                        <td>{{ $pegawai->rekening_bank }}</td>
                        <td>{{ $pegawai->nomor_rekening }}</td>
                        <td>{{ $pegawai->gaji_pokok }}</td>
                        <td>{{ $pegawai->tanggal_masuk }}</td>
                        <td>{{ $pegawai->tanggal_keluar }}</td>
                        <td>{{ $pegawai->user_role }}</td>
                        <td>{{ $pegawai->cabang->nama_cabang }}</td>
                    </tr>
                @endforeach
            </table> --}}
        </div>

  
      
    </div>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>

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
