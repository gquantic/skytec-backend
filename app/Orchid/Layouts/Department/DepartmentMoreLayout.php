<?php

namespace App\Orchid\Layouts\Department;

use App\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class DepartmentMoreLayout extends Table
{
    protected $title = 'Сотрудники подразделения';

    protected $target = 'users';

    protected function columns(): iterable
    {
        return [
            TD::make('name', 'ФИО')
                ->render(function (User $user) {
                    return $user->name;
                }),

            TD::make('remove', '')
                ->render(function (User $user) {
                    return Button::make('Отвязать от отдела')
                        ->icon('minus')
                        ->method('unlinkUser', ['user' => $user])
                        ->confirm("Пользователь будет отвязан от отдела и руководителя. Вы уверены?");
                })
        ];
    }
}
