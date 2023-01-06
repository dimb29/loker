<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentClass extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'payment_class';
    protected $fillable = [
        'on_class_id', 'external_id', 'va_id',
        'payment_channel', 'email', 'account_number', 
        'bank_code', 'price', 'admin_fee', 'status',
        'inv_id', 'owner_id', 'user_id', 'user_type', 
        'expiration_date',
    ];
}
