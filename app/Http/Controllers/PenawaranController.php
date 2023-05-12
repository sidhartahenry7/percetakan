<?php

namespace App\Http\Controllers;

use App\Models\penawaran;
use App\Http\Requests\StorepenawaranRequest;
use App\Http\Requests\UpdatepenawaranRequest;
use App\Models\antrian;
use App\Models\cart;
use App\Models\detail_penawaran;
use App\Models\detail_produk;
use App\Models\detail_transaksi;
use App\Models\kategori;
use App\Models\pegawai;
use App\Models\promo;
use App\Models\status_penawaran;
use App\Models\status_transaksi;
use App\Models\transaksi;
use App\Models\transaksi_pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PenawaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penawaran.pelanggan.ListPenawaranPelanggan', [
            "list_penawaran" => penawaran::where('pelanggan_id', Auth::guard('pelanggan')->user()->id)->where('status_penawaran', '!=', 'Selesai')->where('status_penawaran', '!=', 'Batal')->get(),
            "title" => "Daftar Penawaran"
        ]);
    }
    
    public function indexHistory()
    {
        if (Auth::guard('user')->check()) {
            if (Auth::user()->user_role == 'Admin') {
                return view('penawaran.pegawai.HistoryPenawaranPegawai', [
                    "list_penawaran" => penawaran::where('status_penawaran', 'Selesai')->orWhere('status_penawaran', 'Batal')->get(),
                    "title" => "History Penawaran"
                ]);
            }
            else {
                return view('penawaran.pegawai.HistoryPenawaranPegawai', [
                    "list_penawaran" => penawaran::where('status_penawaran', 'Selesai')->orWhere('status_penawaran', 'Batal')->where('cabang_id', Auth::user()->cabang_id)->get(),
                    "title" => "History Penawaran"
                ]);
            }
        }
        else if (Auth::guard('pelanggan')->check()) {
            return view('penawaran.pelanggan.HistoryPenawaranPelanggan', [
                "list_penawaran" => penawaran::where('status_penawaran', 'Selesai')->orWhere('status_penawaran', 'Batal')->where('pelanggan_id', Auth::guard('pelanggan')->user()->id)->get(),
                "title" => "History Penawaran"
            ]);
        }
    }

    public function detailPenawaran($id) {
        if (Auth::guard('user')->check()) {
            if (Auth::user()->user_role == 'Admin') {
                $penawaran = penawaran::where('id', $id)->first();
                if($penawaran->status_penawaran != 'Penawaran dibuat') {
                    return view('penawaran.pegawai.DetailPenawaranPegawai', [
                        "penawaran" => $penawaran,
                        "detail_penawaran" => detail_penawaran::where('penawaran_id', $penawaran->id)->get(),
                        "jumlah_item" => detail_penawaran::where('penawaran_id', $penawaran->id)->count('id'),
                        "list_status" => status_penawaran::where('penawaran_id', $penawaran->id)->get(),
                        "title" => "Detail Penawaran"
                    ]);
                }
                else {
                    return view('penawaran.pegawai.DetailPenawaranDibuatPegawai', [
                        "penawaran" => $penawaran,
                        "detail_penawaran" => detail_penawaran::where('penawaran_id', $penawaran->id)->get(),
                        "jumlah_item" => detail_penawaran::where('penawaran_id', $penawaran->id)->count('id'),
                        "list_status" => status_penawaran::where('penawaran_id', $penawaran->id)->get(),
                        "title" => "Detail Penawaran"
                    ]);
                }
            }
            else {
                $penawaran = penawaran::where('id', $id)->first();
                if($penawaran->cabang_id == Auth::guard('user')->user()->cabang_id) {
                    if($penawaran->status_penawaran != 'Penawaran dibuat') {
                        return view('penawaran.pegawai.DetailPenawaranPegawai', [
                            "penawaran" => $penawaran,
                            "detail_penawaran" => detail_penawaran::where('penawaran_id', $penawaran->id)->get(),
                            "jumlah_item" => detail_penawaran::where('penawaran_id', $penawaran->id)->count('id'),
                            "list_status" => status_penawaran::where('penawaran_id', $penawaran->id)->get(),
                            "title" => "Detail Penawaran"
                        ]);
                    }
                    else {
                        return view('penawaran.pegawai.DetailPenawaranDibuatPegawai', [
                            "penawaran" => $penawaran,
                            "detail_penawaran" => detail_penawaran::where('penawaran_id', $penawaran->id)->get(),
                            "jumlah_item" => detail_penawaran::where('penawaran_id', $penawaran->id)->count('id'),
                            "list_status" => status_penawaran::where('penawaran_id', $penawaran->id)->get(),
                            "title" => "Detail Penawaran"
                        ]);
                    }
                }
                else {
                    abort(403);
                }
            }
        }
        else if (Auth::guard('pelanggan')->check()) {
            $penawaran = penawaran::where('id', $id)->first();
            if($penawaran->pelanggan_id == Auth::guard('pelanggan')->user()->id) {
                return view('penawaran.pelanggan.DetailPenawaranPelanggan', [
                    "penawaran" => $penawaran,
                    "detail_penawaran" => detail_penawaran::where('penawaran_id', $penawaran->id)->get(),
                    "list_status" => status_penawaran::where('penawaran_id', $penawaran->id)->get(),
                    "title" => "Detail Penawaran"
                ]);
            }
            else {
                return redirect('/dashboard');
            }
        }
    }

    public function downloadFile($id)
    {
        $nama_file = detail_penawaran::where('id',$id)->first('file_cetak');
        // dd($list_file);
        return response()->download(public_path("storage/{$nama_file->file_cetak}"));
    }

    public function listPenawaran() {
        if (Auth::user()->user_role == 'Admin') {
            return view('penawaran.pegawai.ListPenawaranPegawai', [
                "list_penawaran" => penawaran::where('status_penawaran', '!=', 'Selesai')->where('status_penawaran', '!=', 'Batal')->get(),
                "title" => "Daftar Penawaran"
            ]);
        }
        else {
            return view('penawaran.pegawai.ListPenawaranPegawai', [
                "list_penawaran" => penawaran::where('status_penawaran', '!=', 'Selesai')->where('status_penawaran', '!=', 'Batal')->where('cabang_id', Auth::user()->cabang_id)->get(),
                "title" => "Daftar Penawaran"
            ]);
        }
    }

    public function downloadBuktiPembayaran($id)
    {
        $nama_file = penawaran::where('id', $id)->first('bukti_pembayaran');
        return response()->download(public_path("storage/{$nama_file->bukti_pembayaran}"));
    }

    public function fetchPegawai(Request $request)
    {
        $penawaran = penawaran::where("id", $request->penawaran_id)->first();

        $data['list_kasir'] = pegawai::where('cabang_id', $penawaran->cabang_id)
                                     ->where('user_role', 'Kasir')
                                     ->where('deleted', 0)
                                     ->select('pegawais.*')
                                     ->get();

        $data['list_operator_printer'] = pegawai::where('cabang_id', $penawaran->cabang_id)
                                                ->where('user_role', 'Operator Printer')
                                                ->where('deleted', 0)
                                                ->select('pegawais.*')
                                                ->get();
        
        $data['list_desainer'] = pegawai::where('cabang_id', $penawaran->cabang_id)
                                        ->where('user_role', 'Desainer')
                                        ->where('deleted', 0)
                                        ->select('pegawais.*')
                                        ->get();
        // dd($data);
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
     * @param  \App\Http\Requests\StorepenawaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepenawaranRequest $request)
    {
        if ($request->input('keranjang_id') != NULL) {
            $id_penawaran = penawaran::CreateID();
            $validatedData = $request->validate([
                // 'pelanggan_id' => 'required',
                'cabang_id' => 'required',
                'jumlah_total_item' => 'required',
                // 'sub_total_transaksi' => 'required',
                'promo_id' => '',
                // 'total' => 'required',
            ]);
            $validatedData['pelanggan_id'] = Auth::guard('pelanggan')->user()->id;
            $validatedData['id_penawaran'] = $id_penawaran;
            $validatedData['tanggal_penawaran'] = Carbon::now();
            $validatedData['status_penawaran'] = "Penawaran dibuat";
            
            penawaran::create($validatedData);

            $penawaran = penawaran::where('id_penawaran', $id_penawaran)->first();
            
            $statusPenawaran['penawaran_id'] = $penawaran->id;
            $statusPenawaran['pelanggan_id'] = Auth::guard('pelanggan')->user()->id;
            $statusPenawaran['tanggal_status'] = Carbon::now();
            $statusPenawaran['status_penawaran'] = "Penawaran dibuat";

            status_penawaran::create($statusPenawaran);

            foreach ($request->keranjang_id as $res) {
                $cart = cart::where('id', $res)->first();

                // if ($cart->detail_produk->status_finishing == 0) {
                //     $harga_finishing = $cart->detail_produk->finishing->finishing_harga;
                // }
                // else if ($cart->detail_produk->status_finishing == 1) {
                //     $harga_finishing = $cart->detail_produk->finishing->finishing_harga*$cart->jumlah_produk;
                // }

                $detailPenawaran['penawaran_id'] = $penawaran->id;
                $detailPenawaran['kategori_id'] = $cart->kategori_id;
                $detailPenawaran['jenis_bahan_input'] = $cart->jenis_bahan_input;
                $detailPenawaran['ukuran_input'] = $cart->ukuran_input;
                $detailPenawaran['finishing_input'] = $cart->finishing_input;
                $detailPenawaran['warna_input'] = $cart->warna_input;
                // $detailPenawaran['detail_produk_id'] = $cart->detail_produk_id;
                // $detailPenawaran['harga'] = $cart->detail_produk->harga;
                $detailPenawaran['jumlah_produk'] = $cart->jumlah_produk;
                // $detailPenawaran['harga_finishing'] = $harga_finishing;
                // $detailPenawaran['diskon'] = $cart->detail_produk->diskon;
                $detailPenawaran['custom'] = $cart->custom;
                $detailPenawaran['file_cetak'] = $cart->file_cetak;
                // $detailPenawaran['sub_total'] = ($cart->detail_produk->harga*$cart->jumlah_produk+$harga_finishing)*(1-($cart->detail_produk->diskon/100));

                detail_penawaran::create($detailPenawaran);

                $cart = cart::where('id', $res)->first();

                cart::destroy($cart->id);
            }

            return redirect('/shopping-cart')->with('success', 'Penawaran berhasil dibuat!');
        }
        else {
            return redirect('/shopping-cart')->with('error', 'Pilih barang terlebih dahulu!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function show(penawaran $penawaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function edit(penawaran $penawaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepenawaranRequest  $request
     * @param  \App\Models\penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepenawaranRequest $request, penawaran $penawaran)
    {
        $penawarans = penawaran::where('id', $penawaran->id)->first();
        // $sub_total_transaksi = 0;
        // $total = 0;
        if (Auth::guard('user')->check()) {
            if ($penawarans->status_penawaran == 'Penawaran dibuat') {
                // if ($request->input('detail_penawaran_id') != null) {
                //     $count = count($request->input('detail_penawaran_id'));
                // }
                // else {
                //     $count = 0;
                // }
                // for($i = 0; $i < $count; $i++) {
                //     $detail_penawaran = detail_penawaran::where('id', $request->detail_penawaran_id[$i])->first();

                //     $validatedData['persen_cyan'] = $request->persen_cyan[$i];
                //     $validatedData['persen_magenta'] = $request->persen_magenta[$i];
                //     $validatedData['persen_yellow'] = $request->persen_yellow[$i];
                //     $validatedData['persen_black'] = $request->persen_black[$i];
                //     $validatedData['harga_custom'] = $request->harga_custom[$i];
                //     $validatedData['sub_total'] = $detail_penawaran->sub_total + $request->harga_custom[$i];
                //     $sub_total_transaksi += $validatedData['sub_total'];

                //     detail_penawaran::where('id', $detail_penawaran->id)
                //                     ->update($validatedData);
                // }
                
                $dataStatus['penawaran_id'] = $penawaran->id; 
                $dataStatus['tanggal_status'] = Carbon::now();
                $dataStatus['status_penawaran'] = 'Menunggu pembayaran';
                $dataStatus['pegawai_id'] = Auth::user()->id;

                status_penawaran::create($dataStatus);

                // if ($penawarans->promo_id == NULL) {
                //     $potongan = 0;
                // }
                // else {
                //     $promo = promo::where('id', $penawarans->promo_id)->first();
                //     $potongan = $promo->potongan;
                // }
                // $total = $sub_total_transaksi*(1-($potongan/100));
                // $dataPenawaran['sub_total_transaksi'] = $sub_total_transaksi; 
                // $dataPenawaran['total'] = $total;
                $dataPenawaran['status_penawaran'] = 'Menunggu pembayaran';

                penawaran::where('id', $penawaran->id)
                         ->update($dataPenawaran);
            }
            else if ($penawarans->status_penawaran == 'Menunggu konfirmasi pembayaran') {
                if ($request->status_terima == 'Terima') {
                    $dataStatus['penawaran_id'] = $penawaran->id; 
                    $dataStatus['tanggal_status'] = Carbon::now();
                    $dataStatus['status_penawaran'] = 'Selesai';
                    $dataStatus['pegawai_id'] = Auth::user()->id;
    
                    status_penawaran::create($dataStatus);

                    $dataPenawaran['status_penawaran'] = 'Selesai';

                    penawaran::where('id', $penawaran->id)
                             ->update($dataPenawaran);

                    $day = Carbon::today();
                    $time = Carbon::now();
                    $max_time = Carbon::create($time->year, $time->month, $time->day, 21, 30, 0);
                    
                    if ($time <= $max_time) {
                        $jumlah_antrian = antrian::whereDate('tanggal_antrian', '=', $day)->where('cabang_id', '=', $penawarans->cabang_id)->max('nomor_antrian');

                        if ($jumlah_antrian >= 99) {
                            $id_antrian = date('Ymd')."/".$penawarans->cabang->nama_cabang."/".($jumlah_antrian + 1);
                        }
                        else if ($jumlah_antrian >= 9) {
                            $id_antrian = date('Ymd')."/".$penawarans->cabang->nama_cabang."/0".($jumlah_antrian + 1);
                        }
                        else if ($jumlah_antrian >= 1){
                            $id_antrian = date('Ymd')."/".$penawarans->cabang->nama_cabang."/00".($jumlah_antrian + 1);
                        }
                        else {
                            $id_antrian = date('Ymd')."/".$penawarans->cabang->nama_cabang."/00".(1);
                        }

                        $dataAntrian['id_antrian'] = $id_antrian;
                        $dataAntrian['tanggal_antrian'] = $time;
                        $dataAntrian['nomor_antrian'] = $jumlah_antrian+1;
                    }
                    else {
                        $jumlah_antrian = antrian::whereDate('tanggal_antrian', '=', Carbon::today()->addDays(1))->where('cabang_id', '=', $penawarans->cabang_id)->max('nomor_antrian');
                        
                        if ($jumlah_antrian >= 99) {
                            $id_antrian = date('Ymd', strtotime(Carbon::today()->addDays(1)))."/".$penawarans->cabang->nama_cabang."/".($jumlah_antrian + 1);
                        }
                        else if ($jumlah_antrian >= 9) {
                            $id_antrian = date('Ymd', strtotime(Carbon::today()->addDays(1)))."/".$penawarans->cabang->nama_cabang."/0".($jumlah_antrian + 1);
                        }
                        else if ($jumlah_antrian >= 1){
                            $id_antrian = date('Ymd', strtotime(Carbon::today()->addDays(1)))."/".$penawarans->cabang->nama_cabang."/00".($jumlah_antrian + 1);
                        }
                        else {
                            $id_antrian = date('Ymd', strtotime(Carbon::today()->addDays(1)))."/".$penawarans->cabang->nama_cabang."/00".(1);
                        }

                        $dataAntrian['id_antrian'] = $id_antrian;
                        $dataAntrian['tanggal_antrian'] = Carbon::create($time->year, $time->month, $time->day+1, 8, 0, 0);
                        $dataAntrian['nomor_antrian'] = $jumlah_antrian+1;
                    }
                    $dataAntrian['cabang_id'] = $penawarans->cabang_id;
                    $dataAntrian['pelanggan_id'] = $penawarans->pelanggan_id;

                    antrian::create($dataAntrian);

                    $antrian = antrian::where('id_antrian', $dataAntrian['id_antrian'])->first();

                    $dataTransaksi['id_transaksi'] = transaksi::CreateID();
                    $dataTransaksi['penawaran_id'] = $penawarans->id;
                    $dataTransaksi['antrian_id'] = $antrian->id;
                    $dataTransaksi['jumlah_total_item'] = $penawarans->jumlah_total_item;
                    $dataTransaksi['sub_total_transaksi'] = $penawarans->sub_total_transaksi;
                    $dataTransaksi['promo_id'] = $penawarans->promo_id;
                    $dataTransaksi['total'] = $penawarans->total;
                    $dataTransaksi['status_pengerjaan'] = 'Belum dikerjakan';
                    $dataTransaksi['status_transaksi'] = 'Online';
                    $dataTransaksi['bukti_pembayaran'] = $penawarans->bukti_pembayaran;

                    transaksi::create($dataTransaksi);

                    $transaksi = transaksi::where('id_transaksi', $dataTransaksi['id_transaksi'])->first();

                    $detail_penawaran = detail_penawaran::where('penawaran_id', $penawaran->id)->get();

                    $waktu = 0;

                    foreach ($detail_penawaran as $detail) {
                        $dataDetailTransaksi['transaksi_id'] = $transaksi->id;
                        $dataDetailTransaksi['jenis_bahan_input'] = $detail->jenis_bahan_input;
                        $dataDetailTransaksi['ukuran_input'] = $detail->ukuran_input;
                        $dataDetailTransaksi['finishing_input'] = $detail->finishing_input;
                        $dataDetailTransaksi['warna_input'] = $detail->warna_input;
                        $dataDetailTransaksi['detail_produk_id'] = $detail->detail_produk_id;
                        $dataDetailTransaksi['harga'] = $detail->harga;
                        $dataDetailTransaksi['jumlah_produk'] = $detail->jumlah_produk;
                        $dataDetailTransaksi['persen_cyan'] = $detail->persen_cyan;
                        $dataDetailTransaksi['persen_magenta'] = $detail->persen_magenta;
                        $dataDetailTransaksi['persen_yellow'] = $detail->persen_yellow;
                        $dataDetailTransaksi['persen_black'] = $detail->persen_black;
                        $dataDetailTransaksi['harga_finishing'] = $detail->harga_finishing;
                        $dataDetailTransaksi['diskon'] = $detail->diskon;
                        $dataDetailTransaksi['harga_custom'] = $detail->harga_custom;
                        $dataDetailTransaksi['custom'] = $detail->custom;
                        $dataDetailTransaksi['file_cetak'] = $detail->file_cetak;
                        $dataDetailTransaksi['sub_total'] = $detail->sub_total;

                        detail_transaksi::create($dataDetailTransaksi);

                        $temp = detail_transaksi::join('transaksis', 'detail_transaksis.transaksi_id', 'transaksis.id')
                                                ->join('antrians', 'transaksis.antrian_id', 'antrians.id')
                                                ->join('detail_produks', 'detail_transaksis.detail_produk_id', 'detail_produks.id')
                                                ->join('kategoris', 'detail_produks.kategori_id', 'kategoris.id')
                                                ->where('transaksis.status_pengerjaan', '!=', 'Selesai')
                                                ->where('transaksis.status_pengerjaan', '!=', 'Batal')
                                                ->where('antrians.created_at', '<=', $transaksi->antrian->created_at)
                                                ->where('antrians.cabang_id', $transaksi->antrian->cabang_id)
                                                ->where('detail_produks.kategori_id', $detail->detail_produk->kategori_id)
                                                ->selectRaw('SUM(detail_transaksis.jumlah_produk) AS jumlah')
                                                ->first();

                        $kategori = kategori::where('id', $detail->detail_produk->kategori_id)->first();

                        $temp_waktu = $temp->jumlah*$kategori->estimasi_durasi;

                        if ($waktu < $temp_waktu) {
                            $waktu = $temp_waktu;
                        }
                    }

                    if (Carbon::now()->addMinutes($waktu) <= $max_time) {
                        $estimasi_selesai = Carbon::now()->addMinutes($waktu);
                    }
                    else {
                        $diff = Carbon::now()->addMinutes($waktu)->diff($max_time);
                        $estimasi_selesai = Carbon::create($time->year, $time->month, $time->day, 8, 0, 0)
                                                  ->addYears($diff->y)
                                                  ->addMonths($diff->m)
                                                  ->addDays($diff->d)
                                                  ->addHours($diff->h)
                                                  ->addMinutes($diff->i)
                                                  ->addSeconds($diff->s);
                    }

                    transaksi::where('id', $transaksi->id)
                             ->update(['estimasi_selesai' => $estimasi_selesai]);

                    if($request->kasir_id != NULL) {
                        transaksi_pegawai::create([
                            'transaksi_id' => $transaksi->id,
                            'pegawai_id' => $request->kasir_id
                        ]);
                    }
                    if($request->operator_id != NULL) {
                        transaksi_pegawai::create([
                            'transaksi_id' => $transaksi->id,
                            'pegawai_id' => $request->operator_id
                        ]);
                    }
                    if($request->desainer_id != NULL) {
                        transaksi_pegawai::create([
                            'transaksi_id' => $transaksi->id,
                            'pegawai_id' => $request->desainer_id
                        ]);
                    }

                    $dataStatusTransaksi['transaksi_id'] = $transaksi->id;
                    if ($time <= $max_time) {
                        $dataStatusTransaksi['tanggal_status'] = Carbon::now();
                    }
                    else {
                        $dataStatusTransaksi['tanggal_status'] = Carbon::create(Carbon::now()->year, Carbon::now()->month, Carbon::now()->day+1, 8, 0, 0);
                    }
                    $dataStatusTransaksi['status_pengerjaan'] = 'Transaksi dibuat';
                    $dataStatusTransaksi['pegawai_id'] = Auth::user()->id;

                    status_transaksi::create($dataStatusTransaksi);
                }
                else if ($request->status_terima == 'Tolak') {
                    $dataStatus = $request->validate([
                        'notes' => 'required',
                    ]);
                    $dataStatus['penawaran_id'] = $penawaran->id; 
                    $dataStatus['tanggal_status'] = Carbon::now();
                    $dataStatus['status_penawaran'] = 'Batal';
                    $dataStatus['pegawai_id'] = Auth::user()->id;

                    status_penawaran::create($dataStatus);

                    $dataPenawaran['status_penawaran'] = 'Batal';

                    penawaran::where('id', $penawaran->id)
                             ->update($dataPenawaran);
                }
            }
            return redirect('/list-penawaran')->with('success', 'Penyimpanan Berhasil');
        }
        else if (Auth::guard('pelanggan')->check()) {
            if ($penawarans->status_penawaran == 'Menunggu pembayaran') {
                $validatedData = $request->validate([
                    'bukti_pembayaran' => 'required|image'
                ]);
                if ($request->file('bukti_pembayaran')) {
                    $validatedData['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran');
                }
                $validatedData['status_penawaran'] = 'Menunggu konfirmasi pembayaran';

                penawaran::where('id', $penawaran->id)
                         ->update($validatedData);

                $dataStatus['penawaran_id'] = $penawaran->id; 
                $dataStatus['tanggal_status'] = Carbon::now();
                $dataStatus['status_penawaran'] = 'Menunggu konfirmasi pembayaran';
                $dataStatus['pelanggan_id'] = Auth::guard('pelanggan')->user()->id;

                status_penawaran::create($dataStatus);

                return redirect('/daftar-penawaran')->with('success', 'Penyimpanan Berhasil');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(penawaran $penawaran)
    {
        penawaran::where('id', $penawaran->id)
                 ->update(['status_penawaran' => 'Batal']);

        $statusPenawaran['penawaran_id'] = $penawaran->id;
        $statusPenawaran['pelanggan_id'] = Auth::guard('pelanggan')->user()->id;
        $statusPenawaran['tanggal_status'] = Carbon::now();
        $statusPenawaran['status_penawaran'] = "Batal";

        status_penawaran::create($statusPenawaran);
        
        return redirect('/daftar-penawaran')->with('success', 'Penawaran berhasil dibatalkan!');
    }
}
