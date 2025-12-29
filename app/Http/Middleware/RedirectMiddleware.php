<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;

class RedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only handle 404s
        if ($response->getStatusCode() !== 404) {
            return $response;
        }

        $path = '/' . trim($request->path(), '/');

        // Check for exact match
        $redirect = Cache::remember("redirect_{$path}", 3600, function () use ($path) {
            return Redirect::where('source', $path)
                ->where('active', true)
                ->first();
        });

        if ($redirect) {
            return redirect($redirect->destination, $redirect->code);
        }

        return $response;
    }
}
