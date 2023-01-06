<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanUser extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $fillable = [
        'name', 'graduation_date',
        'qualification', 'country',
        'fos', 'major', 'final_score',
        'type_score', 'from_score',
        'description', 'user_id',
    ];

    public function kualifikasilulus(){
        return $this->belongsTo(KualifikasiLulus::class, 'qualification', 'id');
    }

    public function bidangstudi(){
        return $this->belongsTo(BidangStudi::class,'fos', 'id');
    }
}
