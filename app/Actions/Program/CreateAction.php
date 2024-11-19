<?php

namespace App\Actions\Program;

use App\Http\Requests\CreateProgramRequest;

class CreateAction
{
  public function handle(CreateProgramRequest $request)
  {
    $data = $request->validated();

    return;
  }
}
