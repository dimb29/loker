<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnClassImage extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'on_class_image';
    protected $fillable = [
        'title', 'url', 'featured', 'meta_data', 'on_class_id',
    ];
}
