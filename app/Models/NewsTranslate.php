<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsTranslate extends Model
{
    use HasFactory;
    protected $table = 'news_translate';
    protected $fillable = [
        'title',
        'description',
        'news_id',
        'label',
        'lang_id'
    ];

    public function news(){
        return $this->belongsTo('App\Models\News', 'news_id');
    }
    public function label(){
        return $this->hasMany("App\Models\NewsLabel", "news_id");
    }
}
