<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use Illuminate\Foundation\AliasLoader;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('settings', function($app){
            return new Setting();
        });

        $loader = AliasLoader::getInstance();
        $loader->alias('Setting', Setting::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(!App::runnInConsole() && count(Schema::getColumnListing('settings'))){
            $settings = Setting::all();
            foreach($settings as $key => $setting){
                Config::set('settings.'.$setting->key, $setting->value);
            }
        }
    }
}
