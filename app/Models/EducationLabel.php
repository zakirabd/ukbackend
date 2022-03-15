<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationLabel extends Model
{
    use HasFactory;
    protected $table = 'education_labels';
    protected $fillable = [
        'edu_sub_services_id'
    ];

    public function translate(){
        return $this->hasOne('App\Models\EducationLabelTranslate', 'edu_label_id');
    }
}
