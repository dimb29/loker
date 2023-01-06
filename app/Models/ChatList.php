<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatList extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $fillable = [
        'type', 'from', 'to', 'type_to',
    ];
    
    public function chat(){
        return $this->belongsTo(Chat::class,'id', 'chat_list_id');
    }
    public function chat_to(){
        return $this->belongsTo(Chat::class,'to', 'to');
    }
    
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
