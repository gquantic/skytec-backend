<?php

namespace App\Http\Controllers\Api\Content;

use App\Http\Controllers\Controller;
use App\Models\Page\Page;
use App\Services\ApiService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return ApiService::jsonResponse(
            Page::query()->where('active', true)->select(['id', 'title', 'menu_title', 'uri'])->get()
        );
    }

    public function show(Page $page)
    {
        return ApiService::jsonResponse(
            $page
        );
    }
}
