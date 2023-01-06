<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Carbon\Carbon;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        $getdatenow = Carbon::now()->format('dmyhis');
        if(Auth::guard('employer')->user() != null){
            // dd($uri);
            $email = $input['email'];
            $split_email = explode('@', $email);
            if($split_email[1] == 'kedker.com'){
                $create_pu = $input['name'].'-spexample';
            }else{
                $create_pu = $input['name'];
            }
            $purep = strtolower(str_replace(' ', '-', $create_pu));
            // $this->purep = $purep;

            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('employers')->ignore($user->id)],
                'telepon' => ['required', 'string', 'max:20'],
                'alamat' => ['required', 'string', 'max:255'],
                'kodepos' => ['required', 'string', 'max:20'],
                'kota' => ['required', 'max:20'],
                'provinsi' => ['required', 'max:20'],
                'photo' => ['nullable', 'image', 'max:1024'],
            ])->validateWithBag('updateProfileInformation');
    
            if (isset($input['photo'])) {
                $user->updateProfilePhoto($input['photo']);
            }
    
            if ($input['email'] !== $user->email &&
                $user instanceof MustVerifyEmail) {
                $this->updateVerifiedUser($user, $input);
            } else {
                $user->forceFill([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'tagline' => $input['tagline'],
                    'desc' => $input['desc'],
                    'telepon' => $input['telepon'],
                    'alamat' => $input['alamat'],
                    'kodepos' => $input['kodepos'],
                    'profile_url' => $purep,
                    'kota' => $input['kota'],
                    'provinsi' => $input['provinsi'],
                ])->save();
            }
        }else{
            // dd($user->profile_url);
            if($user->profile_url):
                $get_pu = $user->profile_url;
            else:
                $get_pu = $getdatenow;
            endif;
            $xplode_pu = explode('-', $get_pu);
            $getcount_pu = count($xplode_pu);
            $getlast_pu = $xplode_pu[count($xplode_pu)-1];
            // dd($getlast_pu);
            $create_pu = $input['first_name'].'-'.$input['last_name'].'-'.$getlast_pu;
            $purep = strtolower(str_replace(' ', '-', $create_pu));

            Validator::make($input, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'profesi' => ['required', 'string', 'max:50'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'telepon' => ['required', 'string', 'max:20'],
                'photo' => ['nullable', 'image', 'max:1024'],
                'birth_date' => ['required', 'string', 'max:20'],
                'alamat' => ['required', 'string', 'max:255'],
                'kodepos' => ['required', 'string', 'max:20'],
                'kota' => ['required', 'max:20'],
                'provinsi' => ['required', 'max:20'],
            ])->validateWithBag('updateProfileInformation');
    
            if (isset($input['photo'])) {
                $user->updateProfilePhoto($input['photo']);
            }
    
            if ($input['email'] !== $user->email &&
                $user instanceof MustVerifyEmail) {
                $this->updateVerifiedUser($user, $input);
            } else {
                $user->forceFill([
                    'first_name' => $input['first_name'],
                    'last_name' => $input['last_name'],
                    'profesi' => $input['profesi'],
                    'email' => $input['email'],
                    'telepon' => $input['telepon'],
                    'birth_date' => $input['birth_date'],
                    'alamat' => $input['alamat'],
                    'profile_url' => $purep,
                    'kodepos' => $input['kodepos'],
                    'kota' => $input['kota'],
                    'provinsi' => $input['provinsi'],
                ])->save();
            }
        }
    }
    

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {  
        if(Auth::guard('employer')->user() != null){
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();
        }else{
        $user->forceFill([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();
        }

        $user->sendEmailVerificationNotification();
    }
}
