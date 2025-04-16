<?php

namespace App\Actions\ProgramSetStatus;

use App\Http\Requests\UpdateProgramSetStatusRequest;
use App\Repositories\ProgramSetStatusRepository;
use Illuminate\Http\Response;

class UpdateAction
{
  public function handle(UpdateProgramSetStatusRequest $request)
  {
    $data = $request->validated();

    $programSetStatus = (new ProgramSetStatusRepository)->update([
      'name' => $data['name'],
    ], $request->user()->organization_id);

    if(!$programSetStatus) {
      return response([
        'message' => __('messages.action.program_set_status.update.not_found'),
      ], Response::HTTP_BAD_REQUEST);
    }

    return $programSetStatus;
  }
}