<?php

namespace App\Http\Controllers\Api;

use App\Events\BusinessIdeaSend;
use App\Http\Controllers\Controller;
use App\Models\BusinessIdea;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class BusinessIdeaController extends Controller
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
        try {
            $data = $request->all();

            if (!isset($data['anonymous']) || boolval($data['anonymous']) === false) {
                $data['user_id'] = Auth::id();
            } else {
                $data['user_id'] = null;
                $data['name'] = 'Аноним';
            }

            $businessIdea = BusinessIdea::query()->create($data);

            event(new BusinessIdeaSend($businessIdea));

            return ApiService::jsonResponse($businessIdea);
        } catch (\Exception $exception) {
            return ApiService::jsonResponse($exception->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
