<?php
declare(strict_types=1);
namespace Cornatul\Social;

class SocialServiceProvider extends \Illuminate\Support\ServiceProvider
{


    public function boot(): void
    {

        $this->loadRoutesFrom(__DIR__ . '/../routes/social.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'social');
        $this->loadMigrationsFrom(__DIR__ . '/migrations');

        $this->mergeConfigFrom(
            __DIR__ . '/Config/social.php', 'social'
        );
    }

    public function register(): void
    {

    }
}
