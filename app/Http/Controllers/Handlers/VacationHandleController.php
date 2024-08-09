<?php

namespace App\Http\Controllers\Handlers;

use App\Http\Controllers\Controller;
use App\Mail\Vacation\VacationToHeadMail;
use App\Models\Applications\VacationApplication;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VacationHandleController extends Controller
{
    public function accept(VacationApplication $vacation, Request $request)
    {
        $already = true;
        if ($vacation->status == 'На рассмотрении') {
            if ($request->get('type') == 'hr') {
                $status = $request->get('status');
                $vacation->status = config('statuses.applications')[$status];
                $vacation->save();

                $already = false;
            } else {
                $vacation->approved_with_head = true;
                $vacation->save();

                Mail::to(MailService::getMailAddresses('vacation_to_head'))->send(new VacationToHeadMail($vacation));

                $already = false;
            }
        }



        return view('vacation-status', compact('vacation', 'already'));
    }

    public function decline(VacationApplication $vacation, Request $request)
    {
        $already = true;
        if ($vacation->status == 'На рассмотрении') {
//            abort(403, "Решение по заявке уже принято: {$vacation->status}");
            $status = $request->get('status');
            $vacation->status = config('statuses.applications')[$status];
            $vacation->save();

            $already = false;
        }

        return view('vacation-status', compact('vacation', 'already'));
    }

    private function hrAccept()
    {

    }

    private function headAccept()
    {

    }
}
