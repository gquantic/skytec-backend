<?php

namespace App\Http\Controllers\Api\Article;

use App\Http\Controllers\Controller;
use App\Models\Article\Article;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $articles = Article::query()->where('active', true)->orderByDesc('created_at')->with('user');

        if ($request->has('user_id')) {
            $articles->where('user_id', $request->get('user_id'));
        }

        return $articles->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Article::query()->create(array_merge(
                $request->all(),
                [
                    'user_id' => Auth::id()
                ]
            ));

            return ApiService::jsonResponse('Статья успешно создана.', 200);
        } catch (\Exception $exception) {
            return ApiService::jsonResponse('Неизвестная ошибка.', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return $article;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
