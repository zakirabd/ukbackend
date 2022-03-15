<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourismServicesTranslate extends Model
{
    use HasFactory;
    protected $table = 'tourism_services_translates';
    protected $fillable = [
        'name',
        'tourism_services_id',
        'lang_id'
        
    ];

    public function tourism_services(){
        return $this->belongsTo('App\Models\TourismServices', 'tourism_services_id');
    }
}
