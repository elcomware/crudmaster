<?php

namespace Elcomware\CrudMaster;


use Illuminate\Support\ServiceProvider;


/**
 * CrudMasterServiceProvider
 *
 * This is the core service provider for the CrudMaster package.
 * It handles:
 *  - Registration and bootstrapping of the package.
 *  - Publishing of config, views, stubs, and JS assets (for Inertia).
 *  - Loading of routes and view namespaces.
 */
class CrudMasterServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * This method is called before all other service providers.
     */
    public function register(): void
    {

        // Merge package config with app config
        $this->mergeConfigFrom(__DIR__ . '/../config/crudmaster.php', 'crudmaster');

        // Register helper functions if not already autoloaded
        if (file_exists(__DIR__ . '/Helpers/response_helpers.php')) {
            require_once __DIR__ . '/Helpers/response_helpers.php';
        }
    }

    /**
     * Bootstrap any package services.
     *
     * This is where routes, views, and publishable assets are loaded.
     */
    public function boot(): void
    {
        // Load package routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Load views with namespacing: e.g., view('crudmaster::index')
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'crudmaster');

        // Allow publishing of config, views, stubs, and assets
        $this->publishes([
            __DIR__ . '/../config/crudmaster.php' => config_path('crudmaster.php'),
        ], 'crudmaster-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/crudmaster'),
        ], 'crudmaster-views');


        $this->publishes([
            __DIR__ . '/../src/Stubs' => base_path('stubs/crudmaster'),
        ], 'crudmaster-stubs');

        $this->publishes([
            __DIR__ . '/../resources/js' => resource_path('js/vendor/crudmaster'),
        ], 'crudmaster-js');
    }
}
