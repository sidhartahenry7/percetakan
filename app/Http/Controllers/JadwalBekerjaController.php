<?php

namespace App\Http\Controllers;

use App\Models\jadwal_bekerja;
use App\Models\pegawai;
use App\Http\Requests\Storejadwal_bekerjaRequest;
use App\Http\Requests\Updatejadwal_bekerjaRequest;
use Illuminate\Support\Facades\Auth;

class JadwalBekerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('jadwalkerja.AddJadwalKerjaPegawai', [
                "list_pegawai" => pegawai::all()->where('user_role', '!=', 'Admin')->where('deleted', 0)->whereNull('tanggal_keluar'),
                "list_hari" => [
                    "Sunday",
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday"
                ],
                "title" => "Add Jadwal Bekerja Pegawai"
            ]);
        }
        else {
            abort(403);
        }
    }
    
    public function listJadwal()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('jadwalkerja.ListJadwalKerjaPegawai', [
                "list_jadwal" => jadwal_bekerja::join('pegawais', 'jadwal_bekerjas.pegawai_id', '=', 'pegawais.id')->ListJadwal()->where('pegawais.user_role', '!=', 'Admin')->whereNull('pegawais.tanggal_keluar')->where('pegawais.deleted', 0)->orderBy('pegawais.id')->orderBy('jadwal_bekerjas.hari')->select('pegawais.*', 'jadwal_bekerjas.*')->get(),
                "title" => "Daftar Jadwal Bekerja Pegawai"
            ]);
        }
        else if (Auth::user()->user_role == 'Kepala Toko' || Auth::user()->user_role == 'Wakil Kepala Toko') {
            return view('jadwalkerja.ListJadwalKerjaPegawai', [
                "list_jadwal" => jadwal_bekerja::join('pegawais', 'jadwal_bekerjas.pegawai_id', '=', 'pegawais.id')->ListJadwal()->where('pegawais.user_role', '!=', 'Admin')->whereNull('pegawais.tanggal_keluar')->where('pegawais.deleted', 0)->orderBy('pegawais.id')->orderBy('jadwal_bekerjas.hari')->select('pegawais.*', 'jadwal_bekerjas.*')->get(),
                "title" => "Daftar Jadwal Bekerja Pegawai"
            ]);
        }
        else {
            return view('jadwalkerja.ListJadwalKerjaPegawai', [
                "list_jadwal" => jadwal_bekerja::join('pegawais', 'jadwal_bekerjas.pegawai_id', '=', 'pegawais.id')->ListJadwal()->where('pegawais.user_role', '!=', 'Admin')->whereNull('pegawais.tanggal_keluar')->where('pegawais.deleted', 0)->orderBy('pegawais.id')->orderBy('jadwal_bekerjas.hari')->select('pegawais.*', 'jadwal_bekerjas.*')->get(),
                "title" => "Daftar Jadwal Bekerja Pegawai"
            ]);
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
     * @param  \App\Http\Requests\Storejadwal_bekerjaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storejadwal_bekerjaRequest $request)
    {
        $validatedData = $request->validate([
            'pegawai_id' => 'required',
            'hari' => 'required',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required'
        ]);

        jadwal_bekerja::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/list-jadwal');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jadwal_bekerja  $jadwal_bekerja
     * @return \Illuminate\Http\Response
     */
    public function show(jadwal_bekerja $jadwal_bekerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jadwal_bekerja  $jadwal_bekerja
     * @return \Illuminate\Http\Response
     */
    public function edit(jadwal_bekerja $jadwal_bekerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatejadwal_bekerjaRequest  $request
     * @param  \App\Models\jadwal_bekerja  $jadwal_bekerja
     * @return \Illuminate\Http\Response
     */
    public function update(Updatejadwal_bekerjaRequest $request, jadwal_bekerja $jadwal_bekerja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jadwal_bekerja  $jadwal_bekerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(jadwal_bekerja $jadwal_bekerja)
    {
        if (Auth::user()->user_role == 'Admin') {
            jadwal_bekerja::destroy($jadwal_bekerja->id);
        }

        return redirect('/list-jadwal')->with('success', 'Jadwal bekerja telah dihapus!');
    }
}
