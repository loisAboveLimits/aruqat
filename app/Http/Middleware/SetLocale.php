<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->segment(1);

        if ($locale === 'en') {
            App::setLocale('en');
        } else {
            App::setLocale('ar');
        }

        return $next($request);
    }
}
