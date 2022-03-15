<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourismServices extends Model
{
    use HasFactory;
    protected $table = 'tourism_services';
    protected $fillable = [
        'id',
    ];

    public function translate(){
        return $this->hasOne('App\Models\TourismServicesTranslate', 'tourism_services_id');
    }
}
