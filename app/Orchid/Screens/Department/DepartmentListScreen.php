<?php

namespace App\Orchid\Screens\Department;

use App\Models\Department;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class DepartmentListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'departments' => Department::all()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'DepartmentListScreen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('departments', [
                TD::make('department.id', '#')
                    ->render(fn (Department $department) => $department->id),

                TD::make('department.title', 'Название')
                    ->render(fn (Department $department) => $department->title),

                TD::make('department.description', 'Описание')
                    ->render(fn (Department $department) => $department->description)
                    ->width(300),

                TD::make('department.head_id', 'Руководитель')
                    ->render(function (Department $department) {
                        if ($department->head != null) {
                            return Link::make($department->head->name)
                                    ->target('_blank')
                                    ->route('platform.systems.users.edit', $department->head_id);
                        } else return 'Нет руководителя';
                    }),

                TD::make('department.edit', '')
                    ->render(function (Department $department) {
                        return Link::make('Редактировать')
                            ->target('_blank')
                            ->route('platform.departments.edit', $department->id);
                    }),
            ])
        ];
    }
}
