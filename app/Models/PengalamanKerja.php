<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengalamanKerja extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql';
    protected $table = "pengalaman_kerja";

    protected $fillable = [
        'name_pk',
    ];
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
