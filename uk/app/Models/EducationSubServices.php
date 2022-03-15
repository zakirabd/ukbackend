<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationSubServices extends Model
{
    use HasFactory;
    protected $table = 'education_sub_services';
    protected $fillable = [
        'education_services_id'
    ];

    public function translate(){
        return $this->hasOne('App\Models\EducationSubServicesTranslate', 'edu_sub_services_id');
    }
}
