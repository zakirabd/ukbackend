<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLabel extends Model
{
    use HasFactory;
    protected $table = 'news_labels';
    protected $fillable = [
        'label',
        'news_id'
        
    ];

    public function news(){
        return $this->belongsTo('App\Models\News', 'news_id');
    }
}
