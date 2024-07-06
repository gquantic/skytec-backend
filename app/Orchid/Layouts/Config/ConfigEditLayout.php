<?php

namespace App\Orchid\Layouts\Config;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class ConfigEditLayout extends Rows
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
            Input::make('config.title')
                ->title('Название'),

            Input::make('config.name')
                ->title('Уникальный ID (для разработчика)')
                ->help('Не рекомендуется менять!'),

            Input::make('config.value')
                ->title('Значение'),
        ];
    }
}
