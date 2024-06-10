<?php

namespace JHansol\LaravelLanguageDetect;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageDetectBase {
    private Application $application;
    private Request $request;
    private array $able_locales;

    /**
     * initialization
     * @param Application $application
     */
    function __construct(Application $application) {
        $this->application = $application;
        $this->request = $this->application->make('request');
        $this->able_locales = config('language-detect.locales', []);
    }

    /**
     * Retrieves available languages from the specified segment of the URL.
     * @return string|null
     */
    public function getPathLocale() : string|null {
        $locale_segment = config('language-detect.locale_segment');
        $temp_locale = $this->request->segment($locale_segment);
        if($temp_locale && in_array($temp_locale, $this->able_locales)) return $temp_locale;

        return null;
    }

    /**
     * Retrieves available languages from a querystring.
     * @return string|null
     */
    public function getQueryStringLocale() : string|null {
        $temp_locale = $this->request->get(config('language-detect.field_name'));
        if($temp_locale && in_array($temp_locale, $this->able_locales)) return $temp_locale;

        return null;
    }

    /**
     * Retrieves available languages from a querystring.
     * @return string|null
     */
    public function getSessionLocale() : string|null {
        return Session::get('locale');
    }

    /**
     * Saves the specified language information in the session.
     * @param string $locale
     * @return void
     */
    public function setSessionLocale(string $locale) : void {
        Session::put('locale', $locale);
    }

    /**
     * Retrieves available language information from the browser's acceptable languages.
     * @return string|null
     */
    public function getBrowserLocale() : string|null {
        $acceptLanguage = $this->request->server('HTTP_ACCEPT_LANGUAGE');
        $languages = explode(',', $acceptLanguage);
        foreach ($languages as $language) {
            if(in_array($language, $this->able_locales)) return $language;
        }

        return null;
    }

    /**
     * Set the specified language and save it in the session.
     * @param string|null $locale
     * @return void
     */
    public function setLocale(string|null $locale) : void {
        if(!$locale) $locale = config('language-detect.default_locale');

        $this->application->setLocale($locale);
        $this->setSessionLocale($locale);
    }

    /**
     * Set the appropriate language. Language selection is set by detecting the URL segment, query string, session,
     * and browser in that order.
     * @return void
     */
    public function setRightLocale() : void  {
        $this->setLocale(
        $this->getPathLocale() ??
            $this->getQueryStringLocale() ??
            $this->getSessionLocale() ??
            $this->getBrowserLocale()
        );
    }
}
