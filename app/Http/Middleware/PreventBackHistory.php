<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Response as IlluminateResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PreventBackHistory
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $headers = [
            'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => 'Sat, 01 Jan 1990 00:00:00 GMT',
        ];
        foreach ($headers as $key => $value) {
            $response->headers->set($key, $value);
        }

        return $response;

        // return $response->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
        //                 ->header('Pragma','no-cache')
        //                 ->header('Expires','Sat, 01 Jan 1990 00:00:00 GMT');
    }
}
