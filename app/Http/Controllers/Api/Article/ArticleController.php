<?php

namespace App\Http\Controllers\Api\Article;

use App\Exceptions\BaseException;
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
            $article = Article::query()->create(array_merge(
                $request->all(),
                [
                    'user_id' => Auth::id()
                ]
            ));

            return ApiService::jsonResponse($article);
        } catch (BaseException $exception) {
            return ApiService::jsonResponse($exception->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($article)
    {
        return Article::query()->with('user')->where('id', $article)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        if ($article->user_id === $request->user()->id) {
            $article->update($request->all());
        }

        $article->updateViews(Auth::id());
        $article->save();

        return $article;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return ApiService::jsonResponse('Статья удалена.');
    }
}
