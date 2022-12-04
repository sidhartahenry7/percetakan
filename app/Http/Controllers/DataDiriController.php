<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pegawai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DataDiriController extends Controller
{
    public function index() {
        if (Auth::user()->user_role != 'Admin') {
            return view('profile/DataDiri', [
                "data_diri" => pegawai::where('id', Auth::user()->id)->first(),
                "list_bank" => ['BCA', 'BRI', 'BNI', 'Bank Mandiri'],
                "title" => "Data Diri"
            ]);
        }
        else {
            abort(403);
        }
    }

    public function update($id, Request $request) {
        pegawai::where('id', $id)
               ->update(['nama_lengkap' => $request->nama_lengkap,
                         'alamat' => $request->alamat,
                         'nomor_handphone' => $request->nomor_handphone,
                         'email' => $request->email,
                         'rekening_bank' => $request->rekening_bank,
                         'nomor_rekening' => $request->nomor_rekening,
                         'tanggal_masuk' => $request->tanggal_masuk
                 ]);
        
        $request->session()->flash('success','Data Diri Berhasil Diiupdate');

        return redirect('/data-diri'.$request->transaksi_id);
    }

    public function changePassword()
    {
        return view('profile.ChangePassword', [
            "title" => "Change Password"
        ]);
    }

    public function updatePassword($id, Request $request)
    {
        $credentials = $request->validate([
            'password' => 'required',
            'email' => 'required'
        ]);
        if(Auth::attempt($credentials)) {
            $validatedData = $request->validate([
                'password_baru' => 'required'
            ]);
            $validatedData['password_baru'] = Hash::make($request->password_baru);

            pegawai::where('id', $id)->update(['password' => $validatedData['password_baru']]);
    
            $request->session()->flash('success','Password Berhasil Diganti');

            Auth::logout();

            $request->session()->invalidate();
            
            $request->session()->regenerateToken();

            return redirect('/login');
        }
        else
        {
            $request->session()->flash('fail','Password Tidak Berhasil Diganti');
            return redirect('/change-password');
        }
    }
}
