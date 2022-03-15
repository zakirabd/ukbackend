<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamsTranslate extends Model
{
    use HasFactory;
    protected $table = 'teams_translates';
    protected $fillable = [
        'name',
        'position',
        'teams_id',
        'lang_id'
        
    ];

    public function teams(){
        return $this->belongsTo('App\Models\Teams', 'teams_id');
    }
}
