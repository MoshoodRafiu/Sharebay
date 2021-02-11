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

Auth::routes(['register'=>true]);
Route::group(array('namespace'=>'Backend', 'middleware'=>'auth'), function (){
   Route::resource('/ringtones', 'RingtoneController');
   Route::resource('/photos', 'PhotoController');
});
Route::group(array('namespace'=>'Frontend'), function (){
    Route::get('/', 'RingtoneController@index');
    Route::get('/ringtones/{id}/{slug}', 'RingtoneController@show')->name('ringtones.show');
    Route::post('/ringtones/download/{id}', 'RingtoneController@download')->name('ringtones.download');
    Route::get('/category/{id}', 'RingtoneController@category')->name('ringtones.category');
    Route::get('/wallpapers', 'PhotoController@index')->name('wallpaper.index');
    Route::post('/download1/800x600/{id}/{title}', 'PhotoController@download800x600')->name('wallpaper.download1');
    Route::post('/download1/1280x1024/{id}/{title}', 'PhotoController@download1280x1024')->name('wallpaper.download2');
    Route::post('/download1/316x255/{id}/{title}', 'PhotoController@download316x255')->name('wallpaper.download3');
    Route::post('/download1/118x95/{id}/{title}', 'PhotoController@download118x95')->name('wallpaper.download4');
});
Route::get('/home', 'HomeController@index')->name('home');
