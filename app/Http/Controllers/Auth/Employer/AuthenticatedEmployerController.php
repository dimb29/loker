<?php

namespace App\Http\Controllers\Auth\Employer;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Pipeline;
use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Auth;
use Validator;
use App\Models\Employer;
use App\Models\Session as Sessions;
use Session;

class AuthenticatedEmployerController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard) {
        $this->guard = $guard;
    }

    /**
     * Show the login view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LoginViewResponse
     */
    public function create(Request $request) {
        if (Auth::guard('employer')->user()) {
            return redirect('dashborad');
        } else {
            return view('auth.employer.login');
        }
    }

    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return mixed
     */
    public function store(LoginRequest $request) {
        $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                    'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        $email = $request->email;
        $password = $request->password;
        // dd($validator);
        $getdataEm = Employer::where('email', '=', $email)->select('id')->first();
        if(is_null($getdataEm)){
            session()->flash('status', 'email anda salah');
            return redirect()->back();
        }
        $cekreqid = $request->session()->put('employer_id', $getdataEm);
        // dd($getdataEm);
        $sessionId = Session::getId();
        $upsession = Sessions::find($sessionId);
        $upsession->timestamps = false;
        $upsession->update(['employer_id' => $getdataEm->id]);
        // dd($upsession);
        if (Auth::guard('employer')->attempt(['email' => $email, 'password' => $password])) {
            return redirect('dashboard');
        }else{
            return back()->withErrors(['crediential doesnot match']);
        }
    }

  

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LogoutResponse
     */
    public function destroy(Request $request): LogoutResponse {
        $this->guard->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return app(LogoutResponse::class);
    }

}
