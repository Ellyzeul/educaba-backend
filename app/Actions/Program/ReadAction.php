<?php

namespace App\Actions\Program;

use App\Http\Requests\ReadProgramRequest;
use App\Repositories\ProgramRepository;

class ReadAction
{
  public function handle(ReadProgramRequest $request)
  {
    return (new ProgramRepository)->list($request->input('patient_id'));
  }
}
