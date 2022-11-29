<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeedImages extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'image_path',
        'feed_id'
    ];

    protected $hidden = [
        'deleted_at'
    ];
}
