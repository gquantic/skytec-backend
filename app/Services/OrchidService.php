<?php

namespace App\Services;

use Illuminate\Http\Request;

class OrchidService
{
    public static function getFilter(Request $request, string $filterName): string|bool
    {
        if ($request->has('filter') && isset($request->get('filter')[$filterName])) {
            return $request->get('filter')[$filterName];
        } else return false;
    }
}
