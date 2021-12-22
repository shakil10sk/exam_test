<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\GlobalModel;
use Illuminate\Support\Facades\View;

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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);

        if(env('APP_TYPE') == 'single') {

            $subDomain = env('WEB_SUB_DOMAIN');

        }else{

            if(!isset($_SERVER['HTTP_HOST']))
            {
                return;
            }

            $subDomain = explode('.', $_SERVER['HTTP_HOST'])[0];

        }

        $unionProfile = GlobalModel::union_profile($subDomain);

        $url = env('APP_URL');

        if(env('APP_TYPE') == 'sub_domain')
        {
            $url = $_SERVER['HTTP_HOST'];
        }

        View::share(['unionProfile' => $unionProfile, 'path' => env('ADMIN_URL'), 'url' => $url]);


    }
}
