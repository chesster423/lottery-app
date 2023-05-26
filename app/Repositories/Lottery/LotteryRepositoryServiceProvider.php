<?php
namespace App\Repositories\Lottery;

use Illuminate\Support\ServiceProvider;

class LotteryRepositoryServiceProvider extends ServiceProvider

{

    /**
    * Bootstrap the application services.
    *
    * @return void
    */
    public function boot(){

    }

    /**
    * Register the application services.
    *
    * @return void
    */
    public function register(){

        $this->app->bind('App\Repositories\Lottery\LotteryInterface', 'App\Repositories\Lottery\LotteryRepository');

    }

}