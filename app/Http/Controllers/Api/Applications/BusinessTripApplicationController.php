<?php

namespace App\Http\Controllers\Api\Applications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Applications\BusinessTripApplicationStoreRequest;
use App\Models\Applications\BusinessTripApplication;
use App\Services\ApiService;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessTripApplicationController extends Controller
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
    public function store(BusinessTripApplicationStoreRequest $request)
    {
        try {
            $businessTrip = BusinessTripApplication::query()->create(array_merge(
                $request->all(),
                [
                    'user_id' => Auth::id()
                ]
            ));

            MailService::sendForm('trip_mail', 'Заявка на командировку', [
                'Ф.И.О. сотрудника' => $businessTrip->user->name,
                'Начало' => $businessTrip->start_date,
                'Конец' => $businessTrip->end_date,
            ]);

            return ApiService::jsonResponse('Заявка на командировку успешна создана.', 200);
        } catch (\Exception $exception) {
            return ApiService::jsonResponse('Неизвестная ошибка.', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BusinessTripApplication $businessTripApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BusinessTripApplication $businessTripApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BusinessTripApplication $businessTripApplication)
    {
        //
    }
}
