<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'driver_code',
        'name',
        'email',
        'mobile',
        'address',
        'state_id',
        'city_id',
        'wallet_amount',
        'password',
        'verification_status',
        'status',
        'license_number',
        'latitude',
        'longitude',
        'is_online',
        'current_location_address'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'is_online' => 'boolean',
    ];

    public function documents()
    {
        return $this->hasOne(DriverDocument::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
