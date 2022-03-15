<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainPageTranslate extends Model
{
    use HasFactory;
    protected $table = 'main_page_translate';
    protected $fillable = [
        'title',
        'lang_id'
    ];

    public function main_page (){
        return $this->belongsTo('App\Models\MainPage');
    }
}
