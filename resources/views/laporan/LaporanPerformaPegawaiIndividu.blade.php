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
                        <h4 class="card-title">Laporan Performa Pegawai</h4>
                    </div>
                </div>
                <hr style="height: 10px;">
            </div>
            <!--Content-->
            {{-- <div class="form-group">
                <div class="row">
                    <div class="col-sm-1">
                        <label id="date-label-from" class="date-label">From: </label>
                    </div>
                    <div class="col-sm-2">
                        <input type="date" id="min" name="min" class="form-control"/>
                    </div>
                    <div class="col-sm-1">
                        <label id="date-label-to" class="date-label">To: </label>
                    </div>
                    <div class="col-sm-2">
                        <input type="date" id="max" name="max" class="form-control"/>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn" style="background-color: #EC268F; color: white;" id="create">Create</button>
                    </div>
                </div>
            </div>
            <br> --}}
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-2">
                        <label style="color: black; font-weight: bold;" for="id_pegawai">ID Pegawai</label>
                    </div>
                    <div class="col-sm-2" id="id_pegawai">
                        <label style="color: black; font-weight: bold;" for="id_pegawai">: {{ auth()->user()->id_pegawai }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <label for="nama_pegawai">Nama Pegawai</label>
                    </div>
                    <div class="col-sm-2" id="nama_pegawai">
                        <label for="nama_pegawai">: {{ auth()->user()->nama_lengkap }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <label for="jumlah_transaksi">Jumlah Transaksi</label>
                    </div>
                    <div class="col-sm-2" id="jumlah_transaksi">
                        <label for="jumlah_transaksi">: {{ $jumlah_transaksi->jumlah }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <label for="jumlah_komplain">Jumlah Komplain</label>
                    </div>
                    <div class="col-sm-2" id="jumlah_komplain">
                        <label for="jumlah_komplain">: {{ $jumlah_komplain->jumlah }}</label>
                    </div>
                </div>
            </div>
            <div class="table-responsive container">
                <table class="table table-striped table-borderless" id="dtBasicExample">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tanggal Transaksi</th>
                            <th>ID Transaksi</th>
                            <th>ID Antrian</th>
                            <th>Detail Item Transaksi</th>
                            <th>Isi Komplain</th>
                            <th>Bukti Komplain</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($detail_komplain as $komplain)
                        <tr>
                            <td>{{ date('Y-m-d h:i:s', strtotime($komplain->detail_transaksi->transaksi->antrian->tanggal_antrian)) }}</td>
                            <td>{{ $komplain->detail_transaksi->transaksi->id_transaksi }}</td>
                            <td>{{ $komplain->detail_transaksi->transaksi->antrian->id_antrian }}</td>
                            <td>{{ $komplain->detail_transaksi->jenis_bahan_input.' '.$komplain->detail_transaksi->ukuran_input.' '.$komplain->detail_transaksi->finishing_input.' '.$komplain->detail_transaksi->warna_input }}</td>
                            <td>{{ $komplain->isi_komplain }}</td>
                            @isset ($komplain->bukti_komplain)
                            <td>
                                <div class="d-inline">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalViewBukti{{ $komplain->id }}">
                                        <span class="material-icons align-middle">visibility</span>
                                    </button>
                                    <button type="button" onclick="location.href='{{ url('bukti-komplain/'.$komplain->id) }}'" class="btn btn-sm" style="background-color: #29a4da; color:white;"><span class="material-icons align-middle">description</span></button>
                                </div>
                            </td>
                            @else
                            <td>&nbsp;</td>
                            @endisset
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- Modal View Bukti Pembayaran -->
                @foreach ($detail_komplain as $komplain)
                    <div class="modal fade" id="modalViewBukti{{$komplain->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Bukti Komplain</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <center>
                                            <img class="responsive" src="{{ asset('/storage/'.$komplain->bukti_komplain) }}" style="max-width: 400px; max-height: 550px;">
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <canvas id="myChart" style="width:100%;"></canvas>
        </div>
    </div>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-autocolors"></script>

    <script>
        $(document).ready(function() {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
</body>
</html>