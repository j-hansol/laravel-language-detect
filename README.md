# Language detection and Setting for Laravel
[![License](https://img.shields.io/badge/Version-1.0.0-blue)](https://opensource.org/licenses/MIT)
[![License](https://img.shields.io/badge/License-MIT-green)](https://opensource.org/licenses/MIT)

It provides a very simple function for detecting and setting the language in a website or backend service running on the Laravel framework.

## installation
You can simply install it with the command below from the project path under development.
```shell
composer require j-hansol/laravel-language-detect
```

Add the following content to the ```.env``` file. If not added, it will be set to the contents of the ```language_detect.php``` file included in the package.
```dotenv
APP_LOCALES="ko,en"
APP_LOCALE_SEGMENT=1
APP_LOCALE_FIELD_NAME=language
```

## How to use
To detect and set the language, simply add middleware to the routing path as shown below.
```php
Route::prefix('{locale}')->group(function() {
    Route::get('test', [\App\Http\Controllers\LanguageSettingTest::class, 'showResult'])
        ->middleware('set_language');
});
```

## Customize your preferences file
If you have made the necessary settings in ````.env````, this step will not be necessary. Nevertheless, if you want to change the settings, you can change the contents after executing the command below.

```shell
php artisan vendor:publish --tag=language-detect
```
