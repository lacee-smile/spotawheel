<?php

namespace App\Providers;

use App\Interfaces\ClientsRepositoryInterface;
use App\Repositories\ClientsRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ClientsRepositoryInterface::class, ClientsRepository::class);
    }
}
