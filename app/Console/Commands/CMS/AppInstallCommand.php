<?php

namespace App\Console\Commands\CMS;

use App\CMS\Services\AppInstallService;
use Illuminate\Console\Command;

class AppInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Собирает все необходимое при первом запуске.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (new AppInstallService())->init();
    }
}
