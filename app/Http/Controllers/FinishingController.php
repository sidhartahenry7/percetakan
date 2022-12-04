<?php

namespace App\Http\Controllers;

use App\Models\finishing;
use App\Http\Requests\StorefinishingRequest;
use App\Http\Requests\UpdatefinishingRequest;
use Illuminate\Support\Facades\Auth;

class FinishingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('produk.AddFinishing', [
                "idproduk" => finishing::CreateID(),
                "title" => "Add Finishing"
            ]);
        }
        else {
            abort(403);
        }
    }

    public function listFinishing()
    {
        return view('produk.ListFinishing', [
            "list_finishing" => finishing::where('deleted', 0)->get(),
            "title" => "Daftar Finishing"
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
     * @param  \App\Http\Requests\StorefinishingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorefinishingRequest $request)
    {
        $validatedData = $request->validate([
            'id_finishing' => 'required|unique:finishings',
            'jenis_finishing' => 'required|max:255',
            'finishing_harga' => 'required'
        ]);

        finishing::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/list-finishing');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\finishing  $finishing
     * @return \Illuminate\Http\Response
     */
    public function show(finishing $finishing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\finishing  $finishing
     * @return \Illuminate\Http\Response
     */
    public function edit(finishing $finishing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatefinishingRequest  $request
     * @param  \App\Models\finishing  $finishing
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatefinishingRequest $request, finishing $finishing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\finishing  $finishing
     * @return \Illuminate\Http\Response
     */
    public function destroy(finishing $finishing)
    {
        finishing::where('id', $finishing->id)
                 ->update(['deleted' => '1']);
        
        return redirect('/list-finishing')->with('success', 'Finishing berhasil dihapus!');
    }
}
