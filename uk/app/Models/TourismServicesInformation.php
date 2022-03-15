<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourismServicesInformation extends Model
{
    use HasFactory;
    protected $table = 'tourism_services_information';
    protected $fillable = [
        'services_id',
        'email',
        'departure_time',
        'turn_time',
        'first_name',
        'last_name',
        'phone_number',
        'where_from',
        'where_to',
        'description',
    ];

    public function tourism_user_services(){
        return $this->belongsToMany("App\Models\TourismServicesInformation", "tourism_user_services", "user_tourism_id", "services_id");
    }

    // / $exam->subsection()->attach(explode(',', $request->subsections));
    // $exam->subsection()->sync(explode(',', $request->subsections));

}
