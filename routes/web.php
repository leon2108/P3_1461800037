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
	$data = DB::table('guru')->get();
    return view('welcome_0037',compact('data'));
})->name('select');

Route::get('/selectwhere', function () {
	$data = DB::table('data_guru')
					->select('nama_guru','nip','kelamin','alamat_guru','telpon_guru')
					->where('nama_guru','Budi Setiawan')
					->get();
    return view('selectwhere_0037',compact('data'));
})->name('selectwhere');

Route::get('/selectjoin', function () {
	$data = DB::table('tbl_ruangan')
					->leftJoin('data_siswa', 'tbl_ruangan.id_siswa', '=', 'data_siswa.id_siswa')
					->leftJoin('setup_kelas', 'tbl_ruangan.id_kelas', '=', 'setup_kelas.id_kelas')
					->select('id_ruangan','nama_kelas','nama_siswa')
					->get();
    return view('selectjoin_0037',compact('data'));
})->name('selectjoin');

Route::get('/selectjoinlike', function () {
    $data = DB::table('tbl_ruangan')
					->leftJoin('data_siswa', 'tbl_ruangan.id_siswa', '=', 'data_siswa.id_siswa')
					->leftJoin('setup_kelas', 'tbl_ruangan.id_kelas', '=', 'setup_kelas.id_kelas')
					->select('id_ruangan','nama_kelas','nama_siswa')
					->where('nama_kelas','like','%A%')
					->get();
    return view('selectjoinlike_0037',compact('data'));
})->name('selectjoinlike');



 Route::get('/cari', 'filterController@cari')->name('cari');
 Route::get('/simpan', 'filterController@simpan')->name('simpan');
 Route::get('/hapus', 'filterController@hapus')->name('hapus');


