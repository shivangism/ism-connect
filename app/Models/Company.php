<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    public $table="companies";
    
    public function work_experience(){
        return $this->hasOne(Work_experience::class);
    }
    protected $fillable = [
        'name',
        'website',
        'linkdin',
        'facebook',
        'twitter',
        'company_size',
        'headquarters'
    ];
}
