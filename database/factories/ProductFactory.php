<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->words(6, true);
        return [
            'name'              => $name,
            'slug'              => Str::slug($name),
            'description'       => $this->faker->sentence(17),
            'image'             => $this->faker->imageUrl(600, 600),
            'price'             => $this->faker->randomFloat(1, 1, 666),
            'compare_price'     => $this->faker->randomFloat(1, 667, 1000),
            'category_id'       => Category::inRandomOrder()->first()->id,
            'featured'          => rand(0, 1),
            'store_id'          => Store::inRandomOrder()->first()->id,
        ];
    }
}
