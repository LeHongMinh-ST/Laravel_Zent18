<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Schema\Builder;

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
        $arr = ['abc','def'
        ];
        View::share([
            'username'=>'Lê Hồng Minh',
            'arr'=>$arr
        ]);

        Builder::defaultStringLength(191);
    }
}
