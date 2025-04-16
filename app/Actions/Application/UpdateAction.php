<?php

namespace App\Actions\Application;

use App\Http\Requests\UpdateApplicationRequest;
use App\Repositories\ApplicationRepository;

class UpdateAction
{
  public function handle(UpdateApplicationRequest $request)
  {
    $repository = new ApplicationRepository();
    $data = $request->validated();

    $repository->update([
      'inputs' => $data['inputs'],
    ], $data['program_id']);

    return $repository->find($data['id'], $data['program_id']);
  }
}