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
        @include('partials.navbar')
        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Detail Produk Penawaran</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('penawaran/'.$penawaran->id) }}'" style="margin-right: 10px;">
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
                    @elseif(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <!--Card-->
                    <div id="detail">
                        <form action="{{ url('penawaran/'.$penawaran->id.'/'.$detail_penawaran->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="id_penawaran">ID Penawaran</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="id_penawaran">{{ $detail_penawaran->penawaran->id_penawaran }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="cabang_id">Cabang</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="cabang_id">{{ $detail_penawaran->penawaran->cabang->alamat }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="tanggal_penawaran">Tanggal Penawaran</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="tanggal_penawaran">{{ date('d F Y H:i:s', strtotime($detail_penawaran->penawaran->tanggal_penawaran)) }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="status_penawaran">Status Penawaran</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <label id="status_penawaran">{{ $detail_penawaran->penawaran->status_penawaran }}</label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Detail Produk</h4>
                                </div>
                            </div>
                            <hr style="height: 10px;">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="kategori_id">Kategori</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="kategori_id">{{ $detail_penawaran->kategori->nama_kategori }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="jenis_bahan_input">Jenis Bahan</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="jenis_bahan_input">{{ $detail_penawaran->jenis_bahan_input }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="ukuran_input">Ukuran</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="ukuran_input">{{ $detail_penawaran->ukuran_input }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="finishing_input">Finishing</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="finishing_input">{{ $detail_penawaran->finishing_input }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="warna_input">Status Warna</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="warna_input">{{ $detail_penawaran->warna_input }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="jumlah_produk_label">Jumlah Produk</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label id="jumlah_produk_label">{{ $detail_penawaran->jumlah_produk }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" hidden>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="jumlah_produk">Jumlah Produk Input</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" id="jumlah_produk" name="jumlah_produk" value="{{ $detail_penawaran->jumlah_produk }}" readonly required/>
                                        <input type="text" class="form-control" id="detail_penawaran_id" name="detail_penawaran_id" value="{{ $detail_penawaran->id }}" readonly required/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="custom">Custom Notes</label>
                                    </div>
                                    <div class="col-sm-3">
                                        @isset ($detail_penawaran->custom)
                                        <label id="custom">{{ $detail_penawaran->custom }}</label>
                                        @else
                                        <label id="custom">None</label>
                                        @endisset
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label style="color: black; font-weight: bold;" for="file_cetak">File Cetak</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" onclick="location.href='{{ url('file-penawaran/'.$detail_penawaran->id) }}'" class="btn btn-primary btn-sm"><span class="material-icons align-middle">description</span> Download</button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Data Master Produk</h4>
                                </div>
                            </div>
                            <hr style="height: 10px;">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="produk_dropdown"><b>Nama Produk</b></label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="produk_dropdown" name="nama_produk" required>
                                            <option selected="" disabled="" value="">
                                                -- Pilih Produk --
                                            </option>
                                            @foreach ($list_produk as $produk)
                                                <option value="{{ $produk->nama_produk }}">{{ $produk->nama_produk }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="jenis_bahan_input"><b>Jenis Bahan</b></label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="jenis_bahan_dropdown" name="jenis_bahan" autofocus required>
                                            <option selected="" disabled="">
                                                -- Pilih Jenis Bahan --
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="ukuran_input"><b>Ukuran</b></label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="ukuran_dropdown" name="ukuran" autofocus required>
                                            <option selected="" disabled="">
                                                -- Pilih Ukuran --
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="finishing_input"><b>Finishing</b></label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="finishing_dropdown" name="finishing_id" autofocus required>
                                            <option selected="" disabled="">
                                                -- Pilih Finishing --
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="persen_cmyk"><b>CMYK (%)</b></label>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label for="persen_cyan"><b>Cyan (%)</b></label>
                                                <input type="number" class="form-control" min="0" id="persen_cyan" name="persen_cyan" required/>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="persen_magenta"><b>Magenta (%)</b></label>
                                                <input type="number" class="form-control" min="0" id="persen_magenta" name="persen_magenta" required/>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="persen_yellow"><b>Yellow (%)</b></label>
                                                <input type="number" class="form-control" min="0" id="persen_yellow" name="persen_yellow" required/>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="persen_black"><b>Black (%)</b></label>
                                                <input type="number" class="form-control" min="0" id="persen_black" name="persen_black" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="harga_custom"><b>Harga Custom</b></label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" min="0" id="harga_custom" name="harga_custom" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" hidden>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="hidden"><b>Hidden</b></label>
                                    </div>
                                    <div class="col-sm-10" id="input_field">
                                        <input type="text" class="form-control" id="detail_produk_id" name="detail_produk_id" required/>
                                        <input type="number" class="form-control" id="harga" name="harga" required/>
                                        <input type="number" class="form-control" id="harga_finishing" name="harga_finishing" required/>
                                        <input type="number" class="form-control" id="diskon" name="diskon" required/>
                                        <input type="number" class="form-control" id="sub_total_produk" name="sub_total_produk" required/>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
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
            $('#produk_dropdown').select2();
            $('#jenis_bahan_dropdown').select2();
            $('#ukuran_dropdown').select2();
            $('#finishing_dropdown').select2();

            $('#produk_dropdown').change(function () {
                var nama_produk = $('#produk_dropdown').val();
                $("#jenis_bahan_dropdown").html('');
                $("#ukuran_dropdown").html('');
                $("#finishing_dropdown").html('');
                $.ajax({
                    url: "{{url('/api/fetch-kertas')}}",
                    type: 'POST',
                    data: {
                            nama_produk:nama_produk,
                            _token:'{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#jenis_bahan_dropdown').html('<option selected="" disabled="" value="">-- Pilih Jenis Bahan --</option>');
                        $.each(result.list_kertas, function (key, value) {
                            $("#jenis_bahan_dropdown").append('<option value="' + value.jenis_bahan + '">' + value.jenis_bahan + '</option>');
                        });
                        $('#ukuran_dropdown').html('<option selected="" disabled="" value="">-- Pilih Ukuran --</option>');
                        $('#finishing_dropdown').html('<option selected="" disabled="" value="">-- Pilih Finishing --</option>');
                    }
                });
            });
            $('#jenis_bahan_dropdown').change(function () {
                var nama_produk = $('#produk_dropdown').val();
                var jenis_bahan = $('#jenis_bahan_dropdown').val();
                $("#ukuran_dropdown").html('');
                $("#finishing_dropdown").html('');
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
                        $('#ukuran_dropdown').html('<option selected="" disabled="" value="">-- Pilih Ukuran --</option>');
                        $.each(result.list_ukuran, function (key, value) {
                            $("#ukuran_dropdown").append('<option value="' + value.ukuran + '">' + value.ukuran + '</option>');
                        });
                        $('#finishing_dropdown').html('<option selected="" disabled="" value="">-- Pilih Finishing --</option>');
                    }
                });
            });
            $('#ukuran_dropdown').change(function () {
                var nama_produk = $('#produk_dropdown').val();
                var jenis_bahan = $('#jenis_bahan_dropdown').val();
                var ukuran = $('#ukuran_dropdown').val();
                $("#finishing_dropdown").html('');
                $.ajax({
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
                        $('#finishing_dropdown').html('<option selected="" disabled="" value="">-- Pilih Finishing --</option>');
                        $.each(result.list_finishing, function (key, value) {
                            $("#finishing_dropdown").append('<option value="' + value.finishing_id + '">' + value.jenis_finishing +'</option>');
                        });
                    }
                });
            });
            $('#finishing_dropdown').change(function () {
                var nama_produk = $('#produk_dropdown').val();
                var jenis_bahan = $('#jenis_bahan_dropdown').val();
                var ukuran = $('#ukuran_dropdown').val();
                var finishing_id = $('#finishing_dropdown').val();
                var jumlah_produk = $('#jumlah_produk').val();
                var harga_finishing = 0;
                var sub_total = 0;
                if(nama_produk != null && jenis_bahan != null && ukuran != null && finishing_id != null && jumlah_produk > 0) {
                    $("#input_field").html('');
                    $.ajax({
                        url: "{{url('/api/fetch-detail')}}",
                        type: 'POST',
                        data: {
                                nama_produk:nama_produk,
                                jenis_bahan:jenis_bahan,
                                ukuran:ukuran,
                                finishing_id:finishing_id,
                                _token:'{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function (result) {
                            if(result.status_finishing == 0) {
                                harga_finishing = parseInt(result.finishing_harga)
                            }
                            else {
                                harga_finishing = parseInt(result.finishing_harga*jumlah_produk)
                            }
                            sub_total_produk = parseInt((result.harga*jumlah_produk+harga_finishing)*(1-(result.diskon/100)));
                            $('#input_field').html('<input type="text" class="form-control" id="detail_produk_id" name="detail_produk_id" required value="'+result.id+'"/>\
                                                    <input type="number" class="form-control" id="harga" name="harga" required value="'+result.harga+'"/>\
                                                    <input type="number" class="form-control" id="harga_finishing" name="harga_finishing" required value="'+harga_finishing+'"/>\
                                                    <input type="number" class="form-control" id="diskon" name="diskon" required value="'+result.diskon+'"/>\
                                                    <input type="number" class="form-control" id="sub_total_produk" name="sub_total_produk" required value="'+sub_total_produk+'"/>');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
