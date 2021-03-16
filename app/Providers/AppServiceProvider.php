<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        app('validator')->extend('valid', function ($attribute, $value, $parameters) {
            $fileName = base_path('data/'.$value.'.json');
            return file_exists($fileName);
        });

        app('validator')->replacer('valid', function ($message, $attribute, $rule, $parameters) {
            return 'This Provider Type is not valid';
        });

        app('validator')->extend('allowed', function ($attribute, $value, $parameters) {
            return in_array($value, ['authorised','decline','refunded']);
        });

        app('validator')->replacer('allowed', function ($message, $attribute, $rule, $parameters) {
            return 'This Status Code is not alowed';
        });
    }
}
