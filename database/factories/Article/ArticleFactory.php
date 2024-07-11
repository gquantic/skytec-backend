<?php

namespace Database\Factories\Article;

use App\Models\Article\ArticleCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'article_category_id' => ArticleCategory::query()->inRandomOrder()->first()->id,
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'views' => rand(0, 1000),
            'title' => $this->faker->sentence(),
            'content' => $this->faker->randomHtml,
            'active' => rand(0, 1),
            'moderated' => rand(0, 1),
        ];
    }
}
