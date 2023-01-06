<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengalamanUser extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $fillable = [
        'name', 'company_name',
        'work_start', 'work_end',
        'specialist', 'fow',
        'country', 'province', 'city',
        'industry', 'position',
        'salary', 'currency',
        'description','user_id',
    ];

    public function spesialiskerja(){
        return $this->belongsTo(SpesialisKerja::class, 'specialist', 'id');
    }
    public function users(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function bidangkerja(){
        return $this->belongsTo(BidangKerja::class,'fow', 'id');
    }
    
    public function tingkatkerja(){
        return $this->belongsTo(TingkatKerja::class, 'position', 'id');
    }
}
