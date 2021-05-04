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

//Class Route
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'class'], function () use ($router) {
        $router->get('/', ['uses' => 'ClassServiceController@index']);
        $router->get('/studentClass', ['uses' => 'ClassServiceController@studentPerClass']);
        $router->post('/', ['uses' => 'ClassServiceController@store']);
        $router->get('/{class}', ['uses' => 'ClassServiceController@show']);
        $router->put('/{class1}', ['uses' => 'ClassServiceController@update']);
        $router->delete('/{class}', ['uses' => 'ClassServiceController@destroy']);
    });

    $router->group(['prefix' => 'student'], function () use ($router) {
        $router->get('/', ['uses' => 'StudentController@index']);
        $router->post('/', ['uses' => 'StudentController@store']);
        $router->get('/{student}', ['uses' => 'StudentController@show']);
        $router->put('/{student}', ['uses' => 'StudentController@update']);
        $router->delete('/{student}', ['uses' => 'StudentController@destroy']);
    });

    $router->group(['prefix' => 'course'], function () use ($router) {
        $router->get('/', ['uses' => 'CourseController@index']);
        $router->post('/', ['uses' => 'CourseController@store']);
        $router->get('/lessoncourse', ['uses' => 'CourseController@countLesson']);
        $router->get('/{course}', ['uses' => 'CourseController@show']);
        $router->put('/{course}', ['uses' => 'CourseController@update']);
        $router->delete('/{course}', ['uses' => 'CourseController@destroy']);
        $router->get('/student/{course}', ['uses' => 'CourseController@courseStudent']);
    });

    $router->group(['prefix' => 'lesson'], function () use ($router) {
        $router->get('/show/{lesson}', ['uses' => 'LessonController@index']);
        $router->post('/', ['uses' => 'LessonController@store']);
        $router->get('/{lesson}', ['uses' => 'LessonController@show']);
        $router->put('/{lesson}', ['uses' => 'LessonController@update']);
        $router->delete('/{lesson}', ['uses' => 'LessonController@destroy']);
    });
});
