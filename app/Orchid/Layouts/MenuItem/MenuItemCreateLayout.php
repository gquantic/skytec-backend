<?php

namespace App\Orchid\Layouts\MenuItem;

use App\Models\Page\Page;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class MenuItemCreateLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('item.title')
                ->title('Название ссылки'),

            Select::make('item.page_id')
                ->title('Страница')
                ->help('Если указана страница, указанная ниже прямая ссылка не будет работать')
                ->options([
                        null => '→ Прямая ссылка'
                    ] + Page::all()->pluck('title', 'id')->toArray()),

            Input::make('item.url')
                ->title('Ссылка')
                ->help('❗ Обязательно добавьте префикс http, если это прямая ссылка ❗ <br> Если выбрана страница, поле будет замещено автоматом'),

            Select::make('item.top_menu')
                ->title('Показывать в верхнем меню')
                ->options([
                    '1' => '✔ Да', '0' => '❌ Нет'
                ]),

            Input::make('item.sort_top')
                ->type('number')
                ->title('Сортировка в верхнем меню')
                ->help('Чем больше цифра, тем левее ссылка в меню'),

            Select::make('item.left_menu')
                ->title('Показывать в левом меню')
                ->options([
                    '1' => '✔ Да', '0' => '❌ Нет'
                ]),

            Input::make('item.sort_left')
                ->type('number')
                ->title('Сортировка в левом меню')
                ->help('Чем больше цифра, тем выше ссылка в меню'),
        ];
    }
}
