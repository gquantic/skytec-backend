<?php

namespace App\Services;

use App\Models\Attachment;
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

    public function reUploadOrchidFile($fileName, $file)
    {
        $file = Attachment::query()->find($file[0]);
        $newFileName = $file->path . rand(999, 99999) . '_' . Str::slug($file->original_name, '_') . '.' . $file->extension;

        Storage::disk($file->disk)->move(
            $file->path . $file->name . '.' . $file->extension,
            $newFileName
        );

        $file->delete();

        return $newFileName;
    }
}
