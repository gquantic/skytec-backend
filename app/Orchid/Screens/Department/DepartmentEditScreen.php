<?php

namespace App\Orchid\Screens\Department;

use App\Models\Department;
use App\Models\User;
use App\Orchid\Layouts\Department\DepartmentEditLayout;
use App\Orchid\Layouts\Department\DepartmentMoreLayout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class DepartmentEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Department $department): iterable
    {
        return [
            'department' => $department,
            'head' => $department->head,
            'users' => $department->users,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Редактирование подразделения';
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
            Layout::columns([
                DepartmentMoreLayout::class,
                DepartmentEditLayout::class,
            ]),
        ];
    }

    public function unlinkUser(User $user)
    {
        dd($user);
    }
}
