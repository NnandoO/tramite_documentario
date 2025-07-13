<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\AuditEntrega;
use App\Policies\AuditEntregaPolicy;
use App\Models\NotificacionSolicitud;
use App\Policies\NotificacionSolicitudPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    protected $policies = [
        AuditEntrega::class => AuditEntregaPolicy::class,
        NotificacionSolicitud::class => NotificacionSolicitudPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
