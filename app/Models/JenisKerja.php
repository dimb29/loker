<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKerja extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'jenis_kerja';
    protected $fillable = [
        'name_jk',
    ];

    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
