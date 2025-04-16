<?php

namespace App\Actions\ProgramSetStatus;

use App\Http\Requests\CreateProgramSetStatusRequest;
use App\Repositories\ProgramSetStatusRepository;

class CreateAction
{
  public function handle(CreateProgramSetStatusRequest $request)
  {
    $data = $request->validated();
    $organizationId = $request->user()->organization_id;

    return (new ProgramSetStatusRepository)->create([
      'name' => $data['name'],
      'organization_id' => $organizationId,
    ], $organizationId);
  }
}