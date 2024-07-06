<?php

namespace App\Http\Controllers\Api\Requests;

use App\Http\Controllers\Controller;
use App\Mail\Form\FormMail;
use App\Models\Requests\AxoRequest;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AxoRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'location' => 'required|string',
            'request' => 'required|string',
        ]);

        $data['user_id'] = Auth::id();

        $axoRequest = new AxoRequest();
        $axoRequest->fill($data);
        $axoRequest->save();

        Mail::to(app_config()->get('axo_mail', 'gapurovichi@yandex.ru', 'gapurovichi@yandex.ru'))
            ->send(new FormMail($axoRequest));

        return ApiService::jsonResponse('Заявка успешно создана.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AxoRequest $axoRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AxoRequest $axoRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AxoRequest $axoRequest)
    {
        //
    }
}
