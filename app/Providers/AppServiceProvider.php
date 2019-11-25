<?php

namespace App\Providers;

use App\Repositories\DeceasedRepository;
use App\Repositories\DonationRepository;
use App\Repositories\EventRepository;
use App\Repositories\Interfaces\DeceasedRepositoryInterface;
use App\Repositories\Interfaces\DonationRepositoryInterface;
use App\Repositories\Interfaces\EventRepositoryInterface;
use App\Repositories\Interfaces\PanditaRepositoryInterface;
use App\Repositories\Interfaces\RegionRepositoryInterface;
use App\Repositories\Interfaces\RequestKtubRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\ViharaRepositoryInterface;
use App\Repositories\PanditaRepository;
use App\Repositories\RegionRepository;
use App\Repositories\RequestKtubRepository;
use App\Repositories\UserRepository;
use App\Repositories\ViharaRepository;
use App\Services\DeceasedService;
use App\Services\DonationService;
use App\Services\EventService;
use App\Services\Interfaces\DeceasedServiceInterface;
use App\Services\Interfaces\DonationServiceInterface;
use App\Services\Interfaces\EventServiceInterface;
use App\Services\Interfaces\PanditaServiceInterface;
use App\Services\Interfaces\RegionServiceInterface;
use App\Services\Interfaces\RequestKtubServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\Interfaces\ViharaServiceInterface;
use App\Services\PanditaService;
use App\Services\RegionService;
use App\Services\RequestKtubService;
use App\Services\UserService;
use App\Services\ViharaService;
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

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);

        $this->app->bind(DeceasedRepositoryInterface::class, DeceasedRepository::class);
        $this->app->bind(DeceasedServiceInterface::class, DeceasedService::class);

        $this->app->bind(DonationRepositoryInterface::class, DonationRepository::class);
        $this->app->bind(DonationServiceInterface::class, DonationService::class);

        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(EventServiceInterface::class, EventService::class);

        $this->app->bind(PanditaRepositoryInterface::class, PanditaRepository::class);
        $this->app->bind(PanditaServiceInterface::class, PanditaService::class);

        $this->app->bind(RegionRepositoryInterface::class, RegionRepository::class);
        $this->app->bind(RegionServiceInterface::class, RegionService::class);

        $this->app->bind(RequestKtubRepositoryInterface::class, RequestKtubRepository::class);
        $this->app->bind(RequestKtubServiceInterface::class, RequestKtubService::class);

        $this->app->bind(ViharaRepositoryInterface::class, ViharaRepository::class);
        $this->app->bind(ViharaServiceInterface::class, ViharaService::class);
    }
}
