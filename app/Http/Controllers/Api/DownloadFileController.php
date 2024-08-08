<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DownloadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DownloadFileController extends Controller
{
    public function download(DownloadFile $download)
    {
//        $file = File::get($downloadFile->);
//        $response = response()->make($file, 200);
//        $response->header('Content-Type', 'application/pdf');
        return $download;
    }
}
