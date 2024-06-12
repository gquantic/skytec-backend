<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Services\UserBirthdayService;
use Illuminate\Http\Request;

class UserBirthdayController extends Controller
{
    protected UserBirthdayService $userBirthdayService;

    public function __construct(UserBirthdayService $userBirthdayService)
    {
        $this->userBirthdayService = $userBirthdayService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->userBirthdayService->getUpcomingBirthdays();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
