<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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

Route::controller(AuthController::class)->group(function () {
	Route::get('register', 'register')->name('register');
	Route::post('register', 'registerSimpan')->name('register.simpan');

	Route::get('login', 'login')->name('login');
	Route::post('login', 'loginAksi')->name('login.aksi');

	Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::get('/', function () {
	return view('welcome');
});

Route::middleware('auth')->group(function () {
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::controller(BarangController::class)->prefix('barang')->group(function () {
		Route::get('', 'index')->name('barang');
		Route::get('tambah', 'tambah')->name('barang.tambah');
		Route::post('tambah', 'simpan')->name('barang.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('barang.edit');
		Route::post('edit/{id}', 'update')->name('barang.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('barang.hapus');
	});

	Route::controller(KategoriController::class)->prefix('kategori')->group(function () {
		Route::get('', 'index')->name('kategori');
		Route::get('tambah', 'tambah')->name('kategori.tambah');
		Route::post('tambah', 'simpan')->name('kategori.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('kategori.edit');
		Route::post('edit/{id}', 'update')->name('kategori.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('kategori.hapus');
	});

	Route::controller(CustomerController::class)->prefix('customer')->group(function () {
		Route::get('', 'index')->name('customer');
		Route::get('tambah', 'tambah')->name('customer.tambah');
		Route::post('tambah', 'simpan')->name('customer.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('customer.edit');
		Route::post('edit/{id}', 'update')->name('customer.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('customer.hapus');
	});

	Route::controller(TransaksiController::class)->prefix('transaksi')->group(function () {
		Route::get('/transaksi', [TransaksiController::class, 'transaksi'])->name('transaksi');
    	Route::get('/exportpdf', [TransaksiController::class, 'exportpdf'])->name('exportpdf');
    	Route::get('/invoiceadmin/{id}', [TransaksiController::class, 'invoice'])->name('invoiceadmin');
    	Route::get('/pesanan/{id}', [TransaksiController::class, 'cekbuktitf'])->name('cekbuktitf');
    	Route::get('/downloadbuktitf/{id}', [TransaksiController::class, 'downloadbuktitf'])->name('downloadbuktitf');
    	Route::get('/konfirmasitf/{id}', [TransaksiController::class, 'konfirmasitf'])->name('konfirmasitf');
    	Route::get('/selesai/{id}', [TransaksiController::class, 'selesai'])->name('selesai');

	});

	Route::group(['prefix'=>'pembeli', 'middleware' ] ,function(){
		Route::get('/dashboard', [LoginController::class, 'pembeli'])->name('pembeli');
		Route::get('/belanja', [BarangController::class, 'belanja'])->name('belanja');
		Route::get('/detailbelanja/{id}', [BarangController::class, 'detailbelanja'])->name('detailbelanja');
		Route::post('/pesan/{id}', [TransaksiController::class, 'pesan'])->name('pesan');
		Route::get('/pesanlangsung/{id}', [TransaksiController::class, 'pesanlangsung'])->name('pesanlangsung');
		Route::get('/checkout', [TransaksiController::class, 'checkout'])->name('checkout');
		Route::get('/deleteco/{id}', [TransaksiController::class, 'deleteco'])->name('deleteco');
		Route::get('/transfer', [TransaksiController::class, 'transfer'])->name('transfer');
		Route::get('/langsung', [TransaksiController::class, 'langsung'])->name('langsung');
		Route::get('/riwayat', [TransaksiController::class, 'riwayat'])->name('riwayat');
		Route::get('/riwayatdetail/{id}', [TransaksiController::class, 'riwayatdetail'])->name('riwayatdetail');
		Route::post('/buktitf/{id}', [TransaksiController::class, 'buktitf'])->name('buktitf');
	});
});
