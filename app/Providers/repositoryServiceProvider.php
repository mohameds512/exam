<?php

namespace App\Providers;

use App\Repository\questionRepository;
use App\Repository\questionRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class repositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(
        //     'App\Repository\questionRepositoryInterface',
        //     'App\Repository\questionRepository'
        // );
        $this->app->bind(questionRepositoryInterface::class , questionRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
