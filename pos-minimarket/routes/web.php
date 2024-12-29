<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PembelianDetailController;
use App\Http\Controllers\PenjualanDetailController;
use App\Http\Controllers\LaporanPembelianController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\LaporanPengeluaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', fn () => redirect()->route('login'));

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');
});

Route::group(['middleware' => 'auth'], function (){
    // route untuk kategori
    Route::get('/kategori/data', [KategoriController::class,'data'])->name('kategori.data');
    Route::resource('/kategori', KategoriController::class);

    // route untuk produk
    Route::get('/produk/data', [ProdukController::class,'data'])->name('produk.data');
    Route::post('/produk/delete-selected', [ProdukController::class,'deleteSelected'])->name('produk.delete_selected');
    Route::post('/produk/cetak-barcode', [ProdukController::class,'cetakBarcode'])->name('produk.cetak_barcode');
    Route::resource('produk', ProdukController::class);

    // route untuk member
    Route::get('/member/data', [MemberController::class,'data'])->name('member.data');
    Route::resource('/member', MemberController::class);
    Route::post('/member/cetak-member', [MemberController::class, 'cetakMember'])->name('member.cetak_member');

    Route::get('/supplier/data', [SupplierController::class,'data'])->name('supplier.data');
    Route::resource('/supplier', SupplierController::class);

    Route::get('/pengeluaran/data', [PengeluaranController::class,'data'])->name('pengeluaran.data');
    Route::resource('/pengeluaran', PengeluaranController::class);

    Route::get('/pembelian/data', [PembelianController::class, 'data'])->name('pembelian.data');
    Route::get('/pembelian/{id}/create', [PembelianController::class, 'create'])->name('pembelian.create');
    Route::resource('/pembelian', PembelianController::class)
    ->except('create');
    
    Route::get('/pembelian_detail/{id}/data', [PembelianDetailController::class, 'data'])->name('pembelian_detail.data');
    Route::get('/pembelian_detail/loadform/{diskon}/{total}', [PembelianDetailController::class, 'load_form'])->name('pembelian_detail.load_form');
    Route::resource('/pembelian_detail', PembelianDetailController::class)
    ->except('create', 'show', 'edit');
    
    
    
    Route::get('/penjudalan/data', [PenjualanController::class, 'data'])->name('penjualan.data');
    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
    Route::get('/penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
    Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');

    Route::get('/transaksi/baru', [PenjualanController::class, 'create'])->name('transaksi.baru');
    Route::post('/transaksi/simpan', [PenjualanController::class, 'store'])->name('transaksi.simpan');
    Route::get('/transaksi/selesai', [PenjualanController::class, 'selesai'])->name('transaksi.selesai');
    Route::get('/transaksi/nota_kecil', [PenjualanController::class, 'notaKecil'])->name('transaksi.nota_kecil');
    Route::get('/transaksi/nota_besar', [PenjualanController::class, 'notaBesar'])->name('transaksi.nota_besar');

    Route::get('/transaksi/{id}/data', [PenjualanDetailController::class, 'data'])->name('transaksi.data');
    Route::get('/transaksi/loadform/{diskon}/{total}/{diterima}', [PenjualanDetailController::class, 'loadForm'])->name('transaksi.load_form');
    Route::resource('/transaksi', PenjualanDetailController::class)
    ->except('show');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/refresh', [LaporanController::class, 'refresh'])->name('laporan.refresh');
    Route::get('/laporan/data/{awal}/{akhir}', [LaporanController::class, 'data'])->name('laporan.data');
    Route::get('/laporan/pdf/{awal}/{akhir}', [LaporanController::class, 'exportPdf'])->name('laporan.export_pdf');

    Route::get('/laporan_pengeluaran', [LaporanPengeluaranController::class, 'index'])->name('laporan_pengeluaran.index');
    Route::get('/laporan_pengeluaran/refresh', [LaporanPengeluaranController::class, 'refresh'])->name('laporan_pengeluaran.refresh');
    Route::get('/laporan_pengeluaran/data/{awal}/{akhir}', [LaporanPengeluaranController::class, 'data'])->name('laporan_pengeluaran.data');
    Route::get('/laporan_pengeluaran/pdf/{awal}/{akhir}', [LaporanPengeluaranController::class, 'exportPdf'])->name('laporan_pengeluaran.export_pdf');
    
    Route::get('/laporan_penjualan', [LaporanPenjualanController::class, 'index'])->name('laporan_penjualan.index');
    Route::get('/laporan_penjualan/refresh', [LaporanPenjualanController::class, 'refresh'])->name('laporan_penjualan.refresh');
    Route::get('/laporan_penjualan/data/{awal}/{akhir}', [LaporanPenjualanController::class, 'data'])->name('laporan_penjualan.data');
    Route::get('/laporan_penjualan/pdf/{awal}/{akhir}', [LaporanPenjualanController::class, 'exportPdf'])->name('laporan_penjualan.export_pdf');
    
    Route::get('/laporan_pembelian', [LaporanPembelianController::class, 'index'])->name('laporan_pembelian.index');
    Route::get('/laporan_pembelian/refresh', [LaporanPembelianController::class, 'refresh'])->name('laporan_pembelian.refresh');
    Route::get('/laporan_pembelian/data/{awal}/{akhir}', [LaporanPembelianController::class, 'data'])->name('laporan_pembelian.data');
    Route::get('/laporan_pembelian/pdf/{awal}/{akhir}', [LaporanPembelianController::class, 'exportPdf'])->name('laporan_pembelian.export_pdf');
});
