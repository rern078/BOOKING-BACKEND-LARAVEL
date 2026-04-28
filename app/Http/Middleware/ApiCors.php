<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiCors
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->getMethod() === 'OPTIONS') {
            return response('', 204)->withHeaders($this->headers());
        }

        $response = $next($request);
        foreach ($this->headers() as $k => $v) {
            $response->headers->set($k, $v);
        }

        return $response;
    }

    private function headers(): array
    {
        // Dev-friendly CORS for local frontend (Next.js)
        $origin = (string) request()->headers->get('Origin', '*');
        $isDevOrigin =
            preg_match('#^https?://(localhost|127\.0\.0\.1)(:\d+)?$#', $origin) === 1 ||
            // Allow private LAN IPs for dev (10.0.0.0/8, 172.16.0.0/12, 192.168.0.0/16)
            preg_match('#^https?://10\.(\d{1,3}\.){2}\d{1,3}(:\d+)?$#', $origin) === 1 ||
            preg_match('#^https?://192\.168\.(\d{1,3}\.)\d{1,3}(:\d+)?$#', $origin) === 1 ||
            preg_match('#^https?://172\.(1[6-9]|2\d|3[0-1])\.(\d{1,3}\.)\d{1,3}(:\d+)?$#', $origin) === 1;

        $allowOrigin = $isDevOrigin ? $origin : '*';

        return [
            'Access-Control-Allow-Origin' => $allowOrigin,
            'Access-Control-Allow-Methods' => 'GET,POST,PATCH,PUT,DELETE,OPTIONS',
            'Access-Control-Allow-Headers' => 'Content-Type, Authorization, Accept',
        ];
    }
}

