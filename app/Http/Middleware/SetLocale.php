<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = $request->segment(1);
        // $languages = config('app.languages');
        // $locales = array_column($languages, 'locale');

        // if (!in_array($lang, $locales)) {
        //     $lang = config('app.fallback_locale');
        // }

        // App::setLocale($lang);
        foreach (config('app.languages') as $language) {
            if ($lang == $language['locale']) {
                App::setLocale($lang);
            }
        }
        URL::defaults(['locale' => $lang]);
        return $next($request);
    }
}
