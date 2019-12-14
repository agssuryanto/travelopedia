<?php

Route::get('/', 'FrontendController@index');
Route::get('/login', 'FrontendUserController@index');
Route::get('/register', 'FrontendUserController@register');
Route::post('/register', 'FrontendUserController@doregister')->name('doregister');

Route::get('/welcome2', function () {
    return view('welcome2');
});

Route::get('/admin', function () {
    return redirect('admin/home');
});

Route::get('/info', function () {
    echo phpinfo();
});

Route::resource('/admin/login', 'loginController');
Route::resource('/admin/logout', 'logoutController');
Route::post('/admin/dologin', 'LogInOutController@Login')->name('dologin');


Route::group(['middleware' => 'cekstatus'], function () {
    Route::resource('/admin/home', 'AdminController');
    Route::resource('/admin/user_profile', 'UserprofileController');
    Route::post('/admin/update_profile', 'UserprofileController@update_profile')->name('user_profile.update_profile');
    Route::resource('/admin/changepassword', 'Changepassword');
    Route::resource('/admin/changeprofilepict', 'UpdateuserpictController');
    Route::resource('/admin/user-role', 'UserroleController');
    Route::resource('/admin/user-management', 'UserController');
    Route::resource('/admin/province', 'ProvinceController');
    Route::resource('/admin/city', 'CityController');
    Route::get('/admin/city/delete/{city}', 'CityController@confDelete');
    Route::resource('/admin/district', 'DistrictController');
    Route::post('/admin/district/create', 'DistrictController@newdata')->name('district.newdata');
    Route::resource('/admin/subdistrict', 'SubdistrictController');
    Route::post('/admin/subdistrict/create', 'SubdistrictController@newdata')->name('subdistrict.newdata');
    Route::resource('/admin/posts', 'PostsController');
    Route::get('/admin/user_activity', 'LogController@user_activity')->name('user.activity');
    Route::get('/admin/user_network', 'LogController@user_network')->name('user.network');
    Route::get('/admin/user_log_detail/{id}', 'LogController@user_log_detail')->name('user.log_detail');

    Route::get('/user/home', 'FrontendUserController@home')->name('user.home');
    Route::get('/user/profile', 'FrontendUserController@profile')->name('user.profile');

    Route::get('/finder/home', 'HomeUserController@home')->name('finder.home');
    Route::get('/finder/profile', 'HomeUserController@profile')->name('finder.profile');
    Route::get('/finder/personalinfo', 'HomeUserController@personalinfo')->name('finder.personalinfo');
});
