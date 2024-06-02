<?php

namespace App\Http\Controllers\Api\Applications;

use App\Http\Controllers\Controller;
use App\Repositories\ApplicationsRepository;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    protected ApplicationsRepository $applicationsRepository;

    public function __construct(ApplicationsRepository $applicationsRepository)
    {
        $this->applicationsRepository = $applicationsRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->applicationsRepository->getAllApplications();
    }
}
