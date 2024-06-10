<?php
return [
    /**
     * Set default language
     *
     * If a separate language is not specified, set the language to be applied.
     */
    'default_locale' => env('APP_LOCALE', 'en'),

    /**
     * Available language settings
     *
     * Specifies a list of languages supported by the current site or application. If the value of the APP_LOCALES
     * environment variable is specified, use the variable value separately by separating it with a comma (,).
     * If not, use the value of the APP_LOCALE variable. If the values of APP_LOCALE and APP_FALLBACK_LOCALE are
     * different, both values are used, but if they are the same, only one is used.
     */
    'locales' => env('APP_LOCALES', 'en')
        ? explode(',', env('APP_LOCALES', 'en'))
        : (
            env('APP_LOCALE', 'en') == env('APP_FALLBACK_LOCALE', 'en')
                ? [env('APP_LOCALE', 'en')] :
                [env('APP_LOCALE', 'en'), env('APP_FALLBACK_LOCALE', 'en')]
        ),

    /**
     * Language segment settings
     *
     * Sets which value represents the language when the URL is separated by a slash (/).
     */
    'locale_segment' => env('APP_LOCALE_SEGMENT', 1),

    /**
     * Query string settings
     *
     * Set the field name when specifying the language through the query string.
     */
    'field_name' => env('APP_LOCALE_FIELD_NAME', 'language')
];
