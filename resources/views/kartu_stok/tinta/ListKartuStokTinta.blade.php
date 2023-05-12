@include('layouts.main')
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid black;
            text-align: left;
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
                        <h4 class="card-title">Kartu Stok Tinta</h4>
                    </div>
                    <div class="d-inline">
                        @if(auth()->user()->user_role == "Admin")
                        <button type="button" class="btn btn-success" onclick="location.href='{{ url('add-stok-awal-tinta') }}'" style="margin-right: 10px;">
                            <span class="material-icons align-middle">add</span>
                        </button>
                        @endif
                        @if(auth()->user()->user_role == "Admin" || auth()->user()->user_role == "Kepala Toko" || auth()->user()->user_role == "Wakil Kepala Toko")
                        <button type="button" class="btn btn-primary" onclick="location.href='{{ url('stok-opname-tinta') }}'" style="margin-right: 10px;">
                            Stok Opname
                        </button>
                        @endif
                    </div>
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
                </div>
            </div>
            <!--Tabel-->
            <div class="form-group container">
                <div class="row">
                    <div class="col-sm-1">
                        <label id="date-label-from" class="date-label">From: </label>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" id="min" name="min" class="form-control"/>
                    </div>
                    <div class="col-sm-1">
                        <label id="date-label-to" class="date-label">To: </label>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" id="max" name="max" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="form-group container">
                <div class="row">
                    <div class="col-sm-1">
                        <label id="tinta_dropdown-label">Tinta:</label>
                    </div>
                    <div class="col-sm-2">
                        <select id="tinta_dropdown" class="form-control">
                            <option selected="" value="All">All</option>
                            @foreach ($list_tinta as $detail)
                               <option value="{{ $detail->tinta->jenis_tinta. ' ' .$detail->warna }}">{{ $detail->tinta->jenis_tinta. ' ' .$detail->warna }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <label id="cabang_dropdown-label">Cabang: </label>
                    </div>
                    <div class="col-sm-2">
                        <select id="cabang_dropdown" class="form-control">
                            @if(auth()->user()->user_role == 'Admin')
                            <option selected="" value="All">All</option>
                            @foreach ($list_cabang as $cabang)
                                <option value="{{ $cabang->nama_cabang }}">{{ $cabang->nama_cabang }}</option>
                            @endforeach
                            @else
                            <option value="{{ auth()->user()->cabang->nama_cabang }}">{{ auth()->user()->cabang->nama_cabang }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <label id="transaksi_dropdown-label">Transaksi: </label>
                    </div>
                    <div class="col-sm-2">
                        <select id="transaksi_dropdown" class="form-control">
                            <option selected="" value="All">All</option>
                            @foreach ($list_transaksi as $transaksi)
                                <option value="{{ $transaksi->id_transaksi }}">{{ $transaksi->id_transaksi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-responsive container">
                <table class="table table-striped table-borderless" id="dtBasicExample">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>Cabang</th>
                            <th>ID Transaksi</th>
                            <th>Jenis Tinta</th>
                            <th>Qty Masuk</th>
                            <th>Qty Keluar</th>
                            <th>Qty Sekarang</th>
                            <th>Harga Beli / mL</th>
                            {{-- <th>Harga Beli Rata-Rata / mL</th> --}}
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($kartu_stok as $stok)
                        <tr>
                            <td>{{ $stok->tanggal }}</td>
                            <td>{{ $stok->cabang->nama_cabang }}</td>
                            @isset ($stok->transaksi->id_transaksi)
                            <td>{{ $stok->transaksi->id_transaksi }}</td>
                            @else
                            <td>&nbsp;</td>
                            @endisset
                            <td>{{ $stok->detail_tinta->tinta->jenis_tinta. ' ' .$stok->detail_tinta->warna }}</td>
                            <td>{{ $stok->quantity_masuk." ".$stok->satuan }}</td>
                            <td>{{ $stok->quantity_keluar." ".$stok->satuan }}</td>
                            <td>{{ $stok->quantity_sekarang." ".$stok->satuan }}</td>
                            <td>Rp {{ number_format($stok->harga_beli, 2) }}</td>
                            {{-- <td>Rp {{ number_format($stok->harga_average, 2) }}</td> --}}
                            <td>{{ $stok->status }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var minDate, maxDate, input, input_transaksi;

        $(document).ready(function() {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
            $('#tinta_dropdown').select2();
            $('#cabang_dropdown').select2();
            $('#transaksi_dropdown').select2();

            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime($('#max'), {
                format: 'MMMM Do YYYY'
            });
            input = $('#tinta_dropdown');
            input_cabang = $('#cabang_dropdown');
            input_transaksi = $('#transaksi_dropdown');

            // Custom filtering function which will search data in column four between two values
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var min = minDate.val();
                    var max = maxDate.val();
                    var date = new Date( data[0] );
                    var tinta_input = input.val();
                    var cabang_input = input_cabang.val();
                    var transaksi_input = input_transaksi.val();
                    var tinta = data[3];
                    var cabang = data[1];
                    var transaksi = data[2];
            
                    if (tinta_input == "All") {
                        if (cabang_input == "All") {
                            if (transaksi_input == "All") {
                                if (
                                    ( min === null && max === null ) ||
                                    ( min === null && date <= max ) ||
                                    ( min <= date && max === null ) ||
                                    ( min <= date && date <= max )
                                ) {
                                    return true;
                                }
                                return false;
                            }
                            else {
                                if (
                                    (
                                        ( min === null && max === null ) ||
                                        ( min === null && date <= max ) ||
                                        ( min <= date && max === null ) ||
                                        ( min <= date && date <= max )
                                    ) && (transaksi == transaksi_input)
                                ) {
                                    return true;
                                }
                                return false;
                            }
                        }
                        else {
                            if (transaksi_input == "All") {
                                if (
                                    (
                                        ( min === null && max === null ) ||
                                        ( min === null && date <= max ) ||
                                        ( min <= date && max === null ) ||
                                        ( min <= date && date <= max )
                                    ) && (cabang == cabang_input)
                                ) {
                                    return true;
                                }
                                return false;
                            }
                            else {
                                if (
                                    (
                                        ( min === null && max === null ) ||
                                        ( min === null && date <= max ) ||
                                        ( min <= date && max === null ) ||
                                        ( min <= date && date <= max )
                                    ) && (transaksi == transaksi_input) && (cabang == cabang_input)
                                ) {
                                    return true;
                                }
                                return false;
                            }
                        }
                    }
                    else {
                        if (cabang_input == "All") {
                            if (transaksi_input == "All") {
                                if (
                                    (
                                        ( min === null && max === null ) ||
                                        ( min === null && date <= max ) ||
                                        ( min <= date && max === null ) ||
                                        ( min <= date && date <= max )
                                    ) && (tinta == tinta_input)
                                ) {
                                    return true;
                                }
                                return false;
                            }
                            else {
                                if (
                                    (
                                        ( min === null && max === null ) ||
                                        ( min === null && date <= max ) ||
                                        ( min <= date && max === null ) ||
                                        ( min <= date && date <= max )
                                    ) && (tinta == tinta_input) && (transaksi == transaksi_input)
                                ) {
                                    return true;
                                }
                                return false;
                            }
                        }
                        else {
                            if (transaksi_input == "All") {
                                if (
                                    (
                                        ( min === null && max === null ) ||
                                        ( min === null && date <= max ) ||
                                        ( min <= date && max === null ) ||
                                        ( min <= date && date <= max )
                                    ) && (tinta == tinta_input) && (cabang == cabang_input)
                                ) {
                                    return true;
                                }
                                return false;
                            }
                            else {
                                if (
                                    (
                                        ( min === null && max === null ) ||
                                        ( min === null && date <= max ) ||
                                        ( min <= date && max === null ) ||
                                        ( min <= date && date <= max )
                                    ) && (tinta == tinta_input) && (transaksi == transaksi_input) && (cabang == cabang_input)
                                ) {
                                    return true;
                                }
                                return false;
                            }
                        }
                    }
                }
            );

            // DataTables initialisation
            var table = $('#dtBasicExample').DataTable();

            // Refilter the table
            $('#min, #max, #tinta_dropdown, #cabang_dropdown, #transaksi_dropdown').on('change', function () {
                table.draw();
            });
        });
    </script>
</body>
</html>
