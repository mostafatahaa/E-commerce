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

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at', 'image'
    ];

    protected $appends = [
        'image_url'
    ];

    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope());

        static::creating(function (Product $product) {
            $product->slug = Str::slug($product->name);
        });
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

    public function scopeFilter(Builder $builder, $filters)
    {
        $options = array_merge([
            'store_id'      => null,
            'category_id'   => null,
            'tag_id'          => null,
            'status'        => 'active'
        ], $filters);

        $builder->when($options['status'], function ($builder, $status) {
            $builder->where('status', '=', $status);
        });

        $builder->when($options['store_id'], function ($builder, $value) {
            $builder->where('store_id', '=', $value);
        });

        $builder->when($options['category_id'], function ($builder, $value) {
            $builder->where('category_id', '=', $value);
        });

        $builder->when($options['tag_id'], function ($builder, $value) {

            $builder->whereExists(function ($query) use ($value) {
                $query->select(1)
                    ->from('product_tag')
                    ->whereRaw('product_id = products.id')
                    ->where('id', $value);
            });

            // $builder->whereHas('tags', function ($builder) use ($value) {
            //     $builder->whereIn('id', $value);
            // });

            // $builder->whereRaw('id IN (SELECT product_id FROM product_tag WHERE tag_id = ?)', [$value]);

        });
    }
}
