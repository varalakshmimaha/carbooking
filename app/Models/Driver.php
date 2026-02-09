<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Driver extends Model
{
    use HasFactory;

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
        'status', // fallback if needed
        'license_number'
    ];

    protected $hidden = [
        'password',
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
