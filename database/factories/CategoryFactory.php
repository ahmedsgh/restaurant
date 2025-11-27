<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = fake()->words(2, true);

        return [
            'name' => [
                'en' => ucfirst($name),
                'fr' => ucfirst($name),
                'ar' => ucfirst($name),
                'es' => ucfirst($name),
            ],
            'slug' => Str::slug($name),
            'image' => null,
            'is_active' => true,
        ];
    }
}
