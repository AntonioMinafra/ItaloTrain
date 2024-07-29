<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Train extends Model
{

    protected $fillable = [
        'TrainNumber',
        'DepartureStationDescription',
        'DepartureDate',
        'ArrivalStationDescription',
        'ArrivalDate'
    ];

    use HasFactory;

}
