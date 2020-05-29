<?php

namespace App\Providers;

use App\Models\Quiz;
use Illuminate\Support\ServiceProvider;

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
        
        $data['quizzes'] = Quiz::all();
        view()->share($data);
    }
}
