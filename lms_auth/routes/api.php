<?php
/** @var Router $router */

use Laravel\Lumen\Routing\Router;

/* Public Routes */
$router->get('/', function () {
    return response()->json(['message' => 'Welcome to Lumen API Starter']);
});

/* Auth Routes */
$router->group(['prefix' => 'auth', 'as' => 'auth'], function (Router $router) {

    /* Defaults */
    $router->post('/register', [
        'as' => 'register',
        'uses' => 'AuthController@register',
    ]);
    $router->post('/login', [
        'as' => 'login',
        'uses' => 'AuthController@login',
    ]);
    $router->get('/verify/{token}', [
        'as' => 'verify',
        'uses' => 'AuthController@verify'
    ]);

    /* Password Reset */
    $router->post('/password/forgot', [
        'as' => 'password.forgot',
        'uses' => 'AuthController@forgotPassword'
    ]);
    $router->post('/password/recover/{token}', [
        'as' => 'password.recover',
        'uses' => 'AuthController@recoverPassword'
    ]);

    /* Protected User Endpoint */
    $router->get('/user', [
        'uses' => 'AuthController@getUser',
        'as' => 'user',
        'middleware' => 'auth'
    ]);
});



/* Protected Routes */
$router->group(['middleware' => 'auth'], function (Router $router) {

    $router->group(['middleware' => 'role:administrator'], function (Router $router) {

        $router->get('/admin', function () {
            return response()->json(['message' => 'You are authorized as an administrator.']);
        });

    });


    //Role
    $router->group(['prefix' => 'role'], function (Router $router) {

        $router->get('/list_role', [
            'uses' => 'RoleController@index',
            'as' => 'list_role',
        ]);

        $router->post('/create', [
            'uses' => 'RoleController@store',
            'as' => 'store'
        ]);

        $router->get('/show/{id}', [
            'uses' => 'RoleController@show',
            'as' => 'show'
        ]);

        $router->post('/edit/{id}', [
            'uses' => 'RoleController@edit',
            'as' => 'edit'
        ]);

        $router->post('/update/{id}', [
            'uses' => 'RoleController@update',
            'as' => 'update'
        ]);

        $router->post('/delete/{id}', [
            'uses' => 'RoleController@delete',
            'as' => 'delete'
        ]);

    });


    //Permission
    $router->group(['prefix' => 'permission'], function (Router $router) {

        $router->get('/list', [
            'uses' => 'PermissionController@index',
            'as' => 'list'
        ]);

        $router->post('/create', [
            'uses' => 'PermissionController@store',
            'as' => 'store'
        ]);

        $router->get('/show/{id}', [
            'uses' => 'PermissionController@show',
            'as' => 'show'
        ]);

        $router->post('/edit/{id}', [
            'uses' => 'PermissionController@edit',
            'as' => 'edit'
        ]);

        $router->post('/update/{id}', [
            'uses' => 'PermissionController@update',
            'as' => 'update'
        ]);

        $router->post('/delete/{id}', [
            'uses' => 'PermissionController@delete',
            'as' => 'delete'
        ]);

    });

    //user
    $router->group(['prefix' => 'user'], function (Router $router) {

        $router->get('/list', [
            'uses' => 'UserController@index',
            'as' => 'list'
        ]);

        $router->post('/create', [
            'uses' => 'UserController@store',
            'as' => 'store'
        ]);

        $router->get('/show/{id}', [
            'uses' => 'UserController@show',
            'as' => 'show'
        ]);

        $router->post('/edit/{id}', [
            'uses' => 'UserController@edit',
            'as' => 'edit'
        ]);

        $router->post('/update/{id}', [
            'uses' => 'UserController@update',
            'as' => 'update'
        ]);

        $router->post('/delete/{id}', [
            'uses' => 'UserController@delete',
            'as' => 'delete'
        ]);

    });

});
