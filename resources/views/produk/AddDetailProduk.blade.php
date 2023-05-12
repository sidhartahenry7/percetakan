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
                        <h4 class="card-title">Add Detail Produk</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-detail-produk') }}'" style="margin-right: 10px;">
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
                    <form action="{{ url('/detail-produk') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="text">ID Detail Produk</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" readonly="readonly" class="form-control @error('id_detail_produk') is-invalid @enderror" id="id_detail_produk" name="id_detail_produk" required autofocus value="{{ $idproduk }}"/>
                                    @error('id_detail_produk')
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
                                    <label for="text">Nama Produk</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" id="nama_produk" name="nama_produk" required value="{{ old('nama_produk') }}"/>
                                    @error('nama_produk')
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
                                    <label for="produk">Kategori</label>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                                        <option selected="" disabled="">
                                            -- Pilih Kategori --
                                        </option>
                                        @foreach ($list_kategori as $kategori)
                                            @if(old('kategori_id') == $kategori->id)
                                                <option value="{{ $kategori->id }}" selected>{{ $kategori->nama_kategori }}</option>
                                            @else
                                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="text">Jenis Bahan</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control @error('jenis_bahan') is-invalid @enderror" id="jenis_bahan" name="jenis_bahan" required value="{{ old('jenis_bahan') }}"/>
                                    @error('jenis_bahan')
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
                                    <label for="text">Ukuran</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control @error('ukuran') is-invalid @enderror" id="ukuran" name="ukuran" required value="{{ old('ukuran') }}"/>
                                    @error('ukuran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="produk">Ukuran & Jenis Bahan</label>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control @error('produk_id') is-invalid @enderror" id="produk_id" name="produk_id" required>
                                        <option selected="" disabled="">
                                            -- Pilih Jenis Bahan & Ukuran --
                                        </option>
                                        @foreach ($list_main_produk as $main_produk)
                                            @if(old('produk_id') == $main_produk->id)
                                                @isset($main_produk->ukuran)
                                                <option value="{{ $main_produk->id }}" selected>{{ $main_produk->jenis_kertas . " " . $main_produk->ukuran }}</option>
                                                @else
                                                <option value="{{ $main_produk->id }}" selected>{{ $main_produk->jenis_kertas . " " . $main_produk->lebar." ".$main_produk->satuan." x ".$main_produk->panjang." ".$main_produk->satuan }} </option>
                                                @endisset
                                            @else
                                                @isset($main_produk->ukuran)
                                                <option value="{{ $main_produk->id }}">{{ $main_produk->jenis_kertas . " " . $main_produk->ukuran }}</option>
                                                @else
                                                <option value="{{ $main_produk->id }}">{{ $main_produk->jenis_kertas . " " . $main_produk->lebar." ".$main_produk->satuan." x ".$main_produk->panjang." ".$main_produk->satuan }} </option>
                                                @endisset
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="produk">Jenis Tinta</label>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control @error('tinta_id') is-invalid @enderror" id="tinta_id" name="tinta_id" required>
                                        <option selected="" disabled="">
                                            -- Pilih Jenis Tinta --
                                        </option>
                                        @foreach ($list_tinta as $tinta)
                                            @if(old('tinta_id') == $tinta->id)
                                                <option value="{{ $tinta->id }}" selected>{{ $tinta->jenis_tinta }}</option>
                                            @else
                                                <option value="{{ $tinta->id }}">{{ $tinta->jenis_tinta }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <input type="checkbox" id="status_warna" name="status_warna"> black & white
                                </div>
                            </div>
                        </div>  --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="produk">Finishing</label>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control @error('finishing_id') is-invalid @enderror" id="finishing_id" name="finishing_id" required>
                                        <option selected="" disabled="">
                                            -- Pilih Finishing --
                                        </option>
                                        @foreach ($list_finishing as $finishing)
                                            @if(old('finishing_id') == $finishing->id)
                                                <option value="{{ $finishing->id }}" selected>{{ $finishing->jenis_finishing }}</option>
                                            @else
                                                <option value="{{ $finishing->id }}">{{ $finishing->jenis_finishing }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <input type="checkbox" id="status_finishing" name="status_finishing"> harga per quantity
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="text">Keterangan</label>
                            <input id="keterangan" name="keterangan" type="hidden" value="{{ old('keterangan') }}">
                            <trix-editor input="keterangan"></trix-editor>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="text">Harga</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" required value="{{ old('harga') }}"/>
                                    @error('harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        {{-- <div class="form-group">
                            <label for="text">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" required value="{{ old('keterangan') }}"/>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}
                        {{-- <button type="cancel" class="btn btn-danger">
                            Cancel
                        </button> --}}
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Bahan Setengah Jadi</h4>
                                {{-- <h4 class="card-title">Penggunaan Bahan Baku</h4> --}}
                            </div>
                        </div>
                        <hr style="height: 10px;">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="text">Bahan Setengah Jadi</label>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control @error('bahan_setengah_jadi_id') is-invalid @enderror" id="bahan_setengah_jadi_id" name="bahan_setengah_jadi_id" required>
                                        <option selected="" disabled="">
                                            -- Pilih Bahan Setengah Jadi --
                                        </option>
                                        @foreach ($list_bahan_setengah_jadi as $bahan)
                                            @if(old('bahan_setengah_jadi_id') == $bahan->id)
                                                <option value="{{ $bahan->id }}" selected>{{ $bahan->nama_bahan_setengah_jadi }}</option>
                                            @else
                                                <option value="{{ $bahan->id }}">{{ $bahan->nama_bahan_setengah_jadi }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="text">Quantity (buah)</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control @error('quantity_bahan') is-invalid @enderror" id="quantity_bahan" name="quantity_bahan" required value="{{ old('quantity_bahan') }}"/>
                                    @error('quantity_bahan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    {{-- <input type="checkbox" id="status_quantity" name="status_quantity"> quantity tetap --}}
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn" style="background-color: #EC268F; color: white;" onclick="tambahBahanSetengahJadi()">Tambah</button>
                        <br><br>
                        {{-- <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="text">Satuan</label>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control" data-live-search="true" id="satuan_bahan" name="satuan_bahan">                    
                                        <option value="lembar">lembar</option>
                                        <option value="meter">meter</option>
                                        <option value="cm">cm</option>
                                    </select>
                                </div>  
                            </div>
                        </div> --}}
                        {{-- <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label style="color: black; font-weight: bold;" for="text">Bahan Baku</label>
                                    <select class="form-control @error('penggunaan_bahan_id') is-invalid @enderror" id="penggunaan_bahan_id" name="penggunaan_bahan_id" required>
                                        <option selected="" disabled="">
                                            -- Pilih Jenis Bahan & Ukuran --
                                        </option>
                                        @foreach ($list_main_produk as $bahan)
                                            @if(old('penggunaan_bahan_id') == $bahan->id)
                                                @isset($bahan->ukuran)
                                                <option value="{{ $bahan->id }}" selected>{{ $bahan->jenis_kertas . " " . $bahan->ukuran }}</option>
                                                @else
                                                <option value="{{ $bahan->id }}" selected>{{ $bahan->jenis_kertas . " " . $bahan->lebar." ".$bahan->satuan." x ".$bahan->panjang." ".$bahan->satuan }} </option>
                                                @endisset
                                            @else
                                                @isset($bahan->ukuran)
                                                <option value="{{ $bahan->id }}">{{ $bahan->jenis_kertas . " " . $bahan->ukuran }}</option>
                                                @else
                                                <option value="{{ $bahan->id }}">{{ $bahan->jenis_kertas . " " . $bahan->lebar." ".$bahan->satuan." x ".$bahan->panjang." ".$bahan->satuan }} </option>
                                                @endisset
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="text">Quantity</label>
                                    <input type="text" class="form-control @error('quantity_bahan') is-invalid @enderror" id="quantity_bahan" name="quantity_bahan" required value="{{ old('quantity_bahan') }}"/>
                                    @error('quantity_bahan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <label for="text">Satuan</label>
                                    <select class="form-control" data-live-search="true" id="satuan_bahan" name="satuan_bahan">                    
                                        <option value="lembar">lembar</option>
                                        <option value="meter">meter</option>
                                        <option value="cm">cm</option>
                                    </select>
                                </div>  
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">Tinta</label>
                                </div>
                                <div class="col-sm-3">
                                    <label for="text">Warna</label>
                                </div>
                                <div class="col-sm-3">
                                    <label for="text">Quantity</label>
                                </div>
                                <div class="col-sm-3">
                                    <label for="text">Satuan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <select class="form-control @error('penggunaan_tinta_id') is-invalid @enderror" id="penggunaan_tinta_id" name="penggunaan_tinta_id" required data-live-search="true">
                                        <option selected="" disabled="">
                                            -- Pilih Jenis Tinta --
                                        </option>
                                        @foreach ($list_tinta as $tinta)
                                            @if(old('penggunaan__tinta_id') == $tinta->id)
                                                <option value="{{ $tinta->id }}" selected>{{ $tinta->jenis_tinta }}</option>
                                            @else
                                                <option value="{{ $tinta->id }}">{{ $tinta->jenis_tinta }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="warna_cyan" readonly required value="Cyan"/>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control @error('quantity_cyan') is-invalid @enderror" id="quantity_cyan" name="quantity_cyan" required value="{{ old('quantity_cyan') }}"/>
                                    @error('quantity_cyan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" data-live-search="true" id="satuan_cyan" name="satuan_cyan">                    
                                        <option value="ml">mL</option>
                                        <option value="liter">L</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="warna_magenta" readonly required value="Magenta"/>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control @error('quantity_magenta') is-invalid @enderror" id="quantity_magenta" name="quantity_magenta" required value="{{ old('quantity_magenta') }}"/>
                                    @error('quantity_magenta')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" data-live-search="true" id="satuan_magenta" name="satuan_magenta">                    
                                        <option value="ml">mL</option>
                                        <option value="liter">L</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="warna_yellow" readonly required value="Yellow"/>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control @error('quantity_yellow') is-invalid @enderror" id="quantity_yellow" name="quantity_yellow" required value="{{ old('quantity_yellow') }}"/>
                                    @error('quantity_yellow')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" data-live-search="true" id="satuan_yellow" name="satuan_yellow">                    
                                        <option value="ml">mL</option>
                                        <option value="liter">L</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="warna_black" readonly required value="Black"/>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control @error('quantity_black') is-invalid @enderror" id="quantity_black" name="quantity_black" required value="{{ old('quantity_black') }}"/>
                                    @error('quantity_black')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" data-live-search="true" id="satuan_black" name="satuan_black">                    
                                        <option value="ml">mL</option>
                                        <option value="liter">L</option>
                                    </select>
                                </div>
                            </div>
                        </div> --}}

                        <div class="table-responsive container">
                            <table class="table table-striped table-borderless" id="tabel_bahan">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Bahan Setengah Jadi</th>
                                        <th>Quantity</th>
                                        <th>Harga Bahan Setengah Jadi</th>
                                        <th>Harga Rata-Rata</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_del_bahan">
                                    
                                </tbody> 
                            </table>
                        </div>

                        <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-detail-produk') }}'">
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
            $('#kategori_id').select2();
            $('#finishing_id').select2();
            $('#bahan_setengah_jadi_id').select2();
            // $('#penggunaan_bahan_id').select2();
            // $('#penggunaan_tinta_id').select2();
        });
        function tambahBahanSetengahJadi() {
            var bahan_setengah_jadi_id = $('#bahan_setengah_jadi_id').val();
            var quantity_bahan = $('#quantity_bahan').val();
            var quantity_temp = 0;
            var harga_temp = 0;
            // if ($('#status_quantity').is(":checked")) {
            //     var status_quantity = "Quantity Tetap";
            // }
            // else {
            //     var status_quantity = "None";
            // }
            var table = document.getElementById("tabel_bahan");
            var count = 0;
            $.ajax({
                url: "{{url('/api/tambah-bahan-detail-produk')}}",
                type: 'POST',
                data: {
                    bahan_setengah_jadi_id:bahan_setengah_jadi_id,
                    quantity_bahan:quantity_bahan,
                    _token:'{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    $.each(result.bahan_setengah_jadi, function (key, bahan_setengah_jadi) {
                        for (var i = 1, row; row = table.rows[i]; i++) {
                            if ($(table.rows[i].cells[5]).html() == bahan_setengah_jadi_id) {
                                quantity_temp = parseFloat($(table.rows[i].cells[1]).html())+parseFloat(quantity_bahan);
                                harga_temp = parseFloat($(table.rows[i].cells[6]).html())+parseFloat(result.harga_total);
                                $(table.rows[i]).remove();
                                $('#table_del_bahan').append('<tr>\
                                                              <td>'+bahan_setengah_jadi.nama_bahan_setengah_jadi+'</td>\
                                                              <td>'+quantity_temp+'</td>\
                                                              <td>'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(parseFloat(bahan_setengah_jadi.harga)*parseFloat(quantity_temp))+'</td>\
                                                              <td>'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(harga_temp)+'</td>\
                                                              <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)"><i class="fa fa-trash"></i></button></td>\
                                                              <td hidden>'+bahan_setengah_jadi.id+'</td>\
                                                              <td hidden>'+harga_temp+'</td>\
                                                              <td hidden><input type="hidden" name="bahan_setengah_jadi_id[]" value="'+bahan_setengah_jadi.id+'"/></td>\
                                                              <td hidden><input type="hidden" name="quantity[]" value="'+quantity_temp+'"/></td>\
                                                              </tr>');
                                count++;
                                break;
                            }
                        }
                        if (count == 0) {
                            $('#table_del_bahan').append('<tr>\
                                                          <td>'+bahan_setengah_jadi.nama_bahan_setengah_jadi+'</td>\
                                                          <td>'+quantity_bahan+'</td>\
                                                          <td>'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(parseFloat(bahan_setengah_jadi.harga)*parseFloat(quantity_bahan))+'</td>\
                                                          <td>'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(result.harga_total)+'</td>\
                                                          <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)"><i class="fa fa-trash"></i></button></td>\
                                                          <td hidden>'+bahan_setengah_jadi.id+'</td>\
                                                          <td hidden>'+result.harga_total+'</td>\
                                                          <td hidden><input type="hidden" name="bahan_setengah_jadi_id[]" value="'+bahan_setengah_jadi.id+'"/></td>\
                                                          <td hidden><input type="hidden" name="quantity[]" value="'+quantity_bahan+'"/></td>\
                                                          </tr>');
                        }
                        // $('#table_del_bahan').append('<tr>\
                        //                               <td>'+bahan_setengah_jadi.nama_bahan_setengah_jadi+'</td>\
                        //                               <td>'+quantity_bahan+'</td>\
                        //                               <td>'+status_quantity+'</td>\
                        //                               <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)"><i class="fa fa-trash"></i></button></td>\
                        //                               <td hidden>'+bahan_setengah_jadi.id+'</td>\
                        //                               <td hidden><input type="hidden" name="bahan_setengah_jadi_id[]" value="'+bahan_setengah_jadi.id+'"/></td>\
                        //                               <td hidden><input type="hidden" name="quantity[]" value="'+quantity_bahan+'"/></td>\
                        //                               <td hidden><input type="hidden" name="status_quantity[]" value="'+status_quantity+'"/></td>\
                        //                               </tr>');
                    });
                }
            });
        }
        function deleteRow(r) {
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("tabel_bahan").deleteRow(i);
        }
    </script>
</body>
</html>
