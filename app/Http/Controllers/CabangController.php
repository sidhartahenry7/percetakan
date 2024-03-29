<?php

namespace App\Http\Controllers;

use App\Models\cabang;
use App\Http\Requests\StorecabangRequest;
use App\Http\Requests\UpdatecabangRequest;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('cabang.Cabang', [
                "idcabang" => cabang::CreateID(),
                "title" => "Add Cabang"
            ]);
        }
        else {
            abort(403);
        }
    }

    public function listCabang()
    {
        return view('cabang.ListCabang', [
            "list_cabang" => cabang::where('deleted', 0)->get(),
            "title" => "Daftar Cabang"
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
     * @param  \App\Http\Requests\StorecabangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecabangRequest $request)
    {
        $validatedData = $request->validate([
            'id_cabang' => 'required|unique:cabangs',
            'nama_cabang' => 'required|max:255',
            'alamat' => 'required|max:255',
            'longitude' => 'required',
            'latitude' => 'required',
            'nomor_telepon' => 'required|unique:cabangs'
        ]);

        cabang::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');
        return redirect('/list-cabang');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function show(cabang $cabang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function edit(cabang $cabang)
    {
        if (Auth::user()->user_role == 'Admin') {
            $cabangs = cabang::where('id', $cabang->id)->first();    

            return view('cabang.EditCabang', [
                "title" => "Edit Cabang",
                "cabang" => $cabangs,
                "title" => "Edit Cabang"        
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecabangRequest  $request
     * @param  \App\Models\cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecabangRequest $request, cabang $cabang)
    {
        cabang::where('id', $cabang->id)
              ->update(['nama_cabang' => $request->nama_cabang,
                        'alamat' => $request->alamat,
                        'longitude' => $request->longitude,
                        'latitude' => $request->latitude,
                        'nomor_telepon' => $request->nomor_telepon
                      ]); 

        // $request->session()->flash('success','Perusahaan Berhasil Diupdate');
        return redirect('/cabang')->with('success', 'Cabang berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function destroy(cabang $cabang)
    {
        cabang::where('id', $cabang->id)
              ->update(['deleted' => '1']);
        
        return redirect('/cabang')->with('success', 'Cabang berhasil dihapus!');
    }
}
