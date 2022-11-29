<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'name',
        'url',
        'updated_at'
    ];

    protected $hidden = [
        'deleted_at'
    ];
}
