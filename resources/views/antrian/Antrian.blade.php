<!DOCTYPE html>
<html lang="en">
<head>
    <title>Antrian</title>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900"
        rel="stylesheet"
    />

    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                        <h4 class="card-title">Antrian</h4>
                    </div>
                    {{-- <a href="{{ url('po-botol/history') }}" class="btn btn-warning " id="button-add" style="background:orange">
                        <i class="mdi mdi-history" ></i>
                    </a> --}}
                    <button type="button" class="btn btn-success" onclick="location.href='{{ url('history-antrian') }}'" style="margin-right: 10px;">
                        <span class="material-icons align-middle">
                            browse_gallery
                        </span>
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
                    <form action="/antrian" method="post">
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
                                    <input type="hidden" readonly="readonly" class="form-control @error('cabang_id') is-invalid @enderror" id="cabang_id" name="cabang_id" required value="{{ auth()->user()->cabang_id }}"/>
                                    @error('cabang_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @endif
                                </div>
                                <div class="col-sm-3">
                                    <label for="date">Tanggal Antrian</label>
                                    <br>
                                    <input type="date" class="form-control @error('tanggal_antrian') is-invalid @enderror" id="tanggal_antrian" name="tanggal_antrian" required value="{{ date('Y-m-d') }}"/>
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
                                $('#cabang_id').change(function () {
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
                                            $('#nomor_antrian_input').html('<input type="text" readonly="readonly" class="form-control" id="nomor_antrian" name="nomor_antrian" required value="'+parseInt(result.nomor_antrian+1)+'"/>');
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
                        <button type="submit" class="btn" style="background-color: #29a4da; color: white;">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
            <br>
            <!--Tabel-->
            <div class="table-responsive">
                <table class="table table-striped table-borderless">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Antrian</th>
                            <th>Cabang</th>
                            <th>Tanggal Antrian</th>
                            <th>Nomor Antrian</th>
                            <th>Nama Pelanggan</th>
                            <th>Nomor Handphone Pelanggan</th>
                            {{-- <th>Pemesanan VIA</th>
                            <th>Bukti</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_antrian as $antrian)
                        <tr>
                            <td>{{ $antrian->id_antrian }}</td>
                            <td>{{ $antrian->cabang->nama_cabang }}</td>
                            <td>{{ $antrian->tanggal_antrian }}</td>
                            <td>{{ $antrian->nomor_antrian }}</td>
                            <td>{{ $antrian->pelanggan->nama_pelanggan }}</td>
                            <td>{{ $antrian->pelanggan->nomor_handphone }}</td>
                            {{-- <td>{{ $antrian->pemesanan_via }}</td>
                            <td>{{ $antrian->bukti_pembayaran }}</td> --}}
                            <td>
                                <form action="{{ url('/antrian/'.$antrian->id) }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> 
    </div>

    {{-- <script src="js/jquery.min.js"></script> --}}
    <script src="/js/popper.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#cabang_id').select2();
            $('#pelanggan_id').select2();
        });
    </script>
</body>
</html>
