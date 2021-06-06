<?php

use App\Http\Controllers\Auth\LoginController;

Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm'); 

Route::group(['middleware' => 'auth'], function () {
    
    Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'namespace' => 'Admin', 'as'=>'admin.'], function () {
        Route::get('/', 'DashboardController@index')->name('dashboard'); 
    });
    
    Route::group(['prefix' => 'user', 'middleware' => ['user'], 'namespace' => 'User', 'as'=>'user.'], function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::post('/get_info_by_filter', 'DashboardController@get_info_by_filter')->name('dashboard.get_info_by_filter');
        Route::post('/iamAlive', 'DashboardController@iamAlive')->name('dashboard.iamAlive');
        Route::post('/refresh_data', 'DashboardController@refresh_data')->name('dashboard.refresh_data');
        //Users
        Route::get('/users/list', 'UserController@list')->name('user.list');
        Route::get('/users/create', 'UserController@create')->name('user.create');
        Route::post('/users/save', 'UserController@save')->name('user.save');
        Route::get('/users/edit', 'UserController@edit')->name('user.edit');
        Route::post('/users/update', 'UserController@update')->name('user.update');
        Route::get('/users/profile', 'UserController@profile')->name('user.profile');
        Route::post('/users/avatarUpload', 'UserController@avatarUpload')->name('user.avatarUpload');
        Route::post('/users/updateProfile', 'UserController@updateProfile')->name('user.updateProfile');
        Route::post('/users/resetpwd', 'UserController@resetpwd')->name('user.resetpwd');
        Route::post('/users/delete', 'UserController@delete')->name('user.delete');

        //Branchs
        Route::get('/branchs/list', 'BranchController@list')->name('branch.list');
        Route::get('/branchs/add', 'BranchController@create')->name('branch.create');
        Route::post('/branchs/save', 'BranchController@save')->name('branch.save');
        Route::get('/branchs/edit', 'BranchController@edit')->name('branch.edit');
        Route::post('/branchs/update', 'BranchController@update')->name('branch.update');
        Route::post('/branchs/remove', 'BranchController@destroy')->name('branch.delete');
        
        //Surveys
        Route::get('/survey/list/{branch?}', 'SurveyController@list')->name('survey.list');
        Route::get('/survey/create', 'SurveyController@create')->name('survey.create');
        Route::post('/survye/save', 'SurveyController@save')->name('survey.save');
        Route::get('/survey/edit', 'SurveyController@edit')->name('survey.edit');
        Route::post('/survey/update', 'SurveyController@update')->name('survey.update');
        Route::post('/survey/delete', 'SurveyController@delete')->name('survey.delete');
        Route::post('/survey/status', 'SurveyController@status')->name('survey.status');

        //Device
        Route::get('/device/list', 'DeviceController@list')->name('device.list');
        Route::get('/device/create', 'DeviceController@create')->name('device.create');
        Route::post('/device/save', 'DeviceController@save')->name('device.save');
        Route::get('/device/edit', 'DeviceController@edit')->name('device.edit');
        Route::post('/device/update', 'DeviceController@update')->name('device.update');
        Route::post('/device/delete', 'DeviceController@delete')->name('device.delete');

        //CompanyInfo
        Route::get('/companyinfo/list', 'CompanyInfoController@list')->name('companyinfo.list');
        Route::get('/companyinfo/logo', 'CompanyInfoController@logo')->name('companyinfo.logo');
        Route::post('/companyinfo/update', 'CompanyInfoController@update')->name('companyinfo.update');
        Route::post('/companyinfo/updateLogo', 'CompanyInfoController@updateLogo')->name('companyinfo.updateLogo');
        
        //Branding
        Route::get('/brand/index', 'BrandController@index')->name('brand.index');
        Route::post('/brand/save', 'BrandController@save')->name('brand.save');
        Route::post('/brand/delete', 'BrandController@delete')->name('brand.delete');

        //Rating
        Route::get('/rating/list', 'RatingController@list')->name('rating.list');
        Route::get('/rating/create', 'RatingController@create')->name('rating.create');
        Route::post('/rating/save', 'RatingController@save')->name('rating.save');
        Route::get('/rating/edit', 'RatingController@edit')->name('rating.edit');
        Route::post('/rating/update', 'RatingController@update')->name('rating.update');
        Route::post('/rating/delete', 'RatingController@delete')->name('rating.delete');
        
        //Template
        Route::get('/template/list', 'TemplateController@list')->name('template.list');
        Route::get('/template/create', 'TemplateController@create')->name('template.create');
        Route::post('/template/save', 'TemplateController@save')->name('template.save');
        Route::get('/template/edit', 'TemplateController@edit')->name('template.edit');
        Route::post('/template/update', 'TemplateController@update')->name('template.update');
        Route::post('/template/delete', 'TemplateController@delete')->name('template.delete');
        Route::post('/template/status', 'TemplateController@status')->name('template.status');

    });
});