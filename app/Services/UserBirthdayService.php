<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserBirthdayService extends BaseService
{
    public function getTodayBirthdays(): \Illuminate\Database\Eloquent\Collection|array
    {
        $now = Carbon::now();
        $today = $now->format('m-d');

        $users = User::query()
            ->whereNotNull('birthdate')
            ->whereRaw("DATE_FORMAT(birthdate, '%m-%d') = ?", [$today])
            ->get();

        return $users;
    }

    public function getUpcomingBirthdays()
    {
        $now = Carbon::now();
        $tomorrow = $now->copy()->addDay();
        $weekLater = $now->copy()->addWeek();

        $users = User::query()
            ->whereNotNull('birthdate')
            ->select('*', DB::raw("
            CASE
                WHEN DATE_FORMAT(birthdate, '%m-%d') >= DATE_FORMAT(NOW() + INTERVAL 1 DAY, '%m-%d')
                     AND DATE_FORMAT(birthdate, '%m-%d') <= DATE_FORMAT(NOW() + INTERVAL 7 DAY, '%m-%d') THEN
                    STR_TO_DATE(CONCAT(YEAR(NOW()), '-', DATE_FORMAT(birthdate, '%m-%d')), '%Y-%m-%d')
                WHEN DATE_FORMAT(birthdate, '%m-%d') < DATE_FORMAT(NOW() + INTERVAL 1 DAY, '%m-%d') THEN
                    STR_TO_DATE(CONCAT(YEAR(NOW()) + 1, '-', DATE_FORMAT(birthdate, '%m-%d')), '%Y-%m-%d')
                ELSE
                    NULL
            END as next_birthday
        "))
            ->havingRaw('next_birthday IS NOT NULL AND next_birthday >= NOW() + INTERVAL 1 DAY AND next_birthday <= NOW() + INTERVAL 7 DAY')
            ->orderBy('next_birthday')
            ->limit(30)
            ->get();

        return $users;
    }
}
