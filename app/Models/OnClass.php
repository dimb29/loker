<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnClass extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $fillable = [
        'title', 'content', 'user_id', 'on_class_jenis_id',
        'user_type', 'price', 'level', 'views',
        'placename', 'alamat', 'kota', 'provinsi',
        'start_date', 'end_date',
    ];

    public function getdb(){
        $database = $this->database = $this->getConnection()->getDatabaseName();
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function author_employer(){
        return $this->belongsTo(Employer::class, 'user_id', 'id');
    }

    public function images(){
        return $this->hasMany(OnClassImage::class);
    }

    public function classtitle(){
        return $this->hasMany(OnClassTitle::class);
    }

    public function materi(){
        return $this->hasMany(OnClassMateri::class);
    }

    public function benefit(){
        return $this->hasMany(OnClassBenefit::class);
    }

    public function jenismateri(){
        return $this->belongsTo(OnClassJenis::class, 'on_class_jenis_id', 'id');
    }


    public function classsave(){
        return $this->hasMany(User::class);
    }

    public function spesialiskerja(){
        $this->getdb();
        return $this->belongsToMany(SpesialisKerja::class, $this->database.'.on_class_spesialis_kerja');
    }

    public function regency(){
        $this->getdb();
        return $this->belongsToMany(Regency::class, $this->database.'.on_class_regency');
    }
    
    public function district(){
        $this->getdb();
        return $this->belongsToMany(District::class, $this->database.'.district_on_class');
    }

    public function user(){
        $this->getdb();
        return $this->belongsToMany(User::class, $this->database.'.on_class_user');
    }
}
