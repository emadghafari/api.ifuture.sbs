<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['slug', 'url', 'image_path', 'status', 'featured', 'sort_order'];

    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public function getTranslation(string $locale)
    {
        return $this->translations()->where('locale', $locale)->first();
    }
}
