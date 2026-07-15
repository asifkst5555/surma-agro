<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageDownload extends Model
{
    protected $fillable = [
        'product_id', 'search_query', 'source', 'original_url',
        'local_path', 'status', 'error_message', 'response_data',
    ];

    protected $casts = [
        'response_data' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
