<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Kernel
{
    protected $routeMiddleware = [
        'role' => \App\Http\Middleware\CheckRole::class,
        'web' => [
            \App\Http\Middleware\HandleInertiaRequests::class,
        ],
    ];
}
