<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    protected $fillable = [
        'product_id', 'query', 'source', 'results_count',
        'downloaded_count', 'response_data',
    ];

    protected $casts = [
        'response_data' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
