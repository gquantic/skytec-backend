<?php

namespace App\Repositories;

use App\Models\Applications\BusinessTripApplication;
use App\Models\Applications\EducationApplication;
use App\Models\Applications\VacationApplication;
use Illuminate\Support\Facades\Auth;

class ApplicationsRepository
{
    public function getAllApplications(): array
    {
        // Получаем все заявки
        $applications = array_merge(
            $this->getVacationApplications(),
            $this->getBusinessTripApplications(),
            $this->getEducationApplications(),
        );

        // Сортировка по полю created_at
        usort($applications, function ($a, $b) {
            return strtotime($b['created_at']) <=> strtotime($a['created_at']);
        });

        return $applications;
    }

    public function getVacationApplications(): array
    {
        return VacationApplication::query()->where('user_id', Auth::id())->orderByDesc('created_at')->limit(10)->get()->toArray();
    }

    public function getBusinessTripApplications(): array
    {
        return BusinessTripApplication::query()->where('user_id', Auth::id())->orderByDesc('created_at')->limit(10)->get()->toArray();
    }

    public function getEducationApplications(): array
    {
        return EducationApplication::query()->where('user_id', Auth::id())->orderByDesc('created_at')->limit(10)->get()->toArray();
    }
}
