<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => [
        ]
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        $policies = config('policies');

        //TODO CHECK INDEX FOR BOTH "$key"
        foreach ($policies as $key => $policy) {
            foreach ($policy['permissions'] as $key => $permission) {
                Gate::define($permission, [$policy['policy'], $key]);
            }
        }
    }
}
