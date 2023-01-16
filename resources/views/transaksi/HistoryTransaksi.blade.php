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
                        <h4 class="card-title">History Transaksi</h4>
                    </div>
                    {{-- <a href="{{ url('po-botol/history') }}" class="btn btn-warning " id="button-add" style="background:orange">
                        <i class="mdi mdi-history" ></i>
                    </a> --}}
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('transaksi') }}'" style="margin-right: 10px;">
                        Back
                    </button>
                </div>
                <hr style="height: 10px;">
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
                        @foreach ($history_transaksi as $transaksi)
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
                            </td>
                            <td>
                                <div class="d-inline">
                                    <a href="{{ url('/transaksi/'.$transaksi->id) }}" class="btn btn-success btn-sm">
                                        <span class="material-icons align-middle">
                                            visibility
                                        </span>
                                    </a>
                                    @if($transaksi->status_pengerjaan == "Selesai")
                                    <a href="{{ url('/transaksi/'.$transaksi->id.'/nota') }}" class="btn btn-primary btn-sm">
                                        <span class="material-icons align-middle">
                                            description
                                        </span>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> 
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
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
