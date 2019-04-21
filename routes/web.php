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
    return redirect('/login');
});

Auth::routes();

Route::get('/register', function () {
  return redirect('/login');
})->name('register');
Route::get('/downloadPDF','PDFController@pdf');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {
  Route::get('/register', function () {
    return redirect('/login');
  });
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('admin.logout');

  Route::resource('kriteria', 'KriteriaController');
  Route::get('/alternatif', 'AlternatifController@admin')->name('admin.alternatif');
  Route::resource('range', 'RangeController');

  //Route::resource('alternatif', 'AlternatifController');
  Route::get('/hasilseleksi', 'ResultController@index')->name('admin.hasiltest');


});

Route::get('testkriteria','TestController@testkriteria');
Route::group(['middleware' => 'auth'], function () {

  Route::get('/kriteria', 'KriteriaController@user')->name('user.kriteria');
  Route::get('/range', 'RangeController@user')->name('user.range');
  //Route::resource('kriteria', 'KriteriaController');

  //Route::resource('range', 'RangeController');

  Route::resource('alternatif', 'AlternatifController');
  Route::get('/hasilseleksi', 'ResultController@user')->name('admin.hasiltest');


});