<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnClassBenefit extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'on_class_benefit';
    protected $fillable = [
        'on_class_id', 'title',
    ];
}
