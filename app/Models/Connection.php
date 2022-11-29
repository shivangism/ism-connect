<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use HasFactory;
    public $table="connection";
    
    public function user1(){
        return $this->belongsTo(User::class,"user_1_id");
    }

    public function user2(){
        return $this->belongsTo(Company::class,"user_2_id");
    }
}
