<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactsTranslate extends Model
{
    use HasFactory;
    protected $table = 'contacts_translates';
    protected $fillable = [
        'title',
        'description',
        'lang_id',
        'contact_id'
    ];

    public function contact(){
        return $this->belongsTo('App\Models\Contact', 'contact_id');
    }
}
