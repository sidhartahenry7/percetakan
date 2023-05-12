<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\BahanSetengahJadiController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DataDiriController;
use App\Http\Controllers\DetailPenawaranController;
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
use App\Http\Controllers\KartuStokBahanController;
use App\Http\Controllers\KartuStokTintaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PembelianBahanController;
use App\Http\Controllers\PembelianTintaController;
use App\Http\Controllers\PenawaranController;
use App\Http\Controllers\PenerimaanBahanBakuController;
use App\Http\Controllers\PenerimaanTintaController;
use App\Http\Controllers\ProfilePelangganController;
use App\Http\Controllers\TintaController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', [DashboardController::class, 'home']);
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register-admin', [RegisterController::class, 'index']);
Route::post('/register-admin', [RegisterController::class, 'store']);
Route::get('/register', [RegisterController::class, 'register']);
Route::post('/register', [RegisterController::class, 'storePelanggan']);

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware('auth:pelanggan,user');

Route::get('/cabang', [CabangController::class, 'index'])->middleware('auth:user');
Route::post('/cabang', [CabangController::class, 'store']);
Route::delete('/cabang/{cabang:id}', [CabangController::class, 'destroy']);
Route::put('/cabang/{cabang:id}', [CabangController::class, 'edit']);
Route::post('/cabang/{cabang:id}', [CabangController::class, 'update']);
Route::get('/list-cabang', [CabangController::class, 'listCabang'])->middleware('auth:user');

Route::get('/pegawai', [PegawaiController::class, 'index'])->middleware('auth:user');
Route::get('/list-pegawai', [PegawaiController::class, 'listPegawai'])->middleware('auth:user');
Route::post('/pegawai', [PegawaiController::class, 'store']);
Route::delete('/pegawai/{pegawai:id}', [PegawaiController::class, 'destroy']);
Route::put('/pegawai/{pegawai:id}', [PegawaiController::class, 'edit']);
Route::post('/pegawai/{pegawai:id}', [PegawaiController::class, 'update']);

Route::get('/data-diri', [DataDiriController::class, 'index'])->middleware('auth:user');
Route::post('/data-diri/{id}', [DataDiriController::class, 'update']);
Route::get('/change-password', [DataDiriController::class, 'changePassword'])->middleware('auth:user');
Route::post('/change-password/{id}', [DataDiriController::class, 'updatePassword']);

Route::get('/jadwal', [JadwalBekerjaController::class, 'index'])->middleware('auth:user');
Route::get('/list-jadwal', [JadwalBekerjaController::class, 'listJadwal'])->middleware('auth:user');
Route::post('/jadwal', [JadwalBekerjaController::class, 'store']);
Route::delete('/jadwal/{jadwal_bekerja:id}', [JadwalBekerjaController::class, 'destroy']);

Route::get('/absensi', [AbsensiController::class, 'index'])->middleware('auth:user');
Route::get('/list-absensi', [AbsensiController::class, 'listAbsensi'])->middleware('auth:user');
Route::post('/absensi', [AbsensiController::class, 'store']);

Route::get('/gaji', [GajiController::class, 'index'])->middleware('auth:user');
Route::get('/list-gaji', [GajiController::class, 'listGaji'])->middleware('auth:user');
Route::post('/gaji', [GajiController::class, 'store']);
Route::post('api/hitung-gaji', [GajiController::class, 'hitungGaji']);

Route::get('/transaksi', [TransaksiController::class, 'index'])->middleware('auth:user');
Route::post('/transaksi', [TransaksiController::class, 'store']);
Route::post('/transaksi/edit', [TransaksiController::class, 'update']);
Route::get('/history-transaksi', [TransaksiController::class, 'indexHistory'])->middleware('auth:user,pelanggan');
Route::get('/transaksi/{id}/nota', [TransaksiController::class, 'printNota'])->middleware('auth:user,pelanggan');
Route::get('/daftar-transaksi', [TransaksiController::class, 'listTransaksiPelanggan'])->middleware('auth:pelanggan');
Route::get('/bukti-pembayaran-transaksi/{id}', [TransaksiController::class, 'downloadBuktiPembayaran'])->middleware('auth:user,pelanggan');

Route::get('/transaksi/{id}', [DetailTransaksiController::class, 'indexView'])->middleware('auth:user,pelanggan');
Route::get('/transaksi/{transaksi:id}/{detail_transaksi:id}/view', [DetailTransaksiController::class, 'detailProdukTransaksi'])->middleware('auth:user,pelanggan');
Route::get('/transaksi/{id}/edit', [DetailTransaksiController::class, 'index'])->middleware('auth:user');
Route::post('/transaksi/{id}', [DetailTransaksiController::class, 'store']);
Route::post('/transaksi/{id}/edit', [DetailTransaksiController::class, 'update']);
Route::delete('/transaksi/{id}/delete', [DetailTransaksiController::class, 'destroy']);
Route::get('/file-transaksi/{id}', [DetailTransaksiController::class, 'downloadFile'])->middleware('auth:user,pelanggan');

Route::post('api/fetch-kertas', [DetailTransaksiController::class, 'fetchJenisKertas']);
Route::post('/api/fetch-ukuran', [DetailTransaksiController::class, 'fetchUkuran']);
Route::post('api/fetch-tinta', [DetailTransaksiController::class, 'fetchJenisTinta']);
Route::post('api/fetch-finishing', [DetailTransaksiController::class, 'fetchFinishing']);
Route::post('api/fetch-detail', [DetailTransaksiController::class, 'fetchDetail']);
Route::post('api/sub-total', [DetailTransaksiController::class, 'sub']);
Route::post('api/hitung-total', [DetailTransaksiController::class, 'hitungTotal']);

Route::get('/antrian', [AntrianController::class, 'index'])->middleware('auth:user');
Route::post('api/fetch-nomor-antrian', [AntrianController::class, 'fetchNomorAntrian']);
Route::get('/history-antrian', [AntrianController::class, 'indexHistory'])->middleware('auth:user');
Route::post('/antrian', [AntrianController::class, 'store']);
Route::delete('/antrian/{antrian:id}', [AntrianController::class, 'destroy']);
Route::get('/list-antrian', [AntrianController::class, 'listAntrian'])->middleware('auth:user');

Route::get('/pelanggan', [PelangganController::class, 'index'])->middleware('auth:user');
Route::get('/list-pelanggan', [PelangganController::class, 'listPelanggan'])->middleware('auth:user');
Route::post('/pelanggan', [PelangganController::class, 'store']);
Route::delete('/pelanggan/{pelanggan:id}', [PelangganController::class, 'destroy']);
Route::put('/pelanggan/{pelanggan:id}', [PelangganController::class, 'edit']);
Route::post('/pelanggan/{pelanggan:id}', [PelangganController::class, 'update']);

Route::get('/pembelian-bahan-baku', [PembelianBahanController::class, 'index'])->middleware('auth:user');
Route::post('/api/tambah-bahan-baku', [PembelianBahanController::class, 'tambahBahanBaku']);
Route::post('/pembelian-bahan-baku', [PembelianBahanController::class, 'store']);
Route::delete('/pembelian-bahan-baku/{pembelian_bahan:id}', [PembelianBahanController::class, 'destroy']);
Route::get('/list-pembelian-bahan-baku', [PembelianBahanController::class, 'listPembelian'])->middleware('auth:user');
Route::get('/pembelian-bahan-baku/{pembelian_bahan:id}', [PembelianBahanController::class, 'detailPembelian'])->middleware('auth:user');
Route::get('/history-pembelian-bahan-baku', [PembelianBahanController::class, 'historyPembelian'])->middleware('auth:user');
Route::get('/penerimaan-bahan-baku/{pembelian_bahan:id}', [PenerimaanBahanBakuController::class, 'index'])->middleware('auth:user');
Route::post('/penerimaan-bahan-baku', [PenerimaanBahanBakuController::class, 'store']);
Route::get('/kartu-stok-bahan-baku', [KartuStokBahanController::class, 'index'])->middleware('auth:user');
Route::get('/stok-opname-bahan-baku', [KartuStokBahanController::class, 'stokOpname'])->middleware('auth:user');
Route::post('/api/edit-satuan', [KartuStokBahanController::class, 'editSatuan']);
Route::post('/api/tambah-stok-bahan-baku', [KartuStokBahanController::class, 'tambahStokBahan']);
Route::post('/stok-opname-bahan-baku', [KartuStokBahanController::class, 'store']);
Route::get('/add-stok-awal-bahan-baku', [KartuStokBahanController::class, 'addStokAwalBahanBaku'])->middleware('auth:user');
Route::post('/add-stok-awal-bahan-baku', [KartuStokBahanController::class, 'storeStokAwalBahanBaku']);

Route::get('/pembelian-tinta', [PembelianTintaController::class, 'index'])->middleware('auth:user');
Route::post('/api/tambah-tinta', [PembelianTintaController::class, 'tambahTinta']);
Route::post('/pembelian-tinta', [PembelianTintaController::class, 'store']);
Route::delete('/pembelian-tinta/{pembelian_tinta:id}', [PembelianTintaController::class, 'destroy']);
Route::get('/list-pembelian-tinta', [PembelianTintaController::class, 'listPembelian'])->middleware('auth:user');
Route::get('/pembelian-tinta/{pembelian_tinta:id}', [PembelianTintaController::class, 'detailPembelian'])->middleware('auth:user');
Route::get('/history-pembelian-tinta', [PembelianTintaController::class, 'historyPembelian'])->middleware('auth:user');
Route::get('/penerimaan-tinta/{pembelian_tinta:id}', [PenerimaanTintaController::class, 'index'])->middleware('auth:user');
Route::post('/penerimaan-tinta', [PenerimaanTintaController::class, 'store']);
Route::get('/kartu-stok-tinta', [KartuStokTintaController::class, 'index'])->middleware('auth:user');
Route::get('/stok-opname-tinta', [KartuStokTintaController::class, 'stokOpname'])->middleware('auth:user');
Route::post('/api/edit-satuan-tinta', [KartuStokTintaController::class, 'editSatuanTinta']);
Route::post('/api/tambah-stok-tinta', [KartuStokTintaController::class, 'tambahStokTinta']);
Route::post('/stok-opname-tinta', [KartuStokTintaController::class, 'store']);
Route::get('/add-stok-awal-tinta', [KartuStokTintaController::class, 'addStokAwalTinta'])->middleware('auth:user');
Route::post('/add-stok-awal-tinta', [KartuStokTintaController::class, 'storeStokAwalTinta']);

Route::get('/jenis-biaya', [BiayaController::class, 'index'])->middleware('auth:user');
Route::post('/jenis-biaya', [BiayaController::class, 'store']);
Route::put('/jenis-biaya/{biaya:id}', [BiayaController::class, 'edit']);
Route::post('/jenis-biaya/{biaya:id}', [BiayaController::class, 'update']);
Route::delete('/jenis-biaya/{biaya:id}', [BiayaController::class, 'destroy']);
Route::get('/list-jenis-biaya', [BiayaController::class, 'listJenisBiaya'])->middleware('auth:user');

Route::get('/pembayaran', [PembayaranController::class, 'index'])->middleware('auth:user');
Route::post('/pembayaran', [PembayaranController::class, 'store']);
Route::delete('/pembayaran/{biaya:id}', [PembayaranController::class, 'destroy']);
Route::get('/list-pembayaran', [PembayaranController::class, 'listPembayaran'])->middleware('auth:user');

Route::get('/kategori', [KategoriController::class, 'index'])->middleware('auth:user');
Route::get('/list-kategori', [KategoriController::class, 'listKategori'])->middleware('auth:user');
Route::post('/kategori', [KategoriController::class, 'store']);
Route::delete('/kategori/{kategori:id}', [KategoriController::class, 'destroy']);
Route::get('/kategori/{kategori:id}', [KategoriController::class, 'detailKategori'])->middleware('auth:user');
Route::put('/kategori/{kategori:id}', [KategoriController::class, 'edit']);
Route::post('/kategori/{kategori:id}', [KategoriController::class, 'update']);

Route::get('/bahan-baku', [ProdukController::class, 'index'])->middleware('auth:user');
Route::post('/bahan-baku', [ProdukController::class, 'store']);
Route::delete('/bahan-baku/{produk:id}', [ProdukController::class, 'destroy']);
Route::get('/list-bahan-baku', [ProdukController::class, 'listProduk'])->middleware('auth:user');

Route::get('/bahan-setengah-jadi', [BahanSetengahJadiController::class, 'index'])->middleware('auth:user');
Route::post('/api/tambah-bahan-baku-setengah-jadi', [BahanSetengahJadiController::class, 'tambahBahanBakuSetengahJadi']);
Route::post('/api/tambah-tinta-setengah-jadi', [BahanSetengahJadiController::class, 'tambahTintaSetengahJadi']);
Route::post('/bahan-setengah-jadi', [BahanSetengahJadiController::class, 'store']);
Route::delete('/bahan-setengah-jadi/{bahan_setengah_jadi:id}', [BahanSetengahJadiController::class, 'destroy']);
Route::get('/list-bahan-setengah-jadi', [BahanSetengahJadiController::class, 'listBahanSetengahJadi'])->middleware('auth:user');
Route::get('/bahan-setengah-jadi/{bahan_setengah_jadi:id}', [BahanSetengahJadiController::class, 'detailBahanSetengahJadi'])->middleware('auth:user');

Route::get('/tinta', [TintaController::class, 'index'])->middleware('auth:user');
Route::post('/tinta', [TintaController::class, 'store']);
Route::delete('/tinta/{tinta:id}', [TintaController::class, 'destroy']);
Route::get('/list-tinta', [TintaController::class, 'listTinta'])->middleware('auth:user');

Route::get('/finishing', [FinishingController::class, 'index'])->middleware('auth:user');
Route::post('/api/tambah-bahan-finishing', [FinishingController::class, 'tambahBahanFinishing']);
Route::post('/finishing', [FinishingController::class, 'store']);
Route::delete('/finishing/{finishing:id}', [FinishingController::class, 'destroy']);
Route::get('/list-finishing', [FinishingController::class, 'listFinishing'])->middleware('auth:user');
Route::get('/finishing/{finishing:id}', [FinishingController::class, 'detailBahanFinishing'])->middleware('auth:user');

Route::get('/detail-produk', [DetailProdukController::class, 'index'])->middleware('auth:user');
Route::post('/api/tambah-bahan-detail-produk', [DetailProdukController::class, 'tambahBahanDetailProduk']);
Route::post('/detail-produk', [DetailProdukController::class, 'store']);
Route::delete('/detail-produk/{detail_produk:id}', [DetailProdukController::class, 'destroy']);
Route::get('/detail-produk/{detail_produk:id}', [DetailProdukController::class, 'show'])->middleware('auth:user');
Route::put('/detail-produk/{detail_produk:id}', [DetailProdukController::class, 'edit']);
Route::post('/detail-produk/{detail_produk:id}', [DetailProdukController::class, 'update']);
Route::get('/list-detail-produk', [DetailProdukController::class, 'listDetailProduk'])->middleware('auth:user');
Route::get('/kalkulasi-produk', [DetailProdukController::class, 'kalkulasiProduk'])->middleware('auth:user');

// Route::get('/stok', [StokCabangController::class, 'index'])->middleware('auth:user');
// Route::post('/stok', [StokCabangController::class, 'store']);

Route::get('/promo', [PromoController::class, 'index'])->middleware('auth:user');
Route::get('/list-promo', [PromoController::class, 'listPromo'])->middleware('auth:user');
Route::post('/promo', [PromoController::class, 'store']);
Route::delete('/promo/{promo:id}', [PromoController::class, 'destroy']);

Route::get('/komplain', [KomplainController::class, 'index'])->middleware('auth:user');
Route::get('/komplain/{komplain:id}', [KomplainController::class, 'indexDetail'])->middleware('auth:user,pelanggan');
Route::delete('/komplain/{komplain:id}', [KomplainController::class, 'destroy']);
Route::get('/list-komplain', [KomplainController::class, 'listKomplain'])->middleware('auth:user');
Route::post('/komplain', [KomplainController::class, 'store']);
Route::get('/daftar-komplain', [KomplainController::class, 'listKomplainPelanggan'])->middleware('auth:pelanggan');
Route::get('/add-komplain', [KomplainController::class, 'addKomplainPelanggan'])->middleware('auth:pelanggan');

Route::get('/laporan-laba-rugi', [LaporanController::class, 'laporanLabaRugi'])->middleware('auth:user');
Route::post('/api/laporan-laba-rugi', [LaporanController::class, 'fetchLabaRugi']);
Route::get('/laporan-transaksi', [LaporanController::class, 'laporanTransaksi'])->middleware('auth:user');
Route::post('/api/laporan-penjualan-produk', [LaporanController::class, 'fetchProduk']);
Route::post('/api/laporan-transaksi-harian', [LaporanController::class, 'fetchTransaksi']);
Route::post('/api/laporan-pendapatan-harian', [LaporanController::class, 'fetchPendapatan']);;
Route::get('/laporan-pembelian', [LaporanController::class, 'laporanPembelian'])->middleware('auth:user');
Route::post('/api/laporan-pembelian-bahan-baku', [LaporanController::class, 'fetchBahanBaku']);
Route::post('/api/laporan-pembelian-bahan-baku-jumlah', [LaporanController::class, 'fetchBahanBakuJumlah']);
Route::post('/api/laporan-pembelian-tinta', [LaporanController::class, 'fetchTinta']);
Route::post('/api/laporan-pembelian-tinta-jumlah', [LaporanController::class, 'fetchTintaJumlah']);
Route::get('/laporan-performa', [LaporanController::class, 'laporanPerforma'])->middleware('auth:user');
Route::post('/api/laporan-performa', [LaporanController::class, 'fetchPerformaPegawai']);
Route::get('/laporan-performa-individu', [LaporanController::class, 'laporanPerformaIndividu'])->middleware('auth:user');
Route::get('/bukti-komplain/{komplain:id}', [LaporanController::class, 'downloadBuktiKomplain'])->middleware('auth:user,pelanggan');

//Pelanggan
Route::get('/profile', [ProfilePelangganController::class, 'index'])->middleware('auth:pelanggan');
Route::post('/profile/{id}', [ProfilePelangganController::class, 'update']);
Route::get('/user-change-password', [ProfilePelangganController::class, 'changePassword'])->middleware('auth:pelanggan');
Route::post('/user-change-password/{id}', [ProfilePelangganController::class, 'updatePassword']);

// Route::get('/category', [KategoriController::class, 'cardKategori'])->middleware('auth:pelanggan');

Route::get('/shopping-cart', [CartController::class, 'index'])->middleware('auth:pelanggan');
Route::get('/shopping-cart/add', [CartController::class, 'listProduk'])->middleware('auth:pelanggan');
Route::post('/api/fetch-gambar-kategori', [CartController::class, 'fetchGambarKategori']);
Route::post('/shopping-cart', [CartController::class, 'store']);
Route::get('/file/{id}', [CartController::class, 'downloadFile'])->middleware('auth:user,pelanggan');
Route::post('/api/fetch-keranjang', [CartController::class, 'fetchKeranjang']);
Route::post('/api/fetch-promo', [CartController::class, 'fetchPromo']);
Route::post('/api/delete-item', [CartController::class, 'deleteItem']);
// Route::delete('/shopping-cart/{cart:id}', [CartController::class, 'destroy']);
Route::post('/checkout', [PenawaranController::class, 'store']);

Route::get('/list-penawaran', [PenawaranController::class, 'listPenawaran'])->middleware('auth:user');
Route::get('/history-penawaran', [PenawaranController::class, 'indexHistory'])->middleware('auth:user,pelanggan');
Route::get('/daftar-penawaran', [PenawaranController::class, 'index'])->middleware('auth:pelanggan');
Route::get('/penawaran/{penawaran:id}', [PenawaranController::class, 'detailPenawaran'])->middleware('auth:user,pelanggan');
Route::post('/penawaran/{penawaran:id}', [PenawaranController::class, 'update']);
Route::get('/penawaran/{penawaran:id}/{detail_penawaran:id}', [DetailPenawaranController::class, 'index'])->middleware('auth:user,pelanggan');
Route::post('/penawaran/{penawaran:id}/{detail_penawaran:id}', [DetailPenawaranController::class, 'updateDetailProdukPenawaran']);
Route::delete('/penawaran/{penawaran:id}', [PenawaranController::class, 'destroy']);
Route::get('/file-penawaran/{id}', [PenawaranController::class, 'downloadFile'])->middleware('auth:user,pelanggan');
Route::get('/bukti-pembayaran/{id}', [PenawaranController::class, 'downloadBuktiPembayaran'])->middleware('auth:user,pelanggan');
Route::post('/fetch-pegawai', [PenawaranController::class, 'fetchPegawai']);