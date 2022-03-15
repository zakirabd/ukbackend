<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutTranslate extends Model
{
    use HasFactory;
    protected $table = 'about_translates';
    protected $fillable = [
        'description',
        'about_id',
        'lang_id'
    ];

    public function about(){
        return $this->belongsTo('App\Models\About', 'about_id');
    }
}
