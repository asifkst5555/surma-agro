<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'career_id', 'name', 'email', 'phone',
        'cover_letter', 'resume',
    ];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}
