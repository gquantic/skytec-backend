<?php

namespace Database\Seeders;

use App\Models\Article\Article;
use App\Models\Article\ArticleCategory;
use App\Models\Department;
use App\Models\Education;
use App\Models\News\News;
use App\Models\News\NewsCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Department::factory()->count(5)->create();

//        User::factory()->count(80)->create();

        Education::factory()->count(10)->create();

        User::query()->create([
            'avatar' => 'https://i.pravatar.cc/150?img=' . rand(1, 40),
            'manager_id' => User::query()->inRandomOrder()->first()->id ?? null,
            'department_id' => Department::query()->inRandomOrder()->first()->id ?? null,
            'phone' => '33333',
            'login' => 'test',
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'surname' => 'Отчество',
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

//        NewsCategory::factory()->count(100)->create();

//        News::factory()->count(100)->create();

//        ArticleCategory::factory()->count(10)->create();
//        Article::factory()->count(200)->create();

        foreach (User::query()->offset(5)->limit(1000)->get() as $user) {
            $user->manager_id = rand(1,5);
            $user->save();
        }
    }
}
