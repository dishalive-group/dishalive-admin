<?php

namespace App\Providers;
use Auth;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            if(Auth::user()){
                $user = Auth::user();
                $user_id = $user->id;
            }else{                
                $user_id = 0;
            }
            
            $businessName = "DishaLive Group";
            $logo = "/logo.png";
            $userImage = "/assets/dashboard/img/dishalive.png";
            $favicon = "/favicon.ico";

            $data = compact('user_id', 'businessName', 'userImage', 'favicon', 'logo');
            $view->with($data);
        });
    }
}
