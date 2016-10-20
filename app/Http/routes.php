<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'DefaultController@index');

//Route::get('/auth/login', function(){
//    cas()->authenticate();
//});
//
//Route::get('/auth/logout', [
//    'middleware' => 'cas.auth',
//    function(){
//        cas()->logout();
//    }
//]);

Route::controllers([
    'auth' => 'Auth\AuthController',
]);
//Route::get('/auth/login', 'Auth\AuthController@login');

Route::get('/home', 'HomeController@index');
Route::get('/log', 'LogController@index');
Route::get('/account', 'AccountController@index');

Route::post('/user/create/choice', 'UserController@choice');
Route::get('/user/create/designation', 'UserController@designation');
Route::get('/user/success', 'UserController@success');
Route::get('/user/success/{id}', 'UserController@success');
Route::get('/user/failure', 'UserController@failure');
Route::get('/user/destroy/home', 'UserController@getDestroy');
Route::post('/user/destroy/check', 'UserController@check');
Route::get('/user/destroy/designation', 'UserController@designation');
Route::post('/user/destroy/finish', 'UserController@destroy');

Route::get('/authorize/create/edit/{id}', 'AuthorizeController@edit');
Route::get('/authorize/create/choice', 'AuthorizeController@choice');
Route::get('/authorize/create/auth/{id}', 'AuthorizeController@edit');
Route::post('/authorize/create/auth', 'AuthorizeController@auth');

Route::group([], function()
{
    $models = [
        'Server', 'Branche', 'Tradeway', 'Tradewaytype',
        'Whitelist', 'User', 'Permission', 'Auth', 'Org',
        'Stocklimit', 'Omsconfig', 'Ogwconfig', 'Ogwbranche',
        'Usertradeway', 'Authorize', 'Permission'
    ];
    foreach ($models as $model){
        Route::resource(strtolower($model), ucfirst($model).'Controller');
    }
});



Route::get('/record', 'RecordController@index');
Route::get('/record/{id}', 'RecordController@show');
