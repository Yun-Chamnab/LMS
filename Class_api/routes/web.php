<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'class'], function () use ($router) {
        $router->get('/', ['uses' => 'ClassServiceController@index']);
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
