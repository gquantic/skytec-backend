<?php

namespace Database\Factories\News;

use App\Models\News\News;
use App\Models\News\NewsCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition(): array
    {
        $title = $this->faker->colorName . ' ' . $this->faker->word . ' ' . $this->faker->title;

        return [
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'news_category_id' => NewsCategory::query()->inRandomOrder()->first()->id,
            'slug' => Str::slug($title) . '_' . rand(9999, 999999),
            'title' => $title,
            'content' => $this->faker->paragraph(),
            'active' => rand(0, 1),
            'moderated' => rand(0, 1),
        ];
    }
}
