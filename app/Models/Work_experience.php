<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work_experience extends Model
{
    use HasFactory;
    public $table="work_experience";

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
    public function company(){
        return $this->belongsTo(Company::class,"organisation_id");
    }
}
