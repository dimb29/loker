<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $fillable = [
        'title', 'notif_type', 'type', 'from', 'type_to', 'to', 'desc', 'post_id',
    ];
    
    public function notif_user(){
        return $this->belongsTo(User::class,'from', 'id');
    }
    
    public function notif_employer(){
        return $this->belongsTo(Employer::class,'from', 'id');
    }
}
