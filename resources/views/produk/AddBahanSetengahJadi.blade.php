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
                        <h4 class="card-title">Add Bahan Setengah Jadi</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-bahan-setengah-jadi') }}'" style="margin-right: 10px;">
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
                    @if(auth()->user()->user_role == "Admin" || auth()->user()->user_role == "Kepala Toko" || auth()->user()->user_role == "Wakil Kepala Toko")
                    <form action="{{ url('/bahan-setengah-jadi') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">ID Bahan Setengah Jadi</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" readonly="readonly" class="form-control @error('id_bahan_setengah_jadi') is-invalid @enderror" id="id_bahan_setengah_jadi" name="id_bahan_setengah_jadi" required autofocus value="{{ $idbahansetengahjadi }}"/>
                                    @error('id_bahan_setengah_jadi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="text">Nama Bahan Setengah Jadi</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control @error('nama_bahan_setengah_jadi') is-invalid @enderror" id="nama_bahan_setengah_jadi" name="nama_bahan_setengah_jadi" required value="{{ old('nama_bahan_setengah_jadi') }}"/>
                                    @error('nama_bahan_setengah_jadi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
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
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">Bahan Baku</label>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control @error('produk_id') is-invalid @enderror" id="produk_id" name="produk_id" required>
                                        <option selected="" disabled="">
                                            -- Pilih Bahan Baku --
                                        </option>
                                        @foreach ($list_bahan as $bahan)
                                            @if(old('produk_id') == $bahan->id)
                                                @isset($bahan->ukuran)
                                                <option value="{{ $bahan->id }}" selected>{{ $bahan->jenis_kertas . " " . $bahan->ukuran }}</option>
                                                @else
                                                <option value="{{ $bahan->id }}" selected>{{ $bahan->jenis_kertas . " " . $bahan->lebar." x ".$bahan->panjang." ".$bahan->satuan }} </option>
                                                @endisset
                                            @else
                                                @isset($bahan->ukuran)
                                                <option value="{{ $bahan->id }}">{{ $bahan->jenis_kertas . " " . $bahan->ukuran }}</option>
                                                @else
                                                <option value="{{ $bahan->id }}">{{ $bahan->jenis_kertas . " " . $bahan->lebar." x ".$bahan->panjang." ".$bahan->satuan }} </option>
                                                @endisset
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-4">
                                    <label for="text">Quantity</label>
                                    <input type="text" class="form-control @error('quantity_bahan') is-invalid @enderror" id="quantity_bahan" name="quantity_bahan" required value="{{ old('quantity_bahan') }}"/>
                                    @error('quantity_bahan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="text">Satuan</label>
                                    <select class="form-control" data-live-search="true" id="satuan_bahan" name="satuan_bahan">                    
                                        <option value="lembar">lembar</option>
                                        <option value="m2">m2</option>
                                        <option value="cm2">cm2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn" style="background-color: #EC268F; color: white;" onclick="tambahBahan()">Tambah Bahan</button>
                        <br><br>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label style="color: black; font-weight: bold;" for="text">Jenis Tinta</label>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control @error('detail_tinta_id') is-invalid @enderror" id="detail_tinta_id" name="detail_tinta_id" required>
                                        <option selected="" disabled="">
                                            -- Pilih Tinta --
                                        </option>
                                        @foreach ($list_tinta as $tintas)
                                            @if(old('detail_tinta_id') == $tintas->id)
                                            <option value="{{ $tintas->id }}" selected>{{ $tintas->tinta->jenis_tinta . " " . $tintas->warna }}</option>
                                            @else
                                            <option value="{{ $tintas->id }}">{{ $tintas->tinta->jenis_tinta . " " . $tintas->warna }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-4">
                                    <label for="text">Quantity</label>
                                    <input type="text" class="form-control @error('quantity_tinta') is-invalid @enderror" id="quantity_tinta" name="quantity_tinta" required value="{{ old('quantity_tinta') }}"/>
                                    @error('quantity_tinta')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="text">Satuan</label>
                                    <select class="form-control" data-live-search="true" id="satuan_tinta" name="satuan_tinta">                    
                                        <option value="ml">ml</option>
                                        <option value="liter">liter</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn" style="background-color: #EC268F; color: white;" onclick="tambahTinta()">Tambah Tinta</button>
                        <br><br>
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Penggunaan Bahan</h4>
                            </div>
                        </div>
                        <hr style="height: 10px;">
                        <div class="table-responsive container">
                            <table class="table table-striped table-borderless" id="tabel_bahan">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Jenis Bahan</th>
                                        <th>Ukuran</th>
                                        <th>Quantity</th>
                                        <th>Satuan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_del_bahan">
                                    
                                </tbody> 
                            </table>
                        </div>
                        <br>
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Penggunaan Tinta</h4>
                            </div>
                        </div>
                        <hr style="height: 10px;">
                        <div class="table-responsive container">
                            <table class="table table-striped table-borderless" id="tabel_tinta">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Jenis Tinta</th>
                                        <th>Quantity</th>
                                        <th>Satuan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_del_tinta">
                                    
                                </tbody> 
                            </table>
                        </div>
                        <br><br>
                        <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-bahan-setengah-jadi') }}'">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#produk_id').select2();
            $('#detail_tinta_id').select2();
        });
        function tambahBahan() {
            var produk_id = $('#produk_id').val();
            var jumlah_pemakaian_bahan = $('#quantity_bahan').val();
            var satuan_bahan = $('#satuan_bahan').val();
            var table = document.getElementById("tabel_bahan");
            var count = 0;
            var quantity_temp = 0;
            var ukuran_temp = "";
            $.ajax({
                url: "{{url('/api/tambah-bahan-baku-setengah-jadi')}}",
                type: 'POST',
                data: {
                    produk_id:produk_id,
                    _token:'{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    $.each(result.produk, function (key, produk) {
                        if (produk.ukuran == null) {
                            ukuran_temp = produk.lebar+" x "+produk.panjang+" "+produk.satuan
                        }
                        else {
                            ukuran_temp = produk.ukuran
                        }
                        for (var i = 1, row; row = table.rows[i]; i++) {
                            // alert($(table.rows[i].cells[4]).html());
                            if ($(table.rows[i].cells[4]).html() == produk_id) {
                                if ($(table.rows[i].cells[3]).html() == satuan_bahan) {
                                    quantity_temp = parseFloat($(table.rows[i].cells[2]).html())+parseFloat(jumlah_pemakaian_bahan);
                                }
                                else {
                                    if (satuan_bahan == "cm") {
                                        quantity_temp = parseFloat($(table.rows[i].cells[2]).html())+(parseFloat(jumlah_pemakaian_bahan)/100);
                                        satuan_bahan = "meter";
                                    }
                                }
                                $(table.rows[i]).remove();
                                $('#table_del_bahan').append('<tr>\
                                                              <td>'+produk.jenis_kertas+'</td>\
                                                              <td>'+ukuran_temp+'</td>\
                                                              <td>'+quantity_temp+'</td>\
                                                              <td>'+satuan_bahan+'</td>\
                                                              <td hidden>'+produk.id+'</td>\
                                                              <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteRowBahan(this)"><i class="fa fa-trash"></i></button></td>\
                                                              <td hidden><input type="hidden" name="produk_id[]" value="'+produk.id+'"/></td>\
                                                              <td hidden><input type="hidden" name="jumlah_pemakaian_bahan[]" value="'+quantity_temp+'"/></td>\
                                                              <td hidden><input type="hidden" name="satuan_bahan[]" value="'+satuan_bahan+'"/></td>\
                                                              </tr>');
                                count++;
                                break;
                            }
                        }
                        if (count == 0) {
                            if (satuan_bahan == "cm") {
                                jumlah_pemakaian_bahan = (parseFloat(jumlah_pemakaian_bahan)/100);
                                satuan_bahan = "meter";
                            }
                            $('#table_del_bahan').append('<tr>\
                                                          <td>'+produk.jenis_kertas+'</td>\
                                                          <td>'+ukuran_temp+'</td>\
                                                          <td>'+jumlah_pemakaian_bahan+'</td>\
                                                          <td>'+satuan_bahan+'</td>\
                                                          <td hidden>'+produk.id+'</td>\
                                                          <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteRowBahan(this)"><i class="fa fa-trash"></i></button></td>\
                                                          <td hidden><input type="hidden" name="produk_id[]" value="'+produk.id+'"/></td>\
                                                          <td hidden><input type="hidden" name="jumlah_pemakaian_bahan[]" value="'+jumlah_pemakaian_bahan+'"/></td>\
                                                          <td hidden><input type="hidden" name="satuan_bahan[]" value="'+satuan_bahan+'"/></td>\
                                                          </tr>');
                        }
                    });
                }
            });
        }
        function tambahTinta() {
            var detail_tinta_id = $('#detail_tinta_id').val();
            var jumlah_pemakaian_tinta = $('#quantity_tinta').val();
            var satuan_tinta = $('#satuan_tinta').val();
            var table = document.getElementById("tabel_tinta");
            var count = 0;
            var quantity_temp = 0;
            $.ajax({
                url: "{{url('/api/tambah-tinta-setengah-jadi')}}",
                type: 'POST',
                data: {
                    detail_tinta_id:detail_tinta_id,
                    _token:'{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    $.each(result.detail_tinta, function (key, detail_tinta) {
                        for (var i = 1, row; row = table.rows[i]; i++) {
                            if ($(table.rows[i].cells[3]).html() == detail_tinta_id) {
                                if ($(table.rows[i].cells[2]).html() == satuan_tinta) {
                                    quantity_temp = parseFloat($(table.rows[i].cells[1]).html())+parseFloat(jumlah_pemakaian_tinta);
                                }
                                else {
                                    if (satuan_tinta == "liter") {
                                        quantity_temp = parseFloat($(table.rows[i].cells[1]).html())+(parseFloat(jumlah_pemakaian_tinta)*1000);
                                        satuan_tinta = "ml";
                                    }
                                }
                                $(table.rows[i]).remove();
                                $('#table_del_tinta').append('<tr>\
                                                              <td>'+detail_tinta.jenis_tinta+' '+detail_tinta.warna+'</td>\
                                                              <td>'+quantity_temp+'</td>\
                                                              <td>'+satuan_tinta+'</td>\
                                                              <td hidden>'+detail_tinta.id+'</td>\
                                                              <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteRowTinta(this)"><i class="fa fa-trash"></i></button></td>\
                                                              <td hidden><input type="hidden" name="detail_tinta_id[]" value="'+detail_tinta.id+'"/></td>\
                                                              <td hidden><input type="hidden" name="jumlah_pemakaian_tinta[]" value="'+quantity_temp+'"/></td>\
                                                              <td hidden><input type="hidden" name="satuan_tinta[]" value="'+satuan_tinta+'"/></td>\
                                                              </tr>');
                                count++;
                                break;
                            }
                        }
                        if (count == 0) {
                            if (satuan_tinta == "liter") {
                                jumlah_pemakaian_tinta = (parseFloat(jumlah_pemakaian_tinta)*1000);
                                satuan_tinta = "ml";
                            }
                            $('#table_del_tinta').append('<tr>\
                                                        <td>'+detail_tinta.jenis_tinta+' '+detail_tinta.warna+'</td>\
                                                        <td>'+jumlah_pemakaian_tinta+'</td>\
                                                        <td>'+satuan_tinta+'</td>\
                                                        <td hidden>'+detail_tinta.id+'</td>\
                                                        <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteRowTinta(this)"><i class="fa fa-trash"></i></button></td>\
                                                        <td hidden><input type="hidden" name="detail_tinta_id[]" value="'+detail_tinta.id+'"/></td>\
                                                        <td hidden><input type="hidden" name="jumlah_pemakaian_tinta[]" value="'+jumlah_pemakaian_tinta+'"/></td>\
                                                        <td hidden><input type="hidden" name="satuan_tinta[]" value="'+satuan_tinta+'"/></td>\
                                                        </tr>');
                        }
                    });
                }
            });
        }
        function deleteRowBahan(r) {
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("tabel_bahan").deleteRow(i);
        }
        function deleteRowTinta(r) {
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("tabel_tinta").deleteRow(i);
        }
    </script>
</body>
</html>
