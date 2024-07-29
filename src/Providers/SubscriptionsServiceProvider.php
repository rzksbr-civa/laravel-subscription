<?php

declare(strict_types=1);

namespace Webaune\Subscriptions\Providers;

use Webaune\Subscriptions\Models\Plan;
use Illuminate\Support\ServiceProvider;
use Webaune\Support\Traits\ConsoleTools;
use Webaune\Subscriptions\Models\PlanFeature;
use Webaune\Subscriptions\Models\PlanSubscription;
use Webaune\Subscriptions\Models\PlanSubscriptionUsage;
use Webaune\Subscriptions\Console\Commands\MigrateCommand;
use Webaune\Subscriptions\Console\Commands\PublishCommand;
use Webaune\Subscriptions\Console\Commands\RollbackCommand;

class SubscriptionsServiceProvider extends ServiceProvider
{
    use ConsoleTools;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(realpath(__DIR__.'/../../config/config.php'), 'webaune.subscriptions');

        // Bind eloquent models to IoC container
        $this->registerModels([
            'webaune.subscriptions.plan' => Plan::class,
            'webaune.subscriptions.plan_feature' => PlanFeature::class,
            'webaune.subscriptions.plan_subscription' => PlanSubscription::class,
            'webaune.subscriptions.plan_subscription_usage' => PlanSubscriptionUsage::class,
        ]);

    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/config.php' => $this->app->configPath('webaune.subscriptions.php'),
            ], 'webaune/subscriptions::config');

            $this->publishes([
                __DIR__ . '/../../database/migrations' => $this->app->databasePath('migrations'),
            ], 'webaune/subscriptions::migrations');
            $this->commands([
                MigrateCommand::class,
                PublishCommand::class,
                RollbackCommand::class,
            ]);
        }
    }
}
