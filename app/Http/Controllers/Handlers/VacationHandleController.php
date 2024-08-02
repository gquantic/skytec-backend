<?php

namespace App\Http\Controllers\Handlers;

use App\Http\Controllers\Controller;
use App\Models\Applications\VacationApplication;
use Illuminate\Http\Request;

class VacationHandleController extends Controller
{
    public function accept(VacationApplication $vacation, Request $request)
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
}
