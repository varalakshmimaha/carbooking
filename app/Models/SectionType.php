<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionType extends Model
{
    protected $fillable = [
        'key',
        'name',
        'category',
        'icon',
        'description',
        'default_settings',
        'is_active',
    ];

    protected $casts = [
        'default_settings' => 'array',
        'is_active' => 'boolean',
    ];
}
