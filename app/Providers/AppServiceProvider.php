<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Profil;
use Illuminate\Support\Facades\DB;

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
        Carbon::setLocale('id');
        Paginator::useBootstrap();
        View::composer('admin.layouts.footer', function ($view) {
            $profil = Profil::first();
            $view->with('profil', $profil);
        });
        
        $kategori = DB::table('kategori_galeris')->get();

        View::share('kategori', $kategori);

    }
}
