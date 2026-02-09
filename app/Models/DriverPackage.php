<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DriverPackage extends Model
{
    protected $fillable = [
        'driver_id',
        'package_id',
        'amount',
        'start_date',
        'end_date',
        'description',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function getRemainingDaysAttribute()
    {
        if ($this->status === 'expired' || $this->end_date->isPast()) {
            return 'Expired';
        }
        
        $now = Carbon::now()->startOfDay();
        $end = $this->end_date->startOfDay();
        
        if ($now->gt($end)) {
            return 'Expired';
        }
        
        return $now->diffInDays($end) . ' days remaining';
    }
}
