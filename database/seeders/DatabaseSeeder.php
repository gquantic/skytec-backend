<?php

namespace Database\Seeders;

use App\Models\News\News;
use App\Models\News\NewsCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->count(100)->create();

        NewsCategory::factory()->count(100)->create();

        News::factory()->count(100)->create();

        foreach (User::query()->offset(5)->limit(1000)->get() as $user) {
            $user->manager_id = rand(1,5);
            $user->save();
        }
    }
}
