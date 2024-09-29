<?php

namespace App\Providers;
use Illuminate\Support\Facades\Route;
use App\Models\Article;

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
  

    public function boot(){
    Route::bind('articleslug_fa' ,function($value){
        return Article::where('slug_fa' ,$value)->firstOrFail();

    });
   }
    
}
