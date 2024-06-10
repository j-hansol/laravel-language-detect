<?php

namespace JHansol\LaravelLanguageDetect;

use Illuminate\Http\Request;
use Closure;
use Symfony\Component\HttpFoundation\Response;


class DetectLanguageAndSetLanguage {
    /**
     * Set the language.
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response {
        LanguageDetect::setRightLocale();
        return $next($request);
    }
}
