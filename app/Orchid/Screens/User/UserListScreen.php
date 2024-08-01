<?php

declare(strict_types=1);

namespace App\Orchid\Screens\User;

use App\Orchid\Layouts\User\UserEditLayout;
use App\Orchid\Layouts\User\UserFiltersLayout;
use App\Orchid\Layouts\User\UserListLayout;
use App\Services\OrchidService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class UserListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Request $request): iterable
    {
        $users = \App\Models\User::query()
            ->with('roles');

        if ($email = OrchidService::getFilter($request, 'email')) {
            $users->where('email', $email);
        }

        if ($login = OrchidService::getFilter($request, 'login')) {
            $users->where('login', $login);
        }

        if ($name = OrchidService::getFilter($request, 'name')) {
            $users->where('firstname', 'like', "%$name%")
                ->orWhere('lastname', 'like', "%$name%")
                ->orWhere('surname', 'like', "%$name%");
        }

        return [
            'users' => $users->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Управление пользователями';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Отображены все пользователи, их роли и привелегии.';
    }

    public function permission(): ?iterable
    {
        return [
            'platform.systems.users',
        ];
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Новый пользователь'))
                ->icon('bs.plus-circle')
                ->route('platform.systems.users.create'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            UserFiltersLayout::class,
            UserListLayout::class,

//            Layout::modal('asyncEditUserModal', UserEditLayout::class)
//                ->async('asyncGetUser'),
        ];
    }

    /**
     * @return array
     */
    public function asyncGetUser(User $user): iterable
    {
        return [
            'user' => $user,
        ];
    }

    public function saveUser(Request $request, User $user): void
    {
        $request->validate([
            'user.email' => [
                'required',
                Rule::unique(User::class, 'email')->ignore($user),
            ],
        ]);

        $user->fill($request->input('user'))->save();

        Toast::info(__('Пользователь сохранен.'));
    }

    public function remove(Request $request): void
    {
        User::findOrFail($request->get('id'))->delete();

        Toast::info(__('Пользователь удален'));
    }
}
