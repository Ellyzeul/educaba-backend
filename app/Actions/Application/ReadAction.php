<?php

namespace App\Actions\Application;

use App\Http\Requests\ReadApplicationRequest;
use App\Repositories\ApplicationRepository;

class ReadAction
{
  public function handle(ReadApplicationRequest $request)
  {
    return (new ApplicationRepository)->list($request->program_id)->values();
  }
}