<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;
    protected $table = 'teams';
    protected $fillable = [
        'image',
    ];
    protected $hidden = ['image'];
    protected $appends = ['image_full_url'];

    public function getImageFullUrlAttribute()
    {
        if ($this->image) {
            return asset("/storage/uploads/{$this->image}");
        } else {
            return null;
        }
    }

    public function translate(){
        return $this->hasOne('App\Models\TeamsTranslate', 'teams_id');
    }
}
