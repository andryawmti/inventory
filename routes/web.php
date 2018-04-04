<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'MainController@index');
Route::resource('produk', 'ProduksController');
Route::post('/produk-import', 'ProduksController@produkImport')->name('produk.import');
Route::get('/get_harga_produk/{id}', 'ProduksController@getHargaProduk');
Route::resource('satuan', 'SatuansController');
Route::resource('distributor', 'DistributorsController');
Route::post('/distributor-import', 'DistributorsController@distributorImport')->name('distributor.import');
Route::resource('pelanggan', 'PelanggansController');
Route::post('/pelanggan-import', 'PelanggansController@pelangganImport')->name('pelanggan.import');
Route::post('/pembelian/search', 'PembelianController@index_search');
Route::resource('pembelian', 'PembelianController');
Route::post('/penjualan/search', 'PenjualanController@index_search');
Route::resource('penjualan', 'PenjualanController');
Route::resource('eqo', 'PengaturanEqoController');
Route::resource('user', 'UserController');
Route::get('/profile/{id}', 'UserController@profile')->name('profile');
Route::prefix('/report')->group(function(){
    Route::get('/pembelian', 'ReportController@pembelian')->name('report.pembelian');
    Route::post('/pembelian', 'ReportController@reportPembelian')->name('export.pembelian');
    Route::get('/detail-pembelian/{id}', 'ReportController@reportDetailPembelian');
    Route::get('/penjualan', 'ReportController@penjualan')->name('report.penjualan');
    Route::post('/penjualan', 'ReportController@reportPenjualan')->name('export.penjualan');
    Route::get('/detail-penjualan/{id}', 'ReportController@reportDetailPenjualan');
});
Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
Route::prefix('/pengaturan')->group(function(){
    Route::get('/', 'PengaturanController@index')->name('pengaturan');
    Route::post('/', 'PengaturanController@simpanPerubahan');
});
Route::get('/auto-purchase', 'PembelianController@autoPurchase')->name('auto.purchase');
Route::get('/make-purchase', 'PembelianController@makePurchase')->name('make.purchase');
Route::get('/barang-diterima/{id}', 'PembelianController@barangDiterima');
Route::get('/barang-dikirim/{id}', 'PenjualanController@barangDikirim');
Route::post('/cek-ketersediaan', 'PenjualanController@cekKetersediaanProduk');
