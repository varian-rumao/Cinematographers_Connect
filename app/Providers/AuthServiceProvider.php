<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
            Content::class => ContentPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

    }
}
