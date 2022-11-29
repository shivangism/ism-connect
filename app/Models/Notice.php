<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'heading',
        'content',
        'image',
        'updated_at'
    ];

    protected $hidden = [
        'deleted_at'
    ];
}
