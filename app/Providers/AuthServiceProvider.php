<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;

use App\Http\Services\ApiService;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
{
    $this->registerPolicies();

    // Define un gate básico para administradores
    Gate::define('admin', function ($user) {
        // Verifica si el usuario es admin (ajusta según tu estructura)
        return $user->is_admin === 1; // O usando roles: return $user->hasRole('admin');
    });
}
public function register()
{
    $this->app->bind(ApiService::class, function ($app) {
        return new ApiService();
    });
}
}
