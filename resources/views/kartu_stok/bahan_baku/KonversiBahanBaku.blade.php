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
                        <h4 class="card-title">Konversi Bahan Baku</h4>
                    </div>
                    <button type="button" class="btn" onclick="location.href='{{ url('kartu-stok-bahan-baku') }}'" style="margin-right: 10px; background-color: #29a4da; color:white;">
                        <span class="material-icons align-middle">arrow_back</span>
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
                    <form action="{{url('/konversi-bahan-baku')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="produk_id" class="text">Nama Bahan Baku</label>
                                </div>
                                <div class="col-3">
                                    <select class="form-control" data-live-search="true" id="produk_id" name="produk_id">                    
                                        @foreach ($bahan as $b)
                                        @isset($b->ukuran)
                                        <option value="{{ $b->id }}">{{ $b->jenis_kertas}} {{ $b->ukuran }} </option>
                                        @else
                                        <option value="{{ $b->id }}">{{ $b->jenis_kertas}} {{ $b->lebar." ".$b->satuan." x ".$b->panjang." ".$b->satuan }} </option>
                                        @endisset
                                        @endforeach
                                    </select>
                                </div>                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="quantity" class="text">Quantity</label>
                                </div>
                                <div class="col-3">
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" required autofocus/>
                                    @error('quantity')
                            
                                    <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>                
                                <div class="col-2">
                                    <select class="form-control" data-live-search="true" id="satuan">                    
                                        <option value="rim">rim</option>
                                        <option value="lembar">lembar</option>
                                        <option value="rol">rol</option>
                                    </select>
                                </div>                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="harga" class="text">Harga</label>
                                </div>
                                <div class="col-3">
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" required autofocus/>
                                    @error('harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>                
                            </div>
                        </div>
                        <button type="button" class="btn" style="background-color: #EC268F; color: white;" onclick="tambahBahan()">Tambah</button>
                        <br><br>
                        <div class="table-responsive container">
                            <table class="table table-striped table-borderless" id="tabel">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID Bahan Baku</th>
                                        <th>Jenis Bahan</th>
                                        <th>Ukuran</th>
                                        <th>Quantity</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_del_bahan">
                                    
                                </tbody> 
                            </table>
                        </div>
                        <button type="button" class="btn" style="background-color: #29a4da; color:white;" onclick="location.href='{{ url('list-pembelian-bahan-baku') }}'">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
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
            $('#produk_id').select2();
            $('#cabang_id').select2();
            $('#satuan').select2();
        });
        
        function tambahBahan() {
            var produk_id = $('#produk_id').val();
            var quantity = $('#quantity').val();
            var satuan = $('#satuan').val();
            var harga = $('#harga').val();
            var table = document.getElementById("tabel");
            var count = 0;
            var quantity_temp = 0;
            var harga_temp = 0;
            var ukuran_temp = "";
            $.ajax({
                url: "{{url('/api/tambah-bahan-baku')}}",
                type: 'POST',
                data: {
                    produk_id:produk_id,
                    _token:'{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    $.each(result.produk, function (key, produk) {
                        if (produk.ukuran == null) {
                            ukuran_temp = produk.lebar+" "+produk.satuan+" x "+produk.panjang+" "+produk.satuan
                        }
                        else {
                            ukuran_temp = produk.ukuran
                        }
                        for (var i = 1, row; row = table.rows[i]; i++) {
                            if ($(table.rows[i].cells[0]).html() == produk.id_produk) {
                                quantity_temp = parseInt($(table.rows[i].cells[3]).html())+parseInt(quantity);
                                harga_temp = parseInt($(table.rows[i].cells[4]).html())+parseInt(harga);
                                $(table.rows[i]).remove();
                                $('#table_del_bahan').append('<tr>\
                                                        <td>'+produk.id_produk+'</td>\
                                                        <td>'+produk.jenis_kertas+'</td>\
                                                        <td>'+ukuran_temp+'</td>\
                                                        <td>'+quantity_temp+'</td>\
                                                        <td>'+satuan+'</td>\
                                                        <td>'+harga_temp+'</td>\
                                                        <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)"><i class="fa fa-trash"></i></button></td>\
                                                        <td hidden><input type="hidden" name="produk_id[]" value="'+produk.id+'"/></td>\
                                                        <td hidden><input type="hidden" name="quantity[]" value="'+quantity_temp+'"/></td>\
                                                        <td hidden><input type="hidden" name="satuan[]" value="'+satuan+'"/></td>\
                                                        <td hidden><input type="hidden" name="harga[]" value="'+harga_temp+'"/></td>\
                                                        </tr>');
                                count++;
                                break;
                            }
                        }
                        if (count == 0) {
                            $('#table_del_bahan').append('<tr>\
                                                        <td>'+produk.id_produk+'</td>\
                                                        <td>'+produk.jenis_kertas+'</td>\
                                                        <td>'+ukuran_temp+'</td>\
                                                        <td>'+quantity+'</td>\
                                                        <td>'+satuan+'</td>\
                                                        <td>'+harga+'</td>\
                                                        <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)"><i class="fa fa-trash"></i></button></td>\
                                                        <td hidden><input type="hidden" name="produk_id[]" value="'+produk.id+'"/></td>\
                                                        <td hidden><input type="hidden" name="quantity[]" value="'+quantity+'"/></td>\
                                                        <td hidden><input type="hidden" name="satuan[]" value="'+satuan+'"/></td>\
                                                        <td hidden><input type="hidden" name="harga[]" value="'+harga+'"/></td>\
                                                        </tr>');
                        }
                    });
                }
            });
        }

        function deleteRow(r) {
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("tabel").deleteRow(i);
        }
    </script>
</body>
</html>
