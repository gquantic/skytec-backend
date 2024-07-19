<?php

namespace App\Orchid\Layouts\Article;

use App\Models\Article\ArticleCategory;
use App\Models\User;
use App\Orchid\Fields\CkeEditor;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class ArticleEditLayout extends Rows
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
            Input::make('article.title')
                ->title('Заголовок'),

            CkeEditor::make('article.content')
                ->title('Контент')
                ->id('Контент'),

            Select::make('article.article_category_id')
                ->title('Категория')
                ->fromModel(ArticleCategory::class, 'title', 'id'),

            Select::make('article.user_id')
                ->title('Автор')
                ->fromQuery(User::query(), 'name', 'id'),

            Select::make('article.active')
                ->title('Активность')
                ->options([
                    0 => 'Скрыть',
                    1 => 'Показывать',
                ]),

            Select::make('article.moderated')
                ->title('Модерация')
                ->options([
                    -1 => 'Отклонена',
                    0 => 'На рассмотрении',
                    1 => 'Одобрена',
                ]),
        ];
    }
}
