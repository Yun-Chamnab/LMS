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

        $router->group(['prefix' => 'role'], function (Router $router) {

            $router->get('/list_role', [
                'uses' => 'RoleController@index',
                'as' => 'list_role',
                //'middleware' => 'permission:role-list'
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
                'uses' => 'RoleController@upadate',
                'as' => 'update'
            ]);

            $router->post('/delete/{id}', [
                'uses' => 'RoleController@delete',
                'as' => 'delete'
            ]);

        });

        $router->group(['prefix' => 'permission'], function (Router $router) {

            $router->get('/list_permission', [
                'uses' => 'RoleController@list_permission',
                'as' => 'list_permission'
            ]);

        });

    });

});
