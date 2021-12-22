<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;

class ViewComposerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(isset(auth()->user()->id))
        if(auth()->user()->role_id != 1)
        {


            View::composer(['*'],function($view){

                if (env("APP_TYPE") == 'single'){

                    $web_url = env("WEB_URL");

                }else{

                    $host= explode('.',request()->getHost());

                    unset($host[0]);
                    $web_url = $_SERVER['REQUEST_SCHEME'].'://'. auth()->user()->relationBetweenUnion->sub_domain.'.'.implode('.',$host);

                }

                $view->with('url',$web_url);
            });
        }

        return $next($request);
    }
}
