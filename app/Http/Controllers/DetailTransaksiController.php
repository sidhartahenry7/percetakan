<?php

namespace App\Http\Controllers;

use App\Models\detail_transaksi;
use App\Http\Requests\Storedetail_transaksiRequest;
use App\Http\Requests\Updatedetail_transaksiRequest;
use App\Models\detail_produk;
use App\Models\transaksi;
use App\Models\promo;
use App\Models\pegawai;
use App\Models\transaksi_pegawai;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexView($id)
    {
        $transaksi = transaksi::where('id', '=', $id)->first();
        return view('transaksi.DetailTransaksi', [
            "transaksi" => $transaksi,
            "list_beli" => detail_transaksi::where('transaksi_id', '=', $id)->get(),
            "history_kasir" => transaksi_pegawai::join('pegawais', 'transaksi_pegawais.pegawai_id', '=', 'pegawais.id')->where('transaksi_id', $id)->where('pegawais.user_role', 'Kasir')->first(),
            "history_operator_printer" => transaksi_pegawai::join('pegawais', 'transaksi_pegawais.pegawai_id', '=', 'pegawais.id')->where('transaksi_id', $id)->where('pegawais.user_role', 'Operator Printer')->first(),
            "history_desainer" => transaksi_pegawai::join('pegawais', 'transaksi_pegawais.pegawai_id', '=', 'pegawais.id')->where('transaksi_id', $id)->where('pegawais.user_role', 'Desainer')->first(),
            "title" => "Detail Transaksi"
        ]);
    }
    
    public function index($id)
    {
        $transaksi = transaksi::where('id', '=', $id)->first();
        return view('transaksi.EditDetailTransaksi', [
            "transaksi" => $transaksi,
            "list_produk" => detail_produk::distinct()->get('nama_produk'),
            "list_beli" => detail_transaksi::where('transaksi_id', '=', $id)->get(),
            "list_promo" => promo::where('tanggal_mulai', '<=', $transaksi->antrian->tanggal_antrian)->where('tanggal_berakhir', '>=', $transaksi->antrian->tanggal_antrian)->get(),
            "list_kasir" => pegawai::where('user_role', 'Kasir')->whereNull('tanggal_keluar')->where('cabang_id', $transaksi->antrian->cabang_id)->get(),
            "list_operator_printer" => pegawai::where('user_role', 'Operator Printer')->whereNull('tanggal_keluar')->where('cabang_id', $transaksi->antrian->cabang_id)->get(),
            "list_desainer" => pegawai::where('user_role', 'Desainer')->whereNull('tanggal_keluar')->where('cabang_id', $transaksi->antrian->cabang_id)->get(),
            "history_kasir" => transaksi_pegawai::join('pegawais', 'transaksi_pegawais.pegawai_id', '=', 'pegawais.id')->where('transaksi_id', $id)->where('pegawais.user_role', 'Kasir')->first(),
            "history_operator_printer" => transaksi_pegawai::join('pegawais', 'transaksi_pegawais.pegawai_id', '=', 'pegawais.id')->where('transaksi_id', $id)->where('pegawais.user_role', 'Operator Printer')->first(),
            "history_desainer" => transaksi_pegawai::join('pegawais', 'transaksi_pegawais.pegawai_id', '=', 'pegawais.id')->where('transaksi_id', $id)->where('pegawais.user_role', 'Desainer')->first(),
            "title" => "Edit Detail Transaksi"
        ]);

    }

    public function fetchUkuran(Request $request)
    {
        $data['list_ukuran'] = detail_produk::select('produks.ukuran')
                                            ->join('produks', 'detail_produks.produk_id', '=', 'produks.id')
                                            ->where("nama_produk", '=', $request->nama_produk)
                                            ->groupBy('produks.ukuran')
                                            ->get();
        return response()->json($data);
    }

    public function fetchJenisKertas(Request $request)
    {
        $data['list_kertas'] = detail_produk::select('produks.jenis_kertas')
                                            ->join('produks', 'detail_produks.produk_id', '=', 'produks.id')
                                            ->where("nama_produk", '=', $request->nama_produk)
                                            ->where("produks.ukuran", '=', $request->ukuran)
                                            ->groupBy('produks.jenis_kertas')
                                            ->get();
        return response()->json($data);
    }

    public function fetchJenisTinta(Request $request)
    {
        $data['list_tinta'] = detail_produk::select('detail_produks.tinta_id', 'tintas.jenis_tinta')
                                            ->join('produks', 'detail_produks.produk_id', '=', 'produks.id')
                                            ->join('tintas', 'detail_produks.tinta_id', '=', 'tintas.id')
                                            ->where("detail_produks.nama_produk", '=', $request->nama_produk)
                                            ->where("produks.ukuran", '=', $request->ukuran)
                                            ->where("produks.jenis_kertas", '=', $request->jenis_kertas)
                                            ->groupBy('tintas.jenis_tinta')
                                            ->get();                           
        return response()->json($data);
    }
    
    public function fetchFinishing(Request $request)
    {
        $data['list_finishing'] = detail_produk::select('detail_produks.finishing_id', 'finishings.jenis_finishing')
                                                ->join('produks', 'detail_produks.produk_id', '=', 'produks.id')
                                                ->join('tintas', 'detail_produks.tinta_id', '=', 'tintas.id')
                                                ->join('finishings', 'detail_produks.finishing_id', '=', 'finishings.id')
                                                ->where("detail_produks.nama_produk", '=', $request->nama_produk)
                                                ->where("produks.ukuran", '=', $request->ukuran)
                                                ->where("produks.jenis_kertas", '=', $request->jenis_kertas)
                                                ->where("tintas.id", '=', $request->jenis_tinta)
                                                ->groupBy('detail_produks.finishing_id')
                                                ->get();                           
        return response()->json($data);
    }
    
    public function fetchDetail(Request $request)
    {
        $data['list_detail'] = detail_produk::select('produks.ukuran', 'produks.jenis_kertas', 'detail_produks.*')
                                            ->join('produks', 'detail_produks.produk_id', '=', 'produks.id')
                                            ->where('detail_produks.nama_produk', '=', $request->nama_produk)
                                            ->where('produks.ukuran', '=', $request->ukuran)
                                            ->where('produks.jenis_kertas', '=', $request->jenis_kertas)
                                            ->where('detail_produks.keterangan', '=', $request->keterangan)
                                            ->get();
        // $data = "AAA";
        return response()->json($data);
    }
    
    public function sub(Request $request)
    {
        $data['list_detail'] = detail_produk::select('produks.ukuran', 'produks.jenis_kertas', 'tintas.jenis_tinta', 'finishings.jenis_finishing', 'finishings.finishing_harga', 'detail_produks.*')
                                            ->join('produks', 'detail_produks.produk_id', '=', 'produks.id')
                                            ->join('tintas', 'detail_produks.tinta_id', '=', 'tintas.id')
                                            ->join('finishings', 'detail_produks.finishing_id', '=', 'finishings.id')
                                            ->where('detail_produks.nama_produk', '=', $request->nama_produk)
                                            ->where('produks.ukuran', '=', $request->ukuran)
                                            ->where('produks.jenis_kertas', '=', $request->jenis_kertas)
                                            ->where('tintas.id', '=', $request->jenis_tinta)
                                            ->where('finishings.id', '=', $request->jenis_finishing)
                                            ->get();

        $data['sub'] = detail_produk::select('detail_produks.*')
                                    ->join('produks', 'detail_produks.produk_id', '=', 'produks.id')
                                    ->where('detail_produks.nama_produk', '=', $request->nama_produk)
                                    ->where('produks.ukuran', '=', $request->ukuran)
                                    ->where('produks.jenis_kertas', '=', $request->jenis_kertas)
                                    ->where('detail_produks.keterangan', '=', $request->keterangan)
                                    ->get();

        if (is_null($request->promo_id)) {
            $data['promo'] = 0;
        }
        else {
            $data['promo'] = promo::select('potongan')->where('id',$request->promo_id)->get();   
        }
        return response()->json($data);
    }

    public function hitungTotal(Request $request)
    {
        if (is_null($request->promo_id)) {
            $data['promo'] = 0;
        }
        else {
            $data['promo'] = promo::select('potongan')->where('id',$request->promo_id)->get();
        }
        return response()->json($data);
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
     * @param  \App\Http\Requests\Storedetail_transaksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storedetail_transaksiRequest $request)
    {
        transaksi_pegawai::where('transaksi_id', $request->transaksi_id)->delete();
        detail_transaksi::where('transaksi_id', $request->transaksi_id)->delete();
        transaksi::where('id', $request->transaksi_id)
                 ->update(['jumlah_total_item' => 0,
                           'sub_total_transaksi' => 0,
                           'promo_id' => NULL,
                           'total' => 0
                        ]);
        if($request->kasir != NULL) {
            transaksi_pegawai::create([
                'transaksi_id' => $request->transaksi_id,
                'pegawai_id' => $request->kasir
            ]);
        }
        if($request->operator_printer != NULL) {
            transaksi_pegawai::create([
                'transaksi_id' => $request->transaksi_id,
                'pegawai_id' => $request->operator_printer
            ]);
        }
        if($request->desainer != NULL) {
            transaksi_pegawai::create([
                'transaksi_id' => $request->transaksi_id,
                'pegawai_id' => $request->desainer
            ]);
        }
        $count = count($request->input('id_detail_produk'));
        $validatedData = $request->validate([
            'sub_total_transaksi' => 'required',
            'promo_id' => 'nullable',
            'total' => 'required',
        ]);
        $item = 0;
        for($i = 0; $i < $count; $i++) {
            $detail_produk = detail_produk::where("id_detail_produk", '=', $request->id_detail_produk[$i])->first();
            $validatedData['transaksi_id'] = $request->transaksi_id;
            $validatedData['detail_produk_id'] = $detail_produk->id;
            $validatedData['harga'] = $request->harga[$i];
            $validatedData['jumlah_produk'] = $request->quantity[$i];
            $validatedData['harga_finishing'] = $request->harga_finishing[$i];
            $validatedData['diskon'] = $request->diskon[$i];
            $validatedData['harga_custom'] = $request->harga_custom[$i];
            $validatedData['custom'] = $request->custom[$i];
            $validatedData['custom_panjang'] = $request->custom_panjang[$i];
            $validatedData['custom_lebar'] = $request->custom_lebar[$i];
            $validatedData['sub_total'] = $request->sub_total[$i];

            $item += $request->quantity[$i];
        
            detail_transaksi::create($validatedData);
        }
        transaksi::where('id', $request->transaksi_id)
                 ->update(['jumlah_total_item' => $item,
                           'sub_total_transaksi' => $validatedData['sub_total_transaksi'],
                           'promo_id' => $validatedData['promo_id'],
                           'total' => $validatedData['total']
                        ]);

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/transaksi/'.$request->transaksi_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\detail_transaksi  $detail_transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(detail_transaksi $detail_transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\detail_transaksi  $detail_transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(detail_transaksi $detail_transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatedetail_transaksiRequest  $request
     * @param  \App\Models\detail_transaksi  $detail_transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Updatedetail_transaksiRequest $request, detail_transaksi $detail_transaksi)
    {
        $validatedData = $request->validate([
            'sub_total_transaksi' => 'required',
            'promo_id' => 'nullable',
            'total' => 'required',
        ]);
        
        transaksi::where('id', $request->id)
                 ->update(['sub_total_transaksi' => $validatedData['sub_total_transaksi'] ,
                           'promo_id' => $validatedData['promo_id'],
                           'total' => $validatedData['total']
                 ]);

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/transaksi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\detail_transaksi  $detail_transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        detail_transaksi::destroy($request->id);

        $detail_transaksi = detail_transaksi::where('transaksi_id', $request->transaksi)->get();
        $transaksi = transaksi::where('id', $request->transaksi)->first();

        $jumlah_total_item = $detail_transaksi->sum('jumlah_produk');
        $sub_total_transaksi = $detail_transaksi->sum('sub_total');

        if (is_null($transaksi->promo_id)) {
            $total = $detail_transaksi->sum('sub_total') * (1 - ($transaksi->diskon / 100));
        }
        else {
            $total = $detail_transaksi->sum('sub_total') * (1 - ($transaksi->diskon / 100)) * (1 - ($transaksi->promo->potongan / 100));
        }
        

        transaksi::where('id', $request->transaksi)
                 ->update(['sub_total_transaksi' => $sub_total_transaksi,
                           'jumlah_total_item' => $jumlah_total_item,
                           'total' => $total
                 ]);

        return redirect('/transaksi/'.$request->transaksi)->with('success', 'Produk Berhasil Dihapus');

        // dd($sub_total_transaksi, $jumlah_total_item, $total);
    }
}
