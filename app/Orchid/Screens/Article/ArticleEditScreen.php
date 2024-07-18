<?php

namespace App\Orchid\Screens\Article;

use App\Models\Article\Article;
use App\Orchid\Layouts\Article\ArticleEditLayout;
use \Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class ArticleEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Article $article): iterable
    {
        return [
            'article' => $article
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Редактирование статьи';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Сохранить')
                ->icon('check')
                ->method('saveArticle')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ArticleEditLayout::class,
        ];
    }

    public function saveArticle(Request $request, Article $article)
    {
        $article->update(
            $request->collect('article')
                ->except('id', 'created_at', 'updated_at')
                ->toArray()
        );
        Toast::success('Статья сохранена');
        return redirect()->route('platform.articles.list');
    }
}
