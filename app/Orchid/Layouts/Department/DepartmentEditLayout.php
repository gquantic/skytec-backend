<?php

namespace App\Orchid\Layouts\Department;

use App\Ldap\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class DepartmentEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title = 'Редактировать';

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('department.title')
                ->title('Название'),

            TextArea::make('department.description')
                ->rows(3)
                ->title('Описание'),

            Select::make('department.head_id')
                ->fromQuery(\App\Models\User::query(), 'name', 'id'),

            Button::make('Сохранить')
                ->method('save'),
        ];
    }
}
