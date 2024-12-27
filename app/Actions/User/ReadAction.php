<?php

namespace App\Actions\User;

use App\Http\Requests\ReadUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;

class ReadAction
{
  public function handle(ReadUserRequest $request)
  {
    return (new UserRepository)
      ->list($request->user()->organization_id)
      ->map(function(User $user) {
        $user->setHidden(['organization', 'organization_id']);

        return $user;
      });
  }
}
