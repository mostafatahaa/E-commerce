<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'image', 'status', 'slug', 'parent_id'
    ];

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
            'image'         => 'image|max:1048576|dimensions:min_width=100,min_height=100',
            'status'        => 'in:active,archived'
        ];
    }
}
