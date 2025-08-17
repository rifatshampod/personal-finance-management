<?php

namespace App\Providers;

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
        \App\Models\Account::class => \App\Policies\AccountPolicy::class,
        \App\Models\Transaction::class => \App\Policies\TransactionPolicy::class,
        \App\Models\Obligation::class => \App\Policies\ObligationPolicy::class,
        \App\Models\ObligationPayment::class => \App\Policies\ObligationPaymentPolicy::class,
        \App\Models\Category::class => \App\Policies\CategoryPolicy::class,
        \App\Models\Counterparty::class => \App\Policies\CounterpartyPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
