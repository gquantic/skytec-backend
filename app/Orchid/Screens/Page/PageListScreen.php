<?php

namespace App\Orchid\Screens\Page;

use App\Models\Page\Page;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class PageListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'pages' => Page::paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Страницы';
    }

    public function description(): ?string
    {
        return 'Все активные страницы будут отображены в левом меню';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Добавить страницу')
                ->icon('plus')
                ->route('platform.pages.create')
                ->target('_blank')
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
            Layout::table('pages', [
                TD::make('page.title', 'Ссылка')
                    ->render(fn (Page $page) => $page->uri),

                TD::make('page.menu_title', 'Название в меню')
                    ->render(fn (Page $page) => $page->menu_title),

                TD::make('page.title', 'Заголовок')
                    ->render(fn (Page $page) => $page->title),

                TD::make('page.description', 'Описание')
                    ->render(fn (Page $page) => $page->description),

                TD::make('page.edit', 'Редактирование')
                    ->render(function (Page $page) {
                        return Link::make('Редактировать')
                            ->route('platform.pages.edit', $page->id)
                            ->target('_blank');
                    }),
            ]),
        ];
    }
}
