<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'driver_photo',
        'aadhar_front',
        'aadhar_back',
        'dl_front',
        'dl_back',
        'health_certificate',
        'upi_qr_code'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
