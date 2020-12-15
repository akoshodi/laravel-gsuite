<?php

namespace Akoshodi\GSuite;

// Commands
use Akoshodi\GSuite\Commands\CreateGroup;
use Akoshodi\GSuite\Commands\CreateAccount;
use Akoshodi\GSuite\Commands\DeleteAccount;
use Akoshodi\GSuite\Commands\SuspendAccount;
use Akoshodi\GSuite\Commands\UnsuspendAccount;

// Clients
use Akoshodi\GSuite\Clients\GoogleClient;
use Akoshodi\GSuite\Clients\GoogleServicesClient;

// Repos
use Akoshodi\GSuite\Resources\Groups\GroupsRepository;
use Akoshodi\GSuite\Resources\Accounts\AccountsRepository;

// Misc
use Illuminate\Support\ServiceProvider;
use Akoshodi\GSuite\Commands\DeleteGroup;
use Akoshodi\GSuite\Commands\FlushCache;

class GSuiteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish config file...
        $this->publishes([
            __DIR__ . '/../config/gsuite.php' => config_path('gsuite.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/gsuite.php', 'gsuite');

        // The base Google client
        $this->app->singleton('google-client', function () {
            return new GoogleClient;
        });

        // The Google service resolver
        $this->app->singleton('google-services', function () {
            return new GoogleServicesClient(app('google-client'));
        });

        // G-Suite accounts repo
        $this->app->singleton('gsuite-accounts-repo', function () {
            return new AccountsRepository(app('google-services'));
        });

        // G-Suite groups repo
        $this->app->singleton('gsuite-groups-repo', function () {
            return new GroupsRepository(app('google-services'));
        });

        // The base G-Suite class
        $this->app->singleton('gsuite', function () {
            return new GSuite(app('gsuite-groups-repo'), app('gsuite-accounts-repo'));
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
                FlushCache::class,
                CreateGroup::class,
                DeleteGroup::class,
                CreateAccount::class,
                DeleteAccount::class,
                SuspendAccount::class,
                UnsuspendAccount::class,
            ]);
        }
    }
}
