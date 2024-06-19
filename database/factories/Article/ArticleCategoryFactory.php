<?php

namespace Database\Factories\Article;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleCategoryFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence();

        return [
            'title' => $title,
            'slug'  => Str::slug($title),
        ];
    }
}
