<?php
namespace JHansol\LaravelLanguageDetect;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class LanguageDetectServiceProvider extends ServiceProvider {
    public function register(): void {
        // Register language detection and configuration-based class.
        $this->app->singleton('language_detect', function(Application $application) {
            return new LanguageDetectBase($application);
        });

        // Merge the app's preferences with the package's preferences.
        $config = __DIR__ . '/../config/language_detect.php';
        $this->mergeConfigFrom(
            $config, 'language-detect'
        );
    }

    public function boot(): void {
        // Register paths to be published by the publish command.
        $config = __DIR__ . '/../config/language_detect.php';
        $this->publishes(
            [$config => config_path('language_detect.php')],
            ['language-detect', 'language-detect:config']
        );

        // Register middleware.
        $this->registerMiddleware();
    }

    protected function registerMiddleware() : void {
        //  Register middleware.
        $router = $this->app['router'];
        $router->aliasMiddleware('set_language', DetectLanguageAndSetLanguage::class);
    }
}
