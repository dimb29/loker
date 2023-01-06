<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $fillable = [
        'type', 'follower_id', 'type_to', 'following_id'
    ];
}
