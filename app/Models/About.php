<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $table = 'abouts';
    protected $fillable = [
        'id'
    ];

    public function translate(){
        return $this->hasOne('App\Models\AboutTranslate', 'about_id');
    }
}
