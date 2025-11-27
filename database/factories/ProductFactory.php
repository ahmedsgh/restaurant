<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = fake()->words(3, true);
        $description = fake()->sentence(10);

        return [
            'category_id' => Category::factory(),
            'name' => [
                'en' => ucfirst($name),
                'fr' => ucfirst($name),
                'ar' => ucfirst($name),
                'es' => ucfirst($name),
            ],
            'description' => [
                'en' => $description,
                'fr' => $description,
                'ar' => $description,
                'es' => $description,
            ],
            'price' => fake()->randomFloat(2, 5, 50),
            'image' => null,
            'is_active' => true,
        ];
    }
}
