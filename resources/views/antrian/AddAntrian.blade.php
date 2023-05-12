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
                        <h4 class="card-title">Add Antrian</h4>
                    </div>
                    {{-- <a href="{{ url('po-botol/history') }}" class="btn btn-warning " id="button-add" style="background:orange">
                        <i class="mdi mdi-history" ></i>
                    </a> --}}
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-antrian') }}'" style="margin-right: 10px;">
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
                    <form action="{{url('/antrian')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label style="color: black; font-weight: bold;" for="text">ID Antrian</label>
                            <div id="id_antrian_input">
                                <input type="text" readonly="readonly" class="form-control @error('id_antrian') is-invalid @enderror" id="id_antrian" name="id_antrian" required autofocus value="{{ $idantrian }}"/>
                                @error('id_antrian')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="date">Cabang</label>
                                    <br>
                                    @if(auth()->user()->user_role == "Admin")
                                    <select class="form-control @error('cabang_id') is-invalid @enderror" id="cabang_id" name="cabang_id" required>
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
                                    </select>
                                    @else
                                    <input type="text" readonly="readonly" class="form-control" required value="{{ auth()->user()->cabang->nama_cabang }}"/>
                                    <div hidden>
                                        <input type="hidden" readonly="readonly" class="form-control @error('cabang_id') is-invalid @enderror" id="cabang_id" name="cabang_id" required value="{{ auth()->user()->cabang_id }}"/>
                                        @error('cabang_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    @endif
                                </div>
                                <div class="col-sm-3">
                                    <label for="date">Tanggal Antrian</label>
                                    <br>
                                    <input type="date" class="form-control @error('tanggal_antrian') is-invalid @enderror" id="tanggal_antrian" name="tanggal_antrian" required value="{{ date('Y-m-d') }}" readonly/>
                                    @error('tanggal_antrian')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label for="text">Nomor Antrian</label>
                                    <br>
                                    <div id="nomor_antrian_input">
                                        <input type="text" readonly="readonly" class="form-control @error('nomor_antrian') is-invalid @enderror" id="nomor_antrian" name="nomor_antrian" required value="{{ $nomorantrian }}"/>
                                        @error('nomor_antrian')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                        <script>
                            $(document).ready(function () {
                                $('#cabang_id, #tanggal_antrian').change(function () {
                                    var cabang_id = $('#cabang_id').val();
                                    var tanggal_antrian = $('#tanggal_antrian').val();
                                    $("#id_antrian_input").html('');
                                    $("#nomor_antrian_input").html('');
                                    $.ajax({
                                        url: "{{url('/api/fetch-nomor-antrian')}}",
                                        type: 'POST',
                                        data: {
                                                cabang_id:cabang_id,
                                                tanggal_antrian:tanggal_antrian,
                                                _token:'{{ csrf_token() }}'
                                        },
                                        dataType: 'json',
                                        success: function (result) {
                                            $('#nomor_antrian_input').html('<input type="text" readonly="readonly" class="form-control" id="nomor_antrian" name="nomor_antrian" required value="'+parseInt(result.nomor_antrian)+'"/>');
                                            $('#id_antrian_input').html('<input type="text" readonly="readonly" class="form-control" id="id_antrian" name="id_antrian" required value="'+result.id_antrian+'"/>');
                                        },
                                        error: function (xhr, ajaxOptions, thrownError) {
                                            alert(xhr.status);
                                            alert(thrownError);
                                        }
                                    });
                                });
                            });
                        </script>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="namaPelanggan">Pelanggan</label>
                                        <select class="form-control @error('pelanggan_id') is-invalid @enderror" id="pelanggan_id" name="pelanggan_id" required>
                                            <option selected="" disabled="">
                                                -- Pilih Pelanggan --
                                            </option>
                                            @foreach ($list_pelanggan as $pelanggan)
                                                @if(old('pelanggan_id') == $pelanggan->id)
                                                    <option value="{{ $pelanggan->id }}" selected>{{ $pelanggan->nama_pelanggan }}  {{ $pelanggan->nomor_handphone }}</option>
                                                @else
                                                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama_pelanggan }}  {{ $pelanggan->nomor_handphone }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="via">Pemesanan Via</label>
                                        <select class="form-control @error('pemesanan_via') is-invalid @enderror" id="pemesanan_via" name="pemesanan_via" required>
                                            <option selected="" disabled="">
                                                -- Pilih Cara Pemesanan --
                                            </option>
                                            @foreach ($list_cara as $cara_pemesanan)
                                                @if(old('pemesanan_via') == $cara_pemesanan)
                                                    <option value="{{ $cara_pemesanan }}" selected>{{ $cara_pemesanan }}</option>
                                                @else
                                                    <option value="{{ $cara_pemesanan }}">{{ $cara_pemesanan }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        

                        {{-- <button type="cancel" class="btn btn-danger">
                            Cancel
                        </button> --}}
                        <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-antrian') }}'">
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
    
    {{-- <script src="{{asset('js/jquery.min.js')}}"></script> --}}
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#cabang_id').select2();
            $('#pelanggan_id').select2();
        });
    </script>
</body>
</html>
