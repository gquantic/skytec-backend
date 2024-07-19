<?php

namespace App\Orchid\Layouts\Article;

use App\Models\Article\Article;
use App\Services\Admin\FormInterfaceService;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ArticleListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'articles';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('articles.id', 'ID')
                ->render(function (Article $article) {
                    return $article->id;
                }),

            TD::make('articles.title', 'Title')
                ->render(function (Article $article) {
                    return Link::make($article->title)
                            ->route('platform.articles.edit', $article->id);
                }),

            TD::make('articles.active', 'Active')
                ->render(function (Article $article) {
                    return FormInterfaceService::checkIcon($article->active);
                }),

            TD::make('articles.moderated', 'Moderated')
                ->render(function (Article $article) {
                    return FormInterfaceService::checkModeratedIcon($article->moderated);
                }),
        ];
    }
}
