<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Seller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Employee;
use App\Policies\SellerPolicy;
use App\Policies\ProductPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\EmployeePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Category::class=>CategoryPolicy::class,
        Employee::class=>EmployeePolicy::class,
        Product::class=>ProductPolicy::class,
        Seller::class=>SellerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
