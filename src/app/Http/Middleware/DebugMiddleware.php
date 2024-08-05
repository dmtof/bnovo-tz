<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DebugMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);
        $response = $next($request);
        $endTime = microtime(true);

        $memoryUsage = memory_get_peak_usage(true) / 1024; // в Кб

        $response->headers->set('X-Debug-Time', ($endTime - $startTime) * 1000); // в мс
        $response->headers->set('X-Debug-Memory', $memoryUsage); // в Кб

        return $response;
    }
}
