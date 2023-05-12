<?php

namespace App\Http\Controllers;

use App\Models\detail_transaksi;
use App\Http\Requests\Storedetail_transaksiRequest;
use App\Http\Requests\Updatedetail_transaksiRequest;
use App\Models\detail_finishing;
use App\Models\detail_produk;
use App\Models\detail_produk_bahan;
use App\Models\kartu_stok_bahan;
use App\Models\kartu_stok_tinta;
use App\Models\kategori;
use App\Models\transaksi;
use App\Models\promo;
use App\Models\pegawai;
use App\Models\penggunaan_bahan;
use App\Models\penggunaan_tinta;
use App\Models\status_transaksi;
use App\Models\transaksi_pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DetailTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexView($id)
    {
        if (Auth::guard('user')->check()) {
            $transaksi = transaksi::where('id', '=', $id)->first();
            return view('transaksi.DetailTransaksi', [
                "transaksi" => $transaksi,
                "list_beli" => detail_transaksi::where('transaksi_id', '=', $id)->get(),
                "history_kasir" => transaksi_pegawai::join('pegawais', 'transaksi_pegawais.pegawai_id', '=', 'pegawais.id')->where('transaksi_id', $id)->where('pegawais.user_role', 'Kasir')->first(),
                "history_operator_printer" => transaksi_pegawai::join('pegawais', 'transaksi_pegawais.pegawai_id', '=', 'pegawais.id')->where('transaksi_id', $id)->where('pegawais.user_role', 'Operator Printer')->first(),
                "history_desainer" => transaksi_pegawai::join('pegawais', 'transaksi_pegawais.pegawai_id', '=', 'pegawais.id')->where('transaksi_id', $id)->where('pegawais.user_role', 'Desainer')->first(),
                // "list_status" => status_transaksi::join('pegawais', 'status_transaksis.pegawai_id', '=', 'pegawais.id')->where('transaksi_id', $transaksi->id)->select('status_transaksis.*', 'pegawais.nama_lengkap', 'pegawais.user_role')->get(),
                "list_status" => status_transaksi::where('transaksi_id', $transaksi->id)->get(),
                "title" => "Detail Transaksi"
            ]);
        }
        else if (Auth::guard('pelanggan')->check()) {
            $transaksi = transaksi::where('id', $id)->first();
            if($transaksi->antrian->pelanggan_id == Auth::guard('pelanggan')->user()->id) {
                $detail_transaksi = detail_transaksi::join('detail_produks', 'detail_transaksis.detail_produk_id', 'detail_produks.id')
                                                    ->where('transaksi_id', $transaksi->id)
                                                    ->groupBy('detail_produks.kategori_id')
                                                    ->get();
                
                return view('transaksi.pelanggan.DetailTransaksiPelanggan', [
                    "transaksi" => $transaksi,
                    "detail_transaksi" => detail_transaksi::where('transaksi_id', $transaksi->id)->get(),
                    "list_status" => status_transaksi::where('transaksi_id', $transaksi->id)->get(),
                    "title" => "Detail Transaksi"
                ]);
            }
            else {
                abort(403);
            }
        }
    }

    public function downloadFile($id)
    {
        $nama_file = detail_transaksi::where('id',$id)->first('file_cetak');
        // dd($list_file);
        return response()->download(public_path("storage/{$nama_file->file_cetak}"));
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

    public function fetchJenisKertas(Request $request)
    {
        $data['list_kertas'] = detail_produk::select('jenis_bahan')
                                            ->where("nama_produk", '=', $request->nama_produk)
                                            ->groupBy('jenis_bahan')
                                            ->get();
        
        return response()->json($data);
    }

    public function fetchUkuran(Request $request)
    {
        $data['list_ukuran'] = detail_produk::select('ukuran')
                                            ->where("nama_produk", '=', $request->nama_produk)
                                            ->where("jenis_bahan", '=', $request->jenis_bahan)
                                            ->groupBy('ukuran')
                                            ->get();
        return response()->json($data);
    }

    public function fetchJenisTinta(Request $request)
    {
        // if (Str::contains($request->ukuran, ' x ')) {
        //     $data['list_tinta'] = detail_produk::select('detail_produks.tinta_id', 'tintas.jenis_tinta')
        //                                         ->join('produks', 'detail_produks.produk_id', '=', 'produks.id')
        //                                         ->join('tintas', 'detail_produks.tinta_id', '=', 'tintas.id')
        //                                         ->where("detail_produks.nama_produk", '=', $request->nama_produk)
        //                                         ->where(DB::raw('concat(produks.lebar," x ",produks.panjang)') , 'LIKE' , $request->ukuran)
        //                                         ->where("produks.jenis_kertas", '=', $request->jenis_kertas)
        //                                         ->groupBy('tintas.jenis_tinta')
        //                                         ->get();                           
        // }
        // else {
        //     $data['list_tinta'] = detail_produk::select('detail_produks.tinta_id', 'tintas.jenis_tinta')
        //                                         ->join('produks', 'detail_produks.produk_id', '=', 'produks.id')
        //                                         ->join('tintas', 'detail_produks.tinta_id', '=', 'tintas.id')
        //                                         ->where("detail_produks.nama_produk", '=', $request->nama_produk)
        //                                         ->where("produks.ukuran", '=', $request->ukuran)
        //                                         ->where("produks.jenis_kertas", '=', $request->jenis_kertas)
        //                                         ->groupBy('tintas.jenis_tinta')
        //                                         ->get(); 
        // }
        $data['list_tinta'] = detail_produk::select('detail_produks.tinta_id', 'tintas.jenis_tinta')
                                           ->join('tintas', 'detail_produks.tinta_id', '=', 'tintas.id')
                                           ->where("detail_produks.nama_produk", '=', $request->nama_produk)
                                           ->where("detail_produks.jenis_bahan", '=', $request->jenis_bahan)
                                           ->where("detail_produks.ukuran", '=', $request->ukuran)
                                           ->groupBy('tintas.jenis_tinta')
                                           ->get();
        return response()->json($data);
    }
    
    public function fetchFinishing(Request $request)
    {
        // if (Str::contains($request->ukuran, ' x ')) {
        //     $data['list_finishing'] = detail_produk::select('detail_produks.finishing_id', 'finishings.jenis_finishing')
        //                                             ->join('produks', 'detail_produks.produk_id', '=', 'produks.id')
        //                                             ->join('tintas', 'detail_produks.tinta_id', '=', 'tintas.id')
        //                                             ->join('finishings', 'detail_produks.finishing_id', '=', 'finishings.id')
        //                                             ->where("detail_produks.nama_produk", '=', $request->nama_produk)
        //                                             ->where(DB::raw('concat(produks.lebar," x ",produks.panjang)') , 'LIKE' , $request->ukuran)
        //                                             ->where("produks.jenis_kertas", '=', $request->jenis_kertas)
        //                                             ->where("tintas.id", '=', $request->jenis_tinta)
        //                                             ->groupBy('detail_produks.finishing_id')
        //                                             ->get();                           
        // }
        // else {
        //     $data['list_finishing'] = detail_produk::select('detail_produks.finishing_id', 'finishings.jenis_finishing')
        //                                             ->join('produks', 'detail_produks.produk_id', '=', 'produks.id')
        //                                             ->join('tintas', 'detail_produks.tinta_id', '=', 'tintas.id')
        //                                             ->join('finishings', 'detail_produks.finishing_id', '=', 'finishings.id')
        //                                             ->where("detail_produks.nama_produk", '=', $request->nama_produk)
        //                                             ->where("produks.ukuran", '=', $request->ukuran)
        //                                             ->where("produks.jenis_kertas", '=', $request->jenis_kertas)
        //                                             ->where("tintas.id", '=', $request->jenis_tinta)
        //                                             ->groupBy('detail_produks.finishing_id')
        //                                             ->get();  
        // }
        $data['list_finishing'] = detail_produk::select('detail_produks.finishing_id', 'finishings.jenis_finishing')
                                            //    ->join('tintas', 'detail_produks.tinta_id', '=', 'tintas.id')
                                               ->join('finishings', 'detail_produks.finishing_id', '=', 'finishings.id')
                                               ->where("detail_produks.nama_produk", '=', $request->nama_produk)
                                               ->where("detail_produks.jenis_bahan", '=', $request->jenis_bahan)
                                               ->where("detail_produks.ukuran", '=', $request->ukuran)
                                            //    ->where("tintas.id", '=', $request->jenis_tinta)
                                            //    ->groupBy('tintas.jenis_tinta')
                                            //    ->groupBy('finishing.jenis_finishing')
                                               ->get();
        return response()->json($data);
    }
    
    public function fetchDetail(Request $request)
    {
        // if (Str::contains($request->ukuran, ' x ')) {
        //     $data['list_detail'] = detail_produk::select('produks.ukuran', 'produks.jenis_kertas', 'detail_produks.*')
        //                                         ->join('produks', 'detail_produks.produk_id', '=', 'produks.id')
        //                                         ->where('detail_produks.nama_produk', '=', $request->nama_produk)
        //                                         ->where(DB::raw('concat(produks.lebar," x ",produks.panjang)') , 'LIKE' , $request->ukuran)
        //                                         ->where('produks.jenis_kertas', '=', $request->jenis_kertas)
        //                                         ->where("tintas.id", '=', $request->jenis_tinta)
        //                                         ->get();
        // }
        // else {
        //     $data['list_detail'] = detail_produk::select('produks.ukuran', 'produks.jenis_kertas', 'detail_produks.*')
        //                                         ->join('produks', 'detail_produks.produk_id', '=', 'produks.id')
        //                                         ->where('detail_produks.nama_produk', '=', $request->nama_produk)
        //                                         ->where(DB::raw('concat(produks.lebar," x ",produks.panjang)') , 'LIKE' , $request->ukuran)
        //                                         ->where('produks.jenis_kertas', '=', $request->jenis_kertas)
        //                                         ->where("tintas.id", '=', $request->jenis_tinta)
        //                                         ->get();
        // }
        $data = detail_produk::select('finishings.finishing_harga', 'detail_produks.*')
                             ->join('finishings', 'detail_produks.finishing_id', 'finishings.id')
                             ->where('detail_produks.nama_produk', '=', $request->nama_produk)
                             ->where('detail_produks.jenis_bahan', '=', $request->jenis_bahan)
                             ->where('detail_produks.ukuran', '=', $request->ukuran)
                            //  ->where("tintas.id", '=', $request->jenis_tinta)
                            //  ->where('finishings.id', '=', $request->jenis_finishing)
                             ->where('finishing_id', '=', $request->finishing_id)
                             ->first();
                            //  ->get();
        return response()->json($data);
    }
    
    public function sub(Request $request)
    {
        // if (Str::contains($request->ukuran, ' x ')) {
        //     $data['list_detail'] = detail_produk::select('produks.ukuran', 'produks.lebar', 'produks.panjang', 'produks.satuan', 'produks.jenis_kertas', 'tintas.jenis_tinta', 'finishings.jenis_finishing', 'finishings.finishing_harga', 'detail_produks.*')
        //                                         ->join('produks', 'detail_produks.produk_id', '=', 'produks.id')
        //                                         ->join('tintas', 'detail_produks.tinta_id', '=', 'tintas.id')
        //                                         ->join('finishings', 'detail_produks.finishing_id', '=', 'finishings.id')
        //                                         ->where('detail_produks.nama_produk', '=', $request->nama_produk)
        //                                         ->where(DB::raw('concat(produks.lebar," x ",produks.panjang)') , 'LIKE' , $request->ukuran)
        //                                         ->where('produks.jenis_kertas', '=', $request->jenis_kertas)
        //                                         ->where('tintas.id', '=', $request->jenis_tinta)
        //                                         ->where('finishings.id', '=', $request->jenis_finishing)
        //                                         ->get();
        // }
        // else {
        //     $data['list_detail'] = detail_produk::select('produks.ukuran', 'produks.jenis_kertas', 'tintas.jenis_tinta', 'finishings.jenis_finishing', 'finishings.finishing_harga', 'detail_produks.*')
        //                                         ->join('produks', 'detail_produks.produk_id', '=', 'produks.id')
        //                                         ->join('tintas', 'detail_produks.tinta_id', '=', 'tintas.id')
        //                                         ->join('finishings', 'detail_produks.finishing_id', '=', 'finishings.id')
        //                                         ->where('detail_produks.nama_produk', '=', $request->nama_produk)
        //                                         ->where('produks.ukuran', '=', $request->ukuran)
        //                                         ->where('produks.jenis_kertas', '=', $request->jenis_kertas)
        //                                         ->where('tintas.id', '=', $request->jenis_tinta)
        //                                         ->where('finishings.id', '=', $request->jenis_finishing)
        //                                         ->get();
        // }

        $data['list_detail'] = detail_produk::select('finishings.jenis_finishing', 'finishings.finishing_harga', 'detail_produks.*')
                                            // ->join('tintas', 'detail_produks.tinta_id', '=', 'tintas.id')
                                            ->join('finishings', 'detail_produks.finishing_id', '=', 'finishings.id')
                                            ->where('detail_produks.nama_produk', '=', $request->nama_produk)
                                            ->where('detail_produks.jenis_bahan', '=', $request->jenis_bahan)
                                            ->where('detail_produks.ukuran', '=', $request->ukuran)
                                            // ->where("tintas.id", '=', $request->jenis_tinta)
                                            ->where('finishings.id', '=', $request->jenis_finishing)
                                            ->get();

        // $detail_produk = detail_produk::where('id', $data['list_detail']->id)->first();

        // $bahan = penggunaan_bahan::where('detail_produk_id', $detail_produk->id)->first();

        // $stok_bahan = kartu_stok_bahan::where('produk_id', $bahan->produk_id)->latest()->first();

        // if ($bahan->satuan == "lembar") {
        //     if ($bahan->jumlah_pemakaian*$request->jumlah_produk)
        // }

        // $data['sub'] = detail_produk::select('detail_produks.*')
        //                             ->join('produks', 'detail_produks.produk_id', '=', 'produks.id')
        //                             ->where('detail_produks.nama_produk', '=', $request->nama_produk)
        //                             ->where('produks.ukuran', '=', $request->ukuran)
        //                             ->where('produks.jenis_kertas', '=', $request->jenis_kertas)
        //                             ->where('detail_produks.keterangan', '=', $request->keterangan)
        //                             ->get();

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

    public function detailProdukTransaksi($transaksi_id, $detail_transaksi_id) {
        if (Auth::guard('user')->check()) {
            if (Auth::user()->user_role == 'Admin') {
                $transaksi = transaksi::where('id', $transaksi_id)->first();
                $detail_transaksi = detail_transaksi::where('id', $detail_transaksi_id)->first();
                return view('transaksi.detail_transaksi.DetailProdukTransaksiPegawai', [
                    "transaksi" => $transaksi,
                    "detail_transaksi" => $detail_transaksi,
                    "title" => "Detail Produk Transaksi"
                ]);
            }
            else {
                $transaksi = transaksi::where('id', $transaksi_id)->first();
                $detail_transaksi = detail_transaksi::where('id', $detail_transaksi_id)->first();
                if($transaksi->antrian->cabang_id == Auth::guard('user')->user()->cabang_id) {
                    return view('transaksi.detail_transaksi.DetailProdukTransaksiPegawai', [
                        "transaksi" => $transaksi,
                        "detail_transaksi" => $detail_transaksi,
                        "title" => "Detail Produk Transaksi"
                    ]);
                }
                else {
                    abort(403);
                }
            }
        }
        else if (Auth::guard('pelanggan')->check()) {
            $transaksi = transaksi::where('id', $transaksi_id)->first();
            // if($penawaran->pelanggan_id == Auth::guard('pelanggan')->user()->id) {
            //     return view('penawaran.pelanggan.DetailPenawaranPelanggan', [
            //         "penawaran" => $penawaran,
            //         "detail_penawaran" => detail_penawaran::where('penawaran_id', $penawaran->id)->get(),
            //         "list_status" => status_penawaran::where('penawaran_id', $penawaran->id)->get(),
            //         "title" => "Detail Penawaran"
            //     ]);
            // }
            // else {
            //     abort(403);
            // }
        }
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
        if ($request->input('id_detail_produk') != null) {
            $count = count($request->input('id_detail_produk'));
        }
        else {
            $count = 0;
        }
        $validatedData = $request->validate([
            'sub_total_transaksi' => 'required',
            'promo_id' => 'nullable',
            'total' => 'required',
        ]);
        $item = 0;
        $waktu = 0;
        for($i = 0; $i < $count; $i++) {
            $detail_produk = detail_produk::where("id_detail_produk", '=', $request->id_detail_produk[$i])->first();
            $validatedData['transaksi_id'] = $request->transaksi_id;
            $validatedData['detail_produk_id'] = $detail_produk->id;
            $validatedData['jenis_bahan_input'] = $request->jenis_bahan_input[$i];
            $validatedData['ukuran_input'] = $request->ukuran_input[$i];
            $validatedData['finishing_input'] = $request->finishing_input[$i];
            $validatedData['warna_input'] = $request->warna_input[$i];
            $validatedData['harga'] = $request->harga[$i];
            $validatedData['jumlah_produk'] = $request->quantity[$i];
            $validatedData['harga_finishing'] = $request->harga_finishing[$i];
            $validatedData['diskon'] = $request->diskon[$i];
            $validatedData['harga_custom'] = $request->harga_custom[$i];
            $validatedData['custom'] = $request->custom[$i];
            $validatedData['sub_total'] = $request->sub_total[$i];
            $validatedData['persen_cyan'] = $request->persen_cyan[$i];
            $validatedData['persen_magenta'] = $request->persen_magenta[$i];
            $validatedData['persen_yellow'] = $request->persen_yellow[$i];
            $validatedData['persen_black'] = $request->persen_black[$i];

            $item += $request->quantity[$i];
        
            detail_transaksi::create($validatedData);

            $transaksi = transaksi::where('id', $request->transaksi_id)->first();

            $temp = detail_transaksi::join('transaksis', 'detail_transaksis.transaksi_id', 'transaksis.id')
                                    ->join('antrians', 'transaksis.antrian_id', 'antrians.id')
                                    ->join('detail_produks', 'detail_transaksis.detail_produk_id', 'detail_produks.id')
                                    ->join('kategoris', 'detail_produks.kategori_id', 'kategoris.id')
                                    ->where('transaksis.status_pengerjaan', '!=', 'Selesai')
                                    ->where('transaksis.status_pengerjaan', '!=', 'Batal')
                                    ->where('antrians.created_at', '<=', $transaksi->antrian->created_at)
                                    ->where('antrians.cabang_id', $transaksi->antrian->cabang_id)
                                    ->where('detail_produks.kategori_id', $detail_produk->kategori_id)
                                    ->selectRaw('SUM(detail_transaksis.jumlah_produk) AS jumlah')
                                    ->first();

            $temp_waktu = $temp->jumlah*$detail_produk->kategori->estimasi_durasi;
            
            if ($waktu < $temp_waktu) {
                $waktu = $temp_waktu;
            }
        }

        $today = Carbon::today();
        $max_time = Carbon::create($today->year, $today->month, $today->day, 21, 30, 0);

        if (Carbon::now()->addMinutes($waktu) <= $max_time) {
            $estimasi_selesai = Carbon::now()->addMinutes($waktu);
        }
        else {
            $diff = Carbon::now()->addMinutes($waktu)->diff($max_time);
            $estimasi_selesai = Carbon::create($today->year, $today->month, $today->day, 8, 0, 0)
                                      ->addYears($diff->y)
                                      ->addMonths($diff->m)
                                      ->addDays($diff->d)
                                      ->addHours($diff->h)
                                      ->addMinutes($diff->i)
                                      ->addSeconds($diff->s);
        }

        transaksi::where('id', $request->transaksi_id)
                 ->update(['jumlah_total_item' => $item,
                           'sub_total_transaksi' => $validatedData['sub_total_transaksi'],
                           'promo_id' => $validatedData['promo_id'],
                           'total' => $validatedData['total'],
                           'estimasi_selesai' => $estimasi_selesai
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
