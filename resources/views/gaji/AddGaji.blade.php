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
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Add Gaji</h4>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{ url('list-gaji') }}'" style="margin-right: 10px;">
                        Back
                    </button>
                </div>
                <hr style="height: 10px;">
                <div class="iq-card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="date">Tanggal</label>
                                <br>
                                <input type="date" class="form-control" id="tanggal_cetak" name="tanggal_cetak" value="{{ date('Y-m-d') }}"/>
                            </div>
                        </div>
                    </div>
                    {{-- <button type="cancel" class="btn btn-danger">
                        Cancel
                    </button> --}}
                    <button id="tombol" class="btn" style="background-color: #29a4da; color: white;">
                        Submit
                    </button>
                </div>
            </div>
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#tombol').click(function () {
                        var tanggal_cetak = $('#tanggal_cetak').val();
                        $("#list_gaji").html('');
                        $.ajax({
                            url: "{{url('/api/hitung-gaji')}}",
                            type: 'POST',
                            data: {
                                tanggal_cetak: tanggal_cetak,
                                _token:'{{ csrf_token() }}'
                            },
                            dataType : 'json',
                            success: function (result) {
                                $('#list_gaji').html('<thead class="thead-dark"><tr><th>Tanggal</th><th>ID Pegawai</th><th>Nama Pegawai</th><th>Gaji Pokok</th><th>Jumlah Hari Masuk</th><th>Sub Total Gaji</th><th>Bonus</th><th>Total Gaji</th></tr></thead><tbody>');
                                $.each(result.pegawai, function (key, value) {
                                    var jumlah_hari_masuk = 0;
                                    var bonus = 0;
                                    $.each(result.jumlah_hari, function (key, hari) {
                                        if(value.id == hari.id) {
                                            jumlah_hari_masuk = hari.jumlah_hari_masuk;
                                        }
                                    });
                                    if(value.user_role == "Kepala Toko" || value.user_role == "Wakil Kepala Toko") {
                                        if(value.user_role == "Kepala Toko") {
                                            $.each(result.bonus_kepala_toko, function (key, bonus_kepala) {
                                                if(value.cabang_id == bonus_kepala.cabang_id) {
                                                    if(bonus_kepala.omset == 50000000) {
                                                        bonus = 750000;
                                                    }
                                                    else if(bonus_kepala.omset == 40000000) {
                                                        bonus = 600000;
                                                    }
                                                    else if(bonus_kepala.omset == 30000000) {
                                                        bonus = 500000;
                                                    }
                                                    else if(bonus_kepala.omset == 20000000) {
                                                        bonus = 400000;
                                                    }
                                                    else if(bonus_kepala.omset == 15000000) {
                                                        bonus = 300000;
                                                    }
                                                    else {
                                                        bonus = 250000;
                                                    }
                                                }
                                            });
                                        }
                                        else if(value.user_role == "Wakil Kepala Toko") {
                                            $.each(result.bonus_kepala_toko, function (key, bonus_kepala) {
                                                if(value.cabang_id == bonus_kepala.cabang_id) {
                                                    if(bonus_kepala.omset == 50000000) {
                                                        bonus = 650000;
                                                    }
                                                    else if(bonus_kepala.omset == 40000000) {
                                                        bonus = 500000;
                                                    }
                                                    else if(bonus_kepala.omset == 30000000) {
                                                        bonus = 400000;
                                                    }
                                                    else if(bonus_kepala.omset == 20000000) {
                                                        bonus = 300000;
                                                    }
                                                    else if(bonus_kepala.omset == 15000000) {
                                                        bonus = 200000;
                                                    }
                                                    else {
                                                        bonus = 100000;
                                                    }
                                                }
                                            });
                                        }
                                    }
                                    else if(value.user_role == "Kasir" || value.user_role == "Desainer" || value.user_role == "Operator Printer") {
                                        $.each(result.bonus_pegawai, function (key, bonus_pegawai) {
                                            if(value.id == bonus_pegawai.id) {
                                                if(bonus_pegawai.jumlah_komplain > 20) {
                                                    bonus = 'Surat Peringatan';
                                                }
                                                else if(bonus_pegawai.jumlah_komplain > 15) {
                                                    bonus = 0;
                                                }
                                                else if(bonus_pegawai.jumlah_komplain > 11) {
                                                    bonus = 50000;
                                                }
                                                else if(bonus_pegawai.jumlah_komplain > 7) {
                                                    bonus = 100000;
                                                }
                                                else if(bonus_pegawai.jumlah_komplain > 0) {
                                                    bonus = 150000;
                                                }
                                                else {
                                                    bonus = 200000;
                                                }
                                            }
                                        });
                                    }
                                    $("#list_gaji").append('<tr><td>'+tanggal_cetak+'</td>\
                                                                <td style="display:none;"><input type="hidden" name="tanggal_cetak[]" value="'+tanggal_cetak+'"/></td>\
                                                                <td>'+value.id_pegawai+'</td>\
                                                                <td style="display:none;"><input type="hidden" name="pegawai_id[]" value="'+value.id+'"/></td>\
                                                                <td>'+value.nama_lengkap+'</td>\
                                                                <td>'+value.gaji_pokok+'</td>\
                                                                <td style="display:none;"><input type="hidden" name="gaji_pokok[]" value="'+value.gaji_pokok+'"/></td>\
                                                                <td>'+jumlah_hari_masuk+'</td>\
                                                                <td style="display:none;"><input type="hidden" name="jumlah_hari_masuk[]" value="'+jumlah_hari_masuk+'"/></td>\
                                                                <td>'+value.gaji_pokok*jumlah_hari_masuk+'</td>\
                                                                <td>'+bonus+'</td>\
                                                                <td style="display:none;"><input type="hidden" name="bonus[]" value="'+bonus+'"/></td>\
                                                                <td>'+parseInt(value.gaji_pokok*jumlah_hari_masuk+bonus)+'</td>\
                                                                <td style="display:none;"><input type="hidden" name="total_gaji[]" value="'+parseInt(value.gaji_pokok*jumlah_hari_masuk+bonus)+'"/></td>\
                                                            </tr>');
                                });
                                $("#list_gaji").append('</tbody>');
                                $("#list_gaji").append('<br><button type="submit" class="btn btn-success">Simpan</button>');
                            }
                        });
                    }); 
                });
            </script>
            
            <br>
            <!--Tabel-->
            <form action="{{url('/gaji')}}" method="post" id="form_gaji">
                @csrf
                <table id="list_gaji" class="table table-striped table-borderless">
                </table>
            </form>
        </div>
      
    </div>

    {{-- <script src="js/jquery.min.js"></script> --}}
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>
