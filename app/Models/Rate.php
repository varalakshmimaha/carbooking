<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = [
        'vehicle_type_id',
        'default_rate',
        'round_trip_rate',
        'local_12_hours_rate',
        'local_8_hours_rate',
        'extra_km_charge',
        'daily_max_km',
        'night_driving_charge',
        'driver_allowance',
        'gear_type',
        'fuel_type',
        'steering',
        'capacity',
        'image',
        'terms_and_conditions',
        'inclusions',
        'exclusions',
        'status'
    ];

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }
}
