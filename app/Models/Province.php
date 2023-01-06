<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    public function posts(){
        return $this->hasMany(Post::class, 'location_id', 'id');
    }
}