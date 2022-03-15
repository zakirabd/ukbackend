<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationServicesTranslate extends Model
{
    use HasFactory;
    protected $table = 'education_services_translates';
    protected $fillable = [
        'title',
        'description',
        'education_services_id',
        'lang_id'
    ];

    public function education_services(){
        return $this->belongsTo('App\Models\EducationServices', 'education_services_id');
    }
}
