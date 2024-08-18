<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Documents\Document;
use App\Models\Documents\Instruction;
use App\Models\Documents\VacationApplicationDocument;

class DocumentController extends Controller
{
    public function index(string $company)
    {
        return Document::query()->where('company', $company)->get();
    }

    public function vacations(string $company)
    {
        return VacationApplicationDocument::query()->where('company', $company)->get();
    }

    public function instructions()
    {
        return Instruction::query()->get();
    }
}
