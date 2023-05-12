@include('layouts.main')
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid black;
            /* text-align: center; */
            padding: 8px;
            color: black;
            min-width: 150px;
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
            <form action="{{ url('transaksi/'.$transaksi->id) }}" method="post">
                @csrf
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Edit Detail Transaksi</h4>
                        </div>
                        <button type="button" class="btn btn-danger" onclick="location.href='{{ url('transaksi') }}'" style="margin-right: 10px;">
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
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">ID Transaksi</label>
                                    <br>
                                    <label type="text" id="id_transaksi" style="color: black;">{{ $transaksi->id_transaksi }}</label>
                                    <input type="hidden" class="form-control" id="transaksi_id" name="transaksi_id" value="{{ $transaksi->id }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">ID Antrian</label>
                                    <br>
                                    <label type="text" id="IDantrian" style="color: black;">{{ $transaksi->antrian->id_antrian }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">Nama Pelanggan</label>
                                    <br>
                                    <label type="text" id="namaPelanggan" style="color: black;">{{ $transaksi->antrian->pelanggan->nama_pelanggan }}</label>
                                </div>
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">Nomor Handphone</label>
                                    <br>
                                    <label type="text" id="noHandphone" style="color: black;">{{ $transaksi->antrian->pelanggan->nomor_handphone }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label style="color: black; font-weight: bold;" for="text">Kasir</label>
                                        <select class="form-control" id="kasir" name="kasir" required autofocus>
                                            @if(is_null($history_kasir))
                                                <option selected="" disabled="">
                                                    -- Pilih Kasir --
                                                </option>
                                                @foreach ($list_kasir as $kasir)
                                                    @if(old('pegawai_id') == $kasir->id)
                                                        <option value="{{ $kasir->id }}" selected>{{ $kasir->nama_lengkap }}</option>
                                                    @else
                                                        <option value="{{ $kasir->id }}">{{ $kasir->nama_lengkap }}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                @foreach ($list_kasir as $kasir)
                                                    @if(old($history_kasir->pegawai_id) == $kasir->id)
                                                        <option value="{{ $kasir->id }}" selected="">{{ $kasir->nama_lengkap }}</option>
                                                    @else
                                                        <option value="{{ $kasir->id }}">{{ $kasir->nama_lengkap }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>    
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label style="color: black; font-weight: bold;" for="text">Operator Printer</label>
                                        <select class="form-control" id="operator_printer" name="operator_printer" required autofocus>
                                            @if(is_null($history_operator_printer))
                                                <option selected="" disabled="">
                                                    -- Pilih Operator Printer --
                                                </option>
                                                @foreach ($list_operator_printer as $operator_printer)
                                                    @if(old('pegawai_id') == $operator_printer->id)
                                                        <option value="{{ $operator_printer->id }}" selected>{{ $operator_printer->nama_lengkap }}</option>
                                                    @else
                                                        <option value="{{ $operator_printer->id }}">{{ $operator_printer->nama_lengkap }}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                @foreach ($list_operator_printer as $operator_printer)
                                                    @if(old($history_operator_printer->pegawai_id) == $operator_printer->id)
                                                        <option value="{{ $operator_printer->id }}" selected="">{{ $operator_printer->nama_lengkap }}</option>
                                                    @else
                                                        <option value="{{ $operator_printer->id }}">{{ $operator_printer->nama_lengkap }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>    
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label style="color: black; font-weight: bold;" for="text">Desainer</label>
                                        <select class="form-control" id="desainer" name="desainer" autofocus>
                                            @if(is_null($history_desainer))
                                                <option selected="" disabled="">
                                                    -- Pilih Desainer --
                                                </option>
                                                @foreach ($list_desainer as $desainer)
                                                    @if(old('pegawai_id') == $desainer->id)
                                                        <option value="{{ $desainer->id }}" selected>{{ $desainer->nama_lengkap }}</option>
                                                    @else
                                                        <option value="{{ $desainer->id }}">{{ $desainer->nama_lengkap }}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                @foreach ($list_desainer as $desainer)
                                                    @if(old($history_desainer->pegawai_id) == $desainer->id)
                                                        <option value="{{ $desainer->id }}" selected="">{{ $desainer->nama_lengkap }}</option>
                                                    @else
                                                        <option value="{{ $desainer->id }}">{{ $desainer->nama_lengkap }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>    
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="color: black; font-weight: bold;" for="text">Produk</label>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="text">Nama Produk</label>
                                        <select class="form-control" id="produk-dropdown" name="nama_produk" autofocus>
                                            <option selected="" disabled="">
                                                -- Pilih Produk --
                                            </option>
                                            @foreach ($list_produk as $produk)
                                                <option value="{{ $produk->nama_produk }}">{{ $produk->nama_produk }}</option>
                                                {{-- @if(old('nama_produk') == $produk->nama_produk)
                                                    <option value="{{ $produk->nama_produk }}" selected>{{ $produk->nama_produk }}</option>
                                                @else
                                                    <option value="{{ $produk->nama_produk }}">{{ $produk->nama_produk }}</option>
                                                @endif --}}
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="text">Jenis Bahan</label>
                                        <select class="form-control" id="jenis_bahan-dropdown" name="jenis_bahan" autofocus>
                                            <option selected="" disabled="">
                                                -- Pilih Jenis Bahan --
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="text">Ukuran</label>
                                        <select class="form-control" id="ukuran-dropdown" name="ukuran" autofocus>
                                            <option selected="" disabled="">
                                                -- Pilih Ukuran --
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="text">Finishing</label>
                                        <select class="form-control" id="finishing-dropdown" name="finishing_id" autofocus>
                                            <option selected="" disabled="">
                                                -- Pilih Finishing --
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="color: black; font-weight: bold;" for="text">Input Data Produk User</label>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="jenis_bahan_input">Jenis Bahan</label>
                                    <input type="text" class="form-control @error('jenis_bahan_input') is-invalid @enderror" id="jenis_bahan_input" name="jenis_bahan_input" value="{{ old('jenis_bahan_input') }}" required placeholder="ex: HVS 70 gsm"/>
                                    @error('jenis_bahan_input')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label for="ukuran_input">Ukuran</label>
                                    <input type="text" class="form-control @error('ukuran_input') is-invalid @enderror" id="ukuran_input" name="ukuran_input" value="{{ old('ukuran_input') }}" required placeholder="ex: A4"/>
                                    @error('ukuran_input')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label for="finishing_input">Finishing</label>
                                    <input type="text" class="form-control" id="finishing_input" name="finishing_input" value="{{ old('finishing_input') }}" placeholder="ex: Jilid Spiral"/>
                                    <p>* jika tidak perlu finishing maka biarkan kosong</p>
                                </div>
                                <div class="col-sm-3">
                                    <label for="finishing_input">Status Warna</label>
                                    <select class="form-control" id="warna_input" name="warna_input" autofocus required>
                                        <option selected="" disabled="" value="">-- Pilih Warna --</option>
                                        <option value="Berwarna">Berwarna</option>
                                        <option value="Black & White">Black & White</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="text">Custom Notes</label>
                            <input id="custom" name="custom" type="hidden" value="{{ old('custom') }}">
                            <trix-editor input="custom"></trix-editor>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="warna_cyan">Warna Cyan (%)</label>
                                        <input type="number" class="form-control @error('warna_cyan') is-invalid @enderror" id="warna_cyan" name="warna_cyan" value="{{ old('warna_cyan', 0) }}" required/>
                                        @error('warna_cyan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="warna_magenta">Warna Magenta (%)</label>
                                        <input type="number" class="form-control @error('warna_magenta') is-invalid @enderror" id="warna_magenta" name="warna_magenta" value="{{ old('warna_magenta', 0) }}" required/>
                                        @error('warna_magenta')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="warna_yellow">Warna Yellow (%)</label>
                                        <input type="number" class="form-control @error('warna_yellow') is-invalid @enderror" id="warna_yellow" name="warna_yellow" value="{{ old('warna_yellow', 0) }}" required/>
                                        @error('warna_yellow')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="warna_black">Warna Black (%)</label>
                                        <input type="number" class="form-control @error('warna_black') is-invalid @enderror" id="warna_black" name="warna_black" value="{{ old('warna_black', 0) }}" required/>
                                        @error('warna_black')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah Produk</label>
                                        <input type="number" class="form-control @error('jumlah_produk') is-invalid @enderror" id="jumlah_produk" name="jumlah_produk" value="{{ old('jumlah_produk', 0) }}"/>
                                        {{-- @error('jumlah_produk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="jumlah">Harga Custom</label>
                                        <input type="number" class="form-control @error('harga_custom') is-invalid @enderror" id="harga_custom" name="harga_custom" value="{{ old('harga_custom', 0) }}" required/>
                                        @error('harga_custom')
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
                                $('#produk-dropdown').change(function () {
                                    var nama_produk = $('#produk-dropdown').val();
                                    $("#jenis_bahan-dropdown").html('');
                                    $("#ukuran-dropdown").html('');
                                    // $("#jenis-tinta-dropdown").html('');
                                    $("#finishing-dropdown").html('');
                                    $.ajax({
                                        url: "{{url('/api/fetch-kertas')}}",
                                        type: 'POST',
                                        data: {
                                                nama_produk:nama_produk,
                                                _token:'{{ csrf_token() }}'
                                        },
                                        dataType: 'json',
                                        success: function (result) {
                                            $('#jenis_bahan-dropdown').html('<option selected="" disabled="" value="">-- Pilih Jenis Bahan --</option>');
                                            $.each(result.list_kertas, function (key, value) {
                                                $("#jenis_bahan-dropdown").append('<option value="' + value.jenis_bahan + '">' + value.jenis_bahan + '</option>');
                                            });
                                            $('#ukuran-dropdown').html('<option selected="" disabled="" value="">-- Pilih Ukuran --</option>');
                                            // $('#jenis-tinta-dropdown').html('<option selected="" disabled="" value="">-- Pilih Jenis Tinta --</option>');
                                            $('#finishing-dropdown').html('<option selected="" disabled="" value="">-- Pilih Finishing --</option>');
                                        }
                                    });
                                });

                                $('#jenis_bahan-dropdown').change(function () {
                                    var nama_produk = $('#produk-dropdown').val();
                                    var jenis_bahan = $('#jenis_bahan-dropdown').val();
                                    $("#ukuran-dropdown").html('');
                                    // $("#jenis-tinta-dropdown").html('');
                                    $("#finishing-dropdown").html('');
                                    $.ajax({
                                        url: "{{url('/api/fetch-ukuran')}}",
                                        type: 'POST',
                                        data: {
                                                nama_produk:nama_produk,
                                                jenis_bahan:jenis_bahan,
                                                _token:'{{ csrf_token() }}'
                                        },
                                        dataType: 'json',
                                        success: function (result) {
                                            $('#ukuran-dropdown').html('<option selected="" disabled="" value="">-- Pilih Ukuran --</option>');
                                            $.each(result.list_ukuran, function (key, value) {
                                                $("#ukuran-dropdown").append('<option value="' + value.ukuran + '">' + value.ukuran + '</option>');
                                            });
                                            // $('#jenis-tinta-dropdown').html('<option selected="" disabled="" value="">-- Pilih Jenis Tinta --</option>');
                                            $('#finishing-dropdown').html('<option selected="" disabled="" value="">-- Pilih Finishing --</option>');
                                        }
                                    });
                                });

                                $('#ukuran-dropdown').change(function () {
                                    var nama_produk = $('#produk-dropdown').val();
                                    var jenis_bahan = $('#jenis_bahan-dropdown').val();
                                    var ukuran = $('#ukuran-dropdown').val();
                                    $("#finishing-dropdown").html('');
                                    $.ajax({
                                        // url: "{{url('/api/fetch-tinta')}}",
                                        url: "{{url('/api/fetch-finishing')}}",
                                        type: 'POST',
                                        data: {
                                                nama_produk:nama_produk,
                                                jenis_bahan:jenis_bahan,
                                                ukuran:ukuran,
                                                _token:'{{ csrf_token() }}'
                                        },
                                        dataType: 'json',
                                        success: function (result) {
                                            $('#finishing-dropdown').html('<option selected="" disabled="" value="">-- Pilih Finishing --</option>');
                                            $.each(result.list_finishing, function (key, value) {
                                                $("#finishing-dropdown").append('<option value="' + value.finishing_id + '">' + value.jenis_finishing +'</option>');
                                            });
                                        }
                                    });
                                });
                            });
                        </script>
                        
                        <button type="button" class="btn" style="background-color: #29a4da; color: white;" onclick="tambah()">Submit</button>
                    </div>
                </div>
                <br>
                <!--Tabel-->
                <div class="table-responsive container">
                    <table class="table table-striped table-borderless" id="tabel">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID Produk</th>
                                <th>Nama Poduk</th>
                                <th>Jenis Bahan</th>
                                <th>Ukuran</th>
                                <th>Finishing</th>
                                <th>Warna</th>
                                <th>CMYK (%)</th>
                                <th>Harga</th>
                                <th>Jumlah Produk</th>
                                <th>Harga Finishing</th>
                                <th>Diskon (%)</th>
                                <th>Sub Total</th>
                                <th>Harga Custom</th>
                                <th>Total</th>
                                <th>Custom Notes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="list-item">
                            @foreach ($list_beli as $beli)
                            <tr>
                                <td>{{ $beli->detail_produk->id_detail_produk }}</td>
                                <td>{{ $beli->detail_produk->nama_produk }}</td>
                                <td>{{ $beli->jenis_bahan_input }}</td>
                                <td>{{ $beli->ukuran_input }}</td>
                                <td>{{ $beli->finishing_input }}</td>
                                <td>{{ $beli->warna_input }}</td>
                                <td>
                                    <div class="row">
                                        Cyan: {{ $beli->persen_cyan }}%
                                    </div>
                                    <div class="row">
                                        Magenta: {{ $beli->persen_magenta }}%
                                    </div>
                                    <div class="row">
                                        Yellow: {{ $beli->persen_yellow }}%
                                    </div>
                                    <div class="row">
                                        Black: {{ $beli->persen_black }}%
                                    </div>
                                </td>
                                <td>Rp {{ number_format($beli->harga, 2) }}</td>
                                <td>{{ $beli->jumlah_produk }}</td>
                                <td>Rp {{ number_format($beli->harga_finishing, 2) }}</td>
                                <td>{{ $beli->diskon }}</td>
                                <td>Rp {{ number_format((($beli->harga*$beli->jumlah_produk+$beli->harga_finishing)*(1-$beli->diskon/100)), 2) }}</td>
                                <td>Rp {{ number_format($beli->harga_custom, 2) }}</td>
                                <td>Rp {{ number_format($beli->sub_total, 2) }}</td>
                                <td>
                                    @isset($beli->custom)
                                    {!! $beli->custom !!}
                                    @else
                                    None
                                    @endisset
                                </td>
                                <td ><button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)"><i class="fa fa-trash"></i></button></td>
                                <td hidden><input hidden class="form-control form-control-sm" type="text" name="id_detail_produk[]" value="{{ $beli->detail_produk->id_detail_produk }}" readonly/></td>
                                <td hidden><input hidden class="form-control form-control-sm" type="text" name="jenis_bahan_input[]" value="{{ $beli->jenis_bahan_input }}" readonly/></td>
                                <td hidden><input hidden class="form-control form-control-sm" type="text" name="ukuran_input[]" value="{{ $beli->ukuran_input }}" readonly/></td>
                                <td hidden><input hidden class="form-control form-control-sm" type="text" name="finishing_input[]" value="{{ $beli->finishing_input }}" readonly/></td>
                                <td hidden><input hidden class="form-control form-control-sm" type="text" name="warna_input[]" value="{{ $beli->warna_input }}" readonly/></td>
                                <td hidden><input hidden class="form-control form-control-sm" type="number" name="harga[]" value="{{ $beli->harga }}" readonly/></td>
                                <td hidden><input hidden class="form-control form-control-sm" type="number" name="quantity[]" value="{{ $beli->jumlah_produk }}" readonly/></td>
                                <td hidden><input hidden class="form-control form-control-sm" type="number" name="diskon[]" value="{{ $beli->diskon }}" readonly/></td>
                                <td hidden><input hidden class="form-control form-control-sm" type="number" name="harga_finishing[]" value="{{ $beli->harga_finishing }}" readonly/></td>
                                <td hidden><input hidden class="form-control form-control-sm" type="number" name="harga_custom[]" value="{{ $beli->harga_custom }}" readonly/></td>
                                <td hidden><input hidden class="form-control form-control-sm" type="text" name="custom[]" value="{{ $beli->custom }}" readonly/></td>
                                <td hidden><input hidden class="form-control form-control-sm" type="number" name="sub_total[]" value="{{ $beli->sub_total }}" readonly/></td>
                                <td hidden><input hidden class="form-control form-control-sm" type="number" name="persen_cyan[]" value="{{ $beli->persen_cyan }}" readonly/></td>
                                <td hidden><input hidden class="form-control form-control-sm" type="number" name="persen_magenta[]" value="{{ $beli->persen_magenta }}" readonly/></td>
                                <td hidden><input hidden class="form-control form-control-sm" type="number" name="persen_yellow[]" value="{{ $beli->persen_yellow }}" readonly/></td>
                                <td hidden><input hidden class="form-control form-control-sm" type="number" name="persen_black[]" value="{{ $beli->persen_black }}" readonly/></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                <!--Text Bawah-->
                <div class="row">
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ $transaksi->id }}"/>
                    <div class="col-sm-9" style="text-align: right;">
                        <label style="color: black; font-weight: bold; font-size: 20px;" for="text">Sub Total : </label>
                    </div>
                    <div class="col-sm-3" style="text-align: start;" id="subTotal">
                        <label type="text" style="color: black; font-size: 16px; padding-top: 3px;">Rp {{ number_format($transaksi->sub_total_transaksi, 2) }}</label>
                        <input type="hidden" style="color: black; margin-left: 0px; width: 120px; padding-top: 3px;" name="sub_total_transaksi" value="{{ $transaksi->sub_total_transaksi }}"/>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-sm-9" style="text-align: right;">
                        <label style="color: black; font-weight: bold; font-size: 20px;" for="text">Diskon (%) : </label>
                    </div>
                    <div class="col-sm-3">
                        <input type="number" style="color: black; margin-left: 0px; width: 120px; padding-top: 3px;" class="@error('diskon') is-invalid @enderror" id="diskon" name="diskon" required value="{{ old('diskon', $transaksi->diskon) }}"/>
                        @error('diskon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-sm-9" style="text-align: right;">
                        <label style="color: black; font-weight: bold; font-size: 20px;" for="text">Promo : </label>
                    </div>
                    <div class="col-sm-3">
                        <select style="margin-left: 0px; margin-top: 8px; padding-top: 3px;" id="promo_id" name="promo_id" autofocus>
                            @if(is_null($transaksi->promo_id))
                                <option selected="" value="">
                                    -- Pilih Promo --
                                </option>
                                @foreach ($list_promo as $promo)
                                    @if(old('promo_id') == $promo->id)
                                        <option value="{{ $promo->id }}" selected>{{ $promo->potongan }}% s/d {{ date('d M Y', strtotime($promo->tanggal_berakhir)) }}</option>
                                    @else
                                        <option value="{{ $promo->id }}">{{ $promo->potongan }}% s/d {{ date('d M Y', strtotime($promo->tanggal_berakhir)) }}</option>
                                    @endif
                                @endforeach
                            @else
                                @foreach ($list_promo as $promo)
                                    @if(old($transaksi->id) == $promo->id)
                                        <option value="{{ $promo->id }}" selected="">{{ $promo->potongan }}% s/d {{ date('d M Y', strtotime($promo->tanggal_berakhir)) }}</option>
                                    @else
                                        <option value="{{ $promo->id }}">{{ $promo->potongan }}% s/d {{ date('d M Y', strtotime($promo->tanggal_berakhir)) }}</option>
                                    @endif
                                @endforeach
                                <option value="">
                                    -- Pilih Promo --
                                </option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-9" style="text-align: right;">
                        <label style="color: black; font-weight: bold; font-size: 20px;" for="text">Total : </label>
                    </div>
                    <div class="col-sm-3" style="text-align: start;" id="total-form">
                        <label type="text" id="total" name="total" style="color: black; font-weight: bold; font-size: 20px;">Rp {{ number_format($transaksi->total, 2) }}</label>
                        <input type="hidden" style="color: black; margin-left: 0px; width: 120px; padding-top: 3px;" name="total" value="{{ $transaksi->total }}"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-9" style="text-align: right;">   
                    </div>
                    <div class="col-sm-3" style="text-align: start; width: 150px;">
                        <button type="submit" class="btn btn-success">
                            Confirm
                        </button>
                    </div>
                </div>
            </form>

            <script>
                function deleteRow(r) {
                    var i = r.parentNode.parentNode.rowIndex;
                    document.getElementById("tabel").deleteRow(i);
                    $("#total-form").html('');
                    $("#subTotal").html('');
                    var promo_id = $('#promo_id').val();
                    var promo = 0;
                    var table = document.getElementById("tabel");
                    var sub_total = 0;
                    for (var i = 1, row; row = table.rows[i]; i++) {
                        sub_total += parseInt(table.rows[i].cells[27].getElementsByTagName('input')[0].value);
                        // sub_total += parseInt(table.rows[i].cells[11].innerHTML);
                    }
                    $.ajax({
                        url: "{{url('/api/hitung-total')}}",
                        type: 'POST',
                        data: {
                            promo_id:promo_id,
                            _token:'{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function (result) {
                            $.each(result.promo, function (key, potongan) {
                                promo = potongan.potongan;
                            });
                            $("#subTotal").append('<label type="text" id="subTotal" style="color: black; font-size: 16px; padding-top: 3px;">' + Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(sub_total) + '</label>\
                                                    <input type="hidden" style="color: black; margin-left: 0px; width: 120px; padding-top: 3px;" name="sub_total_transaksi" value="' + sub_total + '"/>');
                            $("#total-form").append('<label type="text" id="total" name="total" style="color: black; font-weight: bold; font-size: 20px;">' + Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(sub_total*(1-(promo/100))) + '</label>\
                                                    <input type="hidden" style="color: black; margin-left: 0px; width: 120px; padding-top: 3px;" name="total" value="' + sub_total*(1-(promo/100)) + '"/>');
                        }
                    });
                }

                function tambah() {
                    $("#total-form").html('');
                    $("#subTotal").html('');
                    var nama_produk = $('#produk-dropdown').val();
                    var jenis_bahan_input = $('#jenis_bahan_input').val();
                    var ukuran_input = $('#ukuran_input').val();
                    var finishing_input = $('#finishing_input').val();
                    var warna_input = $('#warna_input').val();
                    var jenis_bahan = $('#jenis_bahan-dropdown').val();
                    var ukuran = $('#ukuran-dropdown').val();
                    // var jenis_tinta = $('#jenis-tinta-dropdown').val();
                    var jenis_finishing = $('#finishing-dropdown').val();
                    var jumlah_produk = $('#jumlah_produk').val();
                    var harga_custom = $('#harga_custom').val();
                    var custom = $('#custom').val();
                    var promo_id = $('#promo_id').val();
                    var promo = 0;
                    var table = document.getElementById("tabel");
                    var sub_total = 0;
                    var hf = 0;
                    var ukuran_temp = "";
                    var persen_cyan = $('#warna_cyan').val();
                    var persen_magenta = $('#warna_magenta').val();
                    var persen_yellow = $('#warna_yellow').val();
                    var persen_black = $('#warna_black').val();
                    for (var i = 1, row; row = table.rows[i]; i++) {
                        sub_total += parseInt(table.rows[i].cells[27].getElementsByTagName('input')[0].value);
                    }
                    $.ajax({
                        url: "{{url('/api/sub-total')}}",
                        type: 'POST',
                        data: {
                            nama_produk:nama_produk,
                            jenis_bahan:jenis_bahan,
                            ukuran:ukuran,
                            // jenis_tinta:jenis_tinta,
                            jenis_finishing:jenis_finishing,
                            promo_id:promo_id,
                            jumlah_produk:jumlah_produk,
                            _token:'{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function (result) {
                            $.each(result.list_detail, function (key, produk) {
                                if(produk.status_finishing == 0) {
                                    hf = parseInt(produk.finishing_harga)
                                }
                                else {
                                    hf = parseInt(produk.finishing_harga*jumlah_produk)
                                }
                                
                                if (jQuery.isEmptyObject(finishing_input)) {
                                    finishing_input = 'None';
                                }
                                $('#list-item').append('<tr>\
                                                        <td>'+produk.id_detail_produk+'</td>\
                                                        <td>'+produk.nama_produk+'</td>\
                                                        <td>'+jenis_bahan_input+'</td>\
                                                        <td>'+ukuran_input+'</td>\
                                                        <td>'+finishing_input+'</td>\
                                                        <td>'+warna_input+'</td>\
                                                        <td>\
                                                            <div class="row">Cyan: '+persen_cyan+'%</div>\
                                                            <div class="row">Magenta: '+persen_magenta+'%</div>\
                                                            <div class="row">Yellow: '+persen_yellow+'%</div>\
                                                            <div class="row">Black: '+persen_black+'%</div>\
                                                        </td>\
                                                        <td>'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(produk.harga)+'</td>\
                                                        <td>'+jumlah_produk+'</td>\
                                                        <td>'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(hf)+'</td>\
                                                        <td>'+produk.diskon+'</td>\
                                                        <td>'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(parseInt((produk.harga*jumlah_produk+hf)*(1-(produk.diskon/100))))+'</td>\
                                                        <td>'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(harga_custom)+'</td>\
                                                        <td>'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(parseInt(((produk.harga*jumlah_produk+hf)*(1-(produk.diskon/100)))+parseInt(harga_custom)))+'</td>\
                                                        <td>'+custom+'</td>\
                                                        <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)"><i class="fa fa-trash"></i></button></td>\
                                                        <td style="display:none;"><input hidden class="form-control form-control-sm" type="text" name="id_detail_produk[]" value="' + produk.id_detail_produk + '" readonly/></td>\
                                                        <td style="display:none;"><input hidden class="form-control form-control-sm" type="text" name="jenis_bahan_input[]" value="' + jenis_bahan_input + '" readonly/></td>\
                                                        <td style="display:none;"><input hidden class="form-control form-control-sm" type="text" name="ukuran_input[]" value="' + ukuran_input + '" readonly/></td>\
                                                        <td style="display:none;"><input hidden class="form-control form-control-sm" type="text" name="finishing_input[]" value="' + finishing_input + '" readonly/></td>\
                                                        <td style="display:none;"><input hidden class="form-control form-control-sm" type="text" name="warna_input[]" value="' + warna_input + '" readonly/></td>\
                                                        <td style="display:none;"><input hidden class="form-control form-control-sm" type="number" name="harga[]" value="' + produk.harga + '" readonly/></td>\
                                                        <td style="display:none;"><input hidden class="form-control form-control-sm" type="number" name="harga_finishing[]" value="' + hf + '" readonly/></td>\
                                                        <td style="display:none;"><input hidden class="form-control form-control-sm" type="number" name="quantity[]" value="' + jumlah_produk + '" readonly/></td>\
                                                        <td style="display:none;"><input hidden class="form-control form-control-sm" type="number" name="diskon[]" value="' + produk.diskon + '" readonly/></td>\
                                                        <td style="display:none;"><input hidden class="form-control form-control-sm" type="number" name="harga_custom[]" value="' + harga_custom + '" readonly/></td>\
                                                        <td style="display:none;"><input hidden class="form-control form-control-sm" type="text" name="custom[]" value="' + custom + '" readonly/></td>\
                                                        <td style="display:none;"><input hidden class="form-control form-control-sm" type="number" name="sub_total[]" value="' + parseInt(((produk.harga*jumlah_produk+hf)*(1-(produk.diskon/100)))+parseInt(harga_custom)) + '" readonly/></td>\
                                                        <td style="display:none;"><input hidden class="form-control form-control-sm" type="number" name="persen_cyan[]" value="' + persen_cyan + '" readonly/></td>\
                                                        <td style="display:none;"><input hidden class="form-control form-control-sm" type="number" name="persen_magenta[]" value="' + persen_magenta + '" readonly/></td>\
                                                        <td style="display:none;"><input hidden class="form-control form-control-sm" type="number" name="persen_yellow[]" value="' + persen_yellow + '" readonly/></td>\
                                                        <td style="display:none;"><input hidden class="form-control form-control-sm" type="number" name="persen_black[]" value="' + persen_black + '" readonly/></td>\
                                                        </tr>');
                                sub_total += parseInt(((jumlah_produk*produk.harga+hf)*(1-(produk.diskon/100)))+parseInt(harga_custom));
                            });
                            $.each(result.promo, function (key, potongan) {
                                promo = potongan.potongan;
                            });
                            $("#subTotal").append('<label type="text" id="subTotal" style="color: black; font-size: 16px; padding-top: 3px;">' + Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(sub_total) + '</label>\
                                                    <input type="hidden" style="color: black; margin-left: 0px; width: 120px; padding-top: 3px;" name="sub_total_transaksi" value="' + sub_total + '"/>');
                            $("#total-form").append('<label type="text" id="total" name="total" style="color: black; font-weight: bold; font-size: 20px;">' + Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(sub_total*(1-(promo/100))) + '</label>\
                                                        <input type="hidden" style="color: black; margin-left: 0px; width: 120px; padding-top: 3px;" name="total" value="' + sub_total*(1-(promo/100)) + '"/>');
                        }
                    });
                }

                $(document).ready(function () {
                    $('#promo_id').change(function () {
                        $("#total-form").html('');
                        var diskon = $('#diskon').val();
                        var promo_id = $('#promo_id').val();
                        var promo = 0;
                        var table = document.getElementById("tabel");
                        var sub_total = 0;
                        for (var i = 1, row; row = table.rows[i]; i++) {
                            sub_total += parseInt(table.rows[i].cells[27].getElementsByTagName('input')[0].value);
                            // sub_total += parseInt(table.rows[i].cells[11].innerHTML);
                        }
                        $.ajax({
                            url: "{{url('/api/hitung-total')}}",
                            type: 'POST',
                            data: {
                                    promo_id:promo_id,
                                    _token:'{{ csrf_token() }}'
                            },
                            dataType: 'json',
                            success: function (result) {
                                $.each(result.promo, function (key, potongan) {
                                    promo = potongan.potongan;
                                });
                                $("#total-form").append('<label type="text" id="total" name="total" style="color: black; font-weight: bold; font-size: 20px;">' + Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(sub_total*(1-(promo/100))) + '</label>\
                                                            <input type="hidden" style="color: black; margin-left: 0px; width: 120px; padding-top: 3px;" name="total" value="' + sub_total*(1-(promo/100)) + '"/>');
                            }
                        });
                    });
                });
            </script>
        </div> 
    </div>

    {{-- <script src="/js/jquery.min.js"></script> --}}
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#kasir').select2();
            $('#operator_printer').select2();
            $('#desainer').select2();
            $('#produk-dropdown').select2();
            $('#jenis_bahan-dropdown').select2();
            $('#ukuran-dropdown').select2();
            // $('#jenis-tinta-dropdown').select2();
            $('#finishing-dropdown').select2();
            $('#warna_input').select2();
            $('#promo_id').select2();
        });
    </script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
</body>
</html>
