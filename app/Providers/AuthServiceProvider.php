<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\Comment;
use App\Models\User;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('my-comment', Function(User $user, Comment $com){
            return $user->id == $com->user_id;
        });
    }

    // Gate: dung de check quyen sua xoa: dung user nao moi sua xoa dc comment cua user do
    
}
