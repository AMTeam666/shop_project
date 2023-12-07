<?php

namespace App\Providers;

use App\Models\Content\Comment;
use App\Models\Market\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        view()->composer('admin.layouts.header', function ($view) {
            $view->with('unseenComments', Comment::where('seen', 0)->get());
        });

        view()->composer('customers.layouts.header', function($view){
            if(Auth::check())
            {
                $Items = CartItem::where('user_id', auth()->user()->id)->get();
                $view->with('cartItems', $Items);
            }
        });
    
    }
}
