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
                        <h4 class="card-title">Transaksi</h4>
                    </div>
                    <button type="button" class="btn btn-success" onclick="location.href='{{ url('history-transaksi') }}'" style="margin-right: 10px;">
                        <span class="material-icons align-middle">
                            browse_gallery
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
                    @endif
                    <form action="/transaksi" method="post">
                        @csrf
                        {{-- <div class="form-group">
                            <label style="color: black; font-weight: bold;" for="text">ID Transaksi</label>
                            <input type="text" readonly="readonly" class="form-control @error('id_transaksi') is-invalid @enderror" id="id_transaksi" name="id_transaksi" required value="{{ $idtransaksi }}"/>
                            @error('id_transaksi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label style="color: black; font-weight: bold;" for="text">ID Transaksi</label>
                                        <input type="text" readonly="readonly" class="form-control @error('id_transaksi') is-invalid @enderror" id="id_transaksi" name="id_transaksi" required value="{{ $idtransaksi }}"/>
                                        @error('id_transaksi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label style="color: black; font-weight: bold;" for="text">ID Antrian</label>
                                        <select class="form-control @error('antrian_id') is-invalid @enderror" id="antrian_id" name="antrian_id" required>
                                            <option selected="" disabled="">
                                                -- Pilih Antrian --
                                            </option>
                                            @foreach ($list_antrian as $antrian)
                                                @if(old('antrian_id') == $antrian->id)
                                                    <option value="{{ $antrian->id }}" selected>{{ $antrian->id_antrian }}</option>
                                                @else
                                                    <option value="{{ $antrian->id }}">{{ $antrian->id_antrian }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <button type="button" class="btn btn-danger">
                            Cancel
                        </button> --}}
                        <button type="submit" class="btn" style="background-color: #29a4da; color: white;">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
            <br>
            <!--Tabel-->
            <div class="table-responsive container">
                <table class="table table-striped table-borderless" id="dtBasicExample">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Transaksi</th>
                            <th>ID Antrian</th>
                            <th>Jumlah Total Item</th>
                            <th>Sub Total Transaksi</th>
                            <th>Promo</th>
                            <th>Total</th>
                            <th>Status Pengerjaan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($list_transaksi as $transaksi)
                        <tr>
                            <td>{{ $transaksi->id_transaksi }}</td>
                            <td>{{ $transaksi->antrian->id_antrian }}</td>
                            <td>{{ $transaksi->jumlah_total_item }}</td>
                            <td>Rp {{ number_format($transaksi->sub_total_transaksi, 2) }}</td>
                            <td>
                                @if(is_null($transaksi->promo_id))
                                    {{ $transaksi->promo_id }}
                                @else
                                    {{ $transaksi->promo->id_promo }}
                                @endif
                            </td>
                            <td>Rp {{ number_format($transaksi->total, 2) }}</td>
                            <td>
                                {{ $transaksi->status_pengerjaan }}
                                @if($transaksi->status_pengerjaan != "Selesai")
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalEditStatus{{ $transaksi->id }}" style="height: 35px; font-size: small; padding: 5px; margin-left: 5px;">Update</button>
                                @endif
                            </td>
                            <td>
                                <div class="d-inline">
                                    <a href="{{ url('/transaksi/'.$transaksi->id) }}" class="btn btn-success btn-sm">
                                        <span class="material-icons align-middle">
                                            visibility
                                        </span>
                                    </a>
                                    @if($transaksi->status_pengerjaan != "Selesai")
                                    <a href="{{ url('/transaksi/'.$transaksi->id.'/edit') }}" class="btn btn-warning btn-sm">
                                        {{-- <i class="mdi mdi-history"></i> --}}
                                        <span class="material-icons align-middle">
                                            edit
                                        </span>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- Modal Edit Status -->
                @foreach ($list_transaksi as $t)
                    <div class="modal fade" id="modalEditStatus{{$t->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Status Pengerjaan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="/transaksi/edit" class="d-inline">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="statusPengerjaan">Status Pengerjaan</label>
                                            <input hidden type="text" readonly="readonly" class="form-control" id="id" name="id" value="{{ $t->id }}"/>
                                            <br>
                                            <div class="form-group">
                                                <select class="form-control @error('status_pengerjaan') is-invalid @enderror" id="status_pengerjaan" name="status_pengerjaan" required>
                                                    {{-- <option selected="" disabled="">
                                                        -- Pilih Status --
                                                    </option> --}}
                                                    @foreach ($list_status as $status)
                                                        @if(old('status_pengerjaan', $t->status_pengerjaan) == $status)
                                                            <option value="{{ $status }}" selected>{{ $status }}</option>
                                                        @else
                                                            <option value="{{ $status }}">{{ $status }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info">Confirm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#antrian_id').select2();
        });
    </script>

    {{-- <script>
        $(document).ready(function () {
            $('#dtHorizontalVerticalExample').DataTable({
                "scrollX": true,
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script> --}}
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
</body>
</html>
