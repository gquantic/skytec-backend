<?php

namespace App\Orchid\Screens\News;

use App\Models\Article\Article;
use App\Models\News\News;
use App\Services\Admin\FormInterfaceService;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class NewsListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'news' => News::all()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Новости';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Добавить новость')
                ->icon('plus')
                ->route('platform.news.create'),
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
            Layout::table('news', [
                TD::make('#')
                    ->render(function (News $news) {
                        return $news->id;
                    }),

                TD::make('Название')
                    ->render(function (News $news) {
                        return Link::make($news->title)
                            ->route('platform.news.edit', $news);
                    }),

                TD::make('Статус')
                    ->render(function (News $news) {
                        return FormInterfaceService::checkIcon($news->active);
                    }),

                TD::make('Модерация')
                    ->render(function (News $news) {
                        return FormInterfaceService::checkModeratedIcon($news->moderated);
                    }),
            ])
        ];
    }
}
