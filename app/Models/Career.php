<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = [
        'title', 'slug', 'department', 'location', 'type',
        'short_description', 'description', 'requirements',
        'benefits', 'deadline', 'is_active',
    ];

    protected $casts = [
        'requirements' => 'array',
        'benefits' => 'array',
        'deadline' => 'date',
        'is_active' => 'boolean',
    ];

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
