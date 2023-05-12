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
                        <h4 class="card-title">Stok Opname Tinta</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('kartu-stok-tinta') }}'" style="margin-right: 10px;">
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
                    <form action="{{ url('/stok-opname-tinta') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="text">Cabang</label>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control @error('cabang_id') is-invalid @enderror" id="cabang_id" name="cabang_id" required>
                                        @if(auth()->user()->user_role == "Admin")
                                        <option selected="" disabled="">
                                            -- Pilih Cabang --
                                        </option>
                                        @foreach ($list_cabang as $cabang)
                                            @if(old('cabang_id') == $cabang->id)
                                                <option value="{{ $cabang->id }}" selected>{{ $cabang->id_cabang }}  {{ $cabang->nama_cabang }}</option>
                                            @else
                                                <option value="{{ $cabang->id }}">{{ $cabang->id_cabang }}  {{ $cabang->nama_cabang }}</option>
                                            @endif
                                        @endforeach
                                        @else
                                            <option value="{{ auth()->user()->cabang_id }}" selected>{{ auth()->user()->cabang->id_cabang }}  {{ auth()->user()->cabang->nama_cabang }}</option>
                                        @endif
                                    </select>
                                    @error('cabang_id')
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
                                    <label for="date">Tanggal</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" readonly required value="{{ date('Y-m-d') }}"/>
                                    @error('tanggal')
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
                                    <label for="text">Jenis Tinta</label>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control" id="detail_tinta_id">
                                        <option selected="" disabled="">
                                            -- Pilih Jenis Tinta --
                                        </option>
                                        @foreach ($list_tinta as $detail)
                                            <option value="{{ $detail->id }}">{{ $detail->tinta->jenis_tinta . " " . $detail->warna }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="text">Quantity Sekarang</label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" id="quantity_sekarang" value="0"/>
                                </div>
                                <div class="col-sm-2" id="satuan-dropdown">
                                    <select class="form-control" id="satuan">
                                        <option value="ml">ml</option>
                                        <option value="liter">liter</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn" style="background-color: #EC268F; color: white;" onclick="tambahTinta()">Tambah</button>
                        <br><br>
                        <div class="table-responsive container">
                            <table class="table table-striped table-borderless" id="tabel_tinta">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Jenis Tinta</th>
                                        <th>Quantity Sekarang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_del_tinta">
                                    
                                </tbody> 
                            </table>
                        </div>
                        <br>
                        <button type="button" class="btn btn-danger" onclick="location.href='{{ url('kartu-stok-tinta') }}'">
                            Cancel
                        </button>
                        <button type="submit" class="btn" style="background-color: #29a4da; color: white;">
                            Submit
                        </button>
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
            $('#detail_tinta_id').select2();
            $('#cabang_id').select2();
        });
        function tambahTinta() {
            var detail_tinta_id = $('#detail_tinta_id').val();
            var quantity_sekarang = $('#quantity_sekarang').val();
            var satuan = $('#satuan').val();
            var table = document.getElementById("tabel_tinta");
            var count = 0;
            $.ajax({
                url: "{{url('/api/tambah-stok-tinta')}}",
                type: 'POST',
                data: {
                    detail_tinta_id:detail_tinta_id,
                    _token:'{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    for (var i = 1, row; row = table.rows[i]; i++) {
                        if ($(table.rows[i].cells[2]).html() == detail_tinta_id) {
                            count++;
                            alert('Tinta sudah terdapat pada tabel. Hapus terlebih dahulu jika ingin mengganti quantity!')
                            break;
                        }
                    }
                    if (count == 0) {
                        if (satuan == "liter") {
                            quantity_sekarang = parseFloat($('#quantity_sekarang').val())*1000;
                            satuan = "ml";
                        }
                        else {
                            quantity_sekarang = $('#quantity_sekarang').val();
                            satuan = "ml";
                        }
                        $('#table_del_tinta').append('<tr>\
                                                      <td>'+result.jenis_tinta+' '+result.warna+'</td>\
                                                      <td>'+quantity_sekarang+' '+satuan+'</td>\
                                                      <td hidden>'+result.id+'</td>\
                                                      <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteRowTinta(this)"><i class="fa fa-trash"></i></button></td>\
                                                      <td hidden><input type="hidden" name="detail_tinta_id[]" value="'+result.id+'"/></td>\
                                                      <td hidden><input type="hidden" name="quantity_sekarang[]" value="'+quantity_sekarang+'"/></td>\
                                                      <td hidden><input type="hidden" name="satuan[]" value="'+satuan+'"/></td>\
                                                      </tr>');
                    }
                }
            });
        }
        function deleteRowTinta(r) {
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("tabel_tinta").deleteRow(i);
        }
    </script>
</body>
</html>
