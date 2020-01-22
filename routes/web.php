<?php

Route::get('/', 'FrontendController@index');
Route::get('/contact', 'FrontendController@contact');
Route::get('/getinfo/{id}', 'FrontendController@getinfo');
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
    Route::get('/finder/posts', 'HomeUserController@posts')->name('finder.posts');
    Route::post('/finder/posts', 'HomeUserController@posts')->name('finder.update');
    Route::get('/finder/edit/{id}', 'HomeUserController@edit')->name('finder.edit');
    Route::get('/finder/log', 'HomeUserController@logs')->name('finder.log');
    Route::post('/finder/store', 'HomeUserController@store')->name('finder.store');
    Route::post('/finder/update', 'HomeUserController@update')->name('finder.update');

    Route::get('/expert/home', 'ExpertController@home')->name('expert.home');
    Route::get('/expert/profile', 'ExpertController@profile')->name('expert.profile');
    Route::get('/expert/personalinfo', 'ExpertController@personalinfo')->name('expert.personalinfo');
    Route::get('/expert/trip', 'ExpertController@trip')->name('expert.trip');
    Route::get('/expert/trip/detail/{id}', 'ExpertController@detail')->name('trip.detail');
    Route::get('/expert/trip/create', 'ExpertController@create')->name('expert.create');
    Route::get('/expert/trip/store', 'ExpertController@store')->name('expert.store');

    Route::get('/narator/home', 'NarratorController@home')->name('narator.home');
    Route::get('/narator/profile', 'NarratorController@profile')->name('narator.profile');
    Route::get('/narator/personalinfo', 'NarratorController@personalinfo')->name('narator.personalinfo');
    Route::get('/narator/detail/{id}', 'NarratorController@detail')->name('narator.detail');
    Route::get('/narator/create/{id}', 'NarratorController@create')->name('narator.create');
    Route::get('/narator/posts', 'NarratorController@posts')->name('narator.posts');
    Route::get('/narator/log', 'NarratorController@logs')->name('narator.log');
    Route::post('/narator/store', 'NarratorController@store')->name('narator.store');
});
