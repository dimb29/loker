<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $fillable = [
        'desc', 'type', 'from', 'to', 'type_to', 'read', 'chat_list_id'
    ];
    
    public function chat_user(){
        return $this->belongsTo(User::class,'from', 'id');
    }
    public function chat_to_user(){
        return $this->belongsTo(User::class,'to', 'id');
    }
    
    public function chat_employer(){
        return $this->belongsTo(Employer::class,'from', 'id');
    }
    public function chat_to_employer(){
        return $this->belongsTo(Employer::class,'to', 'id');
    }
}
