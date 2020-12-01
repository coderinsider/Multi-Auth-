<?php
Route::view('/', 'welcome');
Auth::routes();
Route::get('/clearnow', function() {
        Artisan::call('cache:clear'); // clear cache 
        Artisan::call('route:clear');// Clear router cache
        Artisan::call('config:clear'); // Clear configuration cache
        Artisan::call('view:clear');// Clear view cache
        return "Cache is cleared";
});
Route::get('/isadminlogin', 'Auth\LoginController@showAdminLoginForm')->name('login.admin');
Route::get('/iswriterlogin', 'Auth\LoginController@showWriterLoginForm')->name('login.writer');
Route::get('/isadminregister', 'Auth\RegisterController@showAdminRegisterForm')->name('register.admin');
Route::get('/iswriterregister', 'Auth\RegisterController@showWriterRegisterForm')->name('register.writer');

Route::post('/isadminlogin', 'Auth\LoginController@adminLogin');
Route::post('/iswriterlogin', 'Auth\LoginController@writerLogin');
Route::post('/isadminregister', 'Auth\RegisterController@createAdmin')->name('register.admin');
Route::post('/iswriterregister', 'Auth\RegisterController@createWriter')->name('register.writer');

Route::view('/home', 'home')->middleware('auth');
Route::group(['middleware' => 'auth:admin'], function () {
    Route::view('/admin', 'admin');
});

Route::group(['middleware' => 'auth:writer'], function () {
    Route::view('/writer', 'writer');
});
