<?php

namespace App\Http\Controllers;

use App\Models\register;
use App\Http\Requests\StoreregisterRequest;
use App\Http\Requests\UpdateregisterRequest;
use App\Models\pegawai;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;


class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register.index');
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
     * @param  \App\Http\Requests\StoreregisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreregisterRequest $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'nomor_handphone' => 'required|unique:pegawais',
            'email' => 'required|unique:pegawais|email:dns',
            'password' => 'required'
        ]);

        $validatedData['id_pegawai'] = pegawai::CreateID();
        $validatedData['password'] = Hash::make($request->password);
        $validatedData['tanggal_masuk'] = Carbon::today();
        $validatedData['user_role'] = 'Admin';

        // dd($validatedData['id_pegawai']);

        pegawai::create($validatedData);

        $request->session()->flash('success','Berhasil mendaftar');

        return redirect('/login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\register  $register
     * @return \Illuminate\Http\Response
     */
    public function show(register $register)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\register  $register
     * @return \Illuminate\Http\Response
     */
    public function edit(register $register)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateregisterRequest  $request
     * @param  \App\Models\register  $register
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateregisterRequest $request, register $register)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\register  $register
     * @return \Illuminate\Http\Response
     */
    public function destroy(register $register)
    {
        //
    }
}
