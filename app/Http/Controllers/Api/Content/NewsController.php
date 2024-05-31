<?php

namespace App\Http\Controllers\Api\Content;

use App\Http\Controllers\Controller;
use App\Models\News\News;
use App\Repositories\Content\NewsRepository;
use Illuminate\Http\Request;

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
            $query->select('id', 'slug', 'title');
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
    public function show(string $slug)
    {
        return News::query()
            ->orderByDesc('created_at')
            ->with(['category', 'user', 'comments' => function ($query) {
                $query->orderByDesc('created_at');
            }, 'comments.user'])
            ->where('slug', $slug)
            ->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
