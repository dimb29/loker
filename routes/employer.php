<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Illuminate\Http\Request;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;
use App\Http\Livewire\Main;
use App\Http\Livewire\Posts\Posts;
use App\Http\Livewire\Chat\Chat;
use App\Http\Livewire\Posts\Berita;
use App\Http\Livewire\Notif\Employer\NotifList as NotifEm;
use App\Http\Livewire\Notif\Employer\NotifStar as NotifStem;
use App\Http\Livewire\Chat\Employer\Chat as Chatem;
use App\Http\Controllers\Employer\ProfilEmployer;
use App\Http\Livewire\Profile\Employer\Profile as ProfileEm;

Route::get('employers/{id}', ProfileEm::class)->name('employer.profile.info');
Route::prefix('employer')->name('employer.')->group(function(){
    $enableViews = config('fortify.views', true);

    Route::get('/lowongan/{id}', Berita::class)->name('lowongan/{id}');
    // Route::get('s/{id}', ProfileEm::class)->name('profile.info');

    Route::group(['middleware' => ['auth:employer', 'verified']], function () {
        Route::get('/notif', NotifEm::class)->name('notif');
        Route::get('/notif-berbintang', NotifStem::class)->name('notif.star');
        Route::get('/chat', Chatem::class)->name('chat');
        Route::get('/posts', Posts::class)->name('posts');
        Route::get('/profil', [ProfilEmployer::class, 'render'])->name('profil');
        Route::get('/chat/{id}', Chatem::class)->name('chat.open');
        // Route::post('/register', [RegisteredEmployerController::class, 'store']);
        // Route::get('/register', [RegisteredEmployerController::class, 'create'])->name('registers');
        // Route::get('/login', [AuthenticatedEmployerController::class, 'create'])->name('logins');
        // Route::post('/login', [AuthenticatedEmployerController::class, 'store']);
    });

    Route::view('/login', 'auth.employer.login')->middleware('guest:employer')->name('logins');
    

    $limiter = config('fortify.limiters.login');
    // $twoFactorLimiter = config('fortify.limiters.two-factor');
    $verificationLimiter = config('fortify.limiters.verification', '6,1');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware(array_filter([
            'guest:employer',
            $limiter ? 'throttle:'.$limiter : null,
        ]));

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth:employer')
        ->name('logout');

    Route::get('/dashboard', Main::class)->middleware('auth:employer')->name('dashboard');
    

    // Password Reset...
    if (Features::enabled(Features::resetPasswords())) {
        if ($enableViews) {
            Route::view('/forgot-password', 'auth.employer.forgot-password')
                ->middleware('guest:employer')
                ->name('password.request');

            Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest:employer')
                ->name('password.reset');
        }

        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
            ->middleware('guest:employer')
            ->name('password.email');

        Route::post('/reset-password', [NewPasswordController::class, 'store'])
            ->middleware('guest:employer')
            ->name('password.update');
    }

    // Registration...
    if (Features::enabled(Features::registration())) {
        if ($enableViews) {
            Route::view('/register', 'auth.employer.register')
                ->middleware('guest:employer')
                ->name('register');
                Route::view('/join/{id}', 'auth.employer.register')
                    ->middleware('guest:employer')
                    ->name('register.join');
        }

        Route::post('/register', [RegisteredUserController::class, 'store'])
            ->middleware('guest:employer');
    }

    // Email Verification...
    if (Features::enabled(Features::emailVerification())) {
        if ($enableViews) {
            Route::get('/email/verify', function () {
                return view('auth.employer.verify-email');
            })->middleware('auth:employer')->name('verification.notice');
        } 
        
        Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
            $request->fulfill();
         
            return redirect('employer/dashboard');
        })->middleware(['auth:employer', 'signed'])->name('verification.verify');

        Route::post('/email/verification-notification', function (Request $request) {
            $request->user()->sendEmailVerificationNotification();
         
            return back()->with('status', 'verification-link-sent');
        })->middleware(['auth:employer', 'throttle:6,1'])->name('verification.send');

        // Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        //     ->middleware(['auth:employer', 'signed', 'throttle:'.$verificationLimiter])
        //     ->name('verification.verify');

        // Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        //     ->middleware(['auth:employer', 'throttle:'.$verificationLimiter])
        //     ->name('verification.send');
    }
});