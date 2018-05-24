<?php

Route::get('/', 'MainController@index');

Route::resource('produk', 'ProduksController')->middleware('can:data-produk');
Route::post('/produk-import', 'ProduksController@produkImport')
    ->name('produk.import')
    ->middleware('can:data_produk');
Route::get('/get_harga_produk/{id}', 'ProduksController@getHargaProduk')
    ->middleware('can:data_produk');

Route::resource('satuan', 'SatuansController')
    ->middleware('can:data_satuan');

Route::resource('distributor', 'DistributorsController')
    ->middleware('can:data_distributor');

Route::post('/distributor-import', 'DistributorsController@distributorImport')
    ->name('distributor.import')
    ->middleware('can:data_distributor');

Route::resource('pelanggan', 'PelanggansController')
    ->middleware('can:data_pelanggan');

Route::post('/pelanggan-import', 'PelanggansController@pelangganImport')
    ->name('pelanggan.import')
    ->middleware('can:data_pelanggan');

Route::post('/pembelian/search', 'PembelianController@index_search')
    ->middleware('can:data_pembelian');

Route::resource('pembelian', 'PembelianController')
    ->middleware('can:data_pembelian');

Route::post('/penjualan/search', 'PenjualanController@index_search')
    ->middleware('can:data_penjualan');

Route::resource('penjualan', 'PenjualanController')
    ->middleware('can:data_penjualan');

Route::resource('eqo', 'PengaturanEqoController')
    ->middleware('can:pengaturan_eqo');

Route::resource('user', 'UserController')
    ->middleware('can:data_user');

Route::get('/profile/{id}', 'UserController@profile')->name('profile');

Route::prefix('/report')->group(function(){
    Route::get('/pembelian', 'ReportController@pembelian')->name('report.pembelian')
        ->middleware('can:laporan');
    Route::post('/pembelian', 'ReportController@reportPembelian')->name('export.pembelian')
        ->middleware('can:laporan');
    Route::get('/detail-pembelian/{id}', 'ReportController@reportDetailPembelian')
        ->middleware('can:laporan');
    Route::get('/penjualan', 'ReportController@penjualan')->name('report.penjualan')
        ->middleware('can:laporan');
    Route::post('/penjualan', 'ReportController@reportPenjualan')->name('export.penjualan')
        ->middleware('can:laporan');
    Route::get('/detail-penjualan/{id}', 'ReportController@reportDetailPenjualan')
        ->middleware('can:laporan');
});

Auth::routes();

//Route::get('home', 'HomeController@index')->name('home');
Route::prefix('/pengaturan')->group(function(){
    Route::get('/', 'PengaturanController@index')->name('pengaturan')
        ->middleware('can:pengaturan');
    Route::post('/', 'PengaturanController@simpanPerubahan')
        ->middleware('can:pengaturan');
});

Route::get('/auto-purchase', 'PembelianController@autoPurchase')->name('auto.purchase');
Route::get('/make-purchase', 'PembelianController@makePurchase')->name('make.purchase');
Route::get('/barang-diterima/{id}', 'PembelianController@barangDiterima');
Route::get('/barang-dikirim/{id}', 'PenjualanController@barangDikirim');
Route::post('/cek-ketersediaan', 'PenjualanController@cekKetersediaanProduk');
