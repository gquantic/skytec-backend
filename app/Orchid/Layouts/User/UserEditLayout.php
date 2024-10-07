<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Date;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\DateRange;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class UserEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Picture::make('user.avatar')
                ->storage('public'),

            Group::make([
                Input::make('user.firstname')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('Фамилия'))
                    ->placeholder(__('Фамилия')),

                Input::make('user.lastname')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('Имя'))
                    ->placeholder(__('Имя')),
            ]),

            Input::make('user.email')
                ->type('email')
                ->required()
                ->title(__('Email'))
                ->placeholder(__('Email')),

            Input::make('user.login')
                ->type('text')
                ->required()
                ->title(__('Логин'))
                ->placeholder(__('Логин')),

            Select::make('user.manager_id')
                ->title('Руководитель')
                ->fromQuery(User::query(), 'name', 'id'),

            Select::make('user.department_id')
                ->title('Подразделение')
                ->fromQuery(Department::query(), 'title', 'id'),

            Input::make('user.position')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Должность'))
                ->placeholder(__('Должность')),

            Input::make('user.phone')
                ->type('text')
                ->max(255)
                ->title(__('Телефон'))
                ->placeholder(__('Телефон')),

            DateTimer::make('user.employment_date')
                ->format('d.m.Y')
                ->title('Дата выхода'),

            DateTimer::make('user.birthdate')
                ->format('d.m.Y')
                ->title('Дата рождения'),

            CheckBox::make('user.hide_phone')
                ->placeholder('Скрыть телефон'),

            Select::make('user.is_director')
                ->title('Тип')
                ->options([
                    false => 'Сотрудник',
                    true => 'Директор',
                ]),

            Input::make('user.sort')
                ->type('number')
                ->max(255)
                ->title(__('Сортировка'))
                ->placeholder(__('0')),

            Select::make('user.company')
                ->options(config('structure.companies')),

            TextArea::make('user.description')
                ->title('Описание о пользователе')
                ->rows(4),
        ];
    }
}
