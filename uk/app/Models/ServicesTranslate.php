<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesTranslate extends Model
{
    use HasFactory;
    protected $table = 'services_translates';
    protected $fillable = [
        'title',
        'description',
        'services_id',
        'lang_id'
        
    ];

    public function service(){
        return $this->belongsTo('App\Models\Services', 'services_id');
    }
}
