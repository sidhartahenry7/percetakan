<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\pegawai;
use App\Http\Requests\StoreabsensiRequest;
use App\Http\Requests\UpdateabsensiRequest;
use App\Models\cabang;
use App\Models\jadwal_bekerja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('absensi.AddAbsensi', [
            "single_absensi" => absensi::where('pegawai_id', Auth::user()->id)->where('tanggal_masuk',  Carbon::today())->first(),
            "pegawai" => pegawai::where('id', Auth::user()->id)->where('deleted', 0)->first()
        ]);
    }
    
    public function listAbsensi()
    {
        if (Auth::user()->user_role == "Admin") {
            $list_absensi = absensi::join('pegawais', 'absensis.pegawai_id', '=', 'pegawais.id')
                                   ->where('pegawais.user_role', '!=', 'Admin')
                                   ->whereNull('pegawais.tanggal_keluar')
                                   ->where('pegawais.deleted', 0)
                                   ->get();
        }
        else if (Auth::user()->user_role == "Kepala Toko" || Auth::user()->user_role == "Wakil Kepala Toko") {
            $list_absensi = absensi::join('pegawais', 'absensis.pegawai_id', '=', 'pegawais.id')
                                   ->where('pegawais.cabang_id', Auth::user()->cabang_id)
                                   ->where('pegawais.user_role', '!=', 'Admin')
                                   ->whereNull('pegawais.tanggal_keluar')
                                   ->where('pegawais.deleted', 0)
                                   ->get();
        }
        else {
            $list_absensi = absensi::where('pegawai_id', Auth::user()->id)->get();
        }
        return view('absensi.ListAbsensi', [
            "list_absensi" => $list_absensi
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
     * @param  \App\Http\Requests\StoreabsensiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreabsensiRequest $request)
    {
        $cabang = cabang::where('id', Auth::user()->cabang_id)->first();
        
        if(($request->longitude <= (round($cabang->longitude, 4) + 0.0001)) AND ($request->longitude >= (round($cabang->longitude, 4) - 0.0001)) AND ($request->latitude <= (round($cabang->latitude, 4) + 0.0001)) AND ($request->latitude >= (round($cabang->latitude, 4) - 0.0001))) {
            // dd('BERHASIL');
            
            if ($request->tombol == 'check_in') {
                $jadwal = jadwal_bekerja::where('pegawai_id', Auth::user()->id)
                                        ->where('hari', Carbon::today()->format('l'))
                                        ->first();
                
                if (Carbon::now() >= Carbon::parse($jadwal->jam_masuk)->addMinutes(1)) {
                    $status = 'terlambat';
                }
                else if (Carbon::now() < Carbon::parse($jadwal->jam_masuk)->addMinutes(1)) {
                    $status = 'hadir';
                }
    
                $data = [
                    'pegawai_id' => $request->pegawai_id,
                    'tanggal_masuk' => $request->tanggal_masuk,
                    'jam_masuk' => Carbon::now(),
                    'longitude_masuk' => $request->longitude,
                    'latitude_masuk' => $request->latitude,
                    'status' => $status
                ];
                
                absensi::create($data);
            }
            else if ($request->tombol == 'check_out') {
                absensi::where('pegawai_id', $request->pegawai_id)
                       ->where('tanggal_masuk', Carbon::today())
                       ->update(['tanggal_keluar' => $request->tanggal_keluar,
                                 'jam_keluar' => Carbon::now(),
                                 'longitude_keluar' => $request->longitude,
                                 'latitude_keluar' => $request->latitude]);
            }

            $request->session()->flash('success','Penyimpanan Berhasil');

            return redirect('/absensi');
        }
        else {
            // dd('GAGAL');
            
            $request->session()->flash('fail','Penyimpanan Gagal');

            return redirect('/absensi');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateabsensiRequest  $request
     * @param  \App\Models\absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateabsensiRequest $request, absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(absensi $absensi)
    {
        //
    }
}
