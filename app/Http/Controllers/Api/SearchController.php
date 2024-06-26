<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchUser(Request $request)
    {
        $search = $request->get('fullname');
        $search = explode(' ', $search);

        $users = User::query()->with(['manager' => function ($query) {
            $query->select('id', 'firstname', 'lastname', 'surname');
        }, 'department']);

        if (count($search) > 2) {
            $users->where('surname', 'like', "{$search[0]}%")
                ->where('firstname', 'like', "{$search[1]}%")
                ->where('lastname', 'like', "{$search[2]}%");
        } else {
            $users->where('firstname', 'like', "{$search[0]}%")
                ->orWhere('lastname', 'like', "{$search[0]}%")
                ->orWhere('surname', 'like', "{$search[0]}%");
        }

        return $users->get();
    }
}
