<?php

namespace App\Console\Commands\File;

use App\Models\Attachment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RenameUploadedFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'files:rename';

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
        $attachments = Attachment::all();

        foreach ($attachments as $attachment) {
//            dd($attachment->path . $attachment->name . '.' . $attachment->extension);
            $newName = $attachment->path . "{$attachment->id}_" . $attachment->original_name;

            if (Storage::disk('public')->exists($attachment->path . $attachment->name . '.' . $attachment->extension)) {
                Storage::disk('public')->move(
                    $attachment->path . $attachment->name . '.' . $attachment->extension,
                    $newName,
                );
            } else {
                Storage::disk('public')->move(
                    $attachment->path . $attachment->name,
                    $newName,
                );
            }

            $attachment->name = "{$attachment->id}_" . $attachment->original_name;
            $attachment->save();
        }
    }
}
