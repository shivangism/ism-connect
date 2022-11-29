<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education_log extends Model
{
    use HasFactory;

    public $table = "education_log";
    public function company(){
        return $this->belongsTo(Company::class,"organisation_id");
    }
}
