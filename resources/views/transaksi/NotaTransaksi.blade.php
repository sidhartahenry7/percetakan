<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Nota Transaksi</title>
    
    <style>
        .nota-namaperusahaan {
            font-size: 18px;
            font-weight: bold;
        }
        .nota-alamatperusahaan {
            margin-top: -10px;
            font-size: 14px;
            font-weight: 300;
        }
        .nota-logo {
            width: 100%;
            height: 100%:
        }
        #isi {
            text-align: center;
            font-size: 10px;
        }
        #tabel-isi {
            font-size: 10px;
        }
        #semua {
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    <div class="container-xl" id="semua">
        <table style="width: 100%">
            <tr>
                <th><img src="{{ public_path('/images/Logo-Cassa.png') }}" alt="..." width="150px" height="90px"><p class="nota-namaperusahaan">
                    CASSA DE VERDE
                </p>
                <p class="nota-alamatperusahaan">
                    {{ $transaksi->antrian->cabang->alamat }}<br>
                    {{ $transaksi->antrian->cabang->nomor_telepon }}
                </p></th>
            </tr>
        </table>
        <table style="width: 100%" id="tabel-isi">
            <tr>
                <th colspan="2" style="text-align:left">
                    Nota Transaksi
                </th>
            </tr>
            <br>
            <tr>
                <td style="width: 25%">ID Transaksi</td>
                <td style="width: 1%">:</td>
                <td style="width: 74%">{{ $transaksi->antrian->id_antrian }}</td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td>:</td>
                @foreach($transaksi_pegawai as $p)
                @if($p->pegawai->user_role == "Kasir")
                <td>{{ $p->pegawai->nama_lengkap }}</td>
                @endif
                @endforeach
            </tr>
            <tr>
                <td>Pelanggan</td>
                <td>:</td>
                <td>{{ $transaksi->antrian->pelanggan->nama_pelanggan }}</td>
            </tr>
        </table>
        <br>
        <table style="width: 100%; border: 1px solid #111111;" id="isi">
            <tr>
                <th style=" border: 1px solid #111111;">No</th>
                <th style=" border: 1px solid #111111;">Nama Produk</th>
                <th style=" border: 1px solid #111111;">Finishing</th>
                <th style=" border: 1px solid #111111;">Harga</th>
                <th style=" border: 1px solid #111111;">Jumlah Produk</th>
                <th style=" border: 1px solid #111111;">Harga Finishing</th>
                <th style=" border: 1px solid #111111;">Diskon (%)</th>
                <th style=" border: 1px solid #111111;">Sub Total</th>
                <th style=" border: 1px solid #111111;">Harga Custom</th>
                <th style=" border: 1px solid #111111;">Total</th>
            </tr>
            @php
            $count = 1;
            @endphp
            @foreach ($detail_transaksi as $detail)
            <tr style="text-align: center">
                <td style=" border: 1px solid #111111;">{{ $count }}</td>
                <td style=" border: 1px solid #111111;">{{ $detail->detail_produk->nama_produk }}</td>
                <td style=" border: 1px solid #111111;">{{ $detail->detail_produk->finishing->jenis_finishing }}</td>
                <td style=" border: 1px solid #111111;">Rp {{ number_format($detail->harga) }}</td>
                <td style=" border: 1px solid #111111;">{{ $detail->jumlah_produk }}</td>
                <td style=" border: 1px solid #111111;">Rp {{ number_format($detail->harga_finishing) }}</td>
                <td style=" border: 1px solid #111111;">{{ $detail->diskon }}</td>
                @if($detail->detail_produk->status_finishing == 0)
                <td style=" border: 1px solid #111111;">Rp {{ number_format(($detail->harga*$detail->jumlah_produk+$detail->harga_finishing)*(1-($detail->diskon/100))) }}</td>
                @else
                <td style=" border: 1px solid #111111;">Rp {{ number_format((($detail->harga*$detail->jumlah_produk)+($detail->harga_finishing*$detail->jumlah_produk))*(1-($detail->diskon/100))) }}</td>
                @endif
                <td style=" border: 1px solid #111111;">{{ $detail->harga_custom }}</td>
                <td style=" border: 1px solid #111111;">Rp {{ number_format($detail->sub_total) }}</td>
            </tr>
            @php
            $count++;
            @endphp
            @endforeach
        </table>
        <br>

        <div class="form-group">
            <div class="row">
                <div class="col" style="text-align: right; font-size: 15px">
                    <label style="font-weight: bold" for="total">Total :</label>
                    <label style="font-weight: bold" for="total">Rp {{ number_format($transaksi->total) }}</label>
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
