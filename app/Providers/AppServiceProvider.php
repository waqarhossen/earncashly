<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Admin;
use App\Models\settings;
use App\Models\pages;
use App\Models\Missions;
use App\Models\socialmedia;

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
        $admin_data = Admin::where('id', '=', 1)->first();
        View::share('admin_data', $admin_data);

        $miss = Missions::select('id')->where('slug', "offer")->count();
        View::share('miss', $miss);

        $site_details = settings::where('id', 1)->first();
        View::share('site_details', $site_details);

        $pageslist = pages::where('status', '=', 1)->where('footer', '=', 1)->latest()->get();
        View::share('pageslist', $pageslist);

        $socialmedia = socialmedia::where('status', '=', 1)->latest()->get();
        View::share('socialmedia', $socialmedia);

    }
}
