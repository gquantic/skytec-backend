<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use JoyPixels\Ruleset;
use Overtrue\LaravelEmoji\Emoji;
use PHPHtmlParser\Dom;

class FileService
{
    public function uploadFile(UploadedFile $file)
    {
        $fileName = Str::slug(
                pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
            , '_', 'ru')  . '_' . Carbon::now()->format('Y') . '_' . rand(9, 99) . '.' . $file->extension();

        $file->storeAs('public/files/'. $fileName);

        return Storage::disk('public')->url('files/'. $fileName);
    }
}
