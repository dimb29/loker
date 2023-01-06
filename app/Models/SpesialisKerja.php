<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpesialisKerja extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = "spesialis_kerja";
    
    protected $fillable = [
        'name_sk',
    ];
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
    public function pengalamanuser(){
        return $this->hasMany(PengalamanUser::class, 'specialist', 'id');
    }

    public function bidangkerja(){
        return $this->belongsToMany(BidangKerja::class);
    }
}
