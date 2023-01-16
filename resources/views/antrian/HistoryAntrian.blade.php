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
                        <h4 class="card-title">History Antrian</h4>
                    </div>
                    {{-- <a href="{{ url('po-botol/history') }}" class="btn btn-warning " id="button-add" style="background:orange">
                        <i class="mdi mdi-history" ></i>
                    </a> --}}
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-antrian') }}'" style="margin-right: 10px;">
                        Back
                    </button>
                </div>
                <hr style="height: 10px;">
            </div>
            <br>
            <!--Tabel-->
            <div class="table-responsive">
                <table class="table table-striped table-borderless" id="dtBasicExample">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Antrian</th>
                            <th>Cabang</th>
                            <th>Tanggal Antrian</th>
                            <th>Nomor Antrian</th>
                            <th>Nama Pelanggan</th>
                            <th>Nomor Handphone Pelanggan</th>
                            {{-- <th>Pemesanan VIA</th>
                            <th>Bukti</th>
                            <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($history_antrian as $antrian)
                        <tr>
                            <td>{{ $antrian->id_antrian }}</td>
                            <td>{{ $antrian->cabang->nama_cabang }}</td>
                            <td>{{ date('d-m-Y', strtotime($antrian->tanggal_antrian)) }}</td>
                            <td>{{ $antrian->nomor_antrian }}</td>
                            <td>{{ $antrian->pelanggan->nama_pelanggan }}</td>
                            <td>{{ $antrian->pelanggan->nomor_handphone }}</td>
                            {{-- <td>{{ $antrian->pemesanan_via }}</td>
                            <td>{{ $antrian->bukti_pembayaran }}</td> --}}
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
