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
                        <h4 class="card-title">Detail Produk</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('shopping-cart') }}'" style="margin-right: 10px;">
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
                    <!--Content-->
                    <form action="{{ url('shopping-cart') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    {{-- @isset($kategori->gambar_kategori)
                                    <img class="card-img-top" src="{{ asset('/storage/'.$kategori->gambar_kategori) }}" style="height: 200px;" alt="Card image cap">
                                    @else
                                    <img class="card-img-top" src="{{ asset('/storage/kategori/null.jpg') }}" style="height: 200px;" alt="Card image cap">
                                    @endisset --}}
                                    {{-- <input type="hidden" class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" value="{{ $kategori->id }}" required/> --}}
                                    <div id="gambar_kategori">
                                        <img class="card-img-top" src="{{ asset('/storage/kategori/null.jpg') }}" style="height: 200px;" alt="Card image cap">
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label for="produk_dropdown"><b>Kategori Produk</b></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_dropdown" name="kategori_id" required>
                                                    <option selected="" disabled="" value="">
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
                                            <div class="col-sm-3">
                                                <label for="jenis_bahan_input"><b>Jenis Bahan</b></label>
                                            </div>
                                            <div class="col-sm-9">
                                                {{-- <select class="form-control" id="jenis_bahan_dropdown" name="jenis_bahan" autofocus required>
                                                    <option selected="" disabled="">
                                                        -- Pilih Jenis Bahan --
                                                    </option>
                                                </select> --}}
                                                <input type="text" class="form-control @error('jenis_bahan_input') is-invalid @enderror" id="jenis_bahan_input" name="jenis_bahan_input" value="{{ old('jenis_bahan_input') }}" required placeholder="ex: HVS 70 gsm"/>
                                                @error('jenis_bahan_input')
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
                                                <label for="ukuran_input"><b>Ukuran</b></label>
                                            </div>
                                            <div class="col-sm-9">
                                                {{-- <select class="form-control" id="ukuran_dropdown" name="ukuran" autofocus required>
                                                    <option selected="" disabled="">
                                                        -- Pilih Ukuran --
                                                    </option>
                                                </select> --}}
                                                <input type="text" class="form-control @error('ukuran_input') is-invalid @enderror" id="ukuran_input" name="ukuran_input" value="{{ old('ukuran_input') }}" required placeholder="ex: A4, untuk ukuran selain kertas yang ditulis lebar x panjang m2"/>
                                                @error('ukuran_input')
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
                                                <label for="finishing_input"><b>Finishing</b></label>
                                            </div>
                                            <div class="col-sm-9">
                                                {{-- <select class="form-control" id="finishing_dropdown" name="finishing_id" autofocus required>
                                                    <option selected="" disabled="">
                                                        -- Pilih Finishing --
                                                    </option>
                                                </select> --}}
                                                <input type="text" class="form-control" id="finishing_input" name="finishing_input" value="{{ old('finishing_input') }}" placeholder="ex: Jilid Spiral"/>
                                                <p>* jika tidak perlu finishing maka biarkan kosong</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label for="finishing_input"><b>Status Warna</b></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="warna_dropdown" name="warna_input" autofocus required>
                                                    <option selected="" disabled="" value="">-- Pilih Warna --</option>
                                                    <option value="Berwarna">Berwarna</option>
                                                    <option value="Black & White">Black & White</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <b><label for="harga" style="font-size: 20px;">Harga</label></b>
                                            </div>
                                            <div class="col-sm-9" id="harga">
                                                <b><label for="harga" style="font-size: 20px;">Rp {{ number_format(0, 2) }}</label></b>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label for="jumlah_produk"><b>Jumlah Produk</b></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control @error('jumlah_produk') is-invalid @enderror" id="jumlah_produk" name="jumlah_produk" min="1" value="{{ old('jumlah_produk', 1) }}" required/>
                                                @error('jumlah_produk')
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
                                                <label for="custom"><b>Custom Notes</b></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input id="custom" name="custom" type="hidden" value="{{ old('custom') }}">
                                                <trix-editor input="custom"></trix-editor>
                                                <p>* jika tidak ada custom maka biarkan kosong</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label for="file_cetak"><b>File yang akan dicetak</b></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control @error('file_cetak') is-invalid @enderror" id="file_cetak" name="file_cetak" required value="{{ old('file_cetak') }}"/>
                                                @error('file_cetak')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="jumlah_produk"><b>Jumlah Produk</b></label>
                                                <input type="number" class="form-control @error('jumlah_produk') is-invalid @enderror" id="jumlah_produk" name="jumlah_produk" min="1" value="{{ old('jumlah_produk', 1) }}" required/>
                                                @error('jumlah_produk')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="custom"><b>Custom Notes</b></label>
                                                <input id="custom" name="custom" type="hidden" value="{{ old('custom') }}">
                                                <trix-editor input="custom"></trix-editor>
                                            </div>
                                            <div class="form-group">
                                                <label for="file_cetak"><b>File yang akan dicetak</b></label>
                                                <input type="file" class="form-control @error('file_cetak') is-invalid @enderror" id="file_cetak" name="file_cetak" required value="{{ old('file_cetak') }}"/>
                                                @error('file_cetak')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            {{-- <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="card-title">Keterangan Produk</h5>
                                </div>
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body" id="keterangan">
                                            <p>Keterangan produk akan ditampilkan pada bagian ini</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="sub_total" style="font-size: 15px;">Sub Total</label>
                                </div>
                                <div class="col-sm-3" id="sub_total">
                                    <label for="sub_total" style="font-size: 15px;">Rp {{ number_format(0, 2) }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="diskon" style="font-size: 15px;">Diskon</label>
                                </div>
                                <div class="col-sm-3" id="diskon">
                                    <label for="diskon" style="font-size: 15px;">0%</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <b><label for="total" style="font-size: 20px;">Total</label></b>
                                </div>
                                <div class="col-sm-3" id="total">
                                    <b><label for="total" style="font-size: 20px;">Rp {{ number_format(0, 2) }}</label></b>
                                </div>
                            </div>
                            <br> --}}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-primary">
                                            Add to cart
                                        </button>
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
            $('#kategori_dropdown').select2();
            $('#warna_dropdown').select2();
            // $('#produk_dropdown').select2();
            // $('#jenis_bahan_dropdown').select2();
            // $('#ukuran_dropdown').select2();
            // $('#finishing_dropdown').select2();

            // $('#produk_dropdown').change(function () {
            //     var nama_produk = $('#produk_dropdown').val();
            //     $("#jenis_bahan_dropdown").html('');
            //     $("#ukuran_dropdown").html('');
            //     $("#finishing_dropdown").html('');
            //     $.ajax({
            //         url: "{{url('/api/fetch-kertas')}}",
            //         type: 'POST',
            //         data: {
            //                 nama_produk:nama_produk,
            //                 _token:'{{ csrf_token() }}'
            //         },
            //         dataType: 'json',
            //         success: function (result) {
            //             $('#jenis_bahan_dropdown').html('<option selected="" disabled="" value="">-- Pilih Jenis Bahan --</option>');
            //             $.each(result.list_kertas, function (key, value) {
            //                 $("#jenis_bahan_dropdown").append('<option value="' + value.jenis_bahan + '">' + value.jenis_bahan + '</option>');
            //             });
            //             $('#ukuran_dropdown').html('<option selected="" disabled="" value="">-- Pilih Ukuran --</option>');
            //             $('#finishing_dropdown').html('<option selected="" disabled="" value="">-- Pilih Finishing --</option>');
            //         }
            //     });
            // });
            // $('#jenis_bahan_dropdown').change(function () {
            //     var nama_produk = $('#produk_dropdown').val();
            //     var jenis_bahan = $('#jenis_bahan_dropdown').val();
            //     $("#ukuran_dropdown").html('');
            //     $("#finishing_dropdown").html('');
            //     $.ajax({
            //         url: "{{url('/api/fetch-ukuran')}}",
            //         type: 'POST',
            //         data: {
            //                 nama_produk:nama_produk,
            //                 jenis_bahan:jenis_bahan,
            //                 _token:'{{ csrf_token() }}'
            //         },
            //         dataType: 'json',
            //         success: function (result) {
            //             $('#ukuran_dropdown').html('<option selected="" disabled="" value="">-- Pilih Ukuran --</option>');
            //             $.each(result.list_ukuran, function (key, value) {
            //                 $("#ukuran_dropdown").append('<option value="' + value.ukuran + '">' + value.ukuran + '</option>');
            //             });
            //             $('#finishing_dropdown').html('<option selected="" disabled="" value="">-- Pilih Finishing --</option>');
            //         }
            //     });
            // });
            // $('#ukuran_dropdown').change(function () {
            //     var nama_produk = $('#produk_dropdown').val();
            //     var jenis_bahan = $('#jenis_bahan_dropdown').val();
            //     var ukuran = $('#ukuran_dropdown').val();
            //     $("#finishing_dropdown").html('');
            //     $.ajax({
            //         url: "{{url('/api/fetch-finishing')}}",
            //         type: 'POST',
            //         data: {
            //                 nama_produk:nama_produk,
            //                 jenis_bahan:jenis_bahan,
            //                 ukuran:ukuran,
            //                 _token:'{{ csrf_token() }}'
            //         },
            //         dataType: 'json',
            //         success: function (result) {
            //             $('#finishing_dropdown').html('<option selected="" disabled="" value="">-- Pilih Finishing --</option>');
            //             $.each(result.list_finishing, function (key, value) {
            //                 $("#finishing_dropdown").append('<option value="' + value.finishing_id + '">' + value.jenis_finishing +'</option>');
            //             });
            //         }
            //     });
            // });
            // $('#finishing_dropdown').change(function () {
            //     var nama_produk = $('#produk_dropdown').val();
            //     var jenis_bahan = $('#jenis_bahan_dropdown').val();
            //     var ukuran = $('#ukuran_dropdown').val();
            //     var finishing_id = $('#finishing_dropdown').val();
            //     var jumlah_produk = $('#jumlah_produk').val();
            //     var harga_finishing = 0;
            //     var sub_total = 0;
            //     var total = 0;
            //     if(nama_produk != null && jenis_bahan != null && ukuran != null && finishing_id != null && jumlah_produk > 0) {
            //         $("#keterangan").html('');
            //         $("#harga").html('');
            //         $("#sub_total").html('');
            //         $("#diskon").html('');
            //         $("#total").html('');
            //         $.ajax({
            //             url: "{{url('/api/fetch-detail')}}",
            //             type: 'POST',
            //             data: {
            //                     nama_produk:nama_produk,
            //                     jenis_bahan:jenis_bahan,
            //                     ukuran:ukuran,
            //                     finishing_id:finishing_id,
            //                     _token:'{{ csrf_token() }}'
            //             },
            //             dataType: 'json',
            //             success: function (result) {
            //                 if(result.status_finishing == 0) {
            //                     harga_finishing = parseInt(result.finishing_harga)
            //                 }
            //                 else {
            //                     harga_finishing = parseInt(result.finishing_harga*jumlah_produk)
            //                 }
            //                 sub_total = parseInt(result.harga*jumlah_produk+harga_finishing);
            //                 total = parseInt((result.harga*jumlah_produk+harga_finishing)*(1-(result.diskon/100)));
            //                 $('#keterangan').html(result.keterangan);
            //                 $('#harga').html('<b><label for="harga" style="font-size: 20px;">'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(parseInt(result.harga+result.finishing_harga))+'</label></b>');
            //                 $('#sub_total').html('<label for="sub_total" style="font-size: 15px;">'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(sub_total)+'</label>');
            //                 $('#diskon').html('<label for="diskon" style="font-size: 15px;">'+result.diskon+'%</label>');
            //                 $('#total').html('<b><label for="total" style="font-size: 20px;">'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(total)+'</label></b>');
            //             }
            //         });
            //     }
            // });
            // $('#jumlah_produk').change(function () {
            //     var nama_produk = $('#produk_dropdown').val();
            //     var jenis_bahan = $('#jenis_bahan_dropdown').val();
            //     var ukuran = $('#ukuran_dropdown').val();
            //     var finishing_id = $('#finishing_dropdown').val();
            //     var jumlah_produk = $('#jumlah_produk').val();
            //     var harga_finishing = 0;
            //     var sub_total = 0;
            //     var total = 0;
            //     if(nama_produk != null && jenis_bahan != null && ukuran != null && finishing_id != null && jumlah_produk > 0) {
            //         $("#keterangan").html('');
            //         $("#harga").html('');
            //         $("#sub_total").html('');
            //         $("#diskon").html('');
            //         $("#total").html('');
            //         $.ajax({
            //             url: "{{url('/api/fetch-detail')}}",
            //             type: 'POST',
            //             data: {
            //                     nama_produk:nama_produk,
            //                     jenis_bahan:jenis_bahan,
            //                     ukuran:ukuran,
            //                     finishing_id:finishing_id,
            //                     _token:'{{ csrf_token() }}'
            //             },
            //             dataType: 'json',
            //             success: function (result) {
            //                 if(result.status_finishing == 0) {
            //                     harga_finishing = parseInt(result.finishing_harga)
            //                 }
            //                 else {
            //                     harga_finishing = parseInt(result.finishing_harga*jumlah_produk)
            //                 }
            //                 sub_total = parseInt(result.harga*jumlah_produk+harga_finishing);
            //                 total = parseInt((result.harga*jumlah_produk+harga_finishing)*(1-(result.diskon/100)));
            //                 $('#keterangan').html('<p>'+result.keterangan+'</p>');
            //                 $('#harga').html('<b><label for="harga" style="font-size: 20px;">'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(parseInt(result.harga+result.finishing_harga))+'</label></b>');
            //                 $('#sub_total').html('<label for="sub_total" style="font-size: 15px;">'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(sub_total)+'</label>');
            //                 $('#diskon').html('<label for="diskon" style="font-size: 15px;">'+result.diskon+'%</label>');
            //                 $('#total').html('<b><label for="total" style="font-size: 20px;">'+Intl.NumberFormat('en-EN', { style: 'currency', currency: 'IDR', currencyDisplay: "narrowSymbol", }).format(total)+'</label></b>');
            //             }
            //         });
            //     }
            // });

            $('#kategori_dropdown').change(function () {
                var kategori_id = $('#kategori_dropdown').val();
                $("#gambar_kategori").html('');
                $.ajax({
                    url: "{{url('/api/fetch-gambar-kategori')}}",
                    type: 'POST',
                    data: {
                            kategori_id:kategori_id,
                            _token:'{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        // console.log(JSON.parse(result));
                        // console.log(jQuery.isEmptyObject(result));
                        if (jQuery.isEmptyObject(result)) {
                            $('#gambar_kategori').html(`<img class="card-img-top" src="{{ asset('/storage/kategori/null.jpg') }}" style="height: 200px;" alt="Card image cap">`);
                        }
                        else {
                            $('#gambar_kategori').html(`<img class="card-img-top" src="{{ asset('/storage/`+result+`') }}" style="height: 200px;" alt="Card image cap">`);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
