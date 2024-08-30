<?php

namespace App\Listeners;

use App\Events\FileSystemUploaded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;

class UploadFileNames
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FileSystemUploaded $event): void
    {
        Artisan::call('files:rename');
    }
}
