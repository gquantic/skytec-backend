<?php

namespace Database\Factories;

use App\Models\Education;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EducationFactory extends Factory
{
    protected $model = Education::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'dates' => [
                Carbon::now()->addDays(rand(1, 15))->format('d.m.Y H:i'),
                Carbon::now()->addDays(rand(1, 15))->format('d.m.Y H:i'),
                Carbon::now()->addDays(rand(1, 15))->format('d.m.Y H:i'),
                Carbon::now()->addDays(rand(1, 15))->format('d.m.Y H:i'),
                Carbon::now()->addDays(rand(1, 15))->format('d.m.Y H:i'),
            ],
            'active' => rand(0,1),
        ];
    }
}
