<?php

namespace JHansol\LaravelLanguageDetect;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getPathLocale()
 * @method static string getQueryStringLocale()
 * @method static string getSessionLocale()
 * @method static void setSessionLocale(string $locale)
 * @method static string getBrowserLocale();
 * @method static void setLocale(string|null $locale)
 * @method static void setRightLocale();
 */
class LanguageDetect extends Facade {
    protected static function getFacadeAccessor() : string {
        return 'language_detect';
    }
}
