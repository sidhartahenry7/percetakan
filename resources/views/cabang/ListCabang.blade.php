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
                        <h4 class="card-title">Daftar Cabang</h4>
                    </div>
                    @if(auth()->user()->user_role == "Admin")
                    <button type="button" class="btn btn-primary" onclick="location.href='{{ url('cabang') }}'" style="margin-right: 10px;">
                        <span class="material-icons align-middle">
                            add
                        </span>
                    </button>
                    @endif
                </div>
                <hr style="height: 10px;">
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <br>
            @if(auth()->user()->user_role == "Admin")
            <!--Tabel-->
            <div class="table-responsive container">
                <table class="table table-striped table-borderless" id="dtBasicExample">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Cabang</th>
                            <th>Nama Cabang</th>
                            <th>Alamat</th>
                            <th>Longitude</th>
                            <th>Latitude</th>
                            <th>No Telepon</th>
                            @if(auth()->user()->user_role == "Admin")
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($list_cabang as $cabang)
                        <tr>
                            <td>{{ $cabang->id_cabang }}</td>
                            <td>{{ $cabang->nama_cabang }}</td>
                            <td>{{ $cabang->alamat }}</td>
                            <td>{{ $cabang->longitude }}</td>
                            <td>{{ $cabang->latitude }}</td>
                            <td>{{ $cabang->nomor_telepon }}</td>
                            {{-- <td>
                                <div class="d-inline">
                                    <a href="{{ url('/cabang/'.$cabang->id.'/edit') }}" class="btn btn-warning btn-sm">
                                        <span class="material-icons align-middle">
                                            edit
                                        </span>
                                    </a>
                                    <a href="{{ url('/cabang/'.$cabang->id.'/delete') }}" class="btn btn-danger btn-sm">
                                        <span class="material-icons align-middle">
                                            delete
                                        </span>
                                    </a>
                                </div>
                            </td> --}}
                            @if(auth()->user()->user_role == "Admin")
                            <td>
                                <form action="{{ url('/cabang/'.$cabang->id) }}" method="POST" class="d-inline">
                                    @method('put')
                                    @csrf
                                    <button class="btn btn-success">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </button>
                                </form>
                                <form action="{{ url('/cabang/'.$cabang->id) }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-borderless">
                    <tr>
                        <td class="text-left" style="width: 12%"><label style="color: black; font-weight: bold;" for="text">ID Cabang</label></td>
                        <td class="text-left" style="width: 2%"><label style="color: black; font-weight: bold;" for="text">:</label></td>
                        <td class="text-left"><label for="text">{{ auth()->user()->cabang->id_cabang }}</label></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 12%"><label style="color: black; font-weight: bold;" for="text">Nama Cabang</label></td>
                        <td class="text-left" style="width: 2%"><label style="color: black; font-weight: bold;" for="text">:</label></td>
                        <td class="text-left"><label for="text">{{ auth()->user()->cabang->nama_cabang }}</label></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 12%"><label style="color: black; font-weight: bold;" for="text">Alamat</label></td>
                        <td class="text-left" style="width: 2%"><label style="color: black; font-weight: bold;" for="text">:</label></td>
                        <td class="text-left"><label for="text">{{ auth()->user()->cabang->alamat }}</label></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 12%"><label style="color: black; font-weight: bold;" for="text">Longitude</label></td>
                        <td class="text-left" style="width: 2%"><label style="color: black; font-weight: bold;" for="text">:</label></td>
                        <td class="text-left"><label for="text">{{ auth()->user()->cabang->longitude }}</label></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 12%"><label style="color: black; font-weight: bold;" for="text">Latitude</label></td>
                        <td class="text-left" style="width: 2%"><label style="color: black; font-weight: bold;" for="text">:</label></td>
                        <td class="text-left"><label for="text">{{ auth()->user()->cabang->latitude }}</label></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 12%"><label style="color: black; font-weight: bold;" for="text">Nomor Telepon</label></td>
                        <td class="text-left" style="width: 2%"><label style="color: black; font-weight: bold;" for="text">:</label></td>
                        <td class="text-left"><label for="text">{{ auth()->user()->cabang->nomor_telepon }}</label></td>
                    </tr>
                </table>
            </div>
            @endif
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
