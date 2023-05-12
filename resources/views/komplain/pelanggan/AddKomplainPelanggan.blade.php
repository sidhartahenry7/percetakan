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
        @include('partials.NavbarPelanggan')

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Add Komplain</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('daftar-komplain') }}'" style="margin-right: 10px;">
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
                    <form action="{{ url('/komplain') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label style="color: black; font-weight: bold;" for="text">Transaksi</label>
                            <select class="form-control @error('detail_transaksi_id') is-invalid @enderror" id="detail_transaksi_id" name="detail_transaksi_id" required>
                                <option selected="" value="">
                                    -- Pilih Transaksi --
                                </option>
                                @foreach ($list_transaksi as $detail)
                                    @if(old('detail_transaksi_id') == $detail->id)
                                        <option value="{{ $detail->id }}" selected>{{ $detail->id }} {{ $detail->id_transaksi }} {{ $detail->nama_produk }} Rp {{ number_format($detail->sub_total, 2) }}</option>
                                    @else
                                        <option value="{{ $detail->id }}">{{ $detail->id }} {{ $detail->id_transaksi }} {{ $detail->nama_produk }} Rp {{ number_format($detail->sub_total, 2) }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="color: black; font-weight: bold;" for="text">Komplain</label>
                            <br>
                            {{-- <textarea name="isi_komplain"
                                id="isi_komplain"
                                rows="3"
                                class="col-sm-12 @error('isi_komplain') is-invalid @enderror"
                                required value="{{ old('isi_komplain') }}">
                            </textarea> --}}
                            <div class="row">
                                <div class="col-sm-12">
                                    <textarea class="@error('isi_komplain') is-invalid @enderror" id="isi_komplain" name="isi_komplain" rows="3" style="width: 100%;" required></textarea>
                                    @error('isi_komplain')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label style="color: black; font-weight: bold;" for="text">Bukti Komplain</label>
                            <div class="custom-file">
                                {{-- <input type="file" class="custom-file-input" id="validatedCustomFile" name="bukti_komplain" accept=".jpg,.jpeg,.png"> --}}
                                {{-- <label class="custom-file-label" for="validatedCustomFile">Masukan Bukti...</label> --}}
                                <input type="file" name="bukti_komplain" class="inp-img @error('bukti_komplain') is-invalid @enderror" id="ordinary" accept=".jpg,.jpeg,.png">
                                @error('bukti_komplain')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger" onclick="location.href='{{ url('daftar-komplain') }}'">
                            Cancel
                        </button>
                        <button type="submit" class="btn" style="background-color: #29a4da; color: white;">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>

  
      
    </div>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#detail_transaksi_id').select2();
        });
    </script>
</body>
</html>
