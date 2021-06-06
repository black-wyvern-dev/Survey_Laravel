<?php

namespace App\Providers;

use App\Models\CompanyInfo;
use Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('*', function($view) {
            $user = Auth::user();
            $logo_url = 'logo/company_logo.png';
            if ($user) {
                $owner_id = $user->id;
                if($user->role != 2) {
                    $owner_id = $user->parent_id;
                }
                $logo = CompanyInfo::where('category_id', '=', '0')->where('owner_id', '=', $owner_id)->first();
                $logo_url = $logo->url;
            }
            View::share( 'logo_url', $logo_url );
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
