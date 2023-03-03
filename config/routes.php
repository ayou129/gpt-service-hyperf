<?php

declare(strict_types=1);
/**
 * @author liguoxin
 * @email guoxinlee129@gmail.com
 */
use App\Controller\BaseController;
use App\Controller\UserController;
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@home');

Router::get('/favicon.ico', function () {
    return '';
});

Router::addGroup(
    '/api/v1/user',
    function () {
        Router::get('/info', [
            UserController::class,
            'info',
        ]);
    },
);
Router::addGroup(
    '/api/v1/exception/test/case',
    function () {
        Router::get('/params', [
            BaseController::class,
            'params',
        ]);
        Router::get('/runtime', [
            BaseController::class,
            'runtime',
        ]);
        Router::get('/logic', [
            BaseController::class,
            'logic',
        ]);
    },
);
