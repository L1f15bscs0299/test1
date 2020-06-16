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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'LoginController@index')->name('login');

Route::group(['middleware' => ['user']], function () {
    Route::post('/orderdata', 'IndexController@OrderData');
    Route::get('/manageiptables', 'IndexController@allservers');
    Route::get('/table', 'IndexController@allservers');
    Route::post('/addruleip', 'IndexController@addrule');

    Route::post('/deleteiprule', 'IndexController@delete');
    Route::post('/defaultpolicy', 'IndexController@defaultpolicy');
    Route::post('/checkip', 'IndexController@checkip');

    Route::get('user_management', 'user_management@user_management');
    Route::post('user_management', 'user_management@insert'); 
    Route::delete('user_management/{email}', 'user_management@delete');

    Route::get('remote', 'RemoteController@remote');
    Route::post('remote/write', 'RemoteController@store');
    Route::post('remote/update', 'RemoteController@update');
    Route::post('/deleteip', 'RemoteController@destroy_ip');
    Route::post('/addip', 'RemoteController@store_ip');

    Route::get('/gitautopull', 'GitController@index')->name('git.repos');
    Route::post('/git-repos', 'GitController@store');
    Route::get('/repos/{repo}', 'GitController@destroy')->name('repos.destroy');
    Route::post('/add-ip', 'GitController@store_ip');
    Route::post('/delete-ip', 'GitController@destroy_ip');
    Route::post('/deploy-template', 'TemplateController@deploy');

    // zain_routes
    Route::get('/show_key', 'ServerController@view');
    Route::post('/add_server', 'ServerController@add');
    Route::get('/add_templates', 'IptablerulesController@view');
    Route::post('/add_templates', 'IptablerulesController@save');
    Route::post('/update_template', 'IptablerulesController@show');
    Route::post('/delete_template', 'IptablerulesController@delete_template');
    Route::post('/template_view', 'IptablerulesController@view_template');
    Route::post('/rules_update', 'IptablerulesController@rules_update');
});

Route::post('/loginuser', 'LoginController@loginuser');
Route::get('/logout', 'LoginController@logout');
