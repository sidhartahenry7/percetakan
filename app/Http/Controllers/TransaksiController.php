<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use App\Models\antrian;
use App\Models\detail_transaksi;
use App\Http\Requests\StoretransaksiRequest;
use App\Http\Requests\UpdatetransaksiRequest;
use App\Models\detail_finishing;
use App\Models\detail_produk;
use App\Models\detail_produk_bahan;
use App\Models\kartu_stok_bahan;
use App\Models\kartu_stok_tinta;
use App\Models\penggunaan_bahan;
use App\Models\penggunaan_tinta;
use App\Models\status_transaksi;
use App\Models\transaksi_pegawai;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PDF;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 'Admin') {
            
            return view('transaksi.Transaksi', [
                "idtransaksi" => transaksi::CreateID(),
                "list_transaksi" => transaksi::where('status_pengerjaan', '!=', 'Pesanan telah diambil')->where('status_pengerjaan', '!=', 'Batal')->get(),
                "list_antrian" => antrian::whereNotIn('id', transaksi::all()->pluck('antrian_id'))->get(),
                "list_status" => [
                    "Belum dikerjakan",
                    "Sedang dikerjakan",
                    "Selesai",
                    "Pesanan telah diambil",
                    "Batal"
                ],
                "title" => "Transaksi"
            ]);
        }
        else {
            return view('transaksi.Transaksi', [
                "idtransaksi" => transaksi::CreateID(),
                "list_transaksi" => transaksi::join('antrians', 'antrians.id', '=', 'transaksis.antrian_id')->where('antrians.cabang_id', Auth::user()->cabang_id)->where('status_pengerjaan', '!=', 'Pesanan telah diambil')->where('status_pengerjaan', '!=', 'Batal')->get(),
                "list_antrian" => antrian::whereNotIn('id', transaksi::all()->pluck('antrian_id'))->where('cabang_id', '=', Auth::user()->cabang_id)->get(),
                "list_status" => [
                    "Belum dikerjakan",
                    "Sedang dikerjakan",
                    "Selesai",
                    "Pesanan telah diambil",
                    "Batal"
                ],
                "title" => "Transaksi"
            ]);

        }
    }

    public function indexHistory()
    {   
        if (Auth::guard('user')->check()) {
            return view('transaksi.HistoryTransaksi', [
                "history_transaksi" => transaksi::where('status_pengerjaan', 'Pesanan telah diambil')->orWhere('status_pengerjaan', 'Batal')->orderBy('id', 'DESC')->get(),
                "title" => "History Transaksi"
            ]);
        }
        else if (Auth::guard('pelanggan')->check()) {
            $history_transaksi = transaksi::join('antrians', 'transaksis.antrian_id', 'antrians.id')
                                          ->where(function($query) {
                                                $query->where('transaksis.status_pengerjaan', 'Pesanan telah diambil')
                                                      ->orWhere('transaksis.status_pengerjaan', 'Batal');
                                          })
                                          ->where('antrians.pelanggan_id', Auth::guard('pelanggan')->user()->id)
                                          ->orderBy('transaksis.id', 'DESC')
                                          ->get();

            return view('transaksi.pelanggan.HistoryTransaksiPelanggan', [
                "history_transaksi" => $history_transaksi,
                "title" => "History Transaksi"
            ]);
        }
    }
    
    public function printNota($id)
    {   
        
        $transaksi = transaksi::where('id', $id)->first();

        $detail_transaksi = detail_transaksi::where('transaksi_id', $id)->get();

        $transaksi_pegawai = transaksi_pegawai::where('transaksi_id', $id)->get();

        $pdf = PDF::loadView('transaksi/NotaTransaksi', compact('transaksi', 'detail_transaksi', 'transaksi_pegawai'));
        $pdf->setPaper('A5', 'landscape');

        return $pdf->download('Soerabaja45_'.$transaksi->antrian->id_antrian.'.pdf');
    }

    public function listTransaksiPelanggan()
    {
        return view('transaksi.pelanggan.ListTransaksiPelanggan', [
            "list_transaksi" => transaksi::join('antrians', 'transaksis.antrian_id', 'antrians.id')->where('transaksis.status_pengerjaan', '!=', 'Selesai')->where('transaksis.status_pengerjaan', '!=', 'Batal')->where('antrians.pelanggan_id', Auth::guard('pelanggan')->user()->id)->get(),
            "title" => "Daftar Transaksi"
        ]);
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
     * @param  \App\Http\Requests\StoretransaksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretransaksiRequest $request)
    {
        $validatedData = $request->validate([
            'id_transaksi' => 'required|unique:transaksis',
            'antrian_id' => 'required|max:255'
        ]);

        transaksi::create($validatedData);

        $transaksi = transaksi::where('id_transaksi', $request->id_transaksi)->first();

        $dataStatus['transaksi_id'] = $transaksi->id; 
        $dataStatus['pegawai_id'] = Auth::guard('user')->user()->id; 
        $dataStatus['tanggal_status'] = Carbon::now();
        $dataStatus['status_pengerjaan'] = 'Transaksi dibuat';

        status_transaksi::create($dataStatus);

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('transaksi/'.$transaksi->id.'/edit');
    }

    public function downloadBuktiPembayaran($id)
    {
        $nama_file = transaksi::where('id', $id)->first('bukti_pembayaran');
        return response()->download(public_path("storage/{$nama_file->bukti_pembayaran}"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetransaksiRequest  $request
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetransaksiRequest $request, transaksi $transaksi)
    {
        transaksi::where('id', $request->id)
                 ->update(['status_pengerjaan' => $request->status_pengerjaan]);

        $detail_transaksi = detail_transaksi::where('transaksi_id', $request->id)->get();
        $transaksis = transaksi::where('id', $request->id)->first();

        $dataStatus['transaksi_id'] = $transaksis->id; 
        $dataStatus['tanggal_status'] = Carbon::now();
        $dataStatus['status_pengerjaan'] = $request->status_pengerjaan;
        $dataStatus['pegawai_id'] = Auth::user()->id;

        status_transaksi::create($dataStatus);
        
        if ($request->status_pengerjaan == 'Sedang dikerjakan') {
            foreach ($detail_transaksi as $detail) {
                $detail_produk = detail_produk::where("id", '=', $detail->detail_produk_id)->first();
                $detail_produk_bahan = detail_produk_bahan::where('detail_produk_id', $detail_produk->id)->get();
                foreach ($detail_produk_bahan as $detail_bahan) {
                    $penggunaan_bahan = penggunaan_bahan::where('bahan_setengah_jadi_id', $detail_bahan->bahan_setengah_jadi_id)->first();
                    $stok_bahan = kartu_stok_bahan::where('produk_id', $penggunaan_bahan->produk_id)->where('cabang_id', $transaksis->antrian->cabang_id)->latest('id')->first();
                    kartu_stok_bahan::create([
                        'tanggal' => $transaksis->antrian->tanggal_antrian,
                        'cabang_id' => $transaksis->antrian->cabang_id,
                        'produk_id' => $penggunaan_bahan->produk_id,
                        'quantity_masuk' => 0,
                        'quantity_keluar' => $penggunaan_bahan->jumlah_pemakaian*$detail->jumlah_produk,
                        'quantity_sekarang' => $stok_bahan->quantity_sekarang-($penggunaan_bahan->jumlah_pemakaian*$detail->jumlah_produk),
                        'satuan' => $stok_bahan->satuan,
                        'harga_beli' => 0,
                        'harga_average' => $stok_bahan->harga_average,
                        'status' => "Keluar",
                        'transaksi_id' => $transaksis->id,
                    ]);
    
                    $penggunaan_tinta = penggunaan_tinta::where('bahan_setengah_jadi_id', $detail_bahan->bahan_setengah_jadi_id)->get();
                    foreach($penggunaan_tinta as $tintas) {
                        $stok_tinta = kartu_stok_tinta::where('detail_tinta_id', $tintas->detail_tinta_id)->where('cabang_id', $transaksis->antrian->cabang_id)->latest('id')->first();
                        $quantity_keluar = 0;
                        if($tintas->detail_tinta->warna == "Cyan") {
                            $quantity_keluar = (($detail->persen_cyan/100)*$tintas->jumlah_pemakaian*$detail->jumlah_produk);
                        }
                        else if($tintas->detail_tinta->warna == "Magenta") {
                            $quantity_keluar = (($detail->persen_magenta/100)*$tintas->jumlah_pemakaian*$detail->jumlah_produk);
    
                        }
                        else if($tintas->detail_tinta->warna == "Yellow") {
                            $quantity_keluar = (($detail->persen_yellow/100)*$tintas->jumlah_pemakaian*$detail->jumlah_produk);
    
                        }
                        else if($tintas->detail_tinta->warna == "Black") {
                            $quantity_keluar = (($detail->persen_black/100)*$tintas->jumlah_pemakaian*$detail->jumlah_produk);
                        }
    
                        if ($quantity_keluar != 0) {
                            kartu_stok_tinta::create([
                                'tanggal' => $transaksis->antrian->tanggal_antrian,
                                'cabang_id' => $transaksis->antrian->cabang_id,
                                'detail_tinta_id' => $tintas->detail_tinta_id,
                                'quantity_masuk' => 0,
                                'quantity_keluar' => $quantity_keluar,
                                'quantity_sekarang' => $stok_tinta->quantity_sekarang-$quantity_keluar,
                                'satuan' => $stok_tinta->satuan,
                                'harga_beli' => 0,
                                'harga_average' => $stok_tinta->harga_average,
                                'status' => "Keluar",
                                'transaksi_id' => $transaksis->id,
                            ]);
                        }
                    }
                }
    
                $detail_bahan_finishing = detail_finishing::where('finishing_id', $detail_produk->finishing_id)->get();
                foreach ($detail_bahan_finishing as $detail_finishing) {
                    $penggunaan_bahan_finishing = penggunaan_bahan::where('bahan_setengah_jadi_id', $detail_finishing->bahan_setengah_jadi_id)->first();
                    $stok_bahan_finishing = kartu_stok_bahan::where('produk_id', $penggunaan_bahan_finishing->produk_id)->where('cabang_id', $transaksis->antrian->cabang_id)->latest('id')->first();
                    if ($detail_produk->status_finishing == 0) {
                        $quantity_finishing_keluar = $penggunaan_bahan_finishing->jumlah_pemakaian*$detail_finishing->quantity;
                    }
                    else {
                        $quantity_finishing_keluar = $penggunaan_bahan_finishing->jumlah_pemakaian*$detail_finishing->quantity*$detail->jumlah_produk;
                    }
                    kartu_stok_bahan::create([
                        'tanggal' => $transaksis->antrian->tanggal_antrian,
                        'cabang_id' => $transaksis->antrian->cabang_id,
                        'produk_id' => $penggunaan_bahan_finishing->produk_id,
                        'quantity_masuk' => 0,
                        'quantity_keluar' => $quantity_finishing_keluar,
                        'quantity_sekarang' => $stok_bahan_finishing->quantity_sekarang-$quantity_finishing_keluar,
                        'satuan' => $stok_bahan_finishing->satuan,
                        'harga_beli' => 0,
                        'harga_average' => $stok_bahan_finishing->harga_average,
                        'status' => "Keluar",
                        'transaksi_id' => $transaksis->id,
                    ]);
    
                    $penggunaan_tinta_finishing = penggunaan_tinta::where('bahan_setengah_jadi_id', $detail_finishing->bahan_setengah_jadi_id)->get();
                    foreach($penggunaan_tinta_finishing as $tinta_finishing) {
                        $stok_tinta_finishing = kartu_stok_tinta::where('detail_tinta_id', $tinta_finishing->detail_tinta_id)->where('cabang_id', $transaksis->antrian->cabang_id)->latest('id')->first();
                        $quantity_keluar = 0;
                        if ($detail_produk->status_finishing == 0) {
                            if($tinta_finishing->detail_tinta->warna == "Cyan") {
                                $quantity_keluar_tinta_finishing = (($detail->persen_cyan/100)*$tinta_finishing->jumlah_pemakaian*$detail_finishing->quantity);
                            }
                            else if($tinta_finishing->detail_tinta->warna == "Magenta") {
                                $quantity_keluar_tinta_finishing = (($detail->persen_magenta/100)*$tinta_finishing->jumlah_pemakaian*$detail_finishing->quantity);
    
                            }
                            else if($tinta_finishing->detail_tinta->warna == "Yellow") {
                                $quantity_keluar_tinta_finishing = (($detail->persen_yellow/100)*$tinta_finishing->jumlah_pemakaian*$detail_finishing->quantity);
    
                            }
                            else if($tinta_finishing->detail_tinta->warna == "Black") {
                                $quantity_keluar_tinta_finishing = (($detail->persen_black/100)*$tinta_finishing->jumlah_pemakaian*$detail_finishing->quantity);
                            }
                        }
                        else {
                            if($tinta_finishing->detail_tinta->warna == "Cyan") {
                                $quantity_keluar_tinta_finishing = (($detail->persen_cyan/100)*$tinta_finishing->jumlah_pemakaian*$detail_finishing->quantity*$detail->jumlah_produk);
                            }
                            else if($tinta_finishing->detail_tinta->warna == "Magenta") {
                                $quantity_keluar_tinta_finishing = (($detail->persen_magenta/100)*$tinta_finishing->jumlah_pemakaian*$detail_finishing->quantity*$detail->jumlah_produk);
    
                            }
                            else if($tinta_finishing->detail_tinta->warna == "Yellow") {
                                $quantity_keluar_tinta_finishing = (($detail->persen_yellow/100)*$tinta_finishing->jumlah_pemakaian*$detail_finishing->quantity*$detail->jumlah_produk);
    
                            }
                            else if($tinta_finishing->detail_tinta->warna == "Black") {
                                $quantity_keluar_tinta_finishing = (($detail->persen_black/100)*$tinta_finishing->jumlah_pemakaian*$detail_finishing->quantity*$detail->jumlah_produk);
                            }
                        }
    
                        if ($quantity_keluar_tinta_finishing != 0) {
                            kartu_stok_tinta::create([
                                'tanggal' => $transaksis->antrian->tanggal_antrian,
                                'cabang_id' => $transaksis->antrian->cabang_id,
                                'detail_tinta_id' => $tinta_finishing->detail_tinta_id,
                                'quantity_masuk' => 0,
                                'quantity_keluar' => $quantity_keluar_tinta_finishing,
                                'quantity_sekarang' => $stok_tinta_finishing->quantity_sekarang-$quantity_keluar_tinta_finishing,
                                'satuan' => $stok_tinta_finishing->satuan,
                                'harga_beli' => 0,
                                'harga_average' => $stok_tinta_finishing->harga_average,
                                'status' => "Keluar",
                                'transaksi_id' => $transaksis->id,
                            ]);
                        }
                    }
                }    
            }
        }

        $request->session()->flash('success','Status Berhasil Diupdate');

        return redirect('/transaksi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(transaksi $transaksi)
    {
        //
    }
}
