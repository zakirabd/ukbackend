<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationLabelTranslate extends Model
{
    use HasFactory;
    protected $table = 'education_label_translates';
    protected $fillable = [
        'title',
        'edu_label_id',
        'lang_id'
    ];

    public function education_label(){
        return $this->belongsTo('App\Models\EducationLabel', 'edu_label_id');
    }
}
