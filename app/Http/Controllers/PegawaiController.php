<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use App\Models\cabang;
use App\Http\Requests\StorepegawaiRequest;
use App\Http\Requests\UpdatepegawaiRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('pegawai.AddPegawai', [
                "idpegawai" => pegawai::CreateID(),
                "list_cabang" => cabang::where('deleted', 0)->get()
            ]);
        }
        else {
            abort(403);
        }
    }
    
    public function listPegawai()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('pegawai.ListPegawai', [
                "list_pegawai" => pegawai::oldest()->ListPegawai()->where('user_role', '!=', 'Admin')->where('deleted', 0)->whereNull('tanggal_keluar')->get()
            ]);
        }
        else {
            return view('pegawai.ListPegawai', [
                "list_pegawai" => pegawai::oldest()->ListPegawai()->where('user_role', '!=', 'Admin')->where('cabang_id', Auth::user()->cabang_id)->where('deleted', 0)->whereNull('tanggal_keluar')->get()
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
     * @param  \App\Http\Requests\StorepegawaiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepegawaiRequest $request)
    {
        $validatedData = $request->validate([
            'id_pegawai' => 'required|unique:pegawais',
            'nama_lengkap' => 'required|max:255',
            'alamat' => 'required|max:255',
            'nomor_handphone' => 'required|min:10|max:12',
            'email' => 'required|unique:pegawais|email',
            // 'password' => 'required|min:8|max:255',
            'rekening_bank' => 'required',
            'nomor_rekening' => 'required|min:10|max:10',
            'gaji_pokok' => 'required',
            'tanggal_masuk' => 'required',
            'user_role' => 'required',
            'cabang_id' => 'required'
        ]);

        // $validatedData['password'] = bcrypt($validatedData['password']);

        $validatedData['password'] = Hash::make('password');

        // dd($validatedData['password']);

        pegawai::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/pegawai');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(pegawai $pegawai)
    {
        if (Auth::user()->user_role == 'Admin') {
            $pegawais = pegawai::where('id', $pegawai->id)->first();

            return view('pegawai.EditPegawai', [
                "title" => "Edit Pegawai",
                "list_bank" => [
                    "BCA",
                    "BRI",
                    "BNI",
                    "Bank Mandiri"
                ],
                "list_role" => [
                    "Kepala Toko",
                    "Wakil Kepala Toko",
                    "Kasir",
                    "Desainer",
                    "Operator Printer"
                ],
                "list_cabang" => cabang::where('deleted', 0)->get(),
                "pegawai" => $pegawais         
            ]);
        }
        else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepegawaiRequest  $request
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepegawaiRequest $request, pegawai $pegawai)
    {
        pegawai::where('id', $pegawai->id)
               ->update(['nama_lengkap' => $request->nama_lengkap,
                         'alamat' => $request->alamat,
                         'nomor_handphone' => $request->nomor_handphone,
                         'email' => $request->email,
                         'rekening_bank' => $request->rekening_bank,
                         'nomor_rekening' => $request->nomor_rekening,
                         'gaji_pokok' => $request->gaji_pokok,
                         'tanggal_masuk' => $request->tanggal_masuk,
                         'tanggal_keluar' => $request->tanggal_keluar,
                         'user_role' => $request->user_role,
                         'cabang_id' => $request->cabang_id
                        ]);

        // $request->session()->flash('success','Perusahaan Berhasil Diupdate');
        return redirect('/list-pegawai')->with('success', 'Pegawai berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(pegawai $pegawai)
    {
        pegawai::where('id', $pegawai->id)
               ->update(['deleted' => '1']);
        
        return redirect('/list-pegawai')->with('success', 'Pegawai berhasil dihapus!');
    }
}
