<?php

namespace App\Http\Controllers;

use App\Models\antrian;
use App\Models\detail_transaksi;
use App\Models\kartu_stok_bahan;
use App\Models\kartu_stok_tinta;
use App\Models\penawaran;
use App\Models\transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Auth::guard('user')->check()) {
            if (Auth::user()->user_role == 'Admin') {
                $laris_jumlah = detail_transaksi::join('detail_produks', 'detail_transaksis.detail_produk_id', 'detail_produks.id')
                                                ->join('finishings', 'detail_produks.finishing_id', 'finishings.id')
                                                ->join('transaksis', 'detail_transaksis.transaksi_id', 'transaksis.id')
                                                ->join('antrians', 'transaksis.antrian_id', 'antrians.id')
                                                ->selectRaw("CONCAT(detail_produks.nama_produk, ' ', detail_produks.ukuran, ' ', finishings.jenis_finishing) as nama")
                                                ->selectRaw("SUM(detail_transaksis.jumlah_produk) as jumlah")
                                                ->whereMonth('antrians.tanggal_antrian', Carbon::now()->month)
                                                // ->whereMonth('antrians.tanggal_antrian', 2)
                                                ->where(function($query) {
                                                    $query->where('transaksis.status_pengerjaan', 'Pesanan telah diambil')
                                                          ->orWhere('transaksis.status_pengerjaan', 'Selesai')
                                                          ->orWhere('transaksis.status_pengerjaan', 'Sedang dikerjakan');
                                                })
                                                ->groupBy('detail_transaksis.detail_produk_id')
                                                ->orderBy('jumlah','DESC')
                                                ->limit(4)
                                                ->get();
                
                $laris_harga = detail_transaksi::join('detail_produks', 'detail_transaksis.detail_produk_id', 'detail_produks.id')
                                               ->join('finishings', 'detail_produks.finishing_id', 'finishings.id')
                                               ->join('transaksis', 'detail_transaksis.transaksi_id', 'transaksis.id')
                                               ->join('antrians', 'transaksis.antrian_id', 'antrians.id')
                                               ->selectRaw("CONCAT(detail_produks.nama_produk, ' ', detail_produks.ukuran, ' ', finishings.jenis_finishing) as nama")
                                               ->selectRaw("SUM(detail_transaksis.sub_total) as harga")
                                               ->whereMonth('antrians.tanggal_antrian', (Carbon::now()->month))
                                               ->where(function($query) {
                                                    $query->where('transaksis.status_pengerjaan', 'Pesanan telah diambil')
                                                          ->orWhere('transaksis.status_pengerjaan', 'Selesai')
                                                          ->orWhere('transaksis.status_pengerjaan', 'Sedang dikerjakan');
                                               })
                                            //    ->whereMonth('antrians.tanggal_antrian', 2)
                                               ->groupBy('detail_transaksis.detail_produk_id')
                                               ->orderBy('harga','DESC')
                                               ->limit(4)
                                               ->get();
        
                return view('dashboard.pegawai.DashboardAdmin', [
                    "title" => "Dashboard",
                    "laris_jumlah" => json_encode($laris_jumlah),
                    "laris_harga" => json_encode($laris_harga)
                ]);
            }
            else if (Auth::user()->user_role == 'Kepala Toko' || Auth::user()->user_role == 'Wakil Kepala Toko') {
                $data_bahan_lembar = [];
                $stok_bahan_lembar = kartu_stok_bahan::join('produks', 'kartu_stok_bahans.produk_id', 'produks.id')
                                                     ->where('kartu_stok_bahans.cabang_id', Auth::user()->cabang_id)
                                                     ->whereNotNull('produks.ukuran')
                                                     ->latest('kartu_stok_bahans.created_at')
                                                     ->orderBy('kartu_stok_bahans.quantity_sekarang')
                                                     ->get()
                                                     ->unique('produk_id');
            
                foreach ($stok_bahan_lembar as $res_bahan_lembar) {
                    $data_bahan_lembar[] = ['nama_bahan_lembar' => $res_bahan_lembar->jenis_kertas.' '.$res_bahan_lembar->ukuran, 'quantity_bahan_lembar' => $res_bahan_lembar->quantity_sekarang];
                }
                // dd(array_slice(collect($data_bahan_lembar)->sortBy('quantity_bahan_lembar')->toArray(), 0, 3));
                
                $data_bahan_meter = [];
                $stok_bahan_meter = kartu_stok_bahan::join('produks', 'kartu_stok_bahans.produk_id', 'produks.id')
                                                    ->where('kartu_stok_bahans.cabang_id', Auth::user()->cabang_id)
                                                    ->whereNull('produks.ukuran')
                                                    ->latest('kartu_stok_bahans.created_at')
                                                    ->orderBy('kartu_stok_bahans.quantity_sekarang')
                                                    ->get()
                                                    ->unique('produk_id');
            
                foreach ($stok_bahan_meter as $res_bahan_meter) {
                    $data_bahan_meter[] = ['nama_bahan_meter' => $res_bahan_meter->jenis_kertas.' '.$res_bahan_meter->lebar.' x '.$res_bahan_meter->panjang.' '.$res_bahan_meter->satuan, 'quantity_bahan_meter' => $res_bahan_meter->quantity_sekarang];
                }
                // dd(array_slice(collect($data_bahan_meter)->sortBy('quantity_bahan_meter')->toArray(), 0, 3));
                
                $data_tinta = [];
                $stok_tinta = kartu_stok_tinta::join('detail_tintas', 'kartu_stok_tintas.detail_tinta_id', 'detail_tintas.id')
                                              ->join('tintas', 'detail_tintas.tinta_id', 'tintas.id')
                                              ->where('kartu_stok_tintas.cabang_id', Auth::user()->cabang_id)
                                              ->latest('kartu_stok_tintas.created_at')
                                              ->get()
                                              ->unique('detail_tinta_id');
            
                foreach ($stok_tinta as $res) {
                    $data_tinta[] = ['nama_tinta' => $res->jenis_tinta.' '.$res->warna, 'quantity' => $res->quantity_sekarang];
                }
                // dd(array_slice(collect($data_tinta)->sortBy('quantity')->toArray(), 0, 3));
            
                return view('dashboard.pegawai.DashboardKepala', [
                    "title" => "Dashboard",
                    "data_bahan_lembar" => json_encode(array_slice(collect($data_bahan_lembar)->sortBy('quantity_bahan_lembar')->toArray(), 0, 3)),
                    "data_bahan_meter" => json_encode(array_slice(collect($data_bahan_meter)->sortBy('quantity_bahan_meter')->toArray(), 0, 3)),
                    "data_tinta" => json_encode(array_slice(collect($data_tinta)->sortBy('quantity')->toArray(), 0, 3)),
                ]);
            }
            else if (Auth::user()->user_role == 'Kasir' || Auth::user()->user_role == 'Desainer' || Auth::user()->user_role == 'Operator Printer') {
                $data_status_pesanan = [];

                $status_pesanan_penawaran = penawaran::where('status_penawaran', '!=', 'Selesai')
                                                     ->where('status_penawaran', '!=', 'Batal')
                                                     ->where('cabang_id', Auth::user()->cabang_id)
                                                     ->selectRaw("COUNT(id) as quantity")
                                                     ->first();
            
                $data_status_pesanan[] = ['status_pesanan' => 'Penawaran belum selesai', 'quantity' => $status_pesanan_penawaran != null ? $status_pesanan_penawaran->quantity : 0];

                $antrian = transaksi::select('antrian_id')->get();
                $status_pesanan_antrian = antrian::leftJoin('transaksis', 'transaksis.antrian_id', 'antrians.id')
                                                 ->whereNotIn('antrians.id', $antrian)
                                                 ->where('antrians.cabang_id', Auth::user()->cabang_id)
                                                 ->selectRaw("COUNT(antrians.id) as quantity")
                                                 ->first();
            
                $data_status_pesanan[] = ['status_pesanan' => 'Antrian belum diproses', 'quantity' => $status_pesanan_antrian != null ? $status_pesanan_antrian->quantity : 0];
    
                $status_pesanan_belum_dikerjakan = transaksi::join('transaksi_pegawais', 'transaksi_pegawais.transaksi_id', 'transaksis.id')
                                                            ->where('transaksi_pegawais.pegawai_id', Auth::user()->id)
                                                            ->where('transaksis.status_pengerjaan', 'Belum dikerjakan')
                                                            ->selectRaw("COUNT(transaksis.id) as quantity")
                                                            ->first();
            
                $data_status_pesanan[] = ['status_pesanan' => 'Belum dikerjakan', 'quantity' => $status_pesanan_belum_dikerjakan != null ? $status_pesanan_belum_dikerjakan->quantity : 0];
    
                $status_pesanan_sedang_dikerjakan = transaksi::join('transaksi_pegawais', 'transaksi_pegawais.transaksi_id', 'transaksis.id')
                                                             ->where('transaksi_pegawais.pegawai_id', Auth::user()->id)
                                                             ->where('transaksis.status_pengerjaan', 'Sedang dikerjakan')
                                                             ->selectRaw("COUNT(transaksis.id) as quantity")
                                                             ->first();
            
                $data_status_pesanan[] = ['status_pesanan' => 'Sedang dikerjakan', 'quantity' => $status_pesanan_sedang_dikerjakan != null ? $status_pesanan_sedang_dikerjakan->quantity : 0];
    
                return view('dashboard.pegawai.DashboardPegawai', [
                    "title" => "Dashboard",
                    "data_status_pesanan" => json_encode($data_status_pesanan),
                ]);
            }
            else {
                abort(403);
            }
        }
        else if (Auth::guard('pelanggan')->check()) {
            return view('dashboard.pelanggan.DashboardPelanggan', [
                "title" => "Dashboard",
                "list_penawaran" => penawaran::where('pelanggan_id', Auth::guard('pelanggan')->user()->id)->where('status_penawaran', '!=', 'Selesai')->where('status_penawaran', '!=', 'Batal')->get(),
                "list_transaksi" => transaksi::join('antrians', 'transaksis.antrian_id', 'antrians.id')->where('transaksis.status_pengerjaan', '!=', 'Selesai')->where('transaksis.status_pengerjaan', '!=', 'Batal')->where('antrians.pelanggan_id', Auth::guard('pelanggan')->user()->id)->get()
            ]);
        }
    }

    public function home()
    {
        return view('dashboard.Home', [
            "title" => "Soerabaja45"
        ]);
    }
}
