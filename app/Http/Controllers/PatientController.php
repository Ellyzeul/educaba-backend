<?php

namespace App\Http\Controllers;

use App\Actions\Patient\CreateAction;
use App\Actions\Patient\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdatePatientRequest;

class PatientController extends Controller
{
    public function create(CreatePatientRequest $request)
    {
        return (new CreateAction)->handle($request);
    }

    public function update(UpdatePatientRequest $request)
    {
        return (new UpdateAction)->handle($request);
    }
}
