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

        #status_finishing {
            font-size: 12px;
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
                        <h4 class="card-title">Edit Detail Produk</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-detail-produk') }}'" style="margin-right: 10px;">
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
                    <form action="{{ url('/detail-produk/'.$detail_produk->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="id_detail_produk">ID Detail Produk</label>
                                </div>
                                <div class="col-sm-3">
                                    <label id="id_detail_produk">{{ $detail_produk->id_detail_produk }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="nama_kategori">Kategori</label>
                                </div>
                                <div class="col-sm-4">
                                    <label id="nama_kategori">{{ $detail_produk->kategori->nama_kategori }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="jenis_kertas">Jenis Bahan</label>
                                </div>
                                <div class="col-sm-4">
                                    <label id="jenis_bahan">{{ $detail_produk->jenis_bahan }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="ukuran">Ukuran</label>
                                </div>
                                <div class="col-sm-4">
                                    <label id="ukuran">{{ $detail_produk->ukuran }}</label>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="jenis_tinta">Jenis Tinta</label>
                                </div>
                                <div class="col-sm-4">
                                    <label id="jenis_tinta">{{ $detail_produk->tinta->jenis_tinta }}</label>
                                </div>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="jenis_finishing">Finishing</label>
                                </div>
                                <div class="col-sm-4">
                                    <label id="jenis_finishing">{{ $detail_produk->finishing->jenis_finishing }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="harga_finishing">Harga Finishing</label>
                                </div>
                                <div class="col-sm-4">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="p-0" style="text-align:left;">
                                                <label class="m-0" id="harga_finishing">Rp {{ number_format($detail_produk->finishing->harga, 2) }}</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-0" style="text-align:left;" id="status_finishing">
                                                @if($detail_produk->status_finishing == 0)
                                                <input disabled class="m-0" type="checkbox"> harga per quantity
                                                @else
                                                <input checked disabled class="m-0" type="checkbox"> harga per quantity
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="keterangan">Keterangan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label id="keterangan">{!! $detail_produk->keterangan !!}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="harga">Harga</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control"  id="harga" name="harga" value="{{ $detail_produk->harga }}" required autofocus />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="diskon">Diskon (%)</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control"  id="diskon" name="diskon" value="{{ $detail_produk->diskon }}" required />
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-detail-produk') }}'">
                            Cancel
                        </button>
                        <button type="submit" class="btn" style="background-color: #29a4da; color: white;">
                            Submit
                        </button>
                    </form>
                    {{-- <form action="{{ url('/detail-produk/'.$detail_produk->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label style="color: black; font-weight: bold;" for="id_detail_produk">ID Detail Produk</label>
                                    <input type="text" class="form-control"  id="id_detail_produk" value="{{ $detail_produk->id_detail_produk }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label style="color: black; font-weight: bold;" for="nama_kategori">Kategori</label>
                                    <input type="text" class="form-control"  id="nama_kategori" value="{{ $detail_produk->kategori->nama_kategori }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label style="color: black; font-weight: bold;" for="ukuran">Ukuran</label>
                                    <input type="text" class="form-control"  id="ukuran" value="{{ $detail_produk->produk->ukuran }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label style="color: black; font-weight: bold;" for="jenis_kertas">Jenis Bahan</label>
                                    <input type="text" class="form-control"  id="jenis_kertas" value="{{ $detail_produk->produk->jenis_kertas }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label style="color: black; font-weight: bold;" for="jenis_tinta">Jenis Tinta</label>
                                    <input type="text" class="form-control"  id="jenis_tinta" value="{{ $detail_produk->tinta->jenis_tinta }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label style="color: black; font-weight: bold;" for="finishing">Finishing</label>
                                    <input type="text" class="form-control"  id="finishing" value="{{ $detail_produk->finishing }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label style="color: black; font-weight: bold;" for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control"  id="keterangan" value="{{ $detail_produk->keterangan }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label style="color: black; font-weight: bold;" for="harga">Harga</label>
                                    <input type="number" class="form-control"  id="harga" name="harga" value="{{ $detail_produk->harga }}" required autofocus />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label style="color: black; font-weight: bold;" for="diskon">Diskon (%)</label>
                                    <input type="number" class="form-control"  id="diskon" name="diskon" value="{{ $detail_produk->diskon }}" required />
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger" onclick="location.href='{{ url('detail-produk') }}'">
                            Cancel
                        </button>
                        <button type="submit" class="btn" style="background-color: #29a4da; color: white;">
                            Submit
                        </button>
                    </form> --}}
                </div>
            </div>
        </div>

  
      
    </div>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>
