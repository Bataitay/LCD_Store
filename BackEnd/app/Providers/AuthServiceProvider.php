<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Order;
use App\Models\Permission;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $parentPermissions = Permission::where('group_key', '=', 0)->get();
        foreach($parentPermissions as $parentPermission){
            foreach($parentPermission->childrentPermissions as $childrentPermission){
                Gate::define($childrentPermission->group_name, function(User $user, $group_name){
                    return $user->hasPermission($group_name);
                });
            }
        }
        view()->composer('*', function ($view)
        {
            // $products = Product::all();
            // $oders = Order::all();

            // $view->with([
            //     'products'=> $products,
            //     'oders' => $oders,

            // ]);
        });
    }
}
