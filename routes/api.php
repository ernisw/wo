<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/registerpengguna', 'PenggunaController@store');
Route::post('/loginpengguna', 'PenggunaController@login');
// Route::post('/loginpengguna', 'PenggunaController@update');
// Route::post('/loginpengguna', 'PenggunaController@delete');
// Route::post('/loginpengguna', 'PenggunaController@show');


Route::post('/updateprofile/{id}', 'PenggunaController@update');

// route vendor
Route::get('/vendor','API\VendorController@index');
Route::get('/getallvendor','ApiVendor@getAllVendor');
Route::post('/vendor', 'API\VendorController@store');
Route::put('/vendor/{id}', 'API\VendorController@update');
Route::get('/vendor/{id}', 'API\VendorController@show');
Route::delete('/vendor/{id}', 'API\VendorController@destroy');

// wo route
Route::get('/getallwo','ApiWo@getAllWo');
Route::get('/getdetailwo/{id}','ApiWo@getDetail');
Route::get('/getdetailpaket/{id}','ApiWo@getdDetailPaket');
Route::post('/getknn','ApiWo@getknn');
Route::post('/getsaw','ApiWo@getsaw');

//cart
Route::post('/cart/input','API\CartController@store');
Route::get('/cart/get/{id}','API\CartController@get');
Route::get('/cart/delete/{id}','API\CartController@destroy');

// route layanan

Route::post('/getlayananbywo','ApiWo@getLayananByWo');
Route::get('/layanan','API\LayananController@index');
Route::post('/layanan', 'API\LayananController@store');
Route::put('/layanan/{id}', 'API\LayananController@update');
Route::get('/layanan/{id}', 'API\LayananController@show');
Route::delete('/layanan/{id}', 'API\LayananController@destroy');

// route paket
Route::post('/getpaketbywo','ApiWo@getById');
Route::get('/paket','API\PaketController@index');
Route::get('/getallpaket','API\PaketController@getAllPaket');
Route::post('/paket', 'API\PaketController@store');
Route::put('/paket/{id}', 'API\PaketController@update');
Route::get('/paket/{id}', 'API\PaketController@show');
Route::delete('/paket/{id}', 'API\PaketController@destroy');

// route transaksi
Route::get('/transaksi','API\TransaksiController@index');
Route::post('/transaksi', 'API\TransaksiController@store');
Route::put('/transaksi/{id}', 'API\TransaksiController@update');
Route::get('/transaksi/{id}', 'API\TransaksiController@show');
Route::delete('/transaksi/{id}', 'API\TransaksiController@destroy');

//route detail transaksi
Route::get('/detailtransaksi','API\DetailTransaksiController@index');
Route::post('/detailtransaksi', 'API\DetailTransaksiController@store');
Route::put('/detailtransaksi/{id}', 'API\DetailTransaksiController@update');
Route::get('/detailtransaksi/{id}', 'API\DetailTransaksiController@show');
Route::delete('/detailtransaksi/{id}', 'API\DetailTransaksiController@destroy');

//route metode pembayaran
Route::get('/metodepembayaran','API\MetodePembayaranController@index');
Route::post('/metodepembayaran', 'API\MetodePembayaranController@store');
Route::put('/metodepembayaran/{id}', 'API\MetodePembayaranController@update');
Route::get('/metodepembayaran/{id}', 'API\MetodePembayaranController@show');
Route::delete('/metodepembayaran/{id}', 'API\MetodePembayaranController@destroy');

// keranjang
Route::post('/tambahkeranjang', 'API\KeranjangController@tambahKeranjang');
Route::get('/getkeranjang/{idUser}', 'API\KeranjangController@getKeranjangByUser');

// route detail paket
Route::get('/detailpaket','API\DetailPaketController@index');
Route::get('/getalldetailpaket','API\DetailPaketController@getAllDetailPaket');
Route::post('/detailpaket', 'API\DetailPaketController@store');
Route::put('/detailpaket/{id}', 'API\DetailPaketController@update');
Route::get('/detailpaket/{id}', 'API\DetailPaketController@show');
Route::delete('/detailpaket/{id}', 'API\DetailPaketController@destroy');

// route paket vendor
Route::get('/paket_vendor','API\PaketVendorController@index');
Route::get('/getallpaketvendor','API\PaketVendorController@getAllPaketVendor');
Route::post('/paket_vendor', 'API\PaketVendorController@store');
Route::put('/paket_vendor/{id}', 'API\PaketVendorController@update');
Route::get('/paket_vendor/{id}', 'API\PaketVendorController@show');
Route::delete('/paket_vendor/{id}', 'API\PaketVendorController@destroy');

Route::post('/transaksi', 'PembayaranController@createTransaksi');
Route::get('/transaksi/get/{id}', 'PembayaranController@getByUser');
Route::post('/transaksi/upload/{id}', 'PembayaranController@upload');
Route::post('/transaksi/update/{id}', 'PembayaranController@update');
Route::post('/updateprofile/{id}', 'PenggunaController@updateProfile');