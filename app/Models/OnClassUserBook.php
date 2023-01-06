<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnClassUserBook extends Model
{
    use HasFactory;

    protected $connection = "mysql2";
    protected $table = "on_class_materi_user";
    protected $fillable = [
        'on_class_materi_id', 'on_class_id', 'user_id'
    ];
}
