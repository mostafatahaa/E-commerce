<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'compare_price',
        'status', 'category_id', 'store_id', 'image'
    ];

    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope());
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,     // trelated Model
            'product_tag',  // pivot tabel name
            'product_id',   // Foreign key in pivot tabel for the current model
            'tag_id',       // Foreign key in pivote tabel for the related model
            'id',           // Primary key for current model
            'id'            // Primary key for related model
        );
    }

    protected static function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    // Accessors method
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return "https://static.hertz-audio.com/media/2021/05/no-product-image.png";
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }

    // Accessors method
    public function getSalePercentAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }

        return number_format(100 - (100 * $this->price / $this->compare_price), 2);
    }
}
