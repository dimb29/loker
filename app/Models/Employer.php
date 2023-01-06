<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Model;

class Employer extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $connection = 'mysql';
   protected $fillable = [
       'name', 'email','telepon', 'password', 'tagline', 'desc',
       'alamat','provinsi','kota','kodepos', 'logo', 'profile_url',
       'referral','preferences','remember_token',
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [
       'password',
       'remember_token',
       'two_factor_recovery_codes',
       'two_factor_secret',
   ];

   /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
   protected $casts = [
       'email_verified_at' => 'datetime',
   ];

   /**
    * The accessors to append to the model's array form.
    *
    * @var array
    */
   protected $appends = [
       'profile_photo_url',
   ];

   public function getloker(){
       return $this->hasMany(Post::class, 'employer_id', 'id');
   }
   
    public function author_employer(){
        return $this->hasMany(Post::class, 'employer_id', 'id');
    }
    
    public function getkota(){
        return $this->belongsTo(Regency::class, 'kota', 'id');
    }
    public function getprov(){
        return $this->belongsTo(Regency::class, 'provinsi', 'id');
    }

    public function notif_from_employer(){
        return $this->hasMany(Notification::class, 'from', 'id');
    }
    public function notif_to_employer(){
        return $this->hasMany(Notification::class, 'to', 'id');
    }

    public function chat_from_employer(){
        return $this->hasMany(Chat::class, 'from', 'id');
    }
    public function chat_to_employer(){
        return $this->hasMany(Chat::class, 'to', 'id');
    }
}
