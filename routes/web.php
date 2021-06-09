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

Auth::routes();

Route::get('/', 'DashboardController@index')->name('dashboard');

// Kelas
Route::get('kelas', 'KelasController@index')->name('kelas');
Route::get('kelas/create', 'KelasController@create')->name('createKelas');
Route::post('kelas/store', 'KelasController@store')->name('storeKelas');
Route::get('kelas/edit/{id}', 'KelasController@edit')->name('editKelas');
Route::post('kelas/update/{id}', 'KelasController@update')->name('updateKelas');
Route::get('kelas/delete/{id}', 'KelasController@destroy')->name('deleteKelas');

// Mata Pelajaran
Route::get('mapel', 'MataPelajaranController@index')->name('mapel');
Route::get('mapel/create', 'MataPelajaranController@create')->name('createMapel');
Route::post('mapel/store', 'MataPelajaranController@store')->name('storeMapel');
Route::get('mapel/edit/{id}', 'MataPelajaranController@edit')->name('editMapel');
Route::post('mapel/update/{id}', 'MataPelajaranController@update')->name('updateMapel');
Route::get('mapel/delete/{id}', 'MataPelajaranController@destroy')->name('deleteMapel');

// Guru
Route::get('guru', 'GuruController@index')->name('guru');
Route::get('schedule', 'GuruController@indexGuru');
Route::get('guru/create', 'GuruController@create')->name('createGuru');
Route::post('guru/schedule', 'GuruController@insertJadwal');
Route::post('guru/store', 'GuruController@store')->name('storeGuru');
Route::get('guru/edit/{id}', 'GuruController@edit')->name('editGuru');
Route::post('guru/update/{id}', 'GuruController@update')->name('updateGuru');
Route::get('guru/delete/{id}', 'GuruController@destroy')->name('deleteGuru');
Route::get('guru/biodata/{nip}', 'GuruController@show')->name('biodataGuru');
Route::get('guru/biodata/edit/{id}', 'GuruController@editBiodata')->name('editBiodataGuru');
Route::post('guru/biodata/update/{id}', 'GuruController@updateBiodata')->name('updateBiodataGuru');
Route::get('guru_matkul/{id}', 'GuruController@getMatkulByIdGuru');
Route::get('guru_list_jadwal/{id}', 'GuruController@indexJadwal');
Route::get('guru_list_jadwal_edit/{id}', 'GuruController@indexEdit');
Route::get('guru_list_jadwal_delete/{id}', 'GuruController@deleteJadwal');
Route::get('guru_list_jadwal_cetak', 'GuruController@jadwal');
Route::get('absen_guru', 'GuruController@lihat_absen');
Route::get('absen_guru/{id}', 'GuruController@lihat_absen_ada');
Route::post('filter_guru_absen', 'GuruController@filter_absen');
Route::post('guru/schedule/edit/{id}', 'GuruController@updateJadwal');

// Siswa
Route::get('siswa', 'SiswaController@index')->name('siswa');
Route::get('siswa/create', 'SiswaController@create')->name('createSiswa');
Route::post('siswa/store', 'SiswaController@store')->name('storeSiswa');
Route::get('siswa/edit/{id}', 'SiswaController@edit')->name('editSiswa');
Route::post('siswa/update/{id}', 'SiswaController@update')->name('updateSiswa');
Route::get('siswa/delete/{id}', 'SiswaController@destroy')->name('deleteSiswa');
Route::get('siswa/biodata/{nim}', 'SiswaController@show')->name('biodataSiswa');
Route::get('siswa/biodata/edit/{id}', 'SiswaController@editBiodata')->name('editBiodataSiswa');
Route::post('siswa/biodata/update/{id}', 'SiswaController@updateBiodata')->name('updateBiodataSiswa');

// User
Route::get('user', 'UserController@index')->name('user');
Route::get('user/delete/{id}', 'UserController@destroy')->name('deleteUser');

// Penilaian
Route::get('penilaian/penilaian', 'PenilaianController@indexGuru')->name('penilaian');
Route::get('penilaian/create/{id}', 'PenilaianController@create')->name('createPenilaian');
Route::post('penilaian/store', 'PenilaianController@store')->name('storePenilaian');
Route::get('penilaian/edit/{id}', 'PenilaianController@edit')->name('editPenilaian');
Route::post('penilaian/update/{id}', 'PenilaianController@update')->name('updatePenilaian');
Route::get('penilaian/delete/{id}', 'PenilaianController@destroy')->name('deletePenilaian');
Route::get('penilaian/nilai', 'PenilaianController@indexSiswa')->name('nilaiSiswa');
Route::get('penilaian/rapot', 'PenilaianController@rapot')->name('cetakRAPOT');
Route::get('penilaian/skl', 'PenilaianController@skl');

//Absensi
Route::get('siswa/absensi', 'AbsensiSiswaController@absen')->name('absensiSiswa');
Route::get('siswa/addabsensi', 'AbsensiSiswaController@addabsen')->name('addabsensiSiswa');
// Route::get('siswa/createabsensi', 'SiswaController@createAbsensi')->name('createAbsensiSiswa');
// Route::post('siswa/addAbsensi2', 'AbsensController@addAbsensi')->name('addAbsensi2');
Route::get('guru/absensisiswa', 'AbsensiSiswaController@absen2')->name('absensiSiswa3');
Route::get('absensi/edit/{id}', 'AbsensiSiswaController@edit')->name('editAbsensi');
Route::post('absensi/update/{id}', 'AbsensiSiswaController@update')->name('updateAbsensi');
Route::get('absensi/delete/{id}', 'AbsensiSiswaController@destroy')->name('deleteAbsensi');
Route::get('guru/absensi2', 'AbsensController@absen2')->name('absensiSiswa2');
Route::get('absen/hari_ini/{id}/{id_mapel}/{status}', 'AbsensController@addAbsensiGhuru');

//////
// Route::get('siswa/absensi', 'AbsensController@absen')->name('absensiSiswa');
// Route::get('siswa/addabsensi', 'AbsensController@addabsen')->name('addabsensiSiswa');
// // Route::get('siswa/createabsensi', 'SiswaController@createAbsensi')->name('createAbsensiSiswa');
// Route::post('siswa/addAbsensi2', 'AbsensController@addAbsensi')->name('addAbsensi2');
// Route::get('guru/absensi2', 'AbsensController@absen2')->name('absensiSiswa2');

// Route::get('absensi/edit/{id}', 'AbsensController@edit')->name('editAbsensi');
// Route::post('absensi/update/{id}', 'AbsensController@update')->name('updateAbsensi');
// Route::get('absensi/delete/{id}', 'AbsensController@destroy')->name('deleteAbsensi');
