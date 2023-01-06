<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnClassMateri extends Model
{
    use HasFactory;

    protected $connection = "mysql2";
    protected $table = "on_class_materi";
    protected $fillable = [
        'on_class_id', 'title', 'content',
    ];

    public function userbook(){
        return $this->belongsTo(OnClassUserBook::class, 'id', 'on_class_materi_id');
    }
}
