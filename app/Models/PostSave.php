<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostSave extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'post_save';
    protected $fillable = [
        'user_id',
        'post_id'
    ];
}