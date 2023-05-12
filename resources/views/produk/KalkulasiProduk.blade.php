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
                        <h4 class="card-title">Kalkulasi Produk</h4>
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
                    <form>
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
                        <br>
                        {{-- <div class="row">
                            <div class="col-sm-9" style="text-align: right;">
                                <label style="color: black; font-size: 20px;" for="text">Profit (%) : </label>
                            </div>
                            <div class="col-sm-3" style="text-align: start;" id="profit-form">
                                <input type="number" style="color: black; margin-left: 0px; width: 120px; padding-top: 3px;" id="profit" name="profit" value="{{ 0 }}"/>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-sm-9" style="text-align: right;">
                                <label style="color: black; font-weight: bold; font-size: 20px;" for="text">Total : </label>
                            </div>
                            <div class="col-sm-3" style="text-align: start;" id="total-form">
                                <label type="text" id="total" name="total" style="color: black; font-weight: bold; font-size: 20px;">Rp {{ number_format(0, 2) }}</label>
                                <input type="hidden" style="color: black; margin-left: 0px; width: 120px; padding-top: 3px;" name="total" value="{{ 0 }}"/>
                            </div>
                        </div>
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
            var harga_temp = 0;
            var table = document.getElementById("tabel_bahan");
            var count = 0;
            // var profit = $('#profit').val();
            var sub_total = 0.00;
            $("#total-form").html('');
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
                                harga_bahan_temp = parseFloat($(table.rows[i].cells[7]).html())+parseFloat(bahan_setengah_jadi.harga)*parseFloat(quantity_bahan);
                                $(table.rows[i]).remove();
                                $('#table_del_bahan').append('<tr>\
                                                              <td>'+bahan_setengah_jadi.nama_bahan_setengah_jadi+'</td>\
                                                              <td>'+quantity_temp+'</td>\
                                                              <td>'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(parseFloat(bahan_setengah_jadi.harga)*parseFloat(quantity_temp))+'</td>\
                                                              <td>'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(harga_temp)+'</td>\
                                                              <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)"><i class="fa fa-trash"></i></button></td>\
                                                              <td hidden>'+bahan_setengah_jadi.id+'</td>\
                                                              <td hidden>'+harga_temp+'</td>\
                                                              <td hidden>'+harga_bahan_temp+'</td>\
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
                                                          <td hidden>'+parseFloat(bahan_setengah_jadi.harga)*parseFloat(quantity_bahan)+'</td>\
                                                          </tr>');
                        }
                    });
                    for (var i = 1, row; row = table.rows[i]; i++) {
                        sub_total += parseFloat($(table.rows[i].cells[7]).html());
                    }
                    $("#total-form").append('<label type="text" id="total" name="total" style="color: black; font-weight: bold; font-size: 20px;">' + Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(sub_total) + '</label>');
                }
            });
        }
        function deleteRow(r) {
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("tabel_bahan").deleteRow(i);
            var table = document.getElementById("tabel_bahan");
            var profit = $('#profit').val();
            var sub_total = 0.00;
            $("#total-form").html('');
            for (var i = 1, row; row = table.rows[i]; i++) {
                sub_total += parseFloat($(table.rows[i].cells[7]).html());
            }
            $("#total-form").append('<label type="text" id="total" name="total" style="color: black; font-weight: bold; font-size: 20px;">' + Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(sub_total) + '</label>');                                     
        }
        // $('#profit').change(function () {
        //     var table = document.getElementById("tabel_bahan");
        //     var profit = $('#profit').val();
        //     var sub_total = 0.00;
        //     $("#total-form").html('');
        //     for (var i = 1, row; row = table.rows[i]; i++) {
        //         sub_total += parseFloat($(table.rows[i].cells[5]).html());
        //     }
        //     $("#total-form").append('<label type="text" id="total" name="total" style="color: black; font-weight: bold; font-size: 20px;">' + Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(sub_total*(1+(profit/100))) + '</label>\
        //                              <input type="hidden" style="color: black; margin-left: 0px; width: 120px; padding-top: 3px;" name="total" value="' + sub_total*(1+(profit/100)) + '"/>');                                     
        // });
    </script>
</body>
</html>
