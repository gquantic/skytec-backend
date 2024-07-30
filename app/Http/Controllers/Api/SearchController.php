<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article\Article;
use App\Models\News\News;
use App\Models\Page\Page;
use App\Models\User;
use App\Services\ApiService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        return ApiService::jsonResponse([
            'users' => $this->searchUser($request),
            'news' => $this->searchNews($request),
            'articles' => $this->searchArticles($request),
            'pages' => $this->searchPages($request),
        ]);
    }

    public function searchUser(Request $request)
    {
        $search = $request->get('search');
        $search = explode(' ', $search);

        $users = User::query()->with(['manager', 'department']);

        if (count($search) > 2) {
            $users->where('surname', 'like', "{$search[0]}%")
                ->where('firstname', 'like', "{$search[1]}%")
                ->where('lastname', 'like', "{$search[2]}%")
                ->orWhere('phone', $request->get('search'))
                ->orWhere('email', $request->get('search'));
        } else {
            $users->where('firstname', 'like', "{$search[0]}%")
                ->orWhere('lastname', 'like', "{$search[0]}%")
                ->orWhere('surname', 'like', "{$search[0]}%")
                ->orWhere('phone', $request->get('search'))
                ->orWhere('email', $request->get('search'));
        }

        return $users->get();
    }

    public function searchNews(Request $request)
    {
        return News::query()
            ->active()
            ->where('title', 'like', "{$request->get('search')}%")
            ->get();
    }

    public function searchArticles(Request $request)
    {
        return Article::query()
            ->with(['user'])
            ->where('title', 'like', "{$request->get('search')}%")
            ->get();
    }

    public function searchPages(Request $request)
    {
        return Page::query()
            ->whereAny(['title', 'menu_title'], 'like', "{$request->get('search')}%")
            ->get();
    }
}
