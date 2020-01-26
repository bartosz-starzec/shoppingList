<?php

namespace App\Http\Middleware;

use Closure;

class AddHeaders
{
    /**
     * @param $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Methods', '*');
        $response->header('Access-Control-Allow-Headers', '*');

        return $response;
    }
}
