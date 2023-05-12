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
                    <form action="{{ url('/finishing') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label style="color: black; font-weight: bold;" for="text">ID Finishing</label>
                                </div>
                                <div class="col-4">
                                    <input type="text" readonly="readonly" class="form-control @error('id_finishing') is-invalid @enderror" id="id_finishing" name="id_finishing" required autofocus value="{{ $idproduk }}"/>
                                    @error('id_finishing')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="text">Jenis Finishing</label>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control @error('jenis_finishing') is-invalid @enderror" id="jenis_finishing" name="jenis_finishing" required value="{{ old('jenis_finishing') }}"/>
                                    @error('jenis_finishing')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="text">Harga</label>
                                </div>
                                <div class="col-4">
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror" id="finishing_harga" name="finishing_harga" required value="{{ old('finishing_harga') }}"/>
                                    @error('finishing_harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        {{-- <button type="cancel" class="btn btn-danger">
                            Cancel
                        </button> --}}
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Bahan Setengah Jadi</h4>
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
                                    <input type="text" class="form-control" id="quantity_bahan" name="quantity_bahan" value="{{ old('quantity_bahan') }}"/>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn" style="background-color: #EC268F; color: white;" onclick="tambahBahanSetengahJadi()">Tambah</button>
                        <br><br>
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

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#bahan_setengah_jadi_id').select2();
        });
        function tambahBahanSetengahJadi() {
            var bahan_setengah_jadi_id = $('#bahan_setengah_jadi_id').val();
            var quantity_bahan = $('#quantity_bahan').val();
            var quantity_temp = 0;
            var table = document.getElementById("tabel_bahan");
            var count = 0;
            $.ajax({
                url: "{{url('/api/tambah-bahan-finishing')}}",
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
