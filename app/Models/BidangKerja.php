<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangKerja extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'bidang_kerja';
    protected $fillable = [
        'name', 'spesialis_kerja_id'
    ];

    public function spesialiskerja(){
        return $this->belongsToMany(SpesialisKerja::class);
    }

    public function pengalamanuser(){
        return $this->hasMany(PengalamanUser::class, 'fow', 'id');
    }
}
