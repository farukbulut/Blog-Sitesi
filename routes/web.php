<?php

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
*/

Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function (){

    Route::get('giris','back\AuthController@login')->name('login');
    Route::post('giris','back\AuthController@loginPost')->name('login.post');

});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function (){
    Route::get('panel','back\Dashboard@index')->name('dashboard');
    Route::get('makaleler/silinenler','Back\BlogController@trashed')->name('trashed.blog');
    Route::resource('/makaleler','Back\BlogController');
    Route::get('switch','Back\BlogController@switch')->name('switch');
    Route::get('/harddeleteblog/{id}','Back\BlogController@hardDelete')->name('hard.delete.blog');
    Route::get('/deleteblogs/{id}','Back\BlogController@delete')->name('delete.blog');
    Route::get('/recoverblogs/{id}','Back\BlogController@recover')->name('recover.blog');

    //category route

    Route::get('/kategoriler','Back\CategoryController@index')->name('category.index');
    Route::post('/kategoriler/create','Back\CategoryController@create')->name('category.create');
    Route::post('/kategoriler/update','Back\CategoryController@update')->name('category.update');
    Route::post('/kategoriler/delete','Back\CategoryController@delete')->name('category.delete');
    Route::get('kategori/switch','Back\CategoryController@switch')->name('category.switch');
    Route::get('kategori/getData','Back\CategoryController@getData')->name('category.getData');
        //page route
    Route::get('/sayfalar','Back\PageController@index')->name('page.index');
    Route::get('sayfa/switch','Back\PageController@switch')->name('page.switch');
    Route::get('/sayfalar/olustur','Back\PageController@create')->name('page.create');
    Route::post('/sayfalar/olustur','Back\PageController@post')->name('page.post');
    Route::get('/sayfalar/update/{id}','Back\PageController@update')->name('page.update');
    Route::post('/sayfalar/edit/{id}','Back\PageController@edit')->name('page.edit');
    Route::get('/sayfalar/{id}','Back\PageController@delete')->name('page.delete');

/// /
    Route::get('cikis','back\AuthController@logout')->name('logout');


});



Route::get('/','Front\HomePage@index')->name('homepage');
Route::get('/sayfa','Front\HomePage@index');
Route::get('/iletisim','front\HomePage@contact')->name('contact');
Route::post('/iletisim','front\HomePage@contactpost')->name('contact.post');
Route::get('/kategori/{category}','front\HomePage@category')->name('category');
Route::get('/{category}/{slug}','front\HomePage@single')->name('single');
Route::get('/{sayfa}','front\HomePage@page')->name('page');


/*
|--------------------------------------------------------------------------
| Back Routes
|--------------------------------------------------------------------------
|
*/

