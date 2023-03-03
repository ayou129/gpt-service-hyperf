<?php

declare(strict_types=1);
/**
 * @author liguoxin
 * @email guoxinlee129@gmail.com
 */
return [
    'http' => [
        App\Middleware\CorsMiddleware::class,
        App\Middleware\BaseMiddleware::class,
    ],
];
