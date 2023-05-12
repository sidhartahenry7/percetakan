<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilePelangganController extends Controller
{
    public function index() {
        return view('profile.pelanggan.ProfilePelanggan', [
            "pelanggan" => pelanggan::where('id', Auth::user('pelanggan')->id)->first(),
            "title" => "Profile Saya"
        ]);
    }

    public function update($id, Request $request) {
        $pelanggan = pelanggan::where('id', $id)->first();

        if ($pelanggan->nomor_handphone == $request->nomor_handphone && $pelanggan->email == $request->email) {
            $validatedData = $request->validate([
                'nama_pelanggan' => 'required',
                'nomor_handphone' => 'required',
                'email' => 'required'
            ]);
        }
        else if ($pelanggan->nomor_handphone == $request->nomor_handphone || $pelanggan->email == $request->email) {
            if ($pelanggan->nomor_handphone == $request->nomor_handphone) {
                $validatedData = $request->validate([
                    'nama_pelanggan' => 'required',
                    'nomor_handphone' => 'required',
                    'email' => 'required|email|unique:pelanggans'
                ]);
            }
            else if ($pelanggan->email == $request->email) {
                $validatedData = $request->validate([
                    'nama_pelanggan' => 'required',
                    'nomor_handphone' => 'required|unique:pelanggans',
                    'email' => 'required'
                ]);
            }
        }
        else {
            $validatedData = $request->validate([
                'nama_pelanggan' => 'required',
                'nomor_handphone' => 'required|unique:pelanggans',
                'email' => 'required|email|unique:pelanggans'
            ]);
        }

        pelanggan::where('id', $id)
                 ->update($validatedData);
        
        $request->session()->flash('success','Profile Berhasil Diiupdate');

        return redirect('/profile'.$request->transaksi_id);
    }

    public function changePassword()
    {
        return view('profile.pelanggan.ChangePasswordPelanggan', [
            "title" => "Change Password"
        ]);
    }

    public function updatePassword($id, Request $request)
    {
        $credentials = $request->validate([
            'password' => 'required',
            'email' => 'required'
        ]);
        if(Auth::guard('pelanggan')->attempt($credentials)) {
            $validatedData = $request->validate([
                'password_baru' => 'required'
            ]);
            $validatedData['password_baru'] = Hash::make($request->password_baru);

            pelanggan::where('id', $id)->update(['password' => $validatedData['password_baru']]);
    
            $request->session()->flash('success','Password Berhasil Diganti');

            Auth::logout();

            $request->session()->invalidate();
            
            $request->session()->regenerateToken();

            return redirect('/login');
        }
        return back()->with('error', 'Password tidak berhasil diganti');
    }
}