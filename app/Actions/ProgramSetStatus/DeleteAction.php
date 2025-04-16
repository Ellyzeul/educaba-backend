<?php

namespace App\Actions\ProgramSetStatus;

use App\Http\Requests\DeleteProgramSetStatusRequest;
use App\Models\ProgramSet;
use App\Repositories\ProgramSetStatusRepository;
use Illuminate\Http\Response;

class DeleteAction
{
  public function handle(DeleteProgramSetStatusRequest $request)
  {
    if(ProgramSet::where('program_set_status_id', $request->id)->exists()) return response([
      'message' => __('messages.action.program_set_status.delete.in_use'),
    ], Response::HTTP_BAD_REQUEST);

    return (new ProgramSetStatusRepository)->delete($request->id, $request->user()->organization_id)
      ? response(['message' => __('messages.action.program_set_status.delete.ok')])
      : response(['message' => __('messages.action.program_set_status.delete.not_found')]);
  }
}