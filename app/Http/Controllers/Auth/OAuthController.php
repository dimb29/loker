<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OAuthController extends Controller
{
    public function redirectToProvider($id)
    {
        // dd($id);
        return Socialite::driver($id)->redirect();
    }

    public function handleProviderCallback($id)
    {
        try {
            $user = Socialite::driver($id)->user();
            // dd($user->avatar_original);
            $isUser = User::where(['oauth_id' => $user->id])->first();
            if($isUser){
                Auth::login($isUser);
                return redirect('complete/data');
            }else{
                $isUser = User::where(['email' => $user->email])->first();
                if(!$isUser){
                    $this->getReff();
                    $this->createProfileUrl($user);
                    $createUser = User::create([
                        'first_name' => $user->name,
                        'email' => $user->email,
                        'oauth_id' => $user->id,
                        'oauth_type' => $id,
                        'email_verified_at' => now(),
                        'profile_url' => $this->purep,
                        'profile_photo_path' => $user->avatar_original,
                        'referral' =>$this->refcode,
                        'password' => Hash::make($this->purep.'-'.$this->refcode)
                    ]);
        
                    Auth::login($createUser);
                    return redirect('complete/data');
                }else{
                    if($isUser->oauth_id){
                        if($isUser->oauth_type == $id){
                            session()->flash('message', 'Email yang digunakan pernah didaftarkan');
                        }else{
                            session()->flash('message', 'Email sudah digunakan dengan akun '.$isUser->oauth_type);
                        }
                    }else{
                        session()->flash('message', 'Email yang digunakan pernah didaftarkan');
                    }
                    return redirect('/login');
                }
            }
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }

        // $user->token;
    }
    public function getReff(){

        $chars = "abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@!#$%^&*()_+"; 
        srand((double)microtime()*1000000); 
        $i = 0; 
        $pass = '' ; 
        // dd(strlen($chars));
    
        while ($i <= 7) { 
            $num = rand() % 74; 
            $tmp = substr($chars, $num, 1); 
            $pass = $pass . $tmp; 
            $i++; 
        } 
        $getRef = User::where('referral', $pass)->first();
        if(is_null($getRef)){
            $refcode = $pass;
        }else{
            $this->getReff();
        }
        $this->refcode = $refcode;
        // dd($pass);
    }
    public function createProfileUrl($data){
        $getdatenow = Carbon::now()->format('dmyhis');
        // dd($uri);
        $create_pu = $data->name.'-'.$getdatenow;
        $purep = strtolower(str_replace(' ', '-', $create_pu));
        $this->purep = $purep;
    }

    public function deleteData(){
        //
    }
}
