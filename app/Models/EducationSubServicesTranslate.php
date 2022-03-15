<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationSubServicesTranslate extends Model
{
    use HasFactory;
    protected $table = 'education_sub_services_translates';
    protected $fillable = [
        'title',
        'edu_sub_services_id',
        'lang_id'
    ];

    public function education_sub_services(){
        return $this->belongsTo('App\Models\EducationSubServices', 'edu_sub_services_id');
    }
}
