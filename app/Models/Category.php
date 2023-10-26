<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'description', 'image', 'status', 'slug', 'parent_id'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')
            ->withDefault([
                'name' => '-'
            ]);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $builder->when($filters['name'] ?? false, function ($builder, $value) {

            $builder->where('categories.name', 'LIKE', "%{$value}%");
        });

        $builder->when($filters['status'] ?? false, function ($builder, $value) {

            $builder->where('categories.status', 'LIKE', $value);
        });
    }

    public static function rules($id = 0)
    {
        return [
            'name'          => [

                'required',
                'string',
                'min:3',
                'max:255',
                // or "unique:categoreis,name,$id",
                Rule::unique('categories', 'name')->ignore($id),
                'filter:php,laravel,admin',

                // new Filter(['MOstafa', 'admin', 'php']),
            ],
            'parent_id'     => ['nullable', 'int', 'exists:categories,id'],
            'image'         => 'image|max:20240 |dimensions:min_width=100,min_height=100', // max:20240kb = 20mb
            'status'        => 'in:active,archived'
        ];
    }
}
