<?php

namespace App\Repositories\Content;

use App\Models\News\News;

class NewsRepository
{
    public function all()
    {
        return News::query()
            ->active()
            ->select(['id', 'views', 'news_category_id', 'user_id', 'title', 'content', 'created_at']);
    }
}
