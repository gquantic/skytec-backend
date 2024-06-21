<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\BirthdayCongration;
use App\Models\BirthdayCongrats;
use App\Models\User;
use App\Services\ApiService;
use App\Services\UserBirthdayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function today()
    {
        return $this->userBirthdayService->getTodayBirthdays();
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'message' => 'string|nullable',
            'surprise' => 'string|nullable',
            'anonymous' => 'boolean|nullable',
        ]);

        $birthdayCongrats = new BirthdayCongrats();
        $birthdayCongrats->user_id = Auth::id();
        $birthdayCongrats->to_id = $data['user_id'];
        $birthdayCongrats->message = $data['message'] ?? '';
        $birthdayCongrats->surprise = $data['surprise'] ?? 'none';
        $birthdayCongrats->anonymous = boolval($data['anonymous'] ?? false);
        $birthdayCongrats->save();

        return ApiService::jsonResponse('Поздравление отправлено.');
    }

    public function congrats(Request $request)
    {
        return Auth::user()->congrats;
    }
}
