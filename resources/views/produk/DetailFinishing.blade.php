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
                        <h4 class="card-title">Detail Finishing</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-finishing') }}'" style="margin-right: 10px;">
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
                    <form>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label style="color: black; font-weight: bold;" for="text">ID Finishing</label>
                                </div>
                                <div class="col-4">
                                    <input type="text" readonly="readonly" class="form-control" id="id_finishing" value="{{ $finishing->id_finishing }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="text">Jenis Finishing</label>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="jenis_finishing" value="{{ $finishing->jenis_finishing }}" readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="text">Harga</label>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="finishing_harga" value="Rp {{ number_format($finishing->finishing_harga, 2) }}" readonly/>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Penggunaan Bahan</h4>
                            </div>
                        </div>
                        <hr style="height: 10px;">
                        <div class="table-responsive container">
                            <table class="table table-striped table-borderless" id="tabel_bahan">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Bahan Setengah Jadi</th>
                                        <th>Quantity</th>
                                        <th>Harga Bahan Setengah Jadi</th>
                                        <th>Harga Beli Rata-Rata</th>
                                    </tr>
                                </thead>
                                <tbody id="table_del_bahan">
                                    @foreach($detail_finishing as $bahan)
                                    <tr>
                                        <td>{{ $bahan->bahan_setengah_jadi->nama_bahan_setengah_jadi }}</td>
                                        <td>{{ $bahan->quantity.' buah' }}</td>
                                        <td>Rp {{ number_format($bahan->bahan_setengah_jadi->harga*$bahan->quantity, 2) }}</td>
                                        {{-- @foreach ($data as $key)
                                            @foreach ($key as $res)
                                                @if ($res['id'] == $bahan->id)
                                                <td>{{ $res['harga_total'] }}</td>
                                                @endif
                                            @endforeach
                                        @endforeach --}}
                                        @for($i = 0; $i < count($data); $i++)
                                            @if ($data[$i]['id'] == $bahan->id)
                                            <td>Rp {{ number_format($data[$i]['harga_total'], 2) }}</td>
                                            @endif
                                        @endfor
                                    </tr>
                                    @endforeach
                                </tbody> 
                            </table>
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
</body>
</html>
