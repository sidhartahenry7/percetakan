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
            background-color: #0b2357;
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
                        <h4 class="card-title">Add Bahan Baku</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-bahan-baku') }}'" style="margin-right: 10px;">
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
                    <form action="/bahan-baku" method="post">
                        @csrf
                        <div class="form-group">
                            <label style="color: black; font-weight: bold;" for="text">ID Produk</label>
                            <input type="text" readonly="readonly" class="form-control @error('id_produk') is-invalid @enderror" id="id_produk" name="id_produk" required autofocus value="{{ $idproduk }}"/>
                            @error('id_produk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="text">Jenis Bahan</label>
                            <input type="text" class="form-control @error('jenis_kertas') is-invalid @enderror" id="jenis_kertas" name="jenis_kertas" required value="{{ old('jenis_kertas') }}"/>
                            @error('jenis_kertas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="status_ukuran" onclick="ubahUkuran()"> ukuran panjang x lebar
                        </div>
                        <div class="form-group" id="ukuran_field">
                            <label for="text">Ukuran</label>
                            <input type="text" class="form-control" id="ukuran" name="ukuran" value="{{ old('ukuran') }}"/>
                        </div>
                        <div class="form-group" id="ukuran_field_panjang_lebar_satuan">
                            
                        </div>
                        {{-- <button type="cancel" class="btn btn-danger">
                            Cancel
                        </button> --}}
                        <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-bahan-baku') }}'">
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

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        function ubahUkuran() {
            $("#ukuran_field").html('');
            $("#ukuran_field_panjang_lebar_satuan").html('');
            var checkBox = document.getElementById("status_ukuran");
            if (checkBox.checked == true) {
                $("#ukuran_field").html('');
                $("#ukuran_field_panjang_lebar_satuan").append('<div class="row">\
                                                                    <div class="col-4"><label for="text">Lebar</label>\
                                                                        <input type="number" class="form-control" id="lebar" name="lebar"/>\
                                                                    </div>\
                                                                    <div class="col-4"><label for="text">Panjang</label>\
                                                                        <input type="number" class="form-control" id="panjang" name="panjang"/>\
                                                                    </div>\
                                                                    <div class="col-4"><label for="text">Satuan</label>\
                                                                        <select class="form-control" id="satuan" name="satuan">\
                                                                            <option value="meter">meter</option>\
                                                                            <option value="cm">cm</option>\
                                                                        </select>\
                                                                    </div>\
                                                                </div>');
            }
            else {
                $("#ukuran_field").append('<label for="text">Ukuran</label>\
                                           <input type="text" class="form-control" id="ukuran" name="ukuran"/>');
            }
        }
    </script>
</body>
</html>
