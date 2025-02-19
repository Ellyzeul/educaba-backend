<?php

namespace App\Actions\User;

use App\Http\Requests\ChangeUserPasswordRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;

class ChangePasswordAction
{
  public function handle(ChangeUserPasswordRequest $request)
  {
    $user = (new UserRepository)->update($request->validated(), $request->user()->organization_id);

    if(!$user) {
      return response([
        'message' => __('messages.action.user.change_password.not_found'),
      ], Response::HTTP_BAD_REQUEST);
    }

    return [
      'message' => __('messages.action.user.change_password.ok'),
    ];
  }
}
