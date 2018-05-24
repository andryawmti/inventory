<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerUserPolicies();
    }

    public function registerUserPolicies()
    {
        Gate::define('data_produk', function ($user) {
            return $user->hasAccess(['data_produk']);
        });
        Gate::define('data_satuan', function ($user) {
            return $user->hasAccess(['data_satuan']);
        });
        Gate::define('data_pelanggan', function ($user) {
            return $user->hasAccess(['data_pelanggan']);
        });
        Gate::define('data_distributor', function ($user) {
            return $user->hasAccess(['data_distributor']);
        });
        Gate::define('data_pembelian', function ($user) {
            return $user->hasAccess(['data_pembelian']);
        });
        Gate::define('data_penjualan', function ($user) {
            return $user->hasAccess(['data_penjualan']);
        });
        Gate::define('data_user', function ($user) {
            return $user->hasAccess(['data_user']);
        });
        Gate::define('auto_purchase', function ($user) {
            return $user->hasAccess(['auto_purchase']);
        });
        Gate::define('pengaturan', function ($user) {
            return $user->hasAccess(['pengaturan']);
        });
        Gate::define('pengaturan_eqo', function ($user) {
            return $user->hasAccess(['pengaturan_eqo']);
        });
        Gate::define('laporan', function ($user) {
            return $user->hasAccess(['laporan']);
        });
    }
}
