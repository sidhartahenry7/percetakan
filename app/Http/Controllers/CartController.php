<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Http\Requests\StorecartRequest;
use App\Http\Requests\UpdatecartRequest;
use App\Models\cabang;
use App\Models\detail_produk;
use App\Models\kategori;
use App\Models\promo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $cart = cart::where('pelanggan_id', Auth::guard('pelanggan')->user()->id)->get();

        // foreach ($cart as $res) {
        //     if ($res->detail_produk->status_finishing == 0) {
        //         $harga_finishing = $res->detail_produk->finishing->finishing_harga;
        //     }
        //     else if ($res->detail_produk->status_finishing == 1) {
        //         $harga_finishing = $res->detail_produk->finishing->finishing_harga*$res->jumlah_produk;
        //     }
        //     $sub_total = $res->detail_produk->harga*$res->jumlah_produk+$harga_finishing;
        //     $data[] = ['id_keranjang' => $res->id, 'harga_finishing' => $harga_finishing != null ? $harga_finishing : 0, 'sub_total' => $sub_total != null ? $sub_total : 0];
        // }
        // dd($data);

        return view('cart.KeranjangSaya', [
            "keranjang_saya" => cart::where('pelanggan_id', Auth::guard('pelanggan')->user()->id)->get(),
            // "data" => $data,
            "list_promo" => promo::where('tanggal_mulai', '<=', Carbon::today())->where('tanggal_berakhir', '>=', Carbon::today())->get(),
            "list_cabang" => cabang::where('deleted', 0)->get(),
            "title" => "Keranjang Saya"
        ]);
    }

    public function listProduk()
    {
        $list_kategori = kategori::where('deleted', 0)->get();
        return view('produk.pelanggan.DaftarProduk', [
            "list_kategori" => $list_kategori,
            "title" => "Detail Produk"
        ]);
    }

    public function fetchGambarKategori(Request $request)
    {
        $kategori = kategori::where('id', $request->kategori_id)->first();

        $data = $kategori->gambar_kategori;

        // dd($data);
        
        return response()->json($data);
    }

    public function downloadFile($id)
    {
        $nama_file = cart::where('id',$id)->first('file_cetak');
        // dd($list_file);
        return response()->download(public_path("storage/{$nama_file->file_cetak}"));
    }

    public function fetchKeranjang(Request $request)
    {
        $cart = cart::where("id", '=', $request->id)->first();

        $data['jumlah'] = $cart->jumlah_produk;

        // if ($cart->detail_produk->status_finishing == 0) {
        //     $harga_finishing = $cart->detail_produk->finishing->finishing_harga;
        // }
        // else if ($cart->detail_produk->status_finishing == 1) {
        //     $harga_finishing = $cart->detail_produk->finishing->finishing_harga*$cart->jumlah_produk;
        // }
        // $data['total'] = ($cart->detail_produk->harga*$cart->jumlah_produk+$harga_finishing)*(1-($cart->detail_produk->diskon/100));

        // if ($request->promo_id == NULL) {
        //     $data['potongan'] = 0;
        // }
        // else {
        //     $promo = promo::where('id', $request->promo_id)->first();
        //     $data['potongan'] = $promo->potongan;
        // }

        // dd($data);
        
        return response()->json($data);
    }
    
    public function fetchPromo(Request $request)
    {
        if ($request->promo_id == NULL) {
            $potongan = 0;
        }
        else {
            $promo = promo::where('id', $request->promo_id)->first();
            $potongan = $promo->potongan;
        }
        
        return response()->json($potongan);
    }

    public function deleteItem(Request $request)
    {
        $cart = cart::where('id', $request->id)->first();
        $file = public_path("storage/{$cart->file_cetak}");
        
        File::delete($file);

        cart::destroy($cart->id);

        $result = 'Item berhasil dihapus!';

        return response()->json($result);
        // return redirect('/category')->with('success', 'Item berhasil dihapus!');
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
     * @param  \App\Http\Requests\StorecartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecartRequest $request)
    {
        $validatedData = $request->validate([
            'kategori_id' => 'required',
            'jenis_bahan_input' => 'required',
            'ukuran_input' => 'required',
            'warna_input' => 'required',
            'jumlah_produk' => 'required',
            'custom' => 'nullable',
            'file_cetak' => 'required|file'
        ]);

        $validatedData['pelanggan_id'] = Auth::guard('pelanggan')->user()->id;

        if ($request->file('file_cetak')) {
            $validatedData['file_cetak'] = $request->file('file_cetak')->store('cetak');
        }

        cart::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/shopping-cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecartRequest  $request
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecartRequest $request, cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(cart $cart)
    {
        $temp = cart::where('id', $cart->id)->first();
        $file = public_path("storage/{$temp->file_cetak}");
        
        File::delete($file);

        cart::destroy($cart->id);
        
        return redirect('/shopping-cart')->with('success', 'Item berhasil dihapus!');
    }
}
