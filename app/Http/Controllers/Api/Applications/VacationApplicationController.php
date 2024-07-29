<?php

namespace App\Http\Controllers\Api\Applications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Applications\VacationApplicationStoreRequest;
use App\Models\Applications\VacationApplication;
use App\Services\ApiService;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacationApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VacationApplicationStoreRequest $request)
    {
        try {
            $vacation = VacationApplication::query()->create(array_merge(
                $request->all(),
                [
                    'user_id' => Auth::id()
                ]
            ));

            MailService::sendForm('vacation_mail', 'Заявка на отпуск', [
                'Ф.И.О. сотрудника' => $vacation->user->name,
                'Причина' => $vacation->reason,
                'Тип отпуска' => $vacation->vacation_type,
                'Начало' => $vacation->start_date,
                'Конец' => $vacation->end_date,
            ]);


            return ApiService::jsonResponse('Заявка на отпуск успешна создана.', 200);
        } catch (\Exception $exception) {
            return ApiService::jsonResponse('Неизвестная ошибка.', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(VacationApplication $vacationApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VacationApplication $vacationApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VacationApplication $vacationApplication)
    {
        //
    }
}
