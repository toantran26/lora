<?php

namespace App\Providers;

// use Illuminate\Support\ServiceProvider;

use App\Models\Contact;
use Illuminate\Pagination\Paginator;
// use App\Repositories\Interfaces\AdminRepositoryInterface as AdminReadInterface;
// use App\Repositories\AdminRepository as AdminReadRepo;


use App\Repository\Backend\AdminRepository;
use App\Repository\Backend\Contracts\AdminRepositoryInterface;
use App\Repository\Backend\Contracts\GateWayRepositoryInterface;
use App\Repository\Backend\Contracts\NodeRepositoryInterface;
use App\Repository\Backend\Contracts\SensorRepositoryInterface;
use App\Repository\Backend\Contracts\UserRepositoryInterface;
use App\Repository\Backend\GateWayRepository;
use App\Repository\Backend\NodeRepository;
use App\Repository\Backend\SensorRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    // public $singletons = [
    //     AdminReadInterface::class => AdminReadRepo::class
    // ];
    public $singletons = [
        AdminRepositoryInterface::class => AdminRepository::class,
        GateWayRepositoryInterface::class => GateWayRepository::class,
        NodeRepositoryInterface::class => NodeRepository::class,
        SensorRepositoryInterface::class => SensorRepository::class,
        // Sensi::class => AdminRepository::class,

    
        
    ];
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
        // Carbon::setLocale('vi');
        Schema::defaultStringLength(191);
        \Carbon\Carbon::setLocale('vi');
        Paginator::defaultView('vendor.pagination.bootstrap-4');
    }
}

