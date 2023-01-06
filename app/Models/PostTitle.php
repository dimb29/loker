<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTitle extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'post_title';
    protected $fillable = [ 'title'];

    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
