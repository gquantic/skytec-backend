<?php

namespace App\Http\Controllers\Api\Requests;

use App\Http\Controllers\Controller;
use App\Models\Requests\AxoRequest;
use App\Models\Requests\HelpDeskRequest;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelpDeskRequestController extends Controller
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
    public function store(Request $request)
    {
        $data = $request->validate([
            'location' => 'required|string',
            'request' => 'required|string',
        ]);

        $data['user_id'] = Auth::id();

        $helpDeskRequest = new HelpDeskRequest();
        $helpDeskRequest->fill($data);
        $helpDeskRequest->save();

        return ApiService::jsonResponse('Заявка успешно создана.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HelpDeskRequest $helpDeskRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HelpDeskRequest $helpDeskRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HelpDeskRequest $helpDeskRequest)
    {
        //
    }
}
