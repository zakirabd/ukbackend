<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceServices extends Model
{
    use HasFactory;
    protected $table = 'insurance_services';
    protected $fillable = [
        'email',
        'country',
        'first_name',
        'last_name',
        'phone_number',
        'date',
        'date_of_birth',
        'description',
    ];
}
