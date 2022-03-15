<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnersTranslate extends Model
{
    use HasFactory;
    protected $table = 'partners_translates';
    protected $fillable = [
        'name',
        'partners_id',
        'lang_id'
        
    ];

    public function partners(){
        return $this->belongsTo('App\Models\Partners', 'partners_id');
    }
}
