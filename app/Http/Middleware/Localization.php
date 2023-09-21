<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $langArray = Cache::remember(
            'locale',
            60 * 60,
            fn () => Language::pluck('locale')->toArray()
        );

        if (session()->has('locale') && in_array(session('locale'), $langArray)) {
            App::setLocale(session('locale'));
        }

        if (
            $request->hasHeader('accept-language') &&
            in_array($request->header('accept-language'), $langArray)
        ) {
            App::setLocale($request->header('accept-language'));
        }

        return $next($request);
    }
}
