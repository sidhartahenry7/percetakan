<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use App\Http\Requests\StorepelangganRequest;
use App\Http\Requests\UpdatepelangganRequest;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pelanggan.AddPelanggan', [
            "idpelanggan" => pelanggan::CreateID()
        ]);
    }
    
    public function listPelanggan()
    {
        return view('pelanggan.ListPelanggan', [
            "list_pelanggan" => pelanggan::where('deleted', 0)->get()
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
     * @param  \App\Http\Requests\StorepelangganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepelangganRequest $request)
    {
        $validatedData = $request->validate([
            'id_pelanggan' => 'required|unique:pelanggans',
            'nama_pelanggan' => 'required|max:255',
            'nomor_handphone' => 'required|min:10|max:12|unique:pelanggans'
        ]);

        pelanggan::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/pelanggan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(pelanggan $pelanggan)
    {
        if (Auth::user()->user_role == 'Admin') {
            $pelanggans = pelanggan::where('id', $pelanggan->id)->first();    

            return view('pelanggan.EditPelanggan', [
                "title" => "Edit Pelanggan",
                "pelanggan" => $pelanggans         
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepelangganRequest  $request
     * @param  \App\Models\pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepelangganRequest $request, pelanggan $pelanggan)
    {
        pelanggan::where('id', $pelanggan->id)
                 ->update(['nama_pelanggan' => $request->nama_pelanggan,
                           'nomor_handphone' => $request->nomor_handphone
                         ]); 

        // $request->session()->flash('success','Perusahaan Berhasil Diupdate');
        return redirect('/list-pelanggan')->with('success', 'Pelanggan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy(pelanggan $pelanggan)
    {
        pelanggan::where('id', $pelanggan->id)
                 ->update(['deleted' => '1']);
        
        return redirect('/list-pelanggan')->with('success', 'Pelanggan berhasil dihapus!');
    }
}
