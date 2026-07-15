<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'short_description', 'description',
        'origin', 'moq', 'packaging', 'export_capacity', 'shipment_details',
        'shelf_life', 'specifications', 'featured_image', 'gallery',
        'is_featured', 'is_active',
    ];

    protected $casts = [
        'specifications' => 'array',
        'gallery' => 'array',
        'moq' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getFeaturedImageAttribute($value)
    {
        if ($value) return $value;

        $primary = $this->primaryImage;
        if ($primary && $primary->image_path) {
            return Storage::url($primary->image_path);
        }

        $first = $this->images()->first();
        if ($first && $first->image_path) {
            return Storage::url($first->image_path);
        }

        return null;
    }

    public function getThumbUrlAttribute()
    {
        $primary = $this->primaryImage;
        if ($primary && $primary->thumbnail_path) {
            return Storage::url($primary->thumbnail_path);
        }

        $first = $this->images()->first();
        if ($first && $first->thumbnail_path) {
            return Storage::url($first->thumbnail_path);
        }

        return null;
    }

    public function getImageGalleryAttribute()
    {
        return $this->images()->where('is_active', true)->get()->map(function ($img) {
            return [
                'url' => Storage::url($img->image_path),
                'thumb' => Storage::url($img->thumbnail_path ?? $img->image_path),
                'alt' => $img->alt_text ?: $this->name,
                'id' => $img->id,
                'is_primary' => $img->is_primary,
            ];
        });
    }
}
