<?php

namespace App\Orchid\Layouts\Page;

use App\Orchid\Fields\PageBlocksEditor;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Facades\Layout;

class PageCreateLayout extends Rows
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
            Input::make('page.url')
                ->title('Ссылка страницы в адресе')
                ->help('Можно оставить поле пустым. По умолчанию транслитерация названия в меню'),

            Input::make('page.menu_title')
                ->title('Название в меню'),

            Input::make('page.title')
                ->title('Заголовок страницы'),

            TextArea::make('page.description')
                ->title('Описание страницы')
                ->help('Будет отображено под заголовком на странице'),

            Checkbox::make('page.active')
                ->disabled()
                ->title('Отображение')
                ->placeholder('Страница опубликована')
                ->help('Нажмите опубликовать для выборки. Если убрать галочку, страница будет убрана из меню, а пользователю,
                перешедшему на неё, будет выдаваться 404 ошибка.'),
        ];
    }
}
