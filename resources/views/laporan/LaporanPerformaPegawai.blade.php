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
            <p id="date_filter">
                <span id="date-label-from" class="date-label">From: </span><input type="date" id="min" name="min"/>
                <span id="date-label-to" class="date-label">To: </span><input type="date" id="max" name="max"/>
                {{-- <span id="bahan_dropdown-label">Bahan Baku: </span>
                    <select id="bahan_dropdown">
                        <option selected="" value="All">All</option>
                        @foreach ($list_bahan_baku as $bahan)
                            @isset($bahan->ukuran)
                            <option value="{{ $bahan->id }}">{{ $bahan->jenis_kertas. ' ' .$bahan->ukuran }}</option>
                            @else
                            <option value="{{ $bahan->id }}">{{ $bahan->jenis_kertas. ' ' .$bahan->lebar." x ".$bahan->panjang." ".$bahan->satuan }}</option>
                            @endisset
                        @endforeach
                    </select>
                </span> --}}
                <button type="button" class="btn" style="background-color: #EC268F; color: white;" id="create">Create</button>
            </p>
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
        var xValues = [];
        var yValues = [];
        var yValuesTransaksi = [];
        var barColors = '#9BD0F5';

        $(document).ready(function() {
            var performa = JSON.parse({!! json_encode($data) !!});
            $.each(performa, function (key, value) { 
                xValues.push(value.nama_pegawai);
                yValues.push(value.jumlah_komplain);
                yValuesTransaksi.push(value.jumlah_transaksi);
            });
            const myBarChart = new Chart("myChart", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        label: 'Jumlah komplain',
                        backgroundColor: barColors,
                        data: yValues
                    }, {
                        label: 'Jumlah transaksi',
                        backgroundColor: "#2e5468",
                        data: yValuesTransaksi
                    }]
                },
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Data Jumlah Komplain dan Jumlah Transaksi per Pegawai"
                    },
                    scales: {
                        xAxes: [{
                            stacked: true
                        }],
                        yAxes: [{
                            stacked: true,
                            display: true,
                            ticks: {
                                suggestedMin: 0
                            }
                        }]
                    },
                    plugins: {}
                }
            });
            
            $('#create').on('click', function () {
                xValues = [];
                yValues = [];
                yValuesTransaksi = [];
                var min = $('#min').val();
                var max = $('#max').val();
                $.ajax({
                    url: "{{url('/api/laporan-performa')}}",
                    type: 'POST',
                    data: {
                        min:min,
                        max:max,
                        _token:'{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $.each(result.performa_pegawai, function (key, value) { 
                            xValues.push(value.nama_pegawai);
                            yValues.push(value.jumlah_komplain);
                            yValuesTransaksi.push(value.jumlah_transaksi);
                        });
                        myBarChart.data = {
                            labels: xValues,
                            datasets: [{
                                label: 'Jumlah komplain',
                                backgroundColor: barColors,
                                data: yValues
                            }, {
                                label: 'Jumlah transaksi',
                                backgroundColor: "#2e5468",
                                data: yValuesTransaksi
                            }]
                        };
                        myBarChart.update();
                    }
                });
            });
        });
    </script>
</body>
</html>