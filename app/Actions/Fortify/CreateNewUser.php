<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Employer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Carbon\Carbon;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    
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
    public function createProfileUrl($data,$uri){
        $getdatenow = Carbon::now()->format('dmyhis');
        // dd($uri);
        if($uri[1] == 'employer'){
            $email = $data['email'];
            $split_email = explode('@', $email);
            if($split_email[1] == 'kedker.com'){
                $create_pu = $data['name'].'-spexample';
            }else{
                $create_pu = $data['name'];
            }
            $purep = strtolower(str_replace(' ', '-', $create_pu));
            $this->purep = $purep;
        }else{
            $create_pu = $data['first_name'].'-'.$data['last_name'].'-'.$getdatenow;
            $purep = strtolower(str_replace(' ', '-', $create_pu));
            $this->purep = $purep;
        }
    }
    public function create(array $input)
    {
        $this->getReff();
        $get_uri = explode('/',$input[1]['REQUEST_URI']);
        $this->createProfileUrl($input[0],$get_uri);
        // dd($input[0]);
        if($input[0]['kode_referal'] != null){
            $get_ref = User::where('referral', $input[0]['kode_referal'])->first();
            // dd($get_ref);
            if($get_ref != null){
                $refid = $get_ref->referral;
                $utype = 'afiliator';
            }else{
                $refid = null;
                $utype = null;
            }
        }else{
            $refid = null;
            $utype = 'user';
        }
        if($get_uri[1] == 'employer'){
            Validator::make($input[0], [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:employers'],
                'telepon' => ['required', 'string', 'max:255'],
                'alamat' => ['required', 'string', 'max:255'],
                'kodepos' => ['required', 'string', 'max:20'],
                'provinsi' => ['required', 'string', 'max:255'],
                'kota' => ['required', 'string', 'max:255'],
                'password' => $this->passwordRules(),
                'kode_referal' => ['in:' . $refid],
            ])->validate();
            Validator::make(['profile_url' => $this->purep], [
                'profile_url' => ['required', 'string', 'max:255', 'unique:employers'],
                ])->validate();
            // dd($input[0]['kodepos']);
            return Employer::create([
                'name' => $input[0]['name'],
                'email' => $input[0]['email'],
                'telepon' => $input[0]['telepon'],
                'alamat' => $input[0]['alamat'],
                'kodepos' => $input[0]['kodepos'],
                'provinsi' => $input[0]['provinsi'],
                'profile_url' => $this->purep,
                'kota' => $input[0]['kota'],
                'password' => Hash::make($input[0]['password']),
                'referral' => $input[0]['kode_referal'],
            ]);
        }else{
            Validator::make($input[0], [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'user_type' => ['string', 'exists:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules(),
                'kode_referal' => ['in:' . $refid],
            ])->validate();
            return User::create([
                'first_name' => $input[0]['first_name'],
                'last_name' => $input[0]['last_name'],
                'user_type' => $utype,
                'email' => $input[0]['email'],
                'password' => Hash::make($input[0]['password']),
                'profile_url' => $this->purep,
                'parent_id' => $input[0]['kode_referal'],
                'referral' => $this->refcode,
            ]);
        }
    }
}
