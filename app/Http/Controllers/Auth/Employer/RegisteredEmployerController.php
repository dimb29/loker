<?php

namespace App\Http\Controllers\Auth\Employer;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\Employer;
use App\Models\User;
use Auth;

class RegisteredEmployerController extends Controller
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
     * Show the registration view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\RegisterViewResponse
     */
    public function create(Request $request) {

        if (Auth::guard('employer')->user()) {
            return redirect('employer/dashboard');
        } else {
            return view('auth/employer/register');
        }
    }

    /**
     * Create a new registered user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Fortify\Contracts\CreatesNewUsers  $creator
     * @return \Laravel\Fortify\Contracts\RegisterResponse
     */
    public function store(Request $request) {
        if($request->referral != null){
            $cek_referral = User::where('referral', '=', $request->referral)->first();
        }else{
            $cek_referral = null;
        }
        // dd(count($cek_referral));
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required',
                    'telepon' => 'required',
                    'alamat' => 'required',
                    'kodepos' => 'required',
                    'provinsi' => 'required',
                    // 'referral' => 'required',
                    'kota' => 'required',
                    'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        elseif($request->referral != null){
            if(count($cek_referral) != 1){
                return redirect()->back()->withErrors(['msg' => 'Kode referral salah']);
            }
        }
        $expert = Employer::create([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'telepon' => $request['telepon'],
                    'alamat' => $request['alamat'],
                    'kodepos' => $request['kodepos'],
                    'provinsi' => $request['provinsi'],
                    'kota' => $request['kota'],
                    'referral' => $request['referral'],
                    'password' => Hash::make($request['password']),
        ]);
        Auth::guard('employer')->login($expert);
        return redirect('dashboard');
    }
}
