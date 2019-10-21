<?php

namespace AporteWeb\Dashboard;

/**
* SDClapServiceProvider
*
* The service provider for the modules. After being registered
* it will make sure that each of the modules are properly loaded
* i.e. with their routes, views etc.
*
* @author Alfonzo Diez <alfonzodiez@gmail.com>
* @package AporteWeb\Dashboard
*/

use Illuminate\Support\Facades\Route;
use AporteWeb\Dashboard\Models\Content;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

class DashboardServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Will make sure that the required modules have been fully loaded
     * @return void
     */
    public function boot()
    {
        // Load Routes
        if(file_exists(__DIR__.'/routes/web.php')) {
            Route::middleware('web')
                 ->namespace('\AporteWeb\Dashboard\Controllers')
                 ->group(__DIR__.'/routes/web.php');
        }
        if(file_exists(__DIR__.'/routes/breadcrumbs.php')) {
            include __DIR__.'/routes/breadcrumbs.php';
        }
        // Load the views
        if(is_dir(__DIR__.'/resources/views')) {
            $this->loadViewsFrom(__DIR__.'/resources/views', 'Dashboard');
        }
        // Load Translations
        if(is_dir(__DIR__.'/resources/lang')) {
            $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'Dashboard');
            // $this->publishes([
            //     __DIR__.'/lang' => resource_path('lang/vendor/aporteweb/dashboard'),
            // ]);
        }
        // Load Migrations
        if(is_dir(__DIR__.'/migrations')) {
            $this->loadMigrationsFrom(__DIR__.'/migrations');
        }
        global $__seeders;
        $seed = [];
        if (is_array($__seeders)) {
            array_merge($__seeders, $seed);
        } else {
            $__seeders = $seed;
        }
        /*
        if(file_exists(__DIR__.'/config/dynamic-content.php')) {
            config(['dynamic-content' => include __DIR__.'/config/dynamic-content.php']);
        }
        if(file_exists(__DIR__.'/config/seo.php')) {
            config(['seo' => include __DIR__.'/config/seo.php']);
        }
        if(file_exists(__DIR__.'/config/permissions.php')) {
            config(['permissions' => include __DIR__.'/config/permissions.php']);
        }
        */
        config(['admin.theme.styles' => 'css/dashboard.css']);
        config(['admin.text.footer' => 'Todos los derechos reservados © Dashboard 2019']);
        view()->share([
            'active' => 'web.home',
        ]);
        view()->composer('*', function ($view)
        {
            //...with this variable
            // $view->with('__admin_menu', 'Dashboard::admin.menu');
        });
        Blade::component('Dashboard::components.messages', 'messages');
    }
    public function register()
    {
        // App::register('Krucas\Notification\NotificationServiceProvider');
        // App::alias('Notification','Krucas\Notification\Facades\Notification');
    }
}