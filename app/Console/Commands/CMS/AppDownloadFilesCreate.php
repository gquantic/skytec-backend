<?php

namespace App\Console\Commands\CMS;

use App\Models\DownloadFile;
use Illuminate\Console\Command;

class AppDownloadFilesCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:downloads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create download files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DownloadFile::query()->insert([
            [
                'slug' => 'welcome-book',
                'url' => 'welcome-book.pdf',
            ],
            [
                'slug' => 'instructions-android',
                'url' => 'instructions-android.pdf',
            ],
            [
                'slug' => 'instructions-ios',
                'url' => 'instructions-ios.pdf',
            ],
            [
                'slug' => 'instructions-booking',
                'url' => 'instructions-booking.pdf',
            ],
        ]);
    }
}
