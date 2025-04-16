<?php

namespace App\Actions\ProgramSetStatus;

use App\Http\Requests\ReadProgramSetStatusRequest;
use App\Repositories\ProgramSetStatusRepository;

class ReadAction
{
  public function handle(ReadProgramSetStatusRequest $request)
  {
    return (new ProgramSetStatusRepository)->list($request->user()->organization_id);
  }
}