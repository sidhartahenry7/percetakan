<?php

namespace App\Http\Controllers;

use App\Models\laporan;
use App\Http\Requests\StorelaporanRequest;
use App\Http\Requests\UpdatelaporanRequest;
use App\Models\biaya;
use App\Models\cabang;
use App\Models\detail_pembelian_bahan;
use App\Models\detail_pembelian_tinta;
use App\Models\detail_produk;
use App\Models\detail_tinta;
use App\Models\detail_transaksi;
use App\Models\kartu_stok_bahan;
use App\Models\kartu_stok_tinta;
use App\Models\komplain;
use App\Models\pegawai;
use App\Models\pembayaran;
use App\Models\produk;
use App\Models\transaksi;
use App\Models\transaksi_pegawai;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    
    public function laporanLabaRugi()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('laporan.LaporanLabaRugi', [
                "title" => "Laporan Laba Rugi",
                "list_cabang" => cabang::where('deleted', 0)->get()
            ]);
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function fetchLabaRugi(Request $request)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $request->min);
        $endDate = Carbon::createFromFormat('Y-m-d', $request->max);
        $min_time = Carbon::create($startDate->year, $startDate->month, $startDate->day, 0, 0, 0);
        $max_time = Carbon::create($endDate->year, $endDate->month, $endDate->day, 23, 59, 59);
        
        $pendapatan_bersih = transaksi::join('antrians', 'transaksis.antrian_id', 'antrians.id')
                                      ->selectRaw("SUM(transaksis.total) as harga_bersih")
                                      ->where('antrians.cabang_id', $request->cabang_id)
                                      ->where('antrians.tanggal_antrian', '>=', $min_time)
                                      ->where('antrians.tanggal_antrian', '<=', $max_time)
                                      ->where(function($query) {
                                            $query->where('transaksis.status_pengerjaan', 'Pesanan telah diambil')
                                                  ->orWhere('transaksis.status_pengerjaan', 'Selesai')
                                                  ->orWhere('transaksis.status_pengerjaan', 'Sedang dikerjakan');
                                      })
                                      ->first();

        $data['pendapatan_bersih'] = $pendapatan_bersih->harga_bersih != null ? $pendapatan_bersih->harga_bersih : 0;
        
        $pendapatan_sewa = pembayaran::join('biayas', 'pembayarans.biaya_id', 'biayas.id')
                                     ->selectRaw("SUM(pembayarans.nominal) as harga_sewa")
                                     ->where('pembayarans.cabang_id', $request->cabang_id)
                                     ->whereBetween('pembayarans.tanggal_pembayaran', [$request->min, $request->max])
                                     ->whereRaw('LOWER(biayas.jenis_biaya) = "biaya sewa"')
                                     ->first();

        $data['pendapatan_sewa'] = $pendapatan_sewa->harga_sewa != null ? $pendapatan_sewa->harga_sewa : 0;

        $data['total_pendapatan'] = $data['pendapatan_bersih'] - $data['pendapatan_sewa'];

        $data['harga_pokok_penjualan'] = 0;

        $bahan_baku = produk::where('deleted', 0)->get();
        foreach ($bahan_baku as $bahan) {
            $harga_bahan = kartu_stok_bahan::select('harga_average')
                                           ->where('produk_id', $bahan->id)
                                           ->where('cabang_id', $request->cabang_id)
                                           ->whereBetween('tanggal', [$request->min, $request->max])
                                           ->latest()
                                           ->first();

            $quantity_bahan = kartu_stok_bahan::selectRaw("SUM(quantity_keluar) as quantity_keluar")
                                              ->where('produk_id', $bahan->id)
                                              ->where('cabang_id', $request->cabang_id)
                                              ->whereBetween('tanggal', [$request->min, $request->max])
                                              ->first();
            
            $harga_avg_bahan = $harga_bahan != null ? $harga_bahan->harga_average : 0;
            $qty_out_bahan = $quantity_bahan != null ? $quantity_bahan->quantity_keluar : 0;
            
            // $data['harga_bahan'][] = ['bahan_baku' => $bahan->id, 'harga' => $harga_avg_bahan, 'quantity' => $qty_out_bahan, 'harga_keluar' => $harga_avg_bahan*$qty_out_bahan];
            $data['harga_pokok_penjualan'] += $harga_avg_bahan*$qty_out_bahan;
        }

        $detail_tinta = detail_tinta::where('deleted', 0)->get();
        foreach ($detail_tinta as $detail) {
            $harga_tinta = kartu_stok_tinta::select('harga_average')
                                           ->where('detail_tinta_id', $detail->id)
                                           ->where('cabang_id', $request->cabang_id)
                                           ->whereBetween('tanggal', [$request->min, $request->max])
                                           ->latest()
                                           ->first();

            $quantity_tinta = kartu_stok_tinta::selectRaw("SUM(quantity_keluar) as quantity_keluar")
                                              ->where('detail_tinta_id', $detail->id)
                                              ->where('cabang_id', $request->cabang_id)
                                              ->whereBetween('tanggal', [$request->min, $request->max])
                                              ->first();
            
            $harga_avg_tinta = $harga_tinta != null ? $harga_tinta->harga_average : 0;
            $qty_out_tinta = $quantity_tinta != null ? $quantity_tinta->quantity_keluar : 0;

            // $data['harga_tinta'][] = ['detail_tinta' => $detail->id, 'harga' => $harga_avg_tinta, 'quantity' => $qty_out_tinta, 'harga_keluar' => $harga_avg_tinta*$qty_out_tinta];
            $data['harga_pokok_penjualan'] += $harga_avg_tinta*$qty_out_tinta;
        }
        // dd($data);
        $data['biaya'] =[];

        $jenis_biaya = biaya::where('deleted', 0)->get();
        foreach ($jenis_biaya as $jenis) {
            $nominal_biaya = pembayaran::selectRaw("SUM(pembayarans.nominal) as nominal")
                                       ->whereBetween('pembayarans.tanggal_pembayaran', [$request->min, $request->max])
                                       ->where('pembayarans.biaya_id', $jenis->id)
                                       ->where('pembayarans.cabang_id', $request->cabang_id)
                                       ->first();

            $data['biaya'][] = ['jenis_biaya' => $jenis->jenis_biaya, 'nominal' => $nominal_biaya != null ? $nominal_biaya->nominal : 0];
        }
        // dd($data);

        return response()->json($data);
    }

    public function laporanTransaksi()
    {
        if (Auth::user()->user_role == 'Admin') {
            $laris_jumlah = detail_transaksi::join('detail_produks', 'detail_transaksis.detail_produk_id', 'detail_produks.id')
                                            ->join('finishings', 'detail_produks.finishing_id', 'finishings.id')
                                            ->join('transaksis', 'detail_transaksis.transaksi_id', 'transaksis.id')
                                            ->where(function($query) {
                                                $query->where('transaksis.status_pengerjaan', 'Pesanan telah diambil')
                                                      ->orWhere('transaksis.status_pengerjaan', 'Selesai')
                                                      ->orWhere('transaksis.status_pengerjaan', 'Sedang dikerjakan');
                                            })
                                            ->selectRaw("CONCAT(detail_produks.nama_produk, ' ', finishings.jenis_finishing) as nama")
                                            ->selectRaw("SUM(detail_transaksis.jumlah_produk) as jumlah")
                                            ->groupBy('detail_transaksis.detail_produk_id')
                                            ->orderBy('jumlah','DESC')
                                            ->limit(3)
                                            ->get();
            
            $laris_harga = detail_transaksi::join('detail_produks', 'detail_transaksis.detail_produk_id', 'detail_produks.id')
                                           ->join('finishings', 'detail_produks.finishing_id', 'finishings.id')
                                           ->join('transaksis', 'detail_transaksis.transaksi_id', 'transaksis.id')
                                           ->where(function($query) {
                                                $query->where('transaksis.status_pengerjaan', 'Pesanan telah diambil')
                                                      ->orWhere('transaksis.status_pengerjaan', 'Selesai')
                                                      ->orWhere('transaksis.status_pengerjaan', 'Sedang dikerjakan');
                                           })
                                           ->selectRaw("CONCAT(detail_produks.nama_produk, ' ', finishings.jenis_finishing) as nama")
                                           ->selectRaw("SUM(detail_transaksis.sub_total) as harga")
                                           ->groupBy('detail_transaksis.detail_produk_id')
                                           ->orderBy('harga','DESC')
                                           ->limit(3)
                                           ->get();
    
            return view('laporan.LaporanTransaksi', [
                "title" => "Laporan Transaksi",
                "list_produk" => detail_produk::where('deleted', 0)->get(),
                "laris_jumlah" => json_encode($laris_jumlah),
                "laris_harga" => json_encode($laris_harga)
            ]);
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function fetchProduk(Request $request)
    {
        $data['jumlah_per_produk'] = [];
        if($request->produk_id == "All") {
            $detail_produk = detail_produk::where('deleted', 0)->get();
        }
        else {
            $detail_produk = detail_produk::where('id', $request->produk_id)->where('deleted', 0)->get();
        }
        
        // if($request->max == null) {
        //     $max = Carbon::today();
        // }
        // else {
        //     $max = $request->max;
        // }

        foreach($detail_produk as $detail) {
            $jumlah = detail_transaksi::join('transaksis', 'detail_transaksis.transaksi_id', 'transaksis.id')
                                      ->join('antrians', 'transaksis.antrian_id', 'antrians.id')
                                      ->join('detail_produks', 'detail_produks.id', 'detail_transaksis.detail_produk_id')
                                      ->selectRaw("CONCAT(detail_produks.nama_produk, ' ', detail_produks.ukuran) as nama_produk")
                                      ->selectRaw("SUM(jumlah_produk) as jumlah")
                                      ->groupBy('detail_produks.id')
                                      ->where('detail_produk_id', $detail->id)
                                      ->whereBetween('antrians.tanggal_antrian', [$request->min, $request->max])
                                      ->where(function($query) { 
                                        $query->where('transaksis.status_pengerjaan', 'Selesai')
                                              ->orWhere('transaksis.status_pengerjaan', 'Sedang dikerjakan')
                                              ->orWhere('transaksis.status_pengerjaan', 'Pesanan telah diambil');
                                      })
                                      ->first();
            if ($jumlah != NULL) {
                $data['jumlah_per_produk'][] = ['nama_produk' => $detail->nama_produk.' '.$detail->ukuran.' '.$detail->finishing->jenis_finishing, 'jumlah' => $jumlah != null ? $jumlah->jumlah : 0];
            }
        }
        // dd($data);
        return response()->json($data);
    }

    public function fetchTransaksi(Request $request)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $request->min_transaksi);
        $endDate = Carbon::createFromFormat('Y-m-d', $request->max_transaksi);
        $dateRange = CarbonPeriod::create($startDate, $endDate);
        
        $data['transaksi'] = [];

        foreach ($dateRange as $date) {
            $min_time = Carbon::create($date->year, $date->month, $date->day, 0, 0, 0);
            $max_time = Carbon::create($date->year, $date->month, $date->day, 23, 59, 59);
            $transaksi = transaksi::join('antrians', 'transaksis.antrian_id', 'antrians.id')
                                  ->selectRaw("COUNT(transaksis.id) as jumlah")
                                  ->where('antrians.tanggal_antrian', '>=', $min_time)
                                  ->where('antrians.tanggal_antrian', '<=', $max_time)
                                  ->where(function($query) {
                                        $query->where('transaksis.status_pengerjaan', 'Pesanan telah diambil')
                                              ->orWhere('transaksis.status_pengerjaan', 'Selesai');
                                  })
                                  ->first();

            if($transaksi->jumlah != null) {
                $data['transaksi'][] = ['tanggal' => $date->format('d M y'), 'jumlah' => $transaksi != null ? $transaksi->jumlah : 0];                
            }
        }
        return response()->json($data);
    }

    public function fetchPendapatan(Request $request)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $request->min_pendapatan);
        $endDate = Carbon::createFromFormat('Y-m-d', $request->max_pendapatan);
        $dateRange = CarbonPeriod::create($startDate, $endDate);
        
        $data['pendapatan'] = [];

        foreach ($dateRange as $date) {
            $min_time = Carbon::create($date->year, $date->month, $date->day, 0, 0, 0);
            $max_time = Carbon::create($date->year, $date->month, $date->day, 23, 59, 59);
            $transaksi = transaksi::join('antrians', 'transaksis.antrian_id', 'antrians.id')
                                  ->selectRaw("SUM(transaksis.total) as jumlah")
                                  ->where('antrians.tanggal_antrian', '>=', $min_time)
                                  ->where('antrians.tanggal_antrian', '<=', $max_time)
                                  ->where(function($query) {
                                        $query->where('transaksis.status_pengerjaan', 'Pesanan telah diambil')
                                              ->orWhere('transaksis.status_pengerjaan', 'Selesai');
                                  })
                                  ->first();

            if($transaksi->jumlah != null) {
                $data['pendapatan'][] = ['tanggal' => $date->format('d M y'), 'jumlah' => $transaksi != null ? $transaksi->jumlah : 0];          
            }
        }
        return response()->json($data);
    }

    public function laporanPembelian()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('laporan.LaporanPembelian', [
                "title" => "Laporan Pembelian",
                "list_cabang" => cabang::where('deleted', 0)->get(),
                "list_bahan_baku" => produk::where('deleted', 0)->get(),
                "list_tinta" => detail_tinta::where('deleted', 0)->get(),
            ]);
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function fetchBahanBaku(Request $request)
    {
        if($request->produk_id == "All") {
            if($request->cabang_id == "All") {
                $data = detail_pembelian_bahan::join('pembelian_bahans', 'detail_pembelian_bahans.pembelian_bahan_id', 'pembelian_bahans.id')
                                              ->select('pembelian_bahans.tanggal_pembelian_bahan as tanggal')
                                              ->selectRaw("SUM(detail_pembelian_bahans.harga) as harga")
                                              ->where('pembelian_bahans.status', 'Terima')
                                              ->whereBetween('pembelian_bahans.tanggal_pembelian_bahan', [$request->min_bahan_baku, $request->max_bahan_baku])
                                              ->groupBy('pembelian_bahans.tanggal_pembelian_bahan')
                                              ->get();
            }
            else {
                $data = detail_pembelian_bahan::join('pembelian_bahans', 'detail_pembelian_bahans.pembelian_bahan_id', 'pembelian_bahans.id')
                                              ->select('pembelian_bahans.tanggal_pembelian_bahan as tanggal')
                                              ->selectRaw("SUM(detail_pembelian_bahans.harga) as harga")
                                              ->where('pembelian_bahans.status', 'Terima')
                                              ->where('pembelian_bahans.cabang_id', $request->cabang_id)
                                              ->whereBetween('pembelian_bahans.tanggal_pembelian_bahan', [$request->min_bahan_baku, $request->max_bahan_baku])
                                              ->groupBy('pembelian_bahans.tanggal_pembelian_bahan')
                                              ->get();
            }
        }
        else {
            if($request->cabang_id == "All") {
                $data = detail_pembelian_bahan::join('pembelian_bahans', 'detail_pembelian_bahans.pembelian_bahan_id', 'pembelian_bahans.id')
                                              ->select('pembelian_bahans.tanggal_pembelian_bahan as tanggal')
                                              ->selectRaw("SUM(detail_pembelian_bahans.harga) as harga")
                                              ->where('pembelian_bahans.status', 'Terima')
                                              ->where('detail_pembelian_bahans.produk_id', $request->produk_id)
                                              ->whereBetween('pembelian_bahans.tanggal_pembelian_bahan', [$request->min_bahan_baku, $request->max_bahan_baku])
                                              ->groupBy('pembelian_bahans.tanggal_pembelian_bahan')
                                              ->get();
            }
            else {
                $data = detail_pembelian_bahan::join('pembelian_bahans', 'detail_pembelian_bahans.pembelian_bahan_id', 'pembelian_bahans.id')
                                              ->select('pembelian_bahans.tanggal_pembelian_bahan as tanggal')
                                              ->selectRaw("SUM(detail_pembelian_bahans.harga) as harga")
                                              ->where('pembelian_bahans.status', 'Terima')
                                              ->where('detail_pembelian_bahans.produk_id', $request->produk_id)
                                              ->where('pembelian_bahans.cabang_id', $request->cabang_id)
                                              ->whereBetween('pembelian_bahans.tanggal_pembelian_bahan', [$request->min_bahan_baku, $request->max_bahan_baku])
                                              ->groupBy('pembelian_bahans.tanggal_pembelian_bahan')
                                              ->get();
            }
        }
        return response()->json($data);
    }

    public function fetchBahanBakuJumlah(Request $request)
    {
        if($request->cabang_id == "All") {
            $data = detail_pembelian_bahan::join('pembelian_bahans', 'detail_pembelian_bahans.pembelian_bahan_id', 'pembelian_bahans.id')
                                          ->select('pembelian_bahans.tanggal_pembelian_bahan as tanggal')
                                          ->selectRaw("SUM(detail_pembelian_bahans.quantity) as jumlah")
                                          ->where('pembelian_bahans.status', 'Terima')
                                          ->where('detail_pembelian_bahans.produk_id', $request->produk_id_jumlah)
                                          ->whereBetween('pembelian_bahans.tanggal_pembelian_bahan', [$request->min_bahan_baku_jumlah, $request->max_bahan_baku_jumlah])
                                          ->groupBy('pembelian_bahans.tanggal_pembelian_bahan')
                                          ->get();
        }
        else {
            $data = detail_pembelian_bahan::join('pembelian_bahans', 'detail_pembelian_bahans.pembelian_bahan_id', 'pembelian_bahans.id')
                                          ->select('pembelian_bahans.tanggal_pembelian_bahan as tanggal')
                                          ->selectRaw("SUM(detail_pembelian_bahans.quantity) as jumlah")
                                          ->where('pembelian_bahans.status', 'Terima')
                                          ->where('detail_pembelian_bahans.produk_id', $request->produk_id_jumlah)
                                          ->where('pembelian_bahans.cabang_id', $request->cabang_id)
                                          ->whereBetween('pembelian_bahans.tanggal_pembelian_bahan', [$request->min_bahan_baku_jumlah, $request->max_bahan_baku_jumlah])
                                          ->groupBy('pembelian_bahans.tanggal_pembelian_bahan')
                                          ->get();
        }
        return response()->json($data);
    }

    public function fetchTinta(Request $request)
    {
        if($request->tinta_id == "All") {
            if($request->cabang_id == "All") {
                $data = detail_pembelian_tinta::join('pembelian_tintas', 'detail_pembelian_tintas.pembelian_tinta_id', 'pembelian_tintas.id')
                                              ->select('pembelian_tintas.tanggal_pembelian_tinta as tanggal')
                                              ->selectRaw("SUM(detail_pembelian_tintas.harga) as harga")
                                              ->where('pembelian_tintas.status', 'Terima')
                                              ->whereBetween('pembelian_tintas.tanggal_pembelian_tinta', [$request->min_tinta, $request->max_tinta])
                                              ->groupBy('pembelian_tintas.tanggal_pembelian_tinta')
                                              ->get();
            }
            else {
                $data = detail_pembelian_tinta::join('pembelian_tintas', 'detail_pembelian_tintas.pembelian_tinta_id', 'pembelian_tintas.id')
                                              ->select('pembelian_tintas.tanggal_pembelian_tinta as tanggal')
                                              ->selectRaw("SUM(detail_pembelian_tintas.harga) as harga")
                                              ->where('pembelian_tintas.status', 'Terima')
                                              ->where('pembelian_tintas.cabang_id', $request->cabang_id)
                                              ->whereBetween('pembelian_tintas.tanggal_pembelian_tinta', [$request->min_tinta, $request->max_tinta])
                                              ->groupBy('pembelian_tintas.tanggal_pembelian_tinta')
                                              ->get();
            }
        }
        else {
            if($request->cabang_id == "All") {
                $data = detail_pembelian_tinta::join('pembelian_tintas', 'detail_pembelian_tintas.pembelian_tinta_id', 'pembelian_tintas.id')
                                              ->select('pembelian_tintas.tanggal_pembelian_tinta as tanggal')
                                              ->selectRaw("SUM(detail_pembelian_tintas.harga) as harga")
                                              ->where('pembelian_tintas.status', 'Terima')
                                              ->where('detail_pembelian_tintas.detail_tinta_id', $request->tinta_id)
                                              ->whereBetween('pembelian_tintas.tanggal_pembelian_tinta', [$request->min_tinta, $request->max_tinta])
                                              ->groupBy('pembelian_tintas.tanggal_pembelian_tinta')
                                              ->get();
            }
            else{
                $data = detail_pembelian_tinta::join('pembelian_tintas', 'detail_pembelian_tintas.pembelian_tinta_id', 'pembelian_tintas.id')
                                              ->select('pembelian_tintas.tanggal_pembelian_tinta as tanggal')
                                              ->selectRaw("SUM(detail_pembelian_tintas.harga) as harga")
                                              ->where('pembelian_tintas.status', 'Terima')
                                              ->where('detail_pembelian_tintas.detail_tinta_id', $request->tinta_id)
                                              ->where('pembelian_tintas.cabang_id', $request->cabang_id)
                                              ->whereBetween('pembelian_tintas.tanggal_pembelian_tinta', [$request->min_tinta, $request->max_tinta])
                                              ->groupBy('pembelian_tintas.tanggal_pembelian_tinta')
                                              ->get();
            }
        }
        return response()->json($data);
    }

    public function fetchTintaJumlah(Request $request)
    {
        if($request->tinta_id_jumlah == "All") {
            if($request->cabang_id == "All") {
                $data = detail_pembelian_tinta::join('pembelian_tintas', 'detail_pembelian_tintas.pembelian_tinta_id', 'pembelian_tintas.id')
                                              ->select('pembelian_tintas.tanggal_pembelian_tinta as tanggal')
                                              ->selectRaw("SUM(detail_pembelian_tintas.quantity) as jumlah")
                                              ->where('pembelian_tintas.status', 'Terima')
                                              ->whereBetween('pembelian_tintas.tanggal_pembelian_tinta', [$request->min_tinta_jumlah, $request->max_tinta_jumlah])
                                              ->groupBy('pembelian_tintas.tanggal_pembelian_tinta')
                                              ->get();
            }
            else {
                $data = detail_pembelian_tinta::join('pembelian_tintas', 'detail_pembelian_tintas.pembelian_tinta_id', 'pembelian_tintas.id')
                                              ->select('pembelian_tintas.tanggal_pembelian_tinta as tanggal')
                                              ->selectRaw("SUM(detail_pembelian_tintas.quantity) as jumlah")
                                              ->where('pembelian_tintas.status', 'Terima')
                                              ->where('pembelian_tintas.cabang_id', $request->cabang_id)
                                              ->whereBetween('pembelian_tintas.tanggal_pembelian_tinta', [$request->min_tinta_jumlah, $request->max_tinta_jumlah])
                                              ->groupBy('pembelian_tintas.tanggal_pembelian_tinta')
                                              ->get();
            }
        }
        else {
            if($request->cabang_id == "All") {
                $data = detail_pembelian_tinta::join('pembelian_tintas', 'detail_pembelian_tintas.pembelian_tinta_id', 'pembelian_tintas.id')
                                              ->select('pembelian_tintas.tanggal_pembelian_tinta as tanggal')
                                              ->selectRaw("SUM(detail_pembelian_tintas.quantity) as jumlah")
                                              ->where('pembelian_tintas.status', 'Terima')
                                              ->where('detail_pembelian_tintas.detail_tinta_id', $request->tinta_id_jumlah)
                                              ->whereBetween('pembelian_tintas.tanggal_pembelian_tinta', [$request->min_tinta_jumlah, $request->max_tinta_jumlah])
                                              ->groupBy('pembelian_tintas.tanggal_pembelian_tinta')
                                              ->get();
            }
            else {
                $data = detail_pembelian_tinta::join('pembelian_tintas', 'detail_pembelian_tintas.pembelian_tinta_id', 'pembelian_tintas.id')
                                              ->select('pembelian_tintas.tanggal_pembelian_tinta as tanggal')
                                              ->selectRaw("SUM(detail_pembelian_tintas.quantity) as jumlah")
                                              ->where('pembelian_tintas.status', 'Terima')
                                              ->where('detail_pembelian_tintas.detail_tinta_id', $request->tinta_id_jumlah)
                                              ->where('pembelian_tintas.cabang_id', $request->cabang_id)
                                              ->whereBetween('pembelian_tintas.tanggal_pembelian_tinta', [$request->min_tinta_jumlah, $request->max_tinta_jumlah])
                                              ->groupBy('pembelian_tintas.tanggal_pembelian_tinta')
                                              ->get();
            }
        }
        return response()->json($data);
    }

    public function laporanPerforma()
    {
        if (Auth::user()->user_role == 'Admin') {
            $data = [];
            $pegawai = pegawai::where('deleted', 0)
                              ->where('user_role', '!=', 'Admin')
                              ->where('user_role', '!=', 'Kepala Toko')
                              ->where('user_role', '!=', 'Wakil Kepala Toko')
                              ->get();
    
            foreach($pegawai as $res) {
                $jumlah_komplain = komplain::join('detail_transaksis', 'komplains.detail_transaksi_id', 'detail_transaksis.id')
                                           ->join('transaksis', 'detail_transaksis.transaksi_id', 'transaksis.id')
                                           ->join('transaksi_pegawais', 'transaksis.id', 'transaksi_pegawais.transaksi_id')
                                           ->selectRaw("COUNT(komplains.id) as jumlah")
                                           ->where('transaksi_pegawais.pegawai_id', $res->id)
                                           ->first();
    
                $jumlah_transaksi = detail_transaksi::join('transaksis', 'detail_transaksis.transaksi_id', 'transaksis.id')
                                                    ->join('antrians', 'transaksis.antrian_id', 'antrians.id')
                                                    ->join('transaksi_pegawais', 'transaksi_pegawais.transaksi_id', 'transaksis.id')
                                                    ->selectRaw("COUNT(detail_transaksis.id) as jumlah")
                                                    ->where('transaksi_pegawais.pegawai_id', $res->id)
                                                    ->where(function($query) {
                                                        $query->where('transaksis.status_pengerjaan', 'Pesanan telah diambil')
                                                              ->orWhere('transaksis.status_pengerjaan', 'Selesai');
                                                    })
                                                    ->first();
                
                $data[] = ['nama_pegawai' => $res->nama_lengkap, 'jumlah_komplain' => $jumlah_komplain != null ? $jumlah_komplain->jumlah : 0, 'jumlah_transaksi' => $jumlah_transaksi != null ? $jumlah_transaksi->jumlah : 0];
            }
    
            return view('laporan.LaporanPerformaPegawai', [
                "title" => "Laporan Performa Pegawai",
                "data" => json_encode($data)
            ]);
        }
        else if (Auth::user()->user_role == 'Kepala Toko' || Auth::user()->user_role == 'Wakil Kepala Toko') {
            $data = [];
            $pegawai = pegawai::where('deleted', 0)
                              ->where('user_role', '!=', 'Admin')
                              ->where('user_role', '!=', 'Kepala Toko')
                              ->where('user_role', '!=', 'Wakil Kepala Toko')
                              ->where('cabang_id', Auth::user()->cabang_id)
                              ->get();
    
            foreach($pegawai as $res) {
                $jumlah_komplain = komplain::join('detail_transaksis', 'komplains.detail_transaksi_id', 'detail_transaksis.id')
                                           ->join('transaksis', 'detail_transaksis.transaksi_id', 'transaksis.id')
                                           ->join('transaksi_pegawais', 'transaksis.id', 'transaksi_pegawais.transaksi_id')
                                           ->selectRaw("COUNT(komplains.id) as jumlah")
                                           ->where('transaksi_pegawais.pegawai_id', $res->id)
                                           ->first();
    
                $jumlah_transaksi = detail_transaksi::join('transaksis', 'detail_transaksis.transaksi_id', 'transaksis.id')
                                                    ->join('antrians', 'transaksis.antrian_id', 'antrians.id')
                                                    ->join('transaksi_pegawais', 'transaksi_pegawais.transaksi_id', 'transaksis.id')
                                                    ->selectRaw("COUNT(detail_transaksis.id) as jumlah")
                                                    ->where('transaksi_pegawais.pegawai_id', $res->id)
                                                    ->where(function($query) {
                                                        $query->where('transaksis.status_pengerjaan', 'Pesanan telah diambil')
                                                              ->orWhere('transaksis.status_pengerjaan', 'Selesai');
                                                    })
                                                    ->first();
                
                $data[] = ['nama_pegawai' => $res->nama_lengkap, 'jumlah_komplain' => $jumlah_komplain != null ? $jumlah_komplain->jumlah : 0, 'jumlah_transaksi' => $jumlah_transaksi != null ? $jumlah_transaksi->jumlah : 0];
            }
    
            return view('laporan.LaporanPerformaPegawaiKepalaToko', [
                "title" => "Laporan Performa Pegawai",
                "data" => json_encode($data)
            ]);
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function fetchPerformaPegawai(Request $request)
    {
        $data['performa_pegawai'] = [];
        if (Auth::user()->user_role == 'Admin') {
            $pegawai = pegawai::where('deleted', 0)
                              ->where('user_role', '!=', 'Admin')
                              ->where('user_role', '!=', 'Kepala Toko')
                              ->where('user_role', '!=', 'Wakil Kepala Toko')
                              ->get();
        }
        else if (Auth::user()->user_role == 'Kepala Toko' || Auth::user()->user_role == 'Wakil Kepala Toko') {
            $pegawai = pegawai::where('deleted', 0)
                              ->where('user_role', '!=', 'Admin')
                              ->where('user_role', '!=', 'Kepala Toko')
                              ->where('user_role', '!=', 'Wakil Kepala Toko')
                              ->where('cabang_id', Auth::user()->cabang_id)
                              ->get();
        }

        $startDate = Carbon::createFromFormat('Y-m-d', $request->min);
        $endDate = Carbon::createFromFormat('Y-m-d', $request->max);
        $min_time = Carbon::create($startDate->year, $startDate->month, $startDate->day, 0, 0, 0);
        $max_time = Carbon::create($endDate->year, $endDate->month, $endDate->day, 23, 59, 59);

        foreach($pegawai as $res) {
            $jumlah_komplain = komplain::join('detail_transaksis', 'komplains.detail_transaksi_id', 'detail_transaksis.id')
                                       ->join('transaksis', 'detail_transaksis.transaksi_id', 'transaksis.id')
                                       ->join('antrians', 'transaksis.antrian_id', 'antrians.id')
                                       ->join('transaksi_pegawais', 'transaksis.id', 'transaksi_pegawais.transaksi_id')
                                       ->selectRaw("COUNT(komplains.id) as jumlah")
                                       ->where('transaksi_pegawais.pegawai_id', $res->id)
                                       ->where('antrians.tanggal_antrian', '>=', $min_time)
                                       ->where('antrians.tanggal_antrian', '<=', $max_time)
                                       ->first();

            $jumlah_transaksi = detail_transaksi::join('transaksis', 'detail_transaksis.transaksi_id', 'transaksis.id')
                                                ->join('antrians', 'transaksis.antrian_id', 'antrians.id')
                                                ->join('transaksi_pegawais', 'transaksi_pegawais.transaksi_id', 'transaksis.id')
                                                ->selectRaw("COUNT(detail_transaksis.id) as jumlah")
                                                ->where('transaksi_pegawais.pegawai_id', $res->id)
                                                ->where('antrians.tanggal_antrian', '>=', $min_time)
                                                ->where('antrians.tanggal_antrian', '<=', $max_time)
                                                ->where(function($query) {
                                                    $query->where('transaksis.status_pengerjaan', 'Pesanan telah diambil')
                                                          ->orWhere('transaksis.status_pengerjaan', 'Selesai');
                                                })
                                                ->first();
            
            $data['performa_pegawai'][] = ['nama_pegawai' => $res->nama_lengkap, 'jumlah_komplain' => $jumlah_komplain != null ? $jumlah_komplain->jumlah : 0, 'jumlah_transaksi' => $jumlah_transaksi != null ? $jumlah_transaksi->jumlah : 0];
        }

        return response()->json($data);
    }

    public function laporanPerformaIndividu() {
        if (Auth::user()->user_role == 'Kasir' || Auth::user()->user_role == 'Desainer' || Auth::user()->user_role == 'Operator Printer') {
            $detail_komplain = komplain::join('detail_transaksis', 'komplains.detail_transaksi_id', 'detail_transaksis.id')
                                       ->join('transaksis', 'detail_transaksis.transaksi_id', 'transaksis.id')
                                       ->join('transaksi_pegawais', 'transaksis.id', 'transaksi_pegawais.transaksi_id')
                                       ->where('transaksi_pegawais.pegawai_id', Auth::user()->id)
                                       ->get();

            $jumlah_komplain = komplain::join('detail_transaksis', 'komplains.detail_transaksi_id', 'detail_transaksis.id')
                                       ->join('transaksis', 'detail_transaksis.transaksi_id', 'transaksis.id')
                                       ->join('transaksi_pegawais', 'transaksis.id', 'transaksi_pegawais.transaksi_id')
                                       ->selectRaw("COUNT(komplains.id) as jumlah")
                                       ->where('transaksi_pegawais.pegawai_id', Auth::user()->id)
                                       ->first();

            $jumlah_transaksi = detail_transaksi::join('transaksis', 'detail_transaksis.transaksi_id', 'transaksis.id')
                                                ->join('antrians', 'transaksis.antrian_id', 'antrians.id')
                                                ->join('transaksi_pegawais', 'transaksi_pegawais.transaksi_id', 'transaksis.id')
                                                ->selectRaw("COUNT(detail_transaksis.id) as jumlah")
                                                ->where('transaksi_pegawais.pegawai_id', Auth::user()->id)
                                                ->where(function($query) {
                                                    $query->where('transaksis.status_pengerjaan', 'Pesanan telah diambil')
                                                          ->orWhere('transaksis.status_pengerjaan', 'Selesai');
                                                })
                                                ->first();
    
            return view('laporan.LaporanPerformaPegawaiIndividu', [
                "title" => "Laporan Performa Pegawai",
                "detail_komplain" => $detail_komplain,
                "jumlah_komplain" => $jumlah_komplain,
                "jumlah_transaksi" => $jumlah_transaksi,
            ]);
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function downloadBuktiKomplain($id)
    {
        $nama_file = komplain::where('id', $id)->first('bukti_komplain');
        return response()->download(public_path("storage/{$nama_file->bukti_komplain}"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorelaporanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorelaporanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show(laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit(laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatelaporanRequest  $request
     * @param  \App\Models\laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatelaporanRequest $request, laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(laporan $laporan)
    {
        //
    }
}
