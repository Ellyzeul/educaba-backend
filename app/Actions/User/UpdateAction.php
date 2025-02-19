<?php

namespace App\Actions\User;

use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;

class UpdateAction
{
  public function handle(UpdateUserRequest $request)
  {
    $user = (new UserRepository)->update($request->validated(), $request->user()->organization_id);

    if(!$user) {
      return response([
        'message' => __('messages.action.user.update.not_found'),
      ], Response::HTTP_BAD_REQUEST);
    }

    return $user;
  }
}
