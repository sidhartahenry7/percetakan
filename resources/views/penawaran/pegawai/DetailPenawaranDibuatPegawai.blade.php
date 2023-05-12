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
                        <h4 class="card-title">Detail Penawaran</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-penawaran') }}'" style="margin-right: 10px;">
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
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-0">
                        <ul class="navbar-nav nav-fill w-100">
                            <li class="nav-item">
                                <a class="nav-link" id="detail_penawaran" href="#">Detail Penawaran</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="history_status_penawaran" href="#">History Status Penawaran</a>
                            </li>
                        </ul>
                    </nav>
                    <div id="detail">
                        <form action="{{ url('penawaran/'.$penawaran->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <p class="card-text" style="color: black; font-size: 16px;"><b>ID Penawaran</b></p>
                                    </div>
                                    <div class="col-sm-10">
                                        <p class="card-text" style="color: black; font-size: 16px;"><b>{{ $penawaran->id_penawaran }}</b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <p class="card-text" style="color: black; font-size: 16px;">Cabang</p>
                                    </div>
                                    <div class="col-sm-10">
                                        <p class="card-text" style="color: black; font-size: 16px;">{{ $penawaran->cabang->alamat }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <p class="card-text" style="color: black; font-size: 16px;">Tanggal Penawaran</p>
                                    </div>
                                    <div class="col-sm-10">
                                        <p class="card-text" style="color: black; font-size: 16px;">{{ date('d F Y H:i:s', strtotime($penawaran->tanggal_penawaran)) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <p class="card-text" style="color: black; font-size: 16px;">Status Penawaran</p>
                                    </div>
                                    <div class="col-sm-10">
                                        <p class="card-text" style="color: black; font-size: 16px;">{{ $penawaran->status_penawaran }}</p>
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
                            <div class="table-responsive container">
                                <table class="table table-striped table-borderless" id="tabel">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID Produk</th>
                                            <th>Nama Poduk</th>
                                            <th>Jenis Bahan</th>
                                            <th>Ukuran</th>
                                            <th>Finishing</th>
                                            <th>Warna</th>
                                            <th>CMYK (%)</th>
                                            <th>Harga Produk</th>
                                            <th>Jumlah Produk</th>
                                            <th>Harga Finishing</th>
                                            <th>Diskon (%)</th>
                                            <th>Sub Total</th>
                                            <th>Harga Custom</th>
                                            <th>Total</th>
                                            <th>Custom Notes</th>
                                            <th>File Cetak</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 0;   
                                        @endphp
                                        @foreach ($detail_penawaran as $detail)
                                            <tr>
                                                <td>
                                                    @isset ($detail->detail_produk_id)
                                                    {{ $detail->detail_produk->id_detail_produk }}
                                                    @else
                                                    Belum diassign
                                                    @endisset
                                                </td>
                                                <td>
                                                    @isset ($detail->detail_produk_id)
                                                    {{ $detail->detail_produk->nama_produk }}
                                                    @else
                                                    Belum diassign
                                                    @endisset
                                                </td>
                                                <td>{{ $detail->jenis_bahan_input }}</td>
                                                <td>{{ $detail->ukuran_input }}</td>
                                                <td>{{ $detail->finishing_input }}</td>
                                                <td>{{ $detail->warna_input }}</td>
                                                <td>
                                                    <div class="row">
                                                        Cyan: {{ $detail->persen_cyan }}%
                                                    </div>
                                                    <div class="row">
                                                        Magenta: {{ $detail->persen_magenta }}%
                                                    </div>
                                                    <div class="row">
                                                        Yellow: {{ $detail->persen_yellow }}%
                                                    </div>
                                                    <div class="row">
                                                        Black: {{ $detail->persen_black }}%
                                                    </div>
                                                </td>
                                                <td>Rp {{ number_format($detail->harga, 2) }}</td>
                                                <td>{{ $detail->jumlah_produk }}</td>
                                                <td>Rp {{ number_format($detail->harga_finishing, 2) }}</td>
                                                <td>{{ $detail->diskon }}</td>
                                                <td>Rp {{ number_format((($detail->harga*$detail->jumlah_produk+$detail->harga_finishing)*(1-$detail->diskon/100)), 2) }}</td>
                                                <td>Rp {{ number_format($detail->harga_custom, 2) }}</td>
                                                <td id="label_sub_total">Rp {{ number_format($detail->sub_total, 2) }}</td>
                                                <td>
                                                    @isset ($detail->custom)
                                                    {!! $detail->custom !!}
                                                    @else
                                                    None
                                                    @endisset
                                                </td>
                                                <td><button type="button" onclick="location.href='{{ url('file-penawaran/'.$detail->id) }}'" class="btn btn-primary btn-sm"><span class="material-icons align-middle">description</span></button></td>
                                                <td>
                                                    @isset ($detail->detail_produk_id)
                                                    &nbsp;
                                                    @else
                                                    <div class="d-inline">
                                                        <label>Harap assign produk!</label>
                                                        <button type="button" onclick="location.href='{{ url('penawaran/'.$penawaran->id.'/'.$detail->id) }}'" style="background-color: #29a4da; color:white;" class="btn btn-sm"><span class="material-icons align-middle">edit</span></button>
                                                    </div>
                                                    @endisset
                                                </td>
                                            </tr>
                                            @isset ($detail->detail_produk_id)
                                                @php
                                                    $count++;  
                                                @endphp
                                            @endisset
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            @if ($count == $jumlah_item)
                            <button type="submit" class="btn btn-primary">Submit</button>
                            @endif
                        </form>
                    </div>
                    <div id="status">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless" id="dtBasicExample">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Tanggal / Waktu</th>
                                        <th>Status Penawaran</th>
                                        <th>Notes</th>
                                        <th>PIC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($list_status as $status)
                                    <tr>
                                        <td>{{ date('d F Y H:i:s', strtotime($status->tanggal_status)) }}</td>
                                        <td>{{ $status->status_penawaran }}</td>
                                        @isset($status->notes)
                                        <td>{{ $status->notes }}</td>
                                        @else
                                        <td>&nbsp;</td>
                                        @endisset
                                        @isset($status->pegawai_id)
                                        <td>{{ $status->pegawai->nama_lengkap }} ({{ $status->pegawai->user_role }})</td>
                                        @else
                                        <td>{{ $status->pelanggan->nama_pelanggan }} (Pelanggan)</td>
                                        @endisset
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
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
            $('#tabel').DataTable(
                {
                    'autowidth' : false,
                    'columnDefs' : [
                        // { 'visible': false, 'targets': [14,15] },
                        { 'width': '100%', 'targets': [1, 16] }
                    ]
                }
            );
            $('.dataTables_length').addClass('bs-select');

            $("#detail").show();
            $("#status").hide();

            $('#detail_penawaran').on('click', function () {
                $("#detail").show();
                $("#status").hide();
            });
            $('#history_status_penawaran').on('click', function () {
                $("#detail").hide();
                $("#status").show();
            });
        });
    </script>
</body>
</html>
