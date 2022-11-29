<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Feed extends Model
{
    use HasFactory;

    protected $fillable = [
        'feed_heading',
        'username',
        'image_path',
        'userid',
        'content',
    ];

    protected $hidden = [
        'deleted_at'
    ];
}
