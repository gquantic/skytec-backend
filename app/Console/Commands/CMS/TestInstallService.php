<?php

namespace App\Console\Commands\CMS;

use App\Models\Article\Article;
use App\Models\Article\ArticleCategory;
use App\Models\Department;
use App\Models\News\News;
use App\Models\News\NewsCategory;
use App\Models\User;
use Illuminate\Console\Command;

class TestInstallService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Department::factory()->count(3)->create();
        User::factory()->count(30)->create();

        NewsCategory::factory()->count(5)->create();
        News::factory()->count(30)->create();


        ArticleCategory::factory()->count(30)->create();
        Article::factory()->count(30)->create();
    }
}
