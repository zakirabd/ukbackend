<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contact';
    protected $fillable = [
        'id',
        'address',
        'phone',
        'email',
        'office_hour',
        'instagram',
        'linkedin',
        'facebook',
        'copy_right'
    ];

  
}
