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

Route::get('/', function () {
    return view('splash');
});
Route::post('/login', 'LoginsController@setLogin');
Route::get('/logout', 'LoginsController@setLogout');

// -------------------------- ADMIN --------------------------
Route::get('/admin/dashboard', 'AdminController@index');

// Mutu
Route::get('/admin/mutu-panen', 'AdminController@getMutuPanen');
Route::get('/admin/mutu-panen/rincian/{id}', 'AdminController@rincianMutuPanen');

// Penilaian
Route::get('/admin/penilaian', 'AdminController@getPenilaian');
Route::get('/admin/penilaian/tambah', 'AdminController@viewNilaiMutu');
Route::post('/admin/penilaian/set', 'AdminController@setNilaiMutu');
Route::get('/admin/penilaian/hasil', function () {return view('admin/hasil-penilaian'); });
// Route::get('/admin/penilaian/ubah/{id}', 'AdminController@getDataPenilaian');
// Route::post('/admin/penilaian/set/{id}', 'AdminController@setUpdatePenilaian');

// Pengaturan Kriteria
Route::get('/admin/kriteria', 'AdminController@kriteria');
Route::get('/admin/kriteria/tambah', function () {return view('admin/tambah-kriteria'); });
Route::get('/admin/kriteria/hapus/{id}', 'AdminController@hapusKriteria');
Route::get('/admin/kriteria/ubah/{id}', 'AdminController@viewUbahKriteria');
Route::post('/admin/kriteria/set', 'AdminController@setKriteria');
Route::post('/admin/kriteria/setUpdate/{id}', 'AdminController@setUpdateKriteria');

// Pengaturan Subkriteria
Route::get('/admin/subkriteria/get/{id}', 'AdminController@subkriteria');
Route::get('/admin/subkriteria/tambah/{id}', 'AdminController@viewTambahSubkriteria');
Route::get('/admin/subkriteria/ubah/{id}', 'AdminController@viewUbahSubkriteria');
Route::post('/admin/subkriteria/set', 'AdminController@setSubkriteria');
Route::post('/admin/subkriteria/setUpdate/{id}', 'AdminController@setUpdateSubkriteria');


// -------------------------- USER --------------------------
Route::get('/penguji/dashboard', 'PengujiController@index');

// Mutu Panen
Route::get('/penguji/mutu-panen', 'PengujiController@panen');
Route::get('/penguji/mutu-panen/rincian/{id}', 'PengujiController@rincianMutuPanen');
Route::get('/penguji/mutu-panen/tambah', 'PengujiController@viewTambahPanen');
Route::get('/penguji/mutu-panen/hapus/{id}', 'PengujiController@hapusMutuPanen');
Route::post('/penguji/mutu-panen/set', 'PengujiController@setMutuPanen');
