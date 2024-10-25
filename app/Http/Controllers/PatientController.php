<?php

namespace App\Http\Controllers;

use App\Actions\Patient\CreateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePatientRequest;

class PatientController extends Controller
{
    public function create(CreatePatientRequest $request)
    {
        return (new CreateAction)->handle($request);
    }
}
