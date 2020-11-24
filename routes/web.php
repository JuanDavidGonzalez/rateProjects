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
//    return view('welcome');
    return view('auth.login');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>['auth']], function(){

    Route::get('/home',[
        'as' => 'home',
        'uses'=>'HomeController@index',
    ]);

    Route::resource('user', 'UserController');
    Route::resource('college', 'CollegeController');
    Route::resource('event', 'EventController');
    Route::resource('group', 'GroupController');
    Route::resource('seedbed', 'SeedbedController');
    Route::resource('participant', 'ParticipantController');
    Route::resource('project', 'ProjectController');
    Route::resource('assignment', 'AssignmentController');
    Route::resource('evaluation', 'EvaluationController');

    Route::get('/perfiles/',[
        'as' => 'profile.index',
        'uses' => 'RoleController@index',
    ]);
    Route::get('/perfiles/{id}/edit',[
        'as' => 'roles.edit',
        'uses' => 'RoleController@edit',
    ]);
    Route::put('/perfiles/{id}/edit',[
        'as' => 'roles.edit',
        'uses' => 'RoleController@update',
    ]);
    Route::post('/perfiles/crear',[
        'as' => 'roles.create',
        'uses' => 'RoleController@store'
    ]);
    Route::get('/perfiles/crear',[
        'as' => 'roles.create',
        'uses' => 'RoleController@create'
    ]);

    Route::post('/permisos/crear',[
        'as' => 'perms.create',
        'uses' => 'PermissionController@store'
    ]);

    Route::get('/permisos/crear',[
        'as' => 'perms.create',
        'uses' => 'PermissionController@create'
    ]);

    Route::get('/permisos/{id}/edit',[
        'as' => 'perms.edit',
        'uses' => 'PermissionController@edit',
    ]);

    Route::put('/permisos/{id}/edit',[
        'as' => 'perms.edit',
        'uses' => 'PermissionController@update',
    ]);

    Route::get('/project_/{file}',[
        'as' => 'project.showFile',
        'uses' => 'ProjectController@showFile',
    ]);
    Route::post('/project/changeStatus/{id}',[
        'as' => 'project.changeStatus',
        'uses' => 'ProjectController@changeStatus',
    ]);

    Route::post('/event/changeStatus/{id}',[
        'as' => 'event.changeStatus',
        'uses' => 'EventController@changeStatus',
    ]);
    Route::post('/group/changeStatus/{id}',[
        'as' => 'group.changeStatus',
        'uses' => 'GroupController@changeStatus',
    ]);
    Route::post('/seedbed/changeStatus/{id}',[
        'as' => 'seedbed.changeStatus',
        'uses' => 'SeedbedController@changeStatus',
    ]);
    Route::post('/user/changeStatus/{id}',[
        'as' => 'user.changeStatus',
        'uses' => 'UserController@changeStatus',
    ]);
});