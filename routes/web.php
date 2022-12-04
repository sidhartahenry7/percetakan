<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DataDiriController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KomplainController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\StokCabangController;
use App\Http\Controllers\DetailProdukController;
use App\Http\Controllers\JadwalBekerjaController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\FinishingController;
use App\Http\Controllers\TintaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);


Route::get('/cabang', [CabangController::class, 'index'])->middleware('auth');
Route::post('/cabang', [CabangController::class, 'store']);
Route::delete('/cabang/{cabang:id}', [CabangController::class, 'destroy']);
Route::put('/cabang/{cabang:id}', [CabangController::class, 'edit']);
Route::post('/cabang/{cabang:id}', [CabangController::class, 'update']);
Route::get('/list-cabang', [CabangController::class, 'listCabang'])->middleware('auth');

Route::get('/pegawai', [PegawaiController::class, 'index'])->middleware('auth');
Route::get('/list-pegawai', [PegawaiController::class, 'listPegawai'])->middleware('auth');
Route::post('/pegawai', [PegawaiController::class, 'store']);
Route::delete('/pegawai/{pegawai:id}', [PegawaiController::class, 'destroy']);
Route::put('/pegawai/{pegawai:id}', [PegawaiController::class, 'edit']);
Route::post('/pegawai/{pegawai:id}', [PegawaiController::class, 'update']);

Route::get('/data-diri', [DataDiriController::class, 'index'])->middleware('auth');
Route::post('/data-diri/{id}', [DataDiriController::class, 'update']);
Route::get('/change-password', [DataDiriController::class, 'changePassword'])->middleware('auth');
Route::post('/change-password/{id}', [DataDiriController::class, 'updatePassword']);

Route::get('/jadwal', [JadwalBekerjaController::class, 'index'])->middleware('auth');
Route::get('/list-jadwal', [JadwalBekerjaController::class, 'listJadwal'])->middleware('auth');
Route::post('/jadwal', [JadwalBekerjaController::class, 'store']);
Route::delete('/jadwal/{jadwal_bekerja:id}', [JadwalBekerjaController::class, 'destroy']);

Route::get('/absensi', [AbsensiController::class, 'index'])->middleware('auth');
Route::get('/list-absensi', [AbsensiController::class, 'listAbsensi'])->middleware('auth');
Route::post('/absensi', [AbsensiController::class, 'store']);

Route::get('/gaji', [GajiController::class, 'index'])->middleware('auth');
Route::get('/list-gaji', [GajiController::class, 'listGaji'])->middleware('auth');
Route::post('/gaji', [GajiController::class, 'store']);
Route::post('api/hitung-gaji', [GajiController::class, 'hitungGaji']);


Route::get('/transaksi', [TransaksiController::class, 'index'])->middleware('auth');
Route::post('/transaksi', [TransaksiController::class, 'store']);
Route::post('/transaksi/edit', [TransaksiController::class, 'update']);
Route::get('/history-transaksi', [TransaksiController::class, 'indexHistory'])->middleware('auth');
Route::get('/transaksi/{id}/nota', [TransaksiController::class, 'printNota']);

Route::get('/transaksi/{id}', [DetailTransaksiController::class, 'indexView']);
Route::get('/transaksi/{id}/edit', [DetailTransaksiController::class, 'index']);
Route::post('/transaksi/{id}', [DetailTransaksiController::class, 'store']);
Route::post('/transaksi/{id}/edit', [DetailTransaksiController::class, 'update']);
Route::delete('/transaksi/{id}/delete', [DetailTransaksiController::class, 'destroy']);

Route::post('/api/fetch-ukuran', [DetailTransaksiController::class, 'fetchUkuran']);
Route::post('api/fetch-kertas', [DetailTransaksiController::class, 'fetchJenisKertas']);
Route::post('api/fetch-tinta', [DetailTransaksiController::class, 'fetchJenisTinta']);
Route::post('api/fetch-finishing', [DetailTransaksiController::class, 'fetchFinishing']);
Route::post('api/fetch-detail', [DetailTransaksiController::class, 'fetchDetail']);
Route::post('api/sub-total', [DetailTransaksiController::class, 'sub']);
Route::post('api/hitung-total', [DetailTransaksiController::class, 'hitungTotal']);

Route::get('/antrian', [AntrianController::class, 'index'])->middleware('auth');
Route::post('api/fetch-nomor-antrian', [AntrianController::class, 'fetchNomorAntrian']);
Route::get('/history-antrian', [AntrianController::class, 'indexHistory'])->middleware('auth');
Route::post('/antrian', [AntrianController::class, 'store']);
Route::delete('/antrian/{antrian:id}', [AntrianController::class, 'destroy']);
Route::get('/list-antrian', [AntrianController::class, 'listAntrian'])->middleware('auth');

Route::get('/pelanggan', [PelangganController::class, 'index'])->middleware('auth');
Route::get('/list-pelanggan', [PelangganController::class, 'listPelanggan'])->middleware('auth');
Route::post('/pelanggan', [PelangganController::class, 'store']);
Route::delete('/pelanggan/{pelanggan:id}', [PelangganController::class, 'destroy']);
Route::put('/pelanggan/{pelanggan:id}', [PelangganController::class, 'edit']);
Route::post('/pelanggan/{pelanggan:id}', [PelangganController::class, 'update']);

Route::get('/kategori', [KategoriController::class, 'index'])->middleware('auth');
Route::get('/list-kategori', [KategoriController::class, 'listKategori'])->middleware('auth');
Route::post('/kategori', [KategoriController::class, 'store']);
Route::delete('/kategori/{kategori:id}', [KategoriController::class, 'destroy']);

Route::get('/bahan-baku', [ProdukController::class, 'index'])->middleware('auth');
Route::post('/bahan-baku', [ProdukController::class, 'store']);
Route::delete('/bahan-baku/{produk:id}', [ProdukController::class, 'destroy']);
Route::get('/list-bahan-baku', [ProdukController::class, 'listProduk'])->middleware('auth');

Route::get('/tinta', [TintaController::class, 'index'])->middleware('auth');
Route::post('/tinta', [TintaController::class, 'store']);
Route::delete('/tinta/{tinta:id}', [TintaController::class, 'destroy']);
Route::get('/list-tinta', [TintaController::class, 'listTinta'])->middleware('auth');

Route::get('/finishing', [FinishingController::class, 'index'])->middleware('auth');
Route::post('/finishing', [FinishingController::class, 'store']);
Route::delete('/finishing/{finishing:id}', [FinishingController::class, 'destroy']);
Route::get('/list-finishing', [FinishingController::class, 'listFinishing'])->middleware('auth');

Route::get('/detail-produk', [DetailProdukController::class, 'index'])->middleware('auth');
Route::post('/detail-produk', [DetailProdukController::class, 'store']);
Route::delete('/detail-produk/{detail_produk:id}', [DetailProdukController::class, 'destroy']);
Route::put('/detail-produk/{detail_produk:id}', [DetailProdukController::class, 'edit']);
Route::post('/detail-produk/{detail_produk:id}', [DetailProdukController::class, 'update']);
Route::get('/list-detail-produk', [DetailProdukController::class, 'listDetailProduk'])->middleware('auth');

Route::get('/stok', [StokCabangController::class, 'index'])->middleware('auth');
Route::post('/stok', [StokCabangController::class, 'store']);

Route::get('/promo', [PromoController::class, 'index'])->middleware('auth');
Route::get('/list-promo', [PromoController::class, 'listPromo'])->middleware('auth');
Route::post('/promo', [PromoController::class, 'store']);
Route::delete('/promo/{promo:id}', [PromoController::class, 'destroy']);

Route::get('/komplain', [KomplainController::class, 'index'])->middleware('auth');
Route::get('/komplain/{komplain:id}', [KomplainController::class, 'indexDetail'])->middleware('auth');
Route::delete('/komplain/{komplain:id}', [KomplainController::class, 'destroy']);
Route::get('/list-komplain', [KomplainController::class, 'listKomplain'])->middleware('auth');
Route::post('/komplain', [KomplainController::class, 'store']);