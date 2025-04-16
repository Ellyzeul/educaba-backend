<?php

namespace App\Actions\Application;

use App\Http\Requests\CreateApplicationRequest;
use App\Repositories\ApplicationRepository;

class CreateAction
{
  public function handle(CreateApplicationRequest $request)
  {
    $data = $request->validated();

    $application = (new ApplicationRepository)->create([
      'program_id' => $data['program_id'],
      'goal_id' => $data['goal_id'],
      'inputs' => $data['inputs'],
    ], $data['program_id']);

    return $application;
  }
}
