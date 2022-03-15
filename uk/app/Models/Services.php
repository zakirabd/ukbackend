<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $fillable = [
        'image',
        
    ];

    public function translate(){
        return $this->hasOne('App\Models\ServicesTranslate', 'services_id');
    }
}
