<?php

namespace App\Actions\Application;

use App\Http\Requests\DeleteApplicationRequest;
use App\Repositories\ApplicationRepository;
use Illuminate\Http\Response;

class DeleteAction
{
  public function handle(DeleteApplicationRequest $request)
  {
    return (new ApplicationRepository)->delete($request->id, $request->program_id)
      ? response(['message' => __('messages.action.application.delete.ok')], Response::HTTP_OK)
      : response(['message' => __('messages.action.application.delete.not_found')], Response::HTTP_BAD_REQUEST);
  }
}