<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    protected $model = Department::class;

    public function definition(): array
    {
        $companies = ['СкайТек Медиа', 'Скай Альянс', 'ТЕКНОУЛОДЖИ', 'ПИНЬПАЙ'];

        return [
            'company' => $companies[rand(0,3)],
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
        ];
    }
}
