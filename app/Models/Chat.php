<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'query',
        'subject',
        'sender_id',
        'job_id',  
        'status',
        'forwarded',
        'is_expired',
        'usertype'
      
    ];
}
