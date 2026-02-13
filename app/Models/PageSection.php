<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = [
        'page_id',
        'section_type_id',
        'position',
        'is_visible',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
        'is_visible' => 'boolean',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function type()
    {
        return $this->belongsTo(SectionType::class, 'section_type_id');
    }
}
