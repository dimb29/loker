<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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
 
        if(request()->is('employer/*')){
            ResetPassword::createUrlUsing(function ($user, string $token) {
                return url('employer/reset-password/'.$token.'?email='.$user->email); 
            });
            VerifyEmail::createUrlUsing(function ($notifiable) {
                $frontendUrl = url('employer/auth/email/verify');

                $verifyUrl = URL::temporarySignedRoute(
                    'employer.verification.verify',
                    Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                    [
                        'id' => $notifiable->getKey(),
                        'hash' => sha1($notifiable->getEmailForVerification()),
                    ]
                );
                // dd($verifyUrl);
                // dd($frontendUrl.'/'.$notifiable->getKey().'/'.sha1($notifiable->getEmailForVerification()));
                return $verifyUrl;
            });
        }
    }
}
