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
                        <h4 class="card-title">Detail Komplain</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-komplain') }}'" style="margin-right: 10px;">
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
                    <div class="form-group">
                        <div class="row justify-content-start">
                            <div class="col-2">
                                <label style="color: black; font-weight: bold;" for="text">ID Transaksi</label>
                            </div>
                            <div class="col">
                                <label style="color: black; font-weight: bold;" for="text">{{ $komplain->detail_transaksi->transaksi->id_transaksi }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-start align-self-center">
                            <div class="col-2">
                                <label style="color: black; font-weight: bold;" for="text">Nama Produk</label>
                            </div>
                            <div class="col">
                                <label style="color: black;" for="text">{{ $komplain->detail_transaksi->detail_produk->nama_produk }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-start align-self-center">
                            <div class="col-2">
                                <label style="color: black; font-weight: bold;" for="text">Custom Notes</label>
                            </div>
                            <div class="col">
                                @isset($komplain->detail_transaksi->custom)
                                <label style="color: black;" for="text">{{ $komplain->detail_transaksi->custom }}</label>
                                @else
                                <label style="color: black;" for="text">None</label>
                                @endisset
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-start align-self-center">
                            <div class="col-2">
                                <label style="color: black; font-weight: bold;" for="text">Isi Komplain</label>
                            </div>
                            <div class="col-2">
                                <label style="color: black;" for="text">{{ $komplain->isi_komplain }}</label>
                            </div>
                        </div>
                    </div>
                    @isset($komplain->bukti_komplain)
                    <div class="form-group">
                        <div class="row justify-content-start align-self-center">
                            <div class="col-2">
                                <label style="color: black; font-weight: bold;" for="text">Bukti Komplain</label>
                            </div>
                        </div>
                        <div class="row justify-content-start align-self-center">
                            <div class="col">
                                <img src="/images/bukti_komplain/{{ $komplain->bukti_komplain }}"/>
                            </div>
                        </div>
                    </div>
                    @endisset
                </div>
            </div>
        </div>

  
      
    </div>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/popper.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>

</body>
</html>
