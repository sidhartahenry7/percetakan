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
                        <h4 class="card-title">Daftar Transaksi</h4>
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
                    <!--Table-->
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless" id="dtBasicExample">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Cabang</th>
                                    <th>Jumlah Item</th>
                                    <th>Sub Total</th>
                                    <th>Promo</th>
                                    <th>Total</th>
                                    {{-- <th>Status Transaksi</th> --}}
                                    <th>Status Pengerjaan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($list_transaksi as $transaksi)
                                <tr>
                                    <td>{{ $transaksi->id_transaksi }}</td>
                                    <td>{{ date('d M Y H:i:s', strtotime($transaksi->antrian->tanggal_antrian)) }}</td>
                                    <td>{{ $transaksi->antrian->cabang->alamat }}</td>
                                    <td>{{ $transaksi->jumlah_total_item }}</td>
                                    <td>Rp {{ number_format($transaksi->sub_total_transaksi, 2) }}</td>
                                    @isset ($transaksi->promo_id)
                                    <td>{{ $transaksi->promo->potongan }}%</td>
                                    @else
                                    <td>0%</td>
                                    @endisset
                                    <td>Rp {{ number_format($transaksi->total, 2) }}</td>
                                    {{-- <td>{{ $transaksi->status_transaksi }}</td> --}}
                                    <td>{{ $transaksi->status_pengerjaan }}</td>
                                    <td><button type="button" class="btn btn-primary btn-sm" onclick="location.href='{{ url('transaksi/'.$transaksi->id) }}'"><span class="material-icons align-middle">visibility</span></button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
    <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
</body>
</html>
