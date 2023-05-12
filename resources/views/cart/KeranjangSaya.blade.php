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
        @include('partials.NavbarPelanggan')
        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Keranjang Saya</h4>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="location.href='{{ url('shopping-cart/add') }}'" style="margin-right: 20px;">
                        <span class="material-icons align-middle">
                            add
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
                    @elseif(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <!--Card-->
                    {{-- <form action="{{ url('/checkout') }}" method="post" id="checkout"> --}}
                    <form action="{{ url('/checkout') }}" method="post">
                        @csrf
                        @foreach ($keranjang_saya as $keranjang)
                        <div class="row mb-4">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="row align-middle">
                                            <div class="col-sm-2">
                                                <input type="checkbox" id="keranjang_id" name="keranjang_id[]" value="{{ $keranjang->id }}">
                                            </div>
                                            <div class="col-sm-10">
                                                @isset($keranjang->kategori->gambar_kategori)
                                                <img class="card-img responsive" src="{{ asset('/storage/'.$keranjang->kategori->gambar_kategori) }}" style="height: 200px;" alt="Card image cap">
                                                @else
                                                <img class="card-img responsive" src="{{ asset('/storage/kategori/null.jpg') }}" style="height: 200px; width: 200px;" alt="Card image cap">
                                                @endisset
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h4 class="card-title">{{ $keranjang->kategori->nama_kategori }}</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="card-text">Jenis Bahan</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="card-text">{{ $keranjang->jenis_bahan_input }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="card-text">Ukuran</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="card-text">{{ $keranjang->ukuran_input }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="card-text">Finishing</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="card-text">{{ $keranjang->finishing_input }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="card-text">Status Warna</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="card-text">{{ $keranjang->warna_input }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="card-text">Jumlah Produk</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="card-text">{{ $keranjang->jumlah_produk }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="card-text">Custom Notes</p>
                                            </div>
                                            <div class="col-sm-9">
                                                @isset ($keranjang->custom)
                                                {!! $keranjang->custom !!}
                                                @else
                                                <p class="card-text">None</p>
                                                @endisset
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="card-text">File</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <button type="button" onclick="location.href='{{ url('file/'.$keranjang->id) }}'" class="btn btn-primary btn-sm"><span class="material-icons align-middle">description</span> Download</button>
                                            </div>
                                        </div>
                                        <div class="row" hidden>
                                            <div class="col-sm-3">
                                                <p class="card-text" style="color: black"><b>Hidden</b></p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" id="kategori_id" name="kategori_id[]" value="{{ $keranjang->kategori_id }}"/>
                                                <input type="text" id="jenis_bahan_input" name="jenis_bahan_input[]" value="{{ $keranjang->jenis_bahan_input }}"/>
                                                <input type="text" id="ukuran_input" name="ukuran_input[]" value="{{ $keranjang->ukuran_input }}"/>
                                                <input type="text" id="finishing_input" name="finishing_input[]" value="{{ $keranjang->finishing_input }}"/>
                                                <input type="text" id="warna_input" name="warna_input[]" value="{{ $keranjang->warna_input }}"/>
                                                <input type="number" id="jumlah_produk" name="jumlah_produk[]" value="{{ $keranjang->jumlah_produk }}"/>
                                                <input type="text" id="custom" name="custom[]" value="{{ $keranjang->custom }}"/>
                                                <input type="text" id="file_cetak" name="file_cetak[]" value="{{ $keranjang->file_cetak }}"/>
                                            </div>
                                        </div>
                                        {{-- <div class="row">
                                            <div class="col-sm-3">
                                                <p class="card-text">Sub Total</p>
                                            </div>
                                            <div class="col-sm-9">
                                                @foreach ($data as $sub)
                                                    @if ($sub['id_keranjang'] == $keranjang->id)
                                                    <p class="card-text">Rp {{ number_format($sub['sub_total'], 2) }}</p>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="card-text">Diskon</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="card-text">{{ $keranjang->detail_produk->diskon }}%</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="card-text" style="color: black"><b>Total</b></p>
                                            </div>
                                            <div class="col-sm-9">
                                                @foreach ($data as $sub)
                                                    @if ($sub['id_keranjang'] == $keranjang->id)
                                                    <p class="card-text" style="color: black"><b>Rp {{ number_format($sub['sub_total']*(1-($keranjang->detail_produk->diskon/100)), 2) }}</b></p>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="row" hidden>
                                            <div class="col-sm-3">
                                                <p class="card-text" style="color: black"><b>Hidden</b></p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" id="detail_produk_id" name="detail_produk_id[]" value="{{ $keranjang->detail_produk_id }}"/>
                                                <input type="text" id="harga" name="harga[]" value="{{ $keranjang->detail_produk->harga }}"/>
                                                <input type="text" id="jumlah_produk" name="jumlah_produk[]" value="{{ $keranjang->jumlah_produk }}"/>
                                                @foreach ($data as $sub)
                                                @if ($sub['id_keranjang'] == $keranjang->id)
                                                <input type="text" id="harga_finishing" name="harga_finishing[]" value="{{ $sub['harga_finishing'] }}"/>
                                                <input type="text" id="sub_total" name="sub_total[]" value="{{ $sub['sub_total']*(1-($keranjang->detail_produk->diskon/100)) }}"/>
                                                @endif
                                                @endforeach
                                                <input type="text" id="diskon" name="diskon[]" value="{{ $keranjang->detail_produk->diskon }}"/>
                                                <input type="text" id="custom" name="custom[]" value="{{ $keranjang->custom }}"/>
                                                <input type="text" id="file_cetak" name="file_cetak[]" value="{{ $keranjang->file_cetak }}"/>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                {{-- <form action="{{ url('shopping-cart/'.$keranjang->id) }}" method="POST" class="d-inline" id="delete_item_{{ $keranjang->id }}">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" form="delete_item_{{ $keranjang->id }}"><span class="material-icons align-middle">delete</span></button>
                                                </form> --}}
                                                <button type="button" name="delete[]" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" value="{{ $keranjang->id }}"><span class="material-icons align-middle">delete</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="row">
                            <div class="card card-body">
                                <div class="row" hidden>
                                    {{-- <input type="text" id="pelanggan_id" name="pelanggan_id" value="{{ $keranjang->pelanggan_id }}"/> --}}
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <p class="card-text" style="color: black; font-size: 16px;">Jumlah Produk</p>
                                    </div>
                                    <div class="col-sm-4" id="label_jumlah_total_item">
                                        <p class="card-text" style="color: black; font-size: 16px;">0</p>
                                    </div>
                                    <div class="col-sm-4" id="input_jumlah_total_item">
                                        <input type="hidden" id="jumlah_total_item" name="jumlah_total_item" value="0"/>
                                    </div>
                                </div>
                                {{-- <br>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <p class="card-text" style="color: black; font-size: 16px;">Sub Total</p>
                                    </div>
                                    <div class="col-sm-4" id="label_sub_total_transaksi">
                                        <p class="card-text" style="color: black; font-size: 16px;">Rp {{ number_format(0, 2) }}</p>
                                    </div>
                                    <div class="col-sm-4" id="input_sub_total_transaksi">
                                        <input type="hidden" id="sub_total_transaksi" name="sub_total_transaksi" value="{{ number_format(0, 2) }}"/>
                                    </div>
                                </div> --}}
                                <br>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <p class="card-text" style="color: black; font-size: 16px;">Promo</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="promo_id" name="promo_id" autofocus>
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
                                        </select>
                                    </div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-1">
                                        <p class="card-text" style="color: black; font-size: 16px;">Cabang</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="form-control @error('cabang_id') is-invalid @enderror" id="cabang_id" name="cabang_id" required>
                                            <option selected="" value="" disabled="">
                                                -- Pilih Cabang --
                                            </option>
                                            @foreach ($list_cabang as $cabang)
                                                @if(old('cabang_id') == $cabang->id)
                                                    <option value="{{ $cabang->id }}" selected>{{ $cabang->alamat }}</option>
                                                @else
                                                    <option value="{{ $cabang->id }}">{{ $cabang->alamat }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('cabang_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    {{-- <div class="col-sm-2">
                                        <p class="card-text" style="color: black; font-size: 20px;"><b>Total</b></p>
                                    </div>
                                    <div class="col-sm-4" id="label_total">
                                        <p class="card-text" style="color: black; font-size: 20px;"><b>Rp {{ number_format(0, 2) }}</b></p>
                                    </div>
                                    <div class="col-sm-4" id="input_total">
                                        <input type="hidden" id="total" name="total" value="{{ number_format(0, 2) }}"/>
                                    </div> --}}
                                    <div class="col-sm-12 text-right">
                                        {{-- <button type="submit" class="btn btn-primary" form="checkout">Checkout</button> --}}
                                        <button type="submit" class="btn btn-primary">Checkout</button>
                                    </div>
                                </div>
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
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#promo_id').select2();
            $('#cabang_id').select2();

            $("input:checkbox[name^='keranjang_id']").click(function () {
                $("#label_jumlah_total_item").html('');
                $("#input_jumlah_total_item").html('');
                // $("#label_sub_total_transaksi").html('');
                // $("#input_sub_total_transaksi").html('');
                // $("#label_total").html('');
                // $("#input_total").html('');

                var jumlah_total_item = 0;
                // var sub_total_transaksi = 0;
                var promo_id = $('#promo_id').val();
                // var total = 0;
                $("input:checkbox[name^='keranjang_id']").each(function () {
                    if ($(this).is(":checked")) {
                        var id = $(this).val();
                        $.ajax({
                        url: "{{url('/api/fetch-keranjang')}}",
                            type: 'POST',
                            data: {
                                    id:id,
                                    promo_id:promo_id,
                                    _token:'{{ csrf_token() }}'
                            },
                            dataType: 'json',
                            success: function (result) {
                                jumlah_total_item += parseInt(result.jumlah);
                                $('#label_jumlah_total_item').html('<p class="card-text" style="color: black; font-size: 16px;">'+jumlah_total_item+'</p>');
                                $('#input_jumlah_total_item').html('<input type="hidden" id="jumlah_total_item" name="jumlah_total_item" value="'+jumlah_total_item+'"/>');
                                // sub_total_transaksi += parseFloat(result.total);
                                // $('#label_sub_total_transaksi').html('<p class="card-text" style="color: black; font-size: 16px;">'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(sub_total_transaksi)+'</p>');
                                // $('#input_sub_total_transaksi').html('<input type="hidden" id="sub_total_transaksi" name="sub_total_transaksi" value="'+sub_total_transaksi+'"/>');
                                // total = sub_total_transaksi*(1-(parseFloat(result.potongan)/100));
                                // $('#label_total').html('<p class="card-text" style="color: black; font-size: 20px;"><b>'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(total)+'</b></p>');
                                // $('#input_total').html('<input type="hidden" id="total" name="total" value="'+total+'"/>');
                            }
                        });
                    }
                });
                $('#label_jumlah_total_item').html('<p class="card-text" style="color: black; font-size: 16px;">'+jumlah_total_item+'</p>');
                $('#input_jumlah_total_item').html('<input type="hidden" id="jumlah_total_item" name="jumlah_total_item" value="'+jumlah_total_item+'"/>');                
                // $('#label_sub_total_transaksi').html('<p class="card-text" style="color: black; font-size: 16px;">'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(sub_total_transaksi)+'</p>');
                // $('#label_total').html('<p class="card-text" style="color: black; font-size: 20px;"><b>'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(total)+'</b></p>');
            });

            // $('#promo_id').change(function () {
            //     var sub_total_transaksi = $('#sub_total_transaksi').val();
            //     var promo_id = $('#promo_id').val();
            //     var total = $('#total').val();
            //     $.ajax({
            //         url: "{{url('/api/fetch-promo')}}",
            //         type: 'POST',
            //         data: {
            //                 promo_id:promo_id,
            //                 _token:'{{ csrf_token() }}'
            //         },
            //         dataType: 'json',
            //         success: function (result) {
            //             total = parseFloat(sub_total_transaksi*(1-(result/100)));
            //             $('#label_total').html('<p class="card-text" style="color: black; font-size: 20px;"><b>'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(total)+'</b></p>');
            //             $('#input_total').html('<input type="hidden" id="total" name="total" value="'+total+'"/>');
            //         }
            //     });
            // });

            $("button:button[name^='delete']").click(function () {
                var id = $(this).val();
                $.ajax({
                url: "{{url('/api/delete-item')}}",
                    type: 'POST',
                    data: {
                        id:id,
                        _token:'{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        // $('#alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert">'++'\
                        //                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                        //                         <span aria-hidden="true">&times;</span>\
                        //                     </button>\
                        //                   </div>');
                        location.reload();
                    }
                });
            });
        });
    </script>
</body>
</html>
