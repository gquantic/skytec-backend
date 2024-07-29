<?php

namespace App\Http\Controllers\Api\Applications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Applications\EducationApplicationStoreRequest;
use App\Models\Applications\EducationApplication;
use App\Models\Education;
use App\Services\ApiService;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationApplicationController extends Controller
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
    public function store(EducationApplicationStoreRequest $request)
    {
        try {
            $education = EducationApplication::query()->create(array_merge(
                $request->all(),
                [
                    'user_id' => Auth::id()
                ]
            ));

            MailService::sendForm('education_mail', 'Заявка на обучение', [
                'Ф.И.О. сотрудника' => $education->user->name,
                'Обучение' => $education->education->title,
                'Дата' => $education->date,
                'Комментарий' => $education->comment,
            ]);

            return ApiService::jsonResponse('Заявка на командировку успешна создана.', 200);
        } catch (\Exception $exception) {
            return ApiService::jsonResponse($exception->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EducationApplication $educationApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EducationApplication $educationApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EducationApplication $educationApplication)
    {
        //
    }
}
