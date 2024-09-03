<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class UserService
{
    /**
     * Удалить пользователей, которых нет в ldap
     * @return void
     */
    public function clearUsers()
    {
        $inactiveUsers = User::query()
            ->where(
                'updated_at',
                '<',
                Carbon::now()->subMinutes(25)->format('Y-m-d H:i:s')
            )
            ->get();

        foreach ($inactiveUsers as $user) {
            if ($user->login != 'admin' && $user->login != 'test') {
                echo "{$user->id} \n\n";
                $this->unpinUserFromManager($user);
                $user->delete();
            }
        }
    }

    public function unpinUserFromManager(User $user)
    {
        foreach (User::query()->where('manager_id', $user->id) as $user) {
            $user->manager_id = null;
            $user->save();
        }
    }
}
