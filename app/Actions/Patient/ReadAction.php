<?php

namespace App\Actions\Patient;

use App\Http\Requests\ReadPatientRequest;
use App\Repositories\PatientRepository;

class ReadAction
{
  public function handle(ReadPatientRequest $request)
  {
    return (new PatientRepository)->list($request->user()->organization_id);
  }
}