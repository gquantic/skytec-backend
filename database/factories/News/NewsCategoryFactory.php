<?php

namespace Database\Factories\News;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsCategoryFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->country() . ' ' . $this->faker->city() . ' ' . $this->faker->colorName();

        return [
            'slug' => Str::slug($title),
            'title' => $title,
            'description' => $this->faker->text(),
        ];
    }
}
