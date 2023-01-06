<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $fillable = [
        'title',
        'content',
        'post_type',
        'meta_data',
        'jeniskerja_id',
        'kualifikasilulus_id',
        'pengalamankerja_id',
        'spesialiskerja_id',
        'tingkatkerja_id',
        'per_name',
        'province_id',
        'location_id',
        'author_id',
        'employer_id',
        'email',
        'wa',
        'formulir',
        'salary_start',
        'salary_end',
        'salary_check',
    ];
    
    // public function toSearchableArray(){
    
    //     $array = Post::with('kualifikasilulus')->toArray();
 
    //     return $array;
    // }

    public function author(){
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function author_employer(){
        return $this->belongsTo(Employer::class, 'employer_id', 'id');
    }

    // public function category(){
    //     return $this->belongsTo(Category::class);
    // }

    public function likes_comment(){
        return $this->belongsTo(LikesComment::class, 'id', 'id_post');
    }

    public function comments(){
        return $this->hasMany(Comment::class)->with(['author', 'likes_comment']);
    }

    public function perusahaan(){
        return $this->hasMany(Perusahaan::class, 'owner_id','author_id')->with(['author']);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function videos(){
        return $this->hasMany(Video::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function postTitles(){
        return $this->hasMany(PostTitle::class);
    }

    public function postsave(){
        return $this->hasMany(User::class);
    }

    public function jeniskerja(){
        return $this->belongsToMany(JenisKerja::class);
    }
    
    // public function jobcategory(){
    //     return $this->belongsTo(JobCategory::class);
    // }
    
    public function kualifikasilulus(){
        return $this->belongsToMany(KualifikasiLulus::class);
    }
    
    public function pengalamankerja(){
        return $this->belongsToMany(PengalamanKerja::class);
    }
    
    public function tingkatkerja(){
        return $this->belongsToMany(TingkatKerja::class);
    }

    public function spesialiskerja(){
        return $this->belongsToMany(SpesialisKerja::class);
    }
    public function province(){
        return $this->belongsTo(Province::class, 'location_id', 'id');
    }
    public function regency(){
        return $this->belongsToMany(Regency::class);
    }
    public function district(){
        return $this->belongsToMany(District::class);
    }
}
