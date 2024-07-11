<?php

namespace App\Http\Controllers\Api\Content;

use App\Exceptions\BaseException;
use App\Http\Controllers\Controller;
use App\Models\News\News;
use App\Models\News\NewsReaction;
use App\Repositories\Content\NewsRepository;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    protected NewsRepository $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->newsRepository->all()->with(['category' => function ($query) {
            $query->select('id', 'title');
        }, 'user' => function ($query) {
            $query->select('id', 'avatar', 'firstname', 'lastname', 'surname');
        }])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return News::query()
            ->orderByDesc('created_at')
            ->with(['category', 'user', 'comments' => function ($query) {
                $query->orderByDesc('created_at');
            }, 'comments.user'])
            ->where('id', $id)
            ->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        try {
            if ($news->user_id === $request->user()->id) {
                $news->update($request->all());
            }

            $news->updateViews(Auth::id());
            $news->save();
        } catch (BaseException $exception) {
            return ApiService::jsonResponse($exception->getMessage());
        }

        return $news;
    }

    public function insertReaction(Request $request): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        $data = $request->validate([
            'news_id' => 'required|exists:news,id',
            'emoji_id' => 'required|exists:emoji,id',
        ]);

        $alreadyReacted = NewsReaction::query()->where('user_id', Auth::id());

        // Удаляем старые реакции на эту новость
        NewsReaction::query()
            ->where('user_id', Auth::id())
            ->where('news_id', $data['news_id'])
            ->delete();

        NewsReaction::query()->create([
            'news_id' => $request->post('news_id'),
            'user_id' => Auth::id(),
            'emoji_id' => $request->post('emoji_id'),
        ]);

        return News::query()->find($request->post('news_id'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
