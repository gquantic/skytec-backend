<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserBirthdayService extends BaseService
{
    public function getUpcomingBirthdays()
    {
        $now = Carbon::now();
        $today = $now->format('Y-m-d');

        $users = User::query()
            ->whereNotNull('birthdate')
            ->select('*', DB::raw("
            CASE
                WHEN DATE_FORMAT(birthdate, '%m-%d') >= DATE_FORMAT(NOW(), '%m-%d') THEN
                    STR_TO_DATE(CONCAT(YEAR(NOW()), '-', DATE_FORMAT(birthdate, '%m-%d')), '%Y-%m-%d')
                ELSE
                    STR_TO_DATE(CONCAT(YEAR(NOW()) + 1, '-', DATE_FORMAT(birthdate, '%m-%d')), '%Y-%m-%d')
            END as next_birthday
        "))
            ->orderBy('next_birthday')
            ->limit(30)
            ->get();

        return $users;
    }
}
