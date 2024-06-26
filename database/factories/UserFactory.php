<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fullname = fake()->name();
        $name = explode(' ', $fullname);

        return [
            'avatar' => 'https://i.pravatar.cc/150?img=' . rand(1, 40),
            'manager_id' => User::query()->inRandomOrder()->first()->id ?? null,
            'department_id' => Department::query()->inRandomOrder()->first()->id ?? null,
            'phone' => $this->faker->phoneNumber(),
            'login' => Str::slug($fullname . '_' . Str::random(5), separator: '_'),
            'employment_date' => Carbon::now()->subDays(rand(10, 1000))->format('Y-m-d'),
            'firstname' => $name[0],
            'lastname' => $name[1],
            'surname' => $name[2],
            'birthdate' => $this->faker->date,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
