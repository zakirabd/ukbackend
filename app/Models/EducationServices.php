<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationServices extends Model
{
    use HasFactory;
    protected $table = 'education_services';
    protected $fillable = [
        'id'
    ];

    public function translate(){
        return $this->hasOne('App\Models\EducationServicesTranslate', 'education_services_id');
    }
}
