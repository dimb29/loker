<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeterampilanUser extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $fillable = [
        'name', 'level', 'user_id'
    ];
}
