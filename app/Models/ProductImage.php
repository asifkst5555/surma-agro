<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id', 'image_path', 'thumbnail_path', 'original_url',
        'source', 'ai_tags', 'alt_text', 'title', 'width', 'height',
        'file_size', 'mime_type', 'is_primary', 'is_active', 'type', 'metadata',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'is_active' => 'boolean',
        'metadata' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    public function getUrlAttribute()
    {
        return $this->image_path ? Storage::url($this->image_path) : null;
    }

    public function getThumbUrlAttribute()
    {
        return $this->thumbnail_path ? Storage::url($this->thumbnail_path) : $this->url;
    }
}
