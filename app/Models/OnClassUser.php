<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnClassUser extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'on_class_user';
    protected $fillable = [
        'on_class_id', 'user_id', 'user_type',
    ];
}
