<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'company', 'country',
        'product_id', 'message', 'type', 'is_read', 'is_replied',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_replied' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
