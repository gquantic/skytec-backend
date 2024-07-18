<?php

namespace App\Orchid\Layouts\News;

use App\Models\News\NewsCategory;
use App\Models\User;
use App\Orchid\Fields\CkeEditor;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class NewsEditLayout extends Rows
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
            Input::make('news.title')
                ->title('Заголовок'),

            CkeEditor::make('news.content')
                ->title('Контент')
                ->id('Контент'),

            Select::make('news.news_category_id')
                ->title('Категория')
                ->fromModel(NewsCategory::class, 'title', 'id'),

            Select::make('news.user_id')
                ->title('Автор')
                ->fromQuery(User::query(), 'name', 'id'),

            Select::make('news.active')
                ->title('Активность')
                ->options([
                    0 => 'Скрыть',
                    1 => 'Показывать',
                ]),

            Select::make('news.moderated')
                ->title('Модерация')
                ->options([
                    -1 => 'Отклонена',
                    0 => 'На рассмотрении',
                    1 => 'Одобрена',
                ]),
        ];
    }
}
