<?php

declare(strict_types=1);

return [

    // Manage autoload migrations
    'autoload_migrations' => true,

    // Subscriptions Database Tables
    'tables' => [

        'plans' => 'plans',
        'plan_features' => 'plan_features',
        'plan_subscriptions' => 'plan_subscriptions',
        'plan_subscription_usage' => 'plan_subscription_usage',

    ],

    // Subscriptions Models
    'models' => [

        'plan' => \Webaune\Subscriptions\Models\Plan::class,
        'plan_feature' => \Webaune\Subscriptions\Models\PlanFeature::class,
        'plan_subscription' => \Webaune\Subscriptions\Models\PlanSubscription::class,
        'plan_subscription_usage' => \Webaune\Subscriptions\Models\PlanSubscriptionUsage::class,

    ],

];
