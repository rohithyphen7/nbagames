<?php

namespace App\Providers;

use App\Interfaces\GameInterface;
use App\Interfaces\GroupInterFace;
use App\Interfaces\TeamInterface;
use App\Repositories\GameRepository;
use App\Repositories\GroupRepository;
use App\Repositories\TeamRepository;
use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GameInterface::class, function(){
            return new GameRepository();
        });
        $this->app->bind(GroupInterFace::class, function(){
            return new GroupRepository();
        });
        $this->app->bind(TeamInterface::class, function(){
            return new TeamRepository();
        });
    }
}
