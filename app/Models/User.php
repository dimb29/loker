<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $connection = 'mysql';
    protected $fillable = [
        'first_name',
        'last_name',
        'profesi',
        'email',
        'telepon',
        'alamat',
        'kodepos',
        'kota',
        'provinsi',
        'password',
        'referral',
        'profile_url',
        'parent_id',
        'profile_photo_url',
        'email_verified_at',
        'user_type',
        'preferences',
        'remember_token',
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

    public function comments(){
        return $this->hasMany(Comment::class, 'author_id', 'id');
    }

    public function perusahaan(){
        return $this->hasMany(Perusahaan::class, 'owner_id', 'id');
    }

    public function posts(){
        return $this->hasMany(Post::class, 'author_id', 'id');
    }

    public function pengalamanuser(){
        return $this->hasMany(PengalamanUser::class, 'user_id', 'id');
    }

    public function keterampilanuser(){
        return $this->hasMany(KeterampilanUser::class, 'user_id', 'id');
    }

    public function pendidikanuser(){
        return $this->hasMany(PendidikanUser::class, 'user_id', 'id');
    }
    
    public function postsave(){
        return $this->belongsToMany(Post::class);
    }

    public function bidangkerja(){
        return $this->belongsToMany(BidangKerja::class);
    }
    public function getkota(){
        return $this->belongsTo(Regency::class, 'kota', 'id');
    }
    public function getprov(){
        return $this->belongsTo(Regency::class, 'provinsi', 'id');
    }

    public function notif_from_user(){
        return $this->hasMany(Notification::class, 'from', 'id');
    }
    public function notif_to_user(){
        return $this->hasMany(Notification::class, 'to', 'id');
    }
    public function chat_from_user(){
        return $this->hasMany(Chat::class, 'from', 'id');
    }
    public function chat_to_user(){
        return $this->hasMany(Chat::class, 'to', 'id');
    }

    public function follower(){
        return $this->hasMany(Follow::class, 'follower_id', 'id');
    }
    
    public function following(){
        return $this->hasMany(Follow::class, 'following_id', 'id');
    }
}
