<?php

namespace App\Http\Controllers;

use App\Actions\Patient\CreateAction;
use App\Actions\Patient\DeleteAction;
use App\Actions\Patient\ReadAction;
use App\Actions\Patient\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\DeletePatientRequest;
use App\Http\Requests\ReadPatientRequest;
use App\Http\Requests\UpdatePatientRequest;

class PatientController extends Controller
{
    public function create(CreatePatientRequest $request)
    {
        return (new CreateAction)->handle($request);
    }

    public function read(ReadPatientRequest $request)
    {
        return (new ReadAction)->handle($request);
    }

    public function update(UpdatePatientRequest $request)
    {
        return (new UpdateAction)->handle($request);
    }

    public function delete(DeletePatientRequest $request)
    {
        return (new DeleteAction)->handle($request);
    }
}
