<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'exam'], function () use ($router) {
        $router->get('/', ['uses' => 'ExamController@index']);
        $router->get('/student', ['uses' => 'ExamController@indexStudent']);
        $router->get('/overview', ['uses' => 'ExamController@countExam']);
        $router->post('/', ['uses' => 'ExamController@store']);
        $router->get('/{exam}', ['uses' => 'ExamController@show']);
        $router->patch('/{exam}', ['uses' => 'ExamController@update']);
        $router->delete('/{exam}', ['uses' => 'ExamController@destroy']);
    });

    $router->group(['prefix' => 'question'], function () use ($router) {
        $router->get('/', ['uses' => 'QuestionController@index']);
        $router->post('/', ['uses' => 'QuestionController@store']);
        $router->get('/{question}', ['uses' => 'QuestionController@show']);
        $router->get('/quiz/{question}', ['uses' => 'QuestionController@show']);
        $router->patch('/{question}', ['uses' => 'QuestionController@update']);
        $router->delete('/{question}', ['uses' => 'QuestionController@destroy']);
    });

    $router->group(['prefix' => 'result'], function () use ($router) {
        $router->get('/', ['uses' => 'ResultController@index']);
        $router->post('/', ['uses' => 'ResultController@store']);
        $router->get('/{result}', ['uses' => 'ResultController@show']);
        $router->patch('/{result}', ['uses' => 'ResultController@update']);
        $router->delete('/{result}', ['uses' => 'ResultController@destroy']);
    });
});
