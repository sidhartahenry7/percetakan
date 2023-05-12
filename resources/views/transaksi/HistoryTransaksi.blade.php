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
                            <th>Status Transaksi</th>
                            <th>Bukti Pembayaran</th>
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
                                    0%
                                @else
                                    {{ $transaksi->promo->potongan }}%
                                @endif
                            </td>
                            <td>Rp {{ number_format($transaksi->total, 2) }}</td>
                            <td>
                                {{ $transaksi->status_pengerjaan }}
                            </td>
                            <td>{{ $transaksi->status_transaksi }}</td>
                            <td>
                                @isset($transaksi->bukti_pembayaran)
                                <div class="d-inline">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalViewBukti{{ $transaksi->id }}">
                                        <span class="material-icons align-middle">visibility</span>
                                    </button>
                                    <button type="button" onclick="location.href='{{ url('bukti-pembayaran-transaksi/'.$transaksi->id) }}'" class="btn btn-sm" style="background-color: #29a4da; color:white;"><span class="material-icons align-middle">description</span></button>
                                </div>
                                @else
                                &nbsp;
                                @endif
                            </td>
                            <td>
                                <div class="d-inline">
                                    <button type="button" onclick="location.href='{{ url('/transaksi/'.$transaksi->id) }}'" class="btn btn-success btn-sm"><span class="material-icons align-middle">visibility</span></button>
                                    @if($transaksi->status_pengerjaan == "Selesai")
                                    <button type="button" onclick="location.href='{{ url('/transaksi/'.$transaksi->id.'/nota') }}'" class="btn btn-primary btn-sm"><span class="material-icons align-middle">description</span></button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Modal View Bukti Pembayaran -->
                @foreach ($history_transaksi as $t)
                    <div class="modal fade" id="modalViewBukti{{$t->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <center>
                                            <img class="responsive" src="{{ asset('/storage/'.$t->bukti_pembayaran) }}" style="max-width: 400px; max-height: 550px;">
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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
    <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
</body>
</html>
