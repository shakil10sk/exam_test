<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\GlobalModel;
use View;

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
        if (env("APP_ENV") == 'development') {

            $subDomain = env('WEB_SUB_DOMAIN');

        }elseif (env("APP_ENV") == 'local') {

            $subDomain = env('WEB_SUB_DOMAIN');

        }else{
            if(!isset($_SERVER['HTTP_HOST']))
            {
                return;
            }

            $subDomain = explode('.', $_SERVER['HTTP_HOST'])[0];

        }

        $unionProfile = GlobalModel::union_profile($subDomain);

        if(env("APP_ENV") == 'local'){
            //This is for local run project
            //Note: create thid path for run admin first time than run web
            $path = env('ADMIN_URL');
        }elseif(env("APP_ENV") == 'development'){
            //This is for local-server run project
            $path = env('ADMIN_URL');
        }else {
            //This is for production run project
            $path = env("ADMIN_URL");
        }

        View::share(['unionProfile' => $unionProfile, 'path' => $path]);
    }
}
