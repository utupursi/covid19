<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check header request and determine localizaton
        $locales = config('translatable.locales');

        $local = ($request->hasHeader('X-localization')) && in_array($request->header('X-localization'), $locales) ? $request->header('X-localization') : 'en';

        // set laravel localization
        app()->setLocale($local);

        return $next($request);
    }
}
