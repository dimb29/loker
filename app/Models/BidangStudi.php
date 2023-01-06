<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangStudi extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'bidang_studi';
    protected $fillable = [
        'name',
    ];

    public function pendidikanuser(){
        return $this->hasMany(PendidikanUser::class, 'fos', 'id');
    }
}
