<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


//akses admin
Route::group(['middleware' => ['auth', 'cekrole:Admin']], function () {
    
    Route::get('/admin', 'AdminController@index');
    Route::get('/vendor_wo', 'VendorController@index')->name('dataVendorWo');
    Route::get('/vendor_wo/data', 'VendorController@data');
    Route::get('/paket', 'PaketController@index')->name('dataPaket');

    // //routeakseskonfirmasi
    // Route::get('/persetujuan', 'PenggunaController@persetujuanregis')->name('dataPersetujuanRegis');
    //  Route::get('/persetujuan/konfirmasi/{id}', 'PenggunaController@konfirmasiregis')->name('konfirmasiRegis');
    //  Route::get('/persetujuan/tolak/{id}', 'PenggunaController@tolakregis')->name('tolakRegis');

    // Route::get('/paket/data', 'PaketController@data');
    Route::get('/pengguna', 'PenggunaController@index')->name('dataPengguna');
    Route::get('/pengguna/forminputpengguna', 'PenggunaController@inputPengguna')->name('inputPengguna');
    Route::post('/pengguna/insertpengguna', 'PenggunaController@store')->name('insertPengguna');
    Route::get('/pengguna/formeditpengguna/{id}', 'PenggunaController@show')->name('formEditPengguna');
    Route::post('/pengguna/updatepengguna/{id}', 'PenggunaController@update')->name('updatePengguna');
    Route::get('/pengguna/deletepengguna/{id}', 'PenggunaController@delete')->name('deletePengguna');
    Route::get('/pengguna/konfirmasipengguna/{id}', 'PenggunaController@konfirmasiregis')->name('konfirmasiRegis');
    Route::get('/pengguna/tolakpengguna/{id}', 'PenggunaController@tolakregis')->name('tolakRegis');
    Route::get('/pengguna/belum/{id}', 'PenggunaController@belumproses')->name('belumProses');
    // Route::get('/pengguna/data', 'PenggunaController@data');
    // routes layanan
    Route::get('/layanan', 'LayananController@index')->name('dataLayanan');
    // Route::get('/layanan/data', 'LayananController@data');
    // Route::get('/transaksi', 'TransaksiController@index')->name('dataLayanan');
    // Route::get('/layanan/data', 'LayananController@data');
    Route::get('/layanan/inputlayanan', 'LayananController@inputLayanan')->name('inputLayanan');
    Route::post('/layanan/insertlayanan', 'LayananController@store')->name('insertLayanan');
    Route::get('/layanan/formeditlayanan/{id}', 'LayananController@show')->name('formEditLayanan');
    Route::post('/layanan/updatelayanan/{id}', 'LayananController@update')->name('updateLayanan');
    Route::get('/layanan/deletelayanan/{id}', 'LayananController@delete')->name('deleteLayanan');

    // Paket
    Route::get('/paket/inputpaket', 'PaketController@inputPaket')->name('inputPaket');
    Route::post('/paket/insertpaket', 'PaketController@store')->name('insertPaket');
    Route::get('/paket/formeditpaket/{id}', 'PaketController@show')->name('formEditPaket');
    Route::post('/paket/updatepaket/{id}', 'PaketController@update')->name('updatePaket');
    Route::get('/paket/deletepaket/{id}', 'PaketController@delete')->name('deletePaket');
    
    // vendor
    Route::get('/vendor/inputvendor', 'VendorController@inputVendor')->name('inputVendor');
    Route::post('/vendor/insertvendor', 'VendorController@store')->name('insertVendor');
    Route::get('/vendor/formeditvendor/{id}', 'VendorController@show')->name('formEditVendor');
    Route::post('/vendor/updatevendor/{id}', 'VendorController@update')->name('updateVendor');
    Route::get('/vendor/deletevendor/{id}', 'VendorController@delete')->name('deleteVendor');

    //route wo
    Route::get('/admin/wo', 'WoController@index')->name('dataWO');
    Route::get('admin/wo/inputwo', 'WoController@inputVendor')->name('inputWo');
    Route::post('admin/wo/insertwo', 'WoController@store')->name('insertWo');
    Route::get('admin/wo/formeditwo/{id}', 'WoController@show')->name('formEditWo');
    Route::post('admin/wo/updatewo/{id}', 'WoController@update')->name('updateWo');
    Route::get('admin/wo/deletewo/{id}', 'WoController@delete')->name('deleteWo');


});

//akses vendor
Route::get('/paketvendor', 'PaketVendorController@index')->name('dataPaketVendor');
Route::group(['middleware' => ['auth', 'cekrole:Vendor']], function () {
    Route::get('/vendor', 'HomeController@index');

    // Paket Vendor
    Route::get('/paketvendor/forminputpaketvendor', 'PaketVendorController@inputPaketVendor')->name('inputPaketVendor');
    Route::post('/paketvendor/insertpaketvendor', 'PaketVendorController@store')->name('insertPaketVendor');
    Route::get('/paketvendor/formeditpaketvendor/{id}', 'PaketVendorController@show')->name('formEditPaketVendor');
    Route::post('/paketvendor/updatepaketvendor/{id}', 'PaketVendorController@update')->name('updatePaketVendor');
    Route::get('/paketvendor/deletepaketvendor/{id}', 'PaketVendorController@delete')->name('deletePaketVendor');

     // Paket Transaksi
     Route::get('/transaksi', 'TransaksiController@index')->name('dataTransaksi');
     Route::get('/transaksi/input', 'TransaksiController@inputPaketVendor')->name('inputTransaksi');
     Route::post('/transaksi/insert', 'TransaksiController@store')->name('insertTransaksi');
     Route::get('/transaksi/formedit/{id}', 'TransaksiController@show')->name('formEditTransaksi');
     Route::post('/transaksi/update/{id}', 'TransaksiController@update')->name('updateTransaksi');
     Route::get('/transaksi/deletetransaksi/{id}', 'TransaksiController@status')->name('deleteTransaksi');

      // route layanan vendor
      Route::get('/layananvendor', 'LayananVendorController@index')->name('dataLayananVendor');
      Route::get('/layananvendor/inputlayananvendor', 'LayananVendorController@inputLayanan')->name('inputLayananVendor');
      Route::post('/layananvendor/insertlayananvendor', 'LayananVendorController@store')->name('insertLayananVendor');
      Route::get('/layananvendor/formeditlayananvendor/{id}', 'LayananVendorController@show')->name('formEditLayananVendor');
      Route::post('/layananvendor/updatelayananvendor/{id}', 'LayananVendorController@update')->name('updateLayananVendor');
      Route::get('/layananvendor/deletelayananvendor/{id}', 'LayananVendorController@delete')->name('deleteLayananVendor');
     
     //route ganti stasus
     Route::get('/transaksi/gantistatus1/{id}', 'TransaksiController@status1')->name('status1');
     Route::get('/transaksi/gantistatus2/{id}', 'TransaksiController@status2')->name('status2');
     Route::get('/transaksi/gantistatus3/{id}', 'TransaksiController@status3')->name('status3');
     

     Route::get('/pengajuan', 'LayananVendorController@pengajuankerjasama')->name('dataPengajuanKerjasama');
     Route::get('/pengajuan/konfirmasi/{id}', 'LayananVendorController@konfirmasi')->name('konfirmasiKerjasama');
     Route::get('/pengajuan/tolak/{id}', 'LayananVendorController@tolak')->name('tolakKerjasama');


     //route profile
    Route::get('/profilevendor', 'ProfileVendorController@index')->name('dataProfile');
    
    //route transaksi
   Route::get('/transaksiview', 'Transaksi1Controller@index')->name('dataTransaksi1');
   Route::get('/transaksiview/konfirmasi/{id}', 'Transaksi1Controller@konfirmasiByVendor')->name('konfirmasiByVendor');
   Route::get('/transaksiview/konfirmasipembayaran/{id}', 'Transaksi1Controller@konfirmasiPembayaranByVendor');
    

});
// akses wo
Route::group(['middleware' => ['auth', 'cekrole:Wo']], function () {
    Route::get('/wo', 'PaketWoController@index')->name('dataPaketWo');
    Route::get('/wo/forminputwo', 'PaketWoController@inputPaketWo')->name('wotambahPaket');
    Route::post('/wo/insertpaketwo', 'PaketWoController@store')->name('insertPaketWo');
    Route::get('/wo/tambahlayanan/{idPaket}', 'PaketWoController@tambahLayanan')->name('tambahLayananWo');
    Route::get('/wo/tambahlayaankepaket/{idPaket}/{idLayanan}', 'PaketWoController@tambahLayananKePaket')->name('tambahLayananKePaketWo');
    Route::get('/wo/detailpaket/{idPaket}', 'PaketWoController@detailPaket')->name('detailPaketWo');
    Route::get('/wo/editpaket/{idPaket}', 'PaketWoController@editpaket')->name('updatePaketVendor');
    Route::post('/wo/updatepaket/{idPaket}', 'PaketWoController@update')->name('prosesUpdatePaketVendor');
    Route::get('/wo/deletepaket/{idPaket}', 'PaketWoController@update')->name('deletePaketWo');

    //route layanan wo
    Route::get('/layananwo', 'LayananWoController@index')->name('dataLayananWO');
    Route::get('/layananwo/inputlayananwo', 'LayananWoController@inputLayananWo')->name('wotambahLayanan');
    Route::post('/layananwo/insertlayananwo', 'LayananWoController@store')->name('insertLayananWo');
    Route::get('/layananwo/formeditlayananwo/{id}', 'LayananWoController@show')->name('formEditLayananWo');
    Route::post('/layananwo/updatelayananwo/{id}', 'LayananWoController@update')->name('updateLayananWo');
    Route::get('/layananwo/deletelayananwo/{id}', 'LayananWoController@delete')->name('deleteLayananWo');

    //route profile
    Route::get('/profilewo', 'ProfileController@index')->name('dataProfileWo');

    

    //route view profile vendor
    Route::get('/viewvendor/{id}', 'PaketWoController@getProfileVendor')->name('dataProfileVendor');

    

   //route transaksi
   Route::get('/viewtransaksi', 'ViewTransaksiController@index')->name('dataTransaksiView');
   Route::get('/viewtransaksi/konfirmasi/{id}', 'ViewTransaksiController@konfirmasi')->name('konfirmasi');
   Route::get('/viewtransaksi/konfirmasipembayaran/{id}', 'ViewTransaksiController@konfirmasipembayaran')->name('konfirmasipembayaran');
//    Route::get('/viewtransaksi/bukti/{id}', 'ViewTransaksiController@bukti')->name('bukti');
//    Route::get('/viewtransaksi/buktibayar/{id}', 'ViewTransaksiController@buktibayar')->name('buktibayar');
});





