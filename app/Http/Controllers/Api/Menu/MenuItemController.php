<?php

namespace App\Http\Controllers\Api\Menu;

use App\Http\Controllers\Controller;
use App\Models\Menu\MenuItem;
use App\Services\ApiService;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function top()
    {
        return ApiService::jsonResponse(
            MenuItem::query()->where('top_menu', true)->orderByDesc('sort_top')->get()
        );
    }

    public function left()
    {
        return ApiService::jsonResponse(
            MenuItem::query()->where('left_menu', true)->orderByDesc('sort_left')->get()
        );
    }
}
