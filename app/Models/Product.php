<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Number;

class Product extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    public function getPriceFormattedAttribute()
    {
        return Number::currency($this->attributes['price']);
    }

    public function scopeFilter($query, array $filters)
    {
        $search      = $filters['search'] ?? false;
        $category_id = $filters['category_id'] ?? false;

        $query->when($search, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query
                    ->whereLike('name', "%$search%")
                    ->orWhereLike('price', "%$search%");
            });
        });

        $query->when($category_id, function ($query, $category_id) {
            $query->where('category_id', $category_id);
        });
    }

    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
