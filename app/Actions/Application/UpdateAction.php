<?php

namespace App\Actions\Application;

use App\Http\Requests\UpdateApplicationRequest;
use App\Repositories\ApplicationRepository;
use Illuminate\Http\Response;

class UpdateAction
{
  public function handle(UpdateApplicationRequest $request)
  {
    $data = $request->validated();

    $application = (new ApplicationRepository)->update([
      'inputs' => $data['inputs'],
    ], $data['program_id']);

    if(!$application) {
      return response([
        'message' => __('messages.action.application.update.not_found'),
      ], Response::HTTP_BAD_REQUEST);
    }

    return $application;
  }
}